<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Meeting;
use App\Models\MeetingTime;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentChannel;
use App\Models\ReserveMeeting;
use App\Models\Sale;
use App\Models\Setting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function reserve(Request $request)
    {
        $user = auth()->user();

        if (!empty($user)) {

            $timeId = $request->input('time');
            $day = $request->input('day');
            $studentCount = $request->get('student_count', 1);
            $selectedMeetingType = $request->get('meeting_type', 'online');
            $description = $request->get('description');

            if (empty($studentCount)) {
                $studentCount = 1;
            }

            if (!in_array($selectedMeetingType, ['in_person', 'online'])) {
                $selectedMeetingType = 'online';
            }

            if (!empty($timeId)) {
                $meetingTime = MeetingTime::where('id', $timeId)
                    ->with('meeting')
                    ->first();

                if (!empty($meetingTime)) {
                    $meeting = $meetingTime->meeting;

                    if ($meeting->creator_id == $user->id) {
                        $toastData = [
                            'title' => 'Permintaan gagal',
                            'msg' => 'Anda tidak dapat membuat janji temu',
                            'status' => 'error'
                        ];
                        return response()->json($toastData);
                    }

                    if (!empty($meeting) and !$meeting->disabled) {
                        if (!empty($meeting->amount) and $meeting->amount > 0) {

                            $reserveMeeting = ReserveMeeting::where('meeting_time_id', $meetingTime->id)
                                ->where('day', $day)
                                ->first();

                            if (!empty($reserveMeeting) and $reserveMeeting->locked_at) {
                                $toastData = [
                                    'title' => 'Permintaan gagal',
                                    'msg' => 'Akses ditolak, waktu ini tidak tersedia!',
                                    'status' => 'error'
                                ];
                                return response()->json($toastData);
                            }

                            if (!empty($reserveMeeting) and $reserveMeeting->reserved_at) {
                                $toastData = [
                                    'title' => 'Permintaan gagal',
                                    'msg' => 'Akses ditolak, waktu ini sudah dipesan!',
                                    'status' => 'error'
                                ];
                                return response()->json($toastData);
                            }

                            $hourlyAmountResult = $this->handleHourlyMeetingAmount($meeting, $meetingTime, $studentCount, $selectedMeetingType);

                            if (!$hourlyAmountResult['status']) {
                                return $hourlyAmountResult['result']; // json response
                            }

                            $hourlyAmount = $hourlyAmountResult['result'];

                            $explodetime = explode('-', $meetingTime->time);

                            $hours = (strtotime($explodetime[1]) - strtotime($explodetime[0])) / 3600;

                            $instructorTimezone = $meeting->getTimezone();

                            $startAt = $this->handleUtcDate($day, $explodetime[0], $instructorTimezone);
                            $endAt = $this->handleUtcDate($day, $explodetime[1], $instructorTimezone);

                            $reserveMeeting = ReserveMeeting::updateOrCreate([
                                'user_id' => $user->id,
                                'meeting_time_id' => $meetingTime->id,
                                'meeting_id' => $meetingTime->meeting_id,
                                'status' => ReserveMeeting::$pending,
                                'day' => $day,
                                'meeting_type' => $selectedMeetingType,
                                'student_count' => $studentCount
                            ], [
                                'date' => strtotime($day),
                                'start_at' => $startAt,
                                'end_at' => $endAt,
                                'paid_amount' => (!empty($hourlyAmount) and $hourlyAmount > 0) ? $hourlyAmount * $hours : 0,
                                'discount' => $meetingTime->meeting->discount,
                                'description' => $description,
                                'created_at' => time(),
                            ]);

                            $cart = Cart::where('creator_id', $user->id)
                                ->where('reserve_meeting_id', $reserveMeeting->id)
                                ->first();

                            if (empty($cart)) {
                                Cart::create([
                                    'creator_id' => $user->id,
                                    'reserve_meeting_id' => $reserveMeeting->id,
                                    'created_at' => time()
                                ]);
                            }

                            $toastData = [
                                'status' => 'success',
                                'title' => 'Permintaan berhasil',
                                'msg' => 'Rapat berhasil ditambahkan',
                                'redirect' => '/cart'
                            ];
                            return response()->json($toastData);
                        } else {
                            return $this->handleFreeMeetingReservation($user, $meeting, $meetingTime, $day, $selectedMeetingType, $studentCount);
                        }
                    } else {
                        $toastData = [
                            'title' => 'Permintaan gagal',
                            'msg' => 'Rapat dinonaktifkan.',
                            'status' => 'error'
                        ];
                        return response()->json($toastData);
                    }
                }
            }

            $toastData = [
                'title' => 'Permintaan gagal',
                'msg' => 'Silakan pilih waktu untuk memesan.',
                'status' => 'error'
            ];
            return response()->json($toastData);
        }

        $toastData = [
            'title' => 'Permintaan gagal',
            'msg' => 'Silahkan masuk untuk mengakses materi.',
            'status' => 'error'
        ];
        return response()->json($toastData);
    }

    private function handleUtcDate($day, $clock, $instructorTimezone)
    {
        $date = $day . ' ' . $clock;

        $utcDate = convertTimeToUTCzone($date, $instructorTimezone);

        return $utcDate->getTimestamp();
    }

    private function handleHourlyMeetingAmount(Meeting $meeting, MeetingTime $meetingTime, $studentCount, $selectedMeetingType)
    {
        if (empty($studentCount)) {
            $studentCount = 1;
        }

        $status = true;
        $hourlyAmount = $meeting->amount;

        if ($selectedMeetingType == 'in_person' and in_array($meetingTime->meeting_type, ['in_person', 'all'])) {
            if ($meeting->in_person) {
                $hourlyAmount = $meeting->in_person_amount;
            } else {
                $toastData = [
                    'status' => 'error',
                    'title' => 'Permintaan gagal',
                    'msg' => 'Pertemuan tatap muka tidak tersedia',
                ];
                $hourlyAmount = response()->json($toastData);
                $status = false;
            }
        }

        if ($meeting->group_meeting and $status) {
            $types = ['in_person', 'online'];

            foreach ($types as $type) {
                if ($selectedMeetingType == $type and in_array($meetingTime->meeting_type, ['all', $type])) {

                    $meetingMaxVar = $type . '_group_max_student';
                    $meetingMinVar = $type . '_group_min_student';
                    $meetingAmountVar = $type . '_group_amount';

                    if ($studentCount < $meeting->$meetingMinVar) {
                        $hourlyAmount = $hourlyAmount * $studentCount;
                    } else if ($studentCount > $meeting->$meetingMaxVar) {
                        $toastData = [
                            'status' => 'error',
                            'title' => 'Permintaan gagal',
                            'msg' => 'Kapasitas pertemuan kelompok maksimum adalah' . ' ' . $meeting->$meetingMaxVar,
                        ];
                        $hourlyAmount = response()->json($toastData);
                        $status = false;
                    } else if ($studentCount >= $meeting->$meetingMinVar and $studentCount <= $meeting->$meetingMaxVar) {
                        $hourlyAmount = $meeting->$meetingAmountVar * $studentCount;
                    }
                }
            }
        }

        return [
            'status' => $status,
            'result' => $hourlyAmount
        ];
    }

    private function handleFreeMeetingReservation($user, $meeting, $meetingTime, $day, $selectedMeetingType, $studentCount)
    {
        $instructorTimezone = $meeting->getTimezone();
        $explodetime = explode('-', $meetingTime->time);

        $startAt = $this->handleUtcDate($day, $explodetime[0], $instructorTimezone);
        $endAt = $this->handleUtcDate($day, $explodetime[1], $instructorTimezone);

        $reserve = ReserveMeeting::updateOrCreate([
            'user_id' => $user->id,
            'meeting_time_id' => $meetingTime->id,
            'meeting_id' => $meetingTime->meeting_id,
            'status' => ReserveMeeting::$pending,
            'day' => $day,
            'meeting_type' => $selectedMeetingType,
            'student_count' => $studentCount
        ], [
            'date' => strtotime($day),
            'start_at' => $startAt,
            'end_at' => $endAt,
            'paid_amount' => 0,
            'discount' => $meetingTime->meeting->discount,
            'created_at' => time(),
        ]);

        if (!empty($reserve)) {
            $sale = Sale::create([
                'buyer_id' => $user->id,
                'seller_id' => $meeting->creator_id,
                'meeting_id' => $meeting->id,
                'type' => Sale::$meeting,
                'payment_method' => Sale::$credit,
                'amount' => 0,
                'total_amount' => 0,
                'created_at' => time(),
            ]);

            if (!empty($sale)) {
                $reserve->update([
                    'sale_id' => $sale->id,
                    'reserved_at' => time()
                ]);
            }
        }

        $toastData = [
            'title' => '',
            'msg' => 'Anda berhasil mencadangkan rapat',
            'status' => 'success'
        ];
        return response()->json($toastData);
    }
}
