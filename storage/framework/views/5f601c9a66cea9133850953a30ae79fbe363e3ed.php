<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/daterangepicker/daterangepicker.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <h2 class="section-title">
            Statistik pertemuan</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/49.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-dark-blue mt-5"><?php echo e($pendingReserveCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500">pertemuan tertunda</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/50.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-dark-blue mt-5"><?php echo e($totalReserveCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Total pertemuan</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/38.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-dark-blue mt-5"><?php echo e(addCurrencyToPrice($sumReservePaid)); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Jumlah penjualan</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/hours.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold text-dark-blue mt-5"><?php echo e(convertMinutesToHourAndMinute($activeHoursCount / 60)); ?></strong>
                        <span class="font-16 text-gray font-weight-500">
                            Jam aktif</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-25">
        <h2 class="section-title">Filter pertemuan</h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="/panel/meetings/requests" method="get" class="row">
                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="input-label">Dari</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="dateInputGroupPrepend">
                                            <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="from" autocomplete="off" class="form-control <?php if(!empty(request()->get('from'))): ?> datepicker <?php else: ?> datefilter <?php endif; ?>"
                                           aria-describedby="dateInputGroupPrepend" value="<?php echo e(request()->get('from','')); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="input-label">Sampai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="dateInputGroupPrepend">
                                            <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="to" autocomplete="off" class="form-control <?php if(!empty(request()->get('to'))): ?> datepicker <?php else: ?> datefilter <?php endif; ?>"
                                           aria-describedby="dateInputGroupPrepend" value="<?php echo e(request()->get('to','')); ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label class="input-label">Hari</label>
                                <select class="form-control" id="day" name="day">
                                    <option value="all">Semua hari</option>
                                    <option value="saturday" <?php echo e(request()->get('day') === "saturday" ? 'selected' : ''); ?>>Sabtu</option>
                                    <option value="sunday" <?php echo e(request()->get('day') === "sunday" ? 'selected' : ''); ?>>Minggu</option>
                                    <option value="monday" <?php echo e(request()->get('day') === "monday" ? 'selected' : ''); ?>>Senin</option>
                                    <option value="tuesday" <?php echo e(request()->get('day') === "tuesday" ? 'selected' : ''); ?>>Selasa</option>
                                    <option value="wednesday" <?php echo e(request()->get('day') === "wednesday" ? 'selected' : ''); ?>>Rabu</option>
                                    <option value="thursday" <?php echo e(request()->get('day') === "thursday" ? 'selected' : ''); ?>>Kamis</option>
                                    <option value="friday" <?php echo e(request()->get('day') === "friday" ? 'selected' : ''); ?>>Jum'at</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-lg-8">
                                    <div class="form-group">
                                        <label class="input-label">Peserta</label>
                                        <select name="student_id" class="form-control select2 ">
                                            <option value="all">Semua peserta</option>

                                            <?php $__currentLoopData = $usersReservedTimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($student->id); ?>" <?php if(request()->get('student_id') == $student->id): ?> selected <?php endif; ?>><?php echo e($student->full_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="form-group">
                                        <label class="input-label">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option>Semua</option>
                                            <option value="open" <?php echo e((request()->get('status') === "open") ? 'selected' : ''); ?>>Terbuka</option>
                                            <option value="finished" <?php echo e((request()->get('status') === "finished") ? 'selected' : ''); ?>>Selesai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-2 d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Lihat hasil</button>
                </div>
            </form>
        </div>
    </section>


    <section class="mt-35">
        <form action="/panel/meetings/requests?<?php echo e(http_build_query(request()->all())); ?>" method="get" class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Daftar permintaan pertemuan</h2>

            <div class="d-flex align-items-center flex-row-reverse flex-md-row justify-content-start justify-content-md-center mt-20 mt-md-0">
                <label class="cursor-pointer mb-0 mr-10 text-gray font-14 font-weight-500" for="openMeetingResult">Hanya tampilkan pertemuan terbuka</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="open_meetings" <?php echo e((request()->get('open_meetings', '') == 'on') ? 'checked' : ''); ?> class="js-panel-list-switch-filter custom-control-input" id="openMeetingResult">
                    <label class="custom-control-label" for="openMeetingResult"></label>
                </div>
            </div>
        </form>

        <?php if($reserveMeetings->count() > 0): ?>

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <th class="text-center">Peserta</th>
                                    <th class="text-center">Jenis pertemuan</th>
                                    <th class="text-center">Hari</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Waktu</th>
                                    <th class="text-center">Jumlah pembayaran</th>
                                    <th class="text-center">Peserta</th>
                                    <th class="text-center">Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $reserveMeetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ReserveMeeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-left">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200">
                                                    <img src="<?php echo e($ReserveMeeting->user->getAvatar()); ?>" class="img-cover" alt="">
                                                </div>
                                                <div class=" ml-5">
                                                    <span class="d-block font-weight-500"><?php echo e($ReserveMeeting->user->full_name); ?></span>
                                                    <span class="mt-5 font-12 text-gray d-block"><?php echo e($ReserveMeeting->user->email); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="font-weight-500"><?php echo e($ReserveMeeting->meeting_type); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="font-weight-500"><?php echo e(dateTimeFormat($ReserveMeeting->start_at, 'D')); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <span><?php echo e(dateTimeFormat($ReserveMeeting->start_at, 'j M Y')); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-inline-flex align-items-center rounded bg-gray200 py-5 px-15 font-14 font-weight-500">
                                                <span class=""><?php echo e(dateTimeFormat($ReserveMeeting->start_at, 'H:i')); ?></span>
                                                <span class="mx-1">-</span>
                                                <span class=""><?php echo e(dateTimeFormat($ReserveMeeting->end_at, 'H:i')); ?></span>
                                            </div>
                                        </td>

                                        <td class="font-weight-500 align-middle"><?php echo e(addCurrencyToPrice($ReserveMeeting->paid_amount)); ?></td>

                                        <td class="align-middle font-weight-500">
                                            <?php echo e($ReserveMeeting->student_count ?? 1); ?>

                                        </td>

                                        <td class="align-middle">
                                            <?php switch($ReserveMeeting->status):
                                                case (\App\Models\ReserveMeeting::$pending): ?>
                                                <span class="font-weight-500">Tertunda</span>
                                                <?php break; ?>
                                                <?php case (\App\Models\ReserveMeeting::$open): ?>
                                                <span class="text-primary font-weight-500">Terbuka</span>
                                                <?php break; ?>
                                                <?php case (\App\Models\ReserveMeeting::$finished): ?>
                                                <span class="font-weight-500">Selesai</span>
                                                <?php break; ?>
                                                <?php case (\App\Models\ReserveMeeting::$canceled): ?>
                                                <span class="font-weight-500">Dibatalkan</span>
                                                <?php break; ?>
                                            <?php endswitch; ?>
                                        </td>

                                        <td class="align-middle text-right">
                                            <?php if($ReserveMeeting->status != \App\Models\ReserveMeeting::$finished): ?>
                                                <input type="hidden" class="js-meeting-password-<?php echo e($ReserveMeeting->id); ?>" value="<?php echo e($ReserveMeeting->password); ?>">
                                                <input type="hidden" class="js-meeting-link-<?php echo e($ReserveMeeting->id); ?>" value="<?php echo e($ReserveMeeting->link); ?>">


                                                <div class="btn-group dropdown table-actions">
                                                    <button type="button" class="btn-transparent dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <i data-feather="more-vertical" height="20"></i>
                                                    </button>
                                                    <div class="dropdown-menu menu-lg">
                                                        <?php if($ReserveMeeting->meeting_type != 'in_person' and !empty($ReserveMeeting->link) and $ReserveMeeting->status == \App\Models\ReserveMeeting::$open): ?>
                                                            <button type="button" data-reserve-id="<?php echo e($ReserveMeeting->id); ?>"
                                                                    class="js-join-reserve btn-transparent webinar-actions d-block mt-10">Bergabung</button>
                                                        <?php endif; ?>

                                                        <a href="<?php echo e($ReserveMeeting->addToCalendarLink()); ?>" target="_blank" class="webinar-actions d-block mt-10 font-weight-normal">Tambah ke kalender</a>

                                                        <?php if($ReserveMeeting->meeting_type != 'in_person'): ?>
                                                            <button type="button" data-item-id="<?php echo e($ReserveMeeting->id); ?>"
                                                                    class="add-meeting-url btn-transparent webinar-actions d-block mt-10">Buat tautan</button>
                                                        <?php endif; ?>

                                                        <button type="button"
                                                                data-user-id="<?php echo e($ReserveMeeting->user_id); ?>"
                                                                data-item-id="<?php echo e($ReserveMeeting->id); ?>"
                                                                data-user-type="student"
                                                                class="contact-info btn-transparent webinar-actions d-block mt-10">Hubungi peserta</button>

                                                        <button type="button" data-id="<?php echo e($ReserveMeeting->id); ?>" class="webinar-actions js-finish-meeting-reserve d-block btn-transparent mt-10 font-weight-normal">Selesaikan pertemuan</button>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-30">
                <?php echo e($reserveMeetings->appends(request()->input())->links('vendor.pagination.panel')); ?>

            </div>

        <?php else: ?>
        <?php echo $__env->make(getTemplate() . '.includes.no-result',[
            'file_name' => 'meeting.png',
            'title' => ('Tidak ada permintaan pertemuan!'),
            'hint' => nl2br(('Pertemuan yang dijadwalkan akan ditampilkan dalam daftar ini.')),
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>


    <div class="d-none" id="liveMeetingLinkModal">
        <h3 class="section-title after-line font-20 text-dark-blue mb-25">
            Tambahkan tautan pertemuan</h3>

        <form action="/panel/meetings/create-link" method="post">
            <input type="hidden" name="item_id" value="">

            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <label class="input-label">Url</label>
                        <input type="text" name="link" class="form-control"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label class="input-label">Password (Opsional)</label>
                        <input type="text" name="password" class="form-control"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <p class="font-weight-500 font-12 text-gray">Anda dapat menggunakan tautan Zoom, Bigbluebutton, dll</p>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button" class="js-save-meeting-link btn btn-sm btn-primary">Simpan</button>
                <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">Tutup</button>
            </div>
        </form>
    </div>

    <?php echo $__env->make('web.default.panel.meeting.join_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/select2/select2.min.js"></script>

    <script>
        var instructor_contact_information_lang = '<?php echo e(('Informasi kontak instruktur')); ?>';
        var student_contact_information_lang = '<?php echo e(('Informasi kontak peserta')); ?>';
        var email_lang = '<?php echo e(('Email')); ?>';
        var phone_lang = '<?php echo e(('Telepon')); ?>';
        var location_lang = '<?php echo e(('Lokasi')); ?>';
        var close_lang = '<?php echo e(('Tutup')); ?>';
        var linkSuccessAdd = '<?php echo e(('Tautan pertemuan berhasil ditambahkan')); ?>';
        var linkFailAdd = '<?php echo e(('Terjadi kesalahan saat menambahkan link pertemuan')); ?>';
        var finishReserveHint = '<?php echo e(('Tindakan ini tidak dapat diurungkan.')); ?>';
        var finishReserveConfirm = '<?php echo e(('Ya, selesaikan!')); ?>';
        var finishReserveCancel = '<?php echo e(('Batalkan')); ?>';
        var finishReserveTitle = '<?php echo e(('Apakah Anda ingin menyelesaikan pertemuan?')); ?>';
        var finishReserveSuccess = '<?php echo e(('Berhasil')); ?>';
        var finishReserveSuccessHint = '<?php echo e(('Pertemuan selesai dengan sukses')); ?>';
        var finishReserveFail = '<?php echo e(('Kesalahan!')); ?>';
        var finishReserveFailHint = '<?php echo e(('Pertemuan belum selesai. Silakan hubungi dukungan.')); ?>';
    </script>

    <script src="<?php echo e(asset('')); ?>assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/js/panel/meeting/contact-info.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/js/panel/meeting/reserve_meeting.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/js/panel/meeting/requests.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/meeting/requests.blade.php ENDPATH**/ ?>