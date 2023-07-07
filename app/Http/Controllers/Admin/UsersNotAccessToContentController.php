<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersNotAccessToContentController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin_users_not_access_content_lists');

        $query = User::where('access_content', false);

        $query = $this->filters($query, $request);

        $users = $query->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => 'Daftar pengguna terbatas',
            'users' => $users,
        ];

        return view('admin.users.not_access_to_content', $data);
    }

    private function filters($query, $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $full_name = $request->get('full_name');

        $query = fromAndToDateFilter($from, $to, $query, 'created_at');

        if (!empty($full_name)) {
            $query->where('full_name', 'like', "%$full_name%");
        }

        return $query;
    }

    public function store(Request $request)
    {
        $this->authorize('admin_users_not_access_content_toggle');

        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response([
                'code' => 422,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::find($data['user_id']);

        $user->update([
            'access_content' => false
        ]);

        return response()->json([
            'code' => 200
        ]);
    }

    public function active($id)
    {
        $this->authorize('admin_users_not_access_content_toggle');

        $user = User::findOrFail($id);

        $user->update([
            'access_content' => true
        ]);

        $notifyOptions = [

        ];
        sendNotification('user_access_to_content', $notifyOptions, $user->id);

        $toastData = [
            'title' => 'Permintaan berhasil',
            'msg' => 'Akses konten diaktifkan untuk' . ' ' . $user->full_name,
            'status' => 'success'
        ];
        return back()->with(['toast' => $toastData]);
    }
}
