<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Cart;
use App\Models\ReserveMeeting;
use App\Models\Ticket;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use mysql_xdevapi\Exception;

class CartManagerController extends Controller
{
    public $cookieKey = 'carts';

    public function getCarts()
    {
        $carts = null;

        if (auth()->check()) {
            $user = auth()->user();


            $carts = $user->carts()
                ->with([
                    'webinar',
                    'bundle',
                ])
                ->get();
        } else {
            $cookieCarts = Cookie::get($this->cookieKey);

            if (!empty($cookieCarts)) {
                $cookieCarts = json_decode($cookieCarts, true);

                if (!empty($cookieCarts) and count($cookieCarts)) {
                    $carts = collect();

                    foreach ($cookieCarts as $cookieCart) {

                        if (!empty($cookieCart['item_name']) and $cookieCart['item_name'] == 'webinar_id') {
                            $webinar = Webinar::where('id', $cookieCart['item_id'])
                                ->where('private', false)
                                ->where('status', 'active')
                                ->first();

                            if (!empty($webinar)) {
                                $ticket = null;

                                if (!empty($cookieCart['ticket_id'])) {
                                    $ticket = Ticket::where('id', $cookieCart['ticket_id'])->first();
                                }

                                $item = new Cart();
                                $item->webinar_id = $webinar->id;
                                $item->webinar = $webinar;
                                $item->ticket = $ticket;

                                $carts->add($item);
                            }
                        } elseif (!empty($cookieCart['item_name']) and $cookieCart['item_name'] == 'bundle_id') {
                            $bundle = Bundle::where('id', $cookieCart['item_id'])
                                ->where('status', 'active')
                                ->first();

                            if (!empty($bundle)) {
                                $ticket = null;

                                if (!empty($cookieCart['ticket_id'])) {
                                    $ticket = Ticket::where('id', $cookieCart['ticket_id'])->first();
                                }

                                $item = new Cart();
                                $item->bundle_id = $bundle->id;
                                $item->bundle = $bundle;
                                $item->ticket = $ticket;

                                $carts->add($item);
                            }
                        }

                    }
                }
            }
        }

        return $carts;
    }

    public function storeCookieCartsToDB()
    {
        try {
            if (auth()->check()) {
                $user = auth()->user();
                $carts = Cookie::get($this->cookieKey);

                if (!empty($carts)) {
                    $carts = json_decode($carts, true);

                    if (!empty($carts)) {
                        foreach ($carts as $cart) {
                            if (!empty($cart['item_name']) and !empty($cart['item_id'])) {

                                if ($cart['item_name'] == 'webinar_id') {
                                    $this->storeUserWebinarCart($user, $cart);
                                } elseif ($cart['item_name'] == 'bundle_id') {
                                    $this->storeUserBundleCart($user, $cart);
                                }
                            }
                        }
                    }

                    Cookie::queue($this->cookieKey, null, 0);
                }
            }
        } catch (\Exception $exception) {

        }
    }

    public function storeUserWebinarCart($user, $data)
    {
        $webinar_id = $data['item_id'];
        $ticket_id = $data['ticket_id'] ?? null;

        $webinar = Webinar::where('id', $webinar_id)
            ->where('private', false)
            ->where('status', 'active')
            ->first();

        if (!empty($webinar) and !empty($user)) {
            $checkCourseForSale = checkCourseForSale($webinar, $user);

            if ($checkCourseForSale != 'ok') {
                return $checkCourseForSale;
            }

            $activeSpecialOffer = $webinar->activeSpecialOffer();

            Cart::updateOrCreate([
                'creator_id' => $user->id,
                'webinar_id' => $webinar_id,
            ], [
                'ticket_id' => $ticket_id,
                'special_offer_id' => !empty($activeSpecialOffer) ? $activeSpecialOffer->id : null,
                'created_at' => time()
            ]);

            return 'ok';
        }

        $toastData = [
            'title' => 'Permintaan gagal',
            'msg' => 'Pelatihan tidak ditemukan!',
            'status' => 'error'
        ];
        return back()->with(['toast' => $toastData]);
    }

    public function storeUserBundleCart($user, $data)
    {
        $bundle_id = $data['item_id'];
        $ticket_id = $data['ticket_id'] ?? null;

        $bundle = Bundle::where('id', $bundle_id)
            ->where('status', 'active')
            ->first();

        if (!empty($bundle) and !empty($user)) {
            $checkCourseForSale = checkCourseForSale($bundle, $user);

            if ($checkCourseForSale != 'ok') {
                return $checkCourseForSale;
            }

            $activeSpecialOffer = $bundle->activeSpecialOffer();

            Cart::updateOrCreate([
                'creator_id' => $user->id,
                'bundle_id' => $bundle_id,
            ], [
                'ticket_id' => $ticket_id,
                'special_offer_id' => !empty($activeSpecialOffer) ? $activeSpecialOffer->id : null,
                'created_at' => time()
            ]);

            return 'ok';
        }

        $toastData = [
            'title' => 'Permintaan gagal',
            'msg' => 'Pelatihan tidak ditemukan!',
            'status' => 'error'
        ];
        return back()->with(['toast' => $toastData]);
    }



    public function storeCookieCart($data)
    {
        $carts = Cookie::get($this->cookieKey);

        if (!empty($carts)) {
            $carts = json_decode($carts, true);
        } else {
            $carts = [];
        }

        $item_id = $data['item_id'];
        $item_name = $data['item_name'];

        if (empty($data['quantity'])) {
            $data['quantity'] = 1;
        }

        $carts[$item_name . '_' . $item_id] = $data;

        Cookie::queue($this->cookieKey, json_encode($carts), 30 * 24 * 60);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $this->validate($request, [
            'item_id' => 'required',
            'item_name' => 'nullable',
        ]);

        $data = $request->except('_token');
        $item_name = $data['item_name'];

        if (!empty($user)) { // store in DB
            $result = null;

            if ($item_name == 'webinar_id') {
                $result = $this->storeUserWebinarCart($user, $data);
            } elseif ($item_name == 'bundle_id') {
                $result = $this->storeUserBundleCart($user, $data);
            }

            if ($result != 'ok') {
                return $result;
            }
        } else { // store in cookie
            $this->storeCookieCart($data);
        }

        $toastData = [
            'title' => 'Berhasil Ditambahkan ke keranjang!',
            'msg' => 'Anda dapat melanjutkan berbelanja atau pergi ke keranjang untuk menyelesaikan pesanan Anda.',
            'status' => 'success'
        ];
        return back()->with(['toast' => $toastData]);
    }

    public function destroy($id)
    {
        if (auth()->check()) {
            $user_id = auth()->id();

            $cart = Cart::where('id', $id)
                ->where('creator_id', $user_id)
                ->first();

            if (!empty($cart)) {
                if (!empty($cart->reserve_meeting_id)) {
                    $reserve = ReserveMeeting::where('id', $cart->reserve_meeting_id)
                        ->where('user_id', $user_id)
                        ->first();

                    if (!empty($reserve)) {
                        $reserve->delete();
                    }
                }

                $cart->delete();
            }
        } else {
            $carts = Cookie::get($this->cookieKey);

            if (!empty($carts)) {
                $carts = json_decode($carts, true);

                if (!empty($carts[$id])) {
                    unset($carts[$id]);
                }

                Cookie::queue($this->cookieKey, json_encode($carts), 30 * 24 * 60);
            }
        }

        return response()->json([
            'code' => 200
        ], 200);
    }
}
