<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];
    static $discountUserTypes = ['all_users', 'special_users'];

    static $discountSource = ['all', 'course', 'category', 'meeting'];
    static $discountSourceAll = 'all';
    static $discountSourceCourse = 'course';
    static $discountSourceCategory = 'category';
    static $discountSourceMeeting = 'meeting';

    static $discountTypes = ['percentage', 'fixed_amount'];
    static $discountTypePercentage = 'percentage';
    static $discountTypeFixedAmount = 'fixed_amount';

    public function discountUsers()
    {
        return $this->hasOne('App\Models\DiscountUser', 'discount_id', 'id');
    }

    public function discountCourses()
    {
        return $this->hasMany('App\Models\DiscountCourse', 'discount_id', 'id');
    }

    public function discountCategories()
    {
        return $this->hasMany('App\Models\DiscountCategory', 'discount_id', 'id');
    }

    public function discountGroups()
    {
        return $this->hasMany('App\Models\DiscountGroup', 'discount_id', 'id');
    }

    public function discountRemain()
    {
        $count = $this->count;

        $orderItems = OrderItem::where('discount_id', $this->id)
            ->groupBy('order_id')
            ->get();

        foreach ($orderItems as $orderItem) {
            if (!empty($orderItem) and !empty($orderItem->order) and $orderItem->order->status == 'paid') {
                $count = $count - 1;
            }
        }

        return ($count > 0) ? $count : 0;
    }

    public function checkValidDiscount()
    {
        if ($this->expired_at < time()) {
            return 'Kupon telah kedaluwarsa.'; // expired
        }

        $user = auth()->user();
        $carts = Cart::where('creator_id', $user->id)->get();


        if ($this->source == self::$discountSourceCourse or $this->source == self::$discountSourceCategory) {
            $webinarCount = array_filter($carts->pluck('webinar_id')->toArray());

            if (empty($webinarCount) or count($webinarCount) < 1) {
                return 'Kupon ini hanya untuk pelatihan. Anda tidak memiliki pelatihan di data Anda.';
            }
        } elseif ($this->source == self::$discountSourceMeeting) {
            $meetingCount = array_filter($carts->pluck('reserve_meeting_id')->toArray());

            if (empty($meetingCount) or count($meetingCount) < 1) {
                return 'Kupon ini hanya untuk pertemuan. Anda tidak memiliki pertemuan di data Anda.';
            }
        }

        if ($this->source == self::$discountSourceCourse) {
            $discountWebinarsIds = $this->discountCourses()->pluck('course_id')->toArray();
            $hasSpecialWebinars = false;

            foreach ($carts as $cart) {
                $webinar = $cart->webinar;
                if (!empty($webinar) and in_array($webinar->id, $discountWebinarsIds)) {
                    $hasSpecialWebinars = true;
                }
            }

            if (!$hasSpecialWebinars) {
                return 'Kupon Anda tidak berlaku untuk pelatihan ini.';
            }
        }


        if ($this->source == self::$discountSourceCategory) {
            $categoriesIds = ($this->discountCategories) ? $this->discountCategories()->pluck('category_id')->toArray() : [];
            $hasSpecialCategories = false;

            foreach ($carts as $cart) {
                $webinar = $cart->webinar;
                if (!empty($webinar) and in_array($webinar->category_id, $categoriesIds)) {
                    $hasSpecialCategories = true;
                }
            }

            if (!$hasSpecialCategories) {
                return 'Kupon Anda tidak berlaku untuk kategori ini.';
            }
        }

        if ($this->type == 'special_users') {
            $userDiscount = DiscountUser::where('user_id', $user->id)
                ->where('discount_id', $this->id)
                ->first();

            if (empty($userDiscount)) {
                return 'Kupon tidak valid, pastikan sudah benar.'; // not for this user
            }
        }


        if (!empty($this->minimum_order)) { // check user orders minimum amounts
            $totalCartsPrice = Cart::getCartsTotalPrice($carts);

            if ($this->minimum_order > $totalCartsPrice) {
                return 'Jumlah minimum kupon diskon adalah' . ' ' .  $this->minimum_order; // the minimum order is less than the discount amount
            }
        }

        if (!empty($this->discountGroups) and count($this->discountGroups)) {
            $groupsIds = $this->discountGroups()->pluck('group_id')->toArray();

            if (empty($user->userGroup) or !in_array($user->userGroup->group_id, $groupsIds)) {
                return 'Kupon ini tidak berlaku untuk grup pengguna Anda.'; // this user is not in specific group
            }
        }

        if ($this->for_first_purchase) {
            $checkIsFirstPurchase = Sale::where('buyer_id', $user->id)
                ->whereNull('refund_at')
                ->count();

            if ($checkIsFirstPurchase > 0) {
                return 'Kupon ini hanya untuk pembelian pertama.'; // This discount code for first purchase.
            }
        }

        $usedCount = 0;
        $orderItems = OrderItem::where('discount_id', $this->id)
            ->groupBy('order_id')
            ->get();

        foreach ($orderItems as $orderItem) {
            if (!empty($orderItem) and !empty($orderItem->order) and $orderItem->order->status == 'paid') {
                $usedCount += 1;
            }
        }

        if ($usedCount >= $this->count) {
            return 'Kupon mencapai waktu penggunaan.'; // The number of uses of this code has expired.
        }

        return 'ok';
    }
}
