<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/chartjs/chart.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/apexcharts/apexcharts.css"/>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h1 class="section-title">Dashboard</h1>

            <?php if(!$authUser->isUser()): ?>
                <div class="d-flex align-items-center flex-row-reverse flex-md-row justify-content-start justify-content-md-center mt-20 mt-md-0">
                    <label class="mb-0 mr-10 cursor-pointer text-gray font-14 font-weight-500" for="iNotAvailable">Aktifkan status sedang offline</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="disabled" <?php if($authUser->offline): ?> checked <?php endif; ?> class="custom-control-input" id="iNotAvailable">
                        <label class="custom-control-label" for="iNotAvailable"></label>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if(!$authUser->financial_approval and !$authUser->isUser()): ?>
            <div class="p-15 mt-20 p-lg-20 not-verified-alert font-weight-500 text-dark-blue rounded-sm panel-shadow">
                Identitas dan informasi keuangan Anda tidak diverifikasi sehingga dapat menyebabkan keterlambatan dalam proses pembayaran. Silakan tentukan dari
                <a href="<?php echo e(url('/panel/setting/step/7')); ?>" class="text-decoration-underline">Pengaturan</a>.
            </div>
        <?php endif; ?>

        <div class="bg-white dashboard-banner-container position-relative px-15 px-ld-35 py-10 panel-shadow rounded-sm">
            <h2 class="font-30 text-primary line-height-1">
                <span class="d-block">Hai <?php echo e($authUser->full_name); ?>,</span>
                <span class="font-16 text-secondary font-weight-bold">Kamu memiliki <?php echo e(!empty($unReadNotifications) ? count($unReadNotifications) : 0); ?> notifikasi baru</span>
            </h2>

            <ul class="mt-15 unread-notification-lists">
                <?php if(!empty($unReadNotifications) and !$unReadNotifications->isEmpty()): ?>
                    <?php $__currentLoopData = $unReadNotifications->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unReadNotification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="font-14 mt-1 text-gray">- <?php echo e($unReadNotification->title); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(count($unReadNotifications) > 5): ?>
                        <li>&nbsp;&nbsp;...</li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>

            <a href="<?php echo e(url('/panel/notifications')); ?>" class="mt-15 font-weight-500 text-dark-blue d-inline-block">Lihat semua notifikasi</a>

            <div class="dashboard-banner">
                <img src="<?php echo e(asset(getPageBackgroundSettings('dashboard'))); ?>" alt="" class="img-cover">
            </div>
        </div>
    </section>

    <section class="dashboard">
        <div class="row">
            <div class="col-12 col-lg-3 mt-35">
                <div class="bg-white account-balance rounded-sm panel-shadow py-15 py-md-30 px-10 px-md-20">
                    <div class="text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/36.svg" class="account-balance-icon" alt="">

                        <h3 class="font-16 font-weight-500 text-gray mt-25">Saldo akun</h3>
                        <span class="mt-5 d-block font-30 text-secondary"><?php echo e(addCurrencyToPrice($authUser->getAccountingBalance())); ?></span>
                    </div>

                    <?php
                        $getFinancialSettings = getFinancialSettings();
                        $drawable = $authUser->getPayout();
                        $can_drawable = ($drawable > ((!empty($getFinancialSettings) and !empty($getFinancialSettings['minimum_payout'])) ? (int)$getFinancialSettings['minimum_payout'] : 0))
                    ?>

                    <div class="mt-20 pt-30 border-top border-gray300 d-flex align-items-center <?php if($can_drawable): ?> justify-content-between <?php else: ?> justify-content-center <?php endif; ?>">
                        <?php if($can_drawable): ?>
                            <span class="font-16 font-weight-500 text-gray">
                                Dapat ditarik:</span>
                            <span class="font-16 font-weight-bold text-secondary"><?php echo e(addCurrencyToPrice($drawable)); ?></span>
                        <?php else: ?>
                            <a href="<?php echo e(url('/panel/financial/account')); ?>" class="font-16 font-weight-bold text-dark-blue">Isi saldo akun</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-3 mt-35">
                <a href="<?php if($authUser->isUser()): ?> <?php echo e(url('/panel/webinars/purchases')); ?> <?php else: ?> <?php echo e(url('/panel/meetings/requests')); ?> <?php endif; ?>" class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center">
                    <div class="stat-icon requests">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/icons/request.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-15">
                        <span class="font-30 text-secondary"><?php echo e(!empty($pendingAppointments) ? $pendingAppointments : (!empty($webinarsCount) ? $webinarsCount : 0)); ?></span>
                        <span class="font-16 text-gray font-weight-500"><?php echo e($authUser->isUser() ? 'Pelatihan diikuti' : 'Rapat tertunda'); ?></span>
                    </div>
                </a>

                <a href="<?php if($authUser->isUser()): ?> <?php echo e(url('/panel/meetings/reservation')); ?> <?php else: ?> <?php echo e(url('/panel/financial/sales')); ?> <?php endif; ?>" class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center mt-15 mt-md-30">
                    <div class="stat-icon monthly-sales">
                        <img src="<?php if($authUser->isUser()): ?> <?php echo e(asset('')); ?>assets/default/img/icons/meeting.svg <?php else: ?> <?php echo e(asset('')); ?>assets/default/img/icons/monay.svg <?php endif; ?>" alt="">
                    </div>
                    <div class="d-flex flex-column ml-15">
                        <span class="font-30 text-secondary"><?php echo e(!empty($monthlySalesCount) ? addCurrencyToPrice($monthlySalesCount) : (!empty($reserveMeetingsCount) ? $reserveMeetingsCount : 0)); ?></span>
                        <span class="font-16 text-gray font-weight-500"><?php echo e($authUser->isUser() ? 'Rapat' : 'Penjualan bulanan'); ?></span>
                    </div>
                </a>
            </div>

            <div class="col-12 col-lg-3 mt-35">
                <a href="<?php echo e(url('/panel/support')); ?>" class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center">
                    <div class="stat-icon support-messages">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/icons/support.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-15">
                        <span class="font-30 text-secondary"><?php echo e(!empty($supportsCount) ? $supportsCount : 0); ?></span>
                        <span class="font-16 text-gray font-weight-500">Pesan dukungan</span>
                    </div>
                </a>

                <a href="<?php if($authUser->isUser()): ?> <?php echo e(url('/panel/webinars/my-comments')); ?> <?php else: ?> <?php echo e(url('/panel/webinars/comments')); ?> <?php endif; ?>" class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center mt-15 mt-md-30">
                    <div class="stat-icon comments">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/icons/comment.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-15">
                        <span class="font-30 text-secondary"><?php echo e(!empty($commentsCount) ? $commentsCount : 0); ?></span>
                        <span class="font-16 text-gray font-weight-500">Komentar</span>
                    </div>
                </a>
            </div>

            <div class="col-12 col-lg-3 mt-35">
                <div class="bg-white account-balance rounded-sm panel-shadow py-15 py-md-15 px-10 px-md-20">
                    <div data-percent="<?php echo e(!empty($nextBadge) ? $nextBadge['percent'] : 0); ?>" data-label="<?php echo e((!empty($nextBadge) and !empty($nextBadge['earned'])) ? $nextBadge['earned']->title : ''); ?>" id="nextBadgeChart" class="text-center">
                    </div>
                    <div class="mt-10 pt-10 border-top border-gray300 d-flex align-items-center justify-content-between">
                        <span class="font-16 font-weight-500 text-gray">Lencana Berikutnya:</span>
                        <span class="font-16 font-weight-bold text-secondary"><?php echo e((!empty($nextBadge) and !empty($nextBadge['badge'])) ? $nextBadge['badge']->title : 'Tidak terdifinisikan'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 mt-35">
                <div class="bg-white noticeboard rounded-sm panel-shadow py-10 py-md-20 px-15 px-md-30">
                    <h3 class="font-16 text-dark-blue font-weight-bold">Papan informasi</h3>

                    <?php $__currentLoopData = $authUser->getUnreadNoticeboards(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getUnreadNoticeboard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="noticeboard-item py-15">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h4 class="js-noticeboard-title font-weight-500 text-secondary"><?php echo truncate($getUnreadNoticeboard->title,150); ?></h4>
                                    <div class="font-12 text-gray mt-5">
                                        <span class="mr-5">Dibuat oleh <?php echo e($getUnreadNoticeboard->sender); ?></span>
                                        |
                                        <span class="js-noticeboard-time ml-5"><?php echo e(dateTimeFormat($getUnreadNoticeboard->created_at,'j M Y | H:i')); ?></span>
                                    </div>
                                </div>

                                <div>
                                    <button type="button" data-id="<?php echo e($getUnreadNoticeboard->id); ?>" class="js-noticeboard-info btn btn-sm btn-border-white">Selengkapnya</button>
                                    <input type="hidden" class="js-noticeboard-message" value="<?php echo e($getUnreadNoticeboard->message); ?>">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>

            <div class="col-12 col-lg-6 mt-35">
                <div class="bg-white monthly-sales-card rounded-sm panel-shadow py-10 py-md-20 px-15 px-md-30">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="font-16 text-dark-blue font-weight-bold"><?php echo e(($authUser->isUser()) ? 'Statistik belajar' : 'Penjualan bulanan'); ?></h3>

                        <span class="font-16 font-weight-500 text-gray"><?php echo e(dateTimeFormat(time(),'M Y')); ?></span>
                    </div>

                    <div class="monthly-sales-chart">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="d-none" id="iNotAvailableModal">
        <div class="offline-modal">
            <h3 class="section-title after-line">Aktifkan status sedang offline</h3>
            <p class="mt-20 font-16 text-gray">Jika menjadikan akun Anda offline, sebuah pesan akan ditampilkan di profil Anda dan akan diperhatikan oleh pengguna lain. Anda dapat mengetik pesan yang dipersonalisasi pada kolom berikut untuk ditampilkan pada profil.</p>

            <div class="form-group mt-15">
                <label>Pesan offline</label>
                <textarea name="message" rows="4" class="form-control "><?php echo e($authUser->offline_message); ?></textarea>
                <div class="invalid-feedback"></div>
            </div>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button" class="js-save-offline-toggle btn btn-primary btn-sm">Simpan</button>
                <button type="button" class="btn btn-danger ml-10 close-swl btn-sm">Tutup</button>
            </div>
        </div>
    </div>

    <div class="d-none" id="noticeboardMessageModal">
        <div class="text-center">
            <h3 class="modal-title font-20 font-weight-500 text-dark-blue"></h3>
            <span class="modal-time d-block font-12 text-gray mt-25"></span>
            <p class="modal-message font-weight-500 text-gray mt-4"></p>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/chartjs/chart.min.js"></script>

    <script>
        var offlineSuccess = '<?php echo e(('Status Anda berhasil diubah!')); ?>';
        var $chartDataMonths = <?php echo json_encode($monthlyChart['months'], 15, 512) ?>;
        var $chartData = <?php echo json_encode($monthlyChart['data'], 15, 512) ?>;
    </script>

    <script src="<?php echo e(asset('')); ?>assets/default/js/panel/dashboard.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/dashboard.blade.php ENDPATH**/ ?>