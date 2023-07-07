<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationTemplate extends Model
{
    protected $table = 'notification_templates';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    static $templateKeys = [
        'Email' => '[u.email]',
        'Mobile' => '[u.mobile]',
        'Nama Lengkap Pengguna' => '[u.name]',
        'Nama instruktur' => '[instructor.name]',
        'Nama peserta' => '[student.name]',
        'Grup Pengguna' => '[u.g.title]',
        'Lencana' => '[u.b.title]',
        'Judul pelatihan' => '[c.title]',
        'Judul pelatihan' => '[q.title]',
        'Hasil (Nilai)' => '[q.result]',
        'Judul Tiket Dukungan' => '[s.t.title]',
        'Judul Pesan Kontak' => '[c.u.title]',
        'Waktu & Tanggal' => '[time.date]',
        'URL' => '[link]',
        'Peringkat (Bintang)' => '[rate.count]',
        'Jumlah' => '[amount]',
        'Akun Pembayaran' => '[payout.account]',
        'Uraian Dokumen Keuangan' => '[f.d.description]',
        'Jenis Dokumen Keuangan' => '[f.d.type]',
        'Judul Paket Berlangganan' => '[s.p.name]',
        'Judul Rencana Promosi' => '[p.p.name]',
        'Judul produk' => '[p.title]',
        'Nilai Tugas' => '[assignment_grade]',
        'Judul topik' => '[topic_title]',
        'Judul blog' => '[blog_title]',
    ];

    static $notificationTemplateAssignSetting = [
        'admin' => ['new_comment_admin', 'support_message_admin', 'support_message_replied_admin', 'promotion_plan_admin', 'new_contact_message', 'payout_request_admin'],
        'user' => ['new_badge', 'change_user_group', 'user_access_to_content'],
        'course' => ['course_created', 'course_approve', 'course_reject', 'new_comment', 'support_message', 'support_message_replied', 'new_rating', 'new_question_in_forum', 'new_answer_in_forum'],
        'financial' => ['new_financial_document', 'payout_request', 'payout_proceed', 'offline_payment_request', 'offline_payment_approved', 'offline_payment_rejected'],
        'sale_purchase' => ['new_sales', 'new_purchase'],
        'plans' => ['new_subscribe_plan', 'promotion_plan'],
        'appointment' => ['new_appointment', 'new_appointment_link', 'appointment_reminder', 'meeting_finished'],
        'quiz' => ['new_certificate', 'waiting_quiz', 'waiting_quiz_result'],
        'store' => ['product_new_sale', 'product_new_purchase', 'product_new_comment', 'product_tracking_code', 'product_new_rating', 'product_receive_shipment', 'product_out_of_stock'],
        'assignment' => ['student_send_message', 'instructor_send_message', 'instructor_set_grade'],
        'topic' => ['send_post_in_topic'],
        'blog' => ['publish_instructor_blog_post', 'new_comment_for_instructor_blog_post'],
        'reminders' => ['webinar_reminder', 'meeting_reserve_reminder', 'subscribe_reminder']
    ];
}
