<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $payouts = Payout::where('user_id', $user->id)
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => 'Permintaan pembayaran',
            'payouts' => $payouts,
            'accountCharge' => $user->getAccountingCharge(),
            'readyPayout' => $user->getPayout(),
            'totalIncome' => $user->getIncome(),
        ];

        return view(getTemplate() . '.panel.financial.payout', $data);
    }

    public function requestPayout()
    {
        $user = auth()->user();
        $getUserPayout = $user->getPayout();
        $getFinancialSettings = getFinancialSettings();

        if ($getUserPayout < $getFinancialSettings['minimum_payout']) {
            $toastData = [
                'title' => 'Permintaan gagal',
                'msg' => 'Penghasilan Anda kurang dari jumlah pembayaran minimum. Harap tunggu untuk melewati batasan.',
                'status' => 'error'
            ];
            return back()->with(['toast' => $toastData]);
        }

        if (!empty($user->iban) and !empty($user->account_type)) {
            Payout::create([
                'user_id' => $user->id,
                'amount' => $getUserPayout,
                'account_name' => $user->full_name,
                'account_number' => $user->iban,
                'account_bank_name' => $user->account_type,
                'status' => Payout::$waiting,
                'created_at' => time(),
            ]);

            $notifyOptions = [
                '[payout.amount]' => $getUserPayout,
                '[u.name]' => $user->full_name
            ];

            sendNotification('payout_request', $notifyOptions, $user->id);
            sendNotification('payout_request_admin', $notifyOptions, 1); // for admin

            return back();
        }

        $toastData = [
            'title' => 'Permintaan gagal',
            'msg' => 'Silakan periksa pengaturan identitas Anda',
            'status' => 'error'
        ];
        return back()->with(['toast' => $toastData]);
    }
}
