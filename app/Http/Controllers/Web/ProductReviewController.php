<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
            'product_quality' => 'required',
            'purchase_worth' => 'required',
            'delivery_quality' => 'required',
            'seller_quality' => 'required',
        ]);

        $data = $request->all();
        $user = auth()->user();

        $product = Product::where('id', $data['product_id'])
            ->where('status', 'active')
            ->first();

        if (!empty($product)) {
            if ($product->checkUserHasBought($user)) {
                $productReview = ProductReview::where('creator_id', $user->id)
                    ->where('product_id', $product->id)
                    ->first();

                if (!empty($productReview)) {
                    $toastData = [
                        'title' => 'Permintaan gagal',
                        'msg' => 'duplikat ulasan untuk produk',
                        'status' => 'error'
                    ];
                    return back()->with(['toast' => $toastData]);
                }

                $rates = 0;
                $rates += (int)$data['product_quality'];
                $rates += (int)$data['purchase_worth'];
                $rates += (int)$data['delivery_quality'];
                $rates += (int)$data['seller_quality'];

                ProductReview::create([
                    'product_id' => $product->id,
                    'creator_id' => $user->id,
                    'product_quality' => (int)$data['product_quality'],
                    'purchase_worth' => (int)$data['purchase_worth'],
                    'delivery_quality' => (int)$data['delivery_quality'],
                    'seller_quality' => (int)$data['seller_quality'],
                    'rates' => $rates > 0 ? $rates / 4 : 0,
                    'description' => $data['description'],
                    'status' => 'pending',
                    'created_at' => time(),
                ]);

                $notifyOptions = [
                    '[p.title]' => $product->title,
                    '[u.name]' => $user->full_name,
                    '[rate.count]' => $rates > 0 ? $rates / 4 : 0
                ];
                sendNotification('product_new_rating', $notifyOptions, $product->creator_id);

                $toastData = [
                    'title' => 'Permintaan berhasil',
                    'msg' => 'Ulasan Anda berhasil dikirim dan akan diterbitkan setelah disetujui admin.',
                    'status' => 'success'
                ];
                return back()->with(['toast' => $toastData]);
            } else {
                $toastData = [
                    'title' => 'Permintaan gagal',
                    'msg' => 'Anda belum membeli produk ini',
                    'status' => 'error'
                ];
                return back()->with(['toast' => $toastData]);
            }
        }

        $toastData = [
            'title' => 'Permintaan gagal',
            'msg' => 'Pelatihan tidak ditemukan!',
            'status' => 'error'
        ];
        return back()->with(['toast' => $toastData]);
    }

    public function storeReplyComment(Request $request)
    {
        $this->validate($request, [
            'reply' => 'nullable',
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'comment' => $request->input('reply'),
            'product_review_id' => $request->input('comment_id'),
            'status' => $request->input('status') ?? Comment::$pending,
            'created_at' => time()
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        if (auth()->check()) {
            $review = ProductReview::where('id', $id)
                ->where('creator_id', auth()->id())
                ->first();

            if (!empty($review)) {
                $review->delete();

                $toastData = [
                    'title' => 'Permintaan berhasil',
                    'msg' => 'Ulasan berhasil dihapus.',
                    'status' => 'success'
                ];
                return back()->with(['toast' => $toastData]);
            }

            $toastData = [
                'title' => 'Permintaan gagal',
                'msg' => 'Anda tidak dapat memberika ulasan pada pelatihan ini.',
                'status' => 'error'
            ];
            return back()->with(['toast' => $toastData]);
        }

        abort(404);
    }
}
