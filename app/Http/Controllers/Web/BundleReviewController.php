<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Comment;
use App\Models\Webinar;
use App\Models\WebinarReview;
use Illuminate\Http\Request;

class BundleReviewController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'bundle_id' => 'required',
            'content_quality' => 'required',
            'instructor_skills' => 'required',
            'purchase_worth' => 'required',
            'support_quality' => 'required',
        ]);

        $data = $request->all();
        $user = auth()->user();

        $bundle = Bundle::where('id', $data['bundle_id'])
            ->where('status', 'active')
            ->first();

        if (!empty($bundle)) {
            if ($bundle->checkUserHasBought($user, false)) {
                $bundleReview = WebinarReview::where('creator_id', $user->id)
                    ->where('bundle_id', $bundle->id)
                    ->first();

                if (!empty($bundleReview)) {
                    $toastData = [
                        'title' => 'Permintaan gagal',
                        'msg' => 'Ulasan duplikat untuk pelatihan',
                        'status' => 'error'
                    ];
                    return back()->with(['toast' => $toastData]);
                }

                $rates = 0;
                $rates += (int)$data['content_quality'];
                $rates += (int)$data['instructor_skills'];
                $rates += (int)$data['purchase_worth'];
                $rates += (int)$data['support_quality'];

                WebinarReview::create([
                    'bundle_id' => $bundle->id,
                    'creator_id' => $user->id,
                    'content_quality' => (int)$data['content_quality'],
                    'instructor_skills' => (int)$data['instructor_skills'],
                    'purchase_worth' => (int)$data['purchase_worth'],
                    'support_quality' => (int)$data['support_quality'],
                    'rates' => $rates > 0 ? $rates / 4 : 0,
                    'description' => $data['description'],
                    'status' => 'pending',
                    'created_at' => time(),
                ]);


                /*$notifyOptions = [
                    '[c.title]' => $bundle->title,
                    '[student.name]' => $user->full_name,
                    '[rate.count]' => $rates > 0 ? $rates / 4 : 0
                ];
                sendNotification('new_rating', $notifyOptions, $bundle->teacher_id);*/

                $toastData = [
                    'title' => 'Permintaan berhasil',
                    'msg' => 'Ulasan Anda berhasil dikirim dan akan diterbitkan setelah disetujui admin.',
                    'status' => 'success'
                ];
                return back()->with(['toast' => $toastData]);
            } else {
                $toastData = [
                    'title' => 'Permintaan gagal',
                    'msg' => 'Anda belum membeli bundel ini',
                    'status' => 'error'
                ];
                return back()->with(['toast' => $toastData]);
            }
        }

        $toastData = [
            'title' => 'Permintaan gagal',
            'msg' => 'Bundel tidak tersedia',
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
            'review_id' => $request->input('comment_id'),
            'status' => $request->input('status') ?? Comment::$pending,
            'created_at' => time()
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        if (auth()->check()) {
            $review = WebinarReview::where('id', $id)
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
                'msg' => 'Anda tidak dapat memberikan ulasan pelatihan ini.',
                'status' => 'error'
            ];
            return back()->with(['toast' => $toastData]);
        }

        abort(404);
    }
}
