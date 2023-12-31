<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view(getTemplate() . '.auth.forgot_password');
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = \Illuminate\Support\Str::random(60);
        DB::table('password_resets')->insert([
            'email' => $request->input('email'),
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $generalSettings = getGeneralSettings();
        $emailData = [
            'token' => $token,
            'generalSettings' => $generalSettings,
            'email' => $request->input('email')
        ];

        Mail::send('web.default.auth.password_verify', $emailData, function ($message) use ($request) {
            $message->from(!empty($generalSettings['site_email']) ? $generalSettings['site_email'] : env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $message->to($request->input('email'));
            $message->subject('Reset Password Notification');
        });

        $toastData = [
            'title' => 'Permintaan berhasil dilakukan!',
            'msg' => 'Tautan pemulihan kata sandi dikirim ke alamat email Anda. Silakan periksa email Anda.',
            'status' => 'success'
        ];
        return back()->with(['toast' => $toastData]);
    }
}
