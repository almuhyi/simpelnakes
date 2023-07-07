<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Webinar;
use App\Models\WebinarReview;
use Illuminate\Http\Request;

class WebinarReviewController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'webinar_id' => 'required',
            'content_quality' => 'required',
            'instructor_skills' => 'required',
            'purchase_worth' => 'required',
            'support_quality' => 'required',
        ]);

        $data = $request->all();
        $user = auth()->user();

        $webinar = Webinar::where('id', $data['webinar_id'])
            ->where('status', 'active')
            ->first();

        if (!empty($webinar)) {
            if ($webinar->checkUserHasBought($user, false)) {
                $webinarReview = WebinarReview::where('creator_id', $user->id)
                    ->where('webinar_id', $webinar->id)
                    ->first();

                if (!empty($webinarReview)) {
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
                    'webinar_id' => $webinar->id,
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


                $notifyOptions = [
                    '[c.title]' => $webinar->title,
                    '[student.name]' => $user->full_name,
                    '[rate.count]' => $rates > 0 ? $rates / 4 : 0
                ];
                sendNotification('new_rating', $notifyOptions, $webinar->teacher_id);

                $toastData = [
                    'title' => 'Permintaan berhasil',
                    'msg' => 'Ulasan Anda berhasil dikirim dan akan dipublikasikan setelah disetujui admin.',
                    'status' => 'success'
                ];
                return back()->with(['toast' => $toastData]);
            } else {
                $toastData = [
                    'title' => 'Permintaan gagal',
                    'msg' => 'Anda belum membeli pelatihan ini.',
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

        $comment = Comment::create([
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
                    'msg' => 'Ulasan berhasil dihapus!',
                    'status' => 'success'
                ];
                return back()->with(['toast' => $toastData]);
            }

            $toastData = [
                'title' => 'Permintaan gagal',
                'msg' => 'Anda tidak dapat memberikan ulasan pada pelatihan ini.',
                'status' => 'error'
            ];
            return back()->with(['toast' => $toastData]);
        }

        abort(404);
    }
}
