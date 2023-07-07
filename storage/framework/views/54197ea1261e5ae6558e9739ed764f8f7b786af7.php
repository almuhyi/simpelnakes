<?php $__env->startPush('libraries_top'); ?>
    <link rel="stylesheet" href="/assets/admin/vendor/owl.carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/admin/vendor/owl.carousel/owl.theme.min.css">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


    <section class="section">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="hero text-white hero-bg-image hero-bg" data-background="<?php echo e(!empty(getPageBackgroundSettings('admin_dashboard')) ? getPageBackgroundSettings('admin_dashboard') : ''); ?>">
                    <div class="hero-inner">
                        <h2>Selamat Datang, <?php echo e($authUser->full_name); ?>!</h2>

                        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_quick_access_links')): ?>
                                <div>
                                    <p class="lead">Gunakan tombol akses dibawah untuk memudahkan mengatur relasi.</p>

                                    <div class="mt-2 mb-2 d-flex flex-column flex-md-row">
                                        <a href="/admin/comments/webinars" class="mt-2 mt-md-0 btn btn-outline-white btn-lg btn-icon icon-left ml-0 ml-md-2"><i class="far fa-comment"></i>Komentar </a>
                                        <a href="/admin/supports" class="mt-2 mt-md-0 btn btn-outline-white btn-lg btn-icon icon-left ml-0 ml-md-2"><i class="far fa-envelope"></i>Pengajuan Bantuan</a>
                                        <a href="/admin/reports/webinars" class="mt-2 mt-md-0 btn btn-outline-white btn-lg btn-icon icon-left ml-0 ml-md-2"><i class="fas fa-info"></i>Laporan</a>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_clear_cache')): ?>
                                <div class="w-xs-to-lg-100">
                                    <p class="lead d-none d-lg-block">&nbsp;</p>

                                    <?php echo $__env->make('admin.includes.delete_button',[
                                             'url' => '/admin/clear-cache',
                                             'btnClass' => 'btn btn-outline-white btn-lg btn-icon icon-left mt-2 w-100',
                                             'btnText' => 'Bersihkan cache',
                                             'hideDefaultClass' => true
                                          ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="row">

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_new_sales')): ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <a href="/admin/financial/sales" class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pelatihan</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($getNewSalesCount); ?>

                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_new_comments')): ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <a href="/admin/comments/webinars" class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-comment"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Komentar</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($getNewCommentsCount); ?>

                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_new_tickets')): ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <a href="/admin/supports" class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-envelope"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Bantuan</h4>
                            </div>
                            <div class="card-body">
                                <?php echo e($getNewTicketsCount); ?>

                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            

        </div>


        <div class="row">
            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_recent_comments')): ?>
                <div class="col-lg-12 col-md-12 col-12 col-sm-12 <?php if(count($recentComments) < 6): ?> pb-30 <?php endif; ?>">
                    <div class="card <?php if(count($recentComments) < 6): ?> h-100 <?php endif; ?>">
                        <div class="card-header">
                            <h4>Komentar Terkini</h4>
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <ul class="list-unstyled list-unstyled-border">
                                <?php $__currentLoopData = $recentComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentComment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" height="50" src="<?php echo e($recentComment->user->getAvatar()); ?>" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right text-primary font-12"><?php echo e(dateTimeFormat($recentComment->created_at, 'j M Y | H:i')); ?></div>
                                            <div class="media-title"><?php echo e($recentComment->user->full_name); ?></div>
                                            <span class="text-small text-muted"><?php echo truncate($recentComment->comment, 150); ?></span>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                            <div class="text-center pt-1 pb-1">
                                <a href="/admin/comments/webinars" class="btn btn-primary btn-lg btn-round ">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>


        <div class="row">

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_recent_tickets')): ?>
                <?php if(!empty($recentTickets)): ?>
                    <div class="col-md-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h5>Bantuan Terkini</h5>
                                <div class="card-description"><?php echo e($recentTickets['pendingReply']); ?> Menunggu Jawaban</div>
                            </div>

                            <div class="card-body p-0">
                                <div class="tickets-list">

                                    <?php $__currentLoopData = $recentTickets['tickets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="/admin/supports/<?php echo e($ticket->id); ?>/conversation" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4><?php echo e($ticket->title); ?></h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div><?php echo e($ticket->user->full_name); ?></div>
                                                <div class="bullet"></div>
                                                <?php if($ticket->status == 'replied' or $ticket->status == 'open'): ?>
                                                    <span class="text-warning  text-small font-600-bold">Menunggu Jawaban</span>
                                                <?php elseif($ticket->status == 'close'): ?>
                                                    <span class="text-danger  text-small font-600-bold">Selesai</span>
                                                <?php else: ?>
                                                    <span class="text-primary  text-small font-600-bold">Sedang Berlangsung</span>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <a href="/admin/supports" class="ticket-item ticket-more">
                                        Lihat semua <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_recent_webinars')): ?>
                <?php if(!empty($recentWebinars)): ?>
                    <div class="col-md-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5>Kelas webinar Terkini</h5>
                                <div class="card-description"><?php echo e($recentWebinars['pendingReviews']); ?> Menunggu Tinjauan</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    <?php $__currentLoopData = $recentWebinars['webinars']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="/admin/webinars/<?php echo e($webinar->id); ?>/edit" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4><?php echo e($webinar->title); ?></h4>
                                            </div>

                                            <div class="ticket-info">
                                                <div><?php echo e($webinar->teacher->full_name); ?></div>
                                                <div class="bullet"></div>
                                                <?php switch($webinar->status):
                                                    case (\App\Models\Webinar::$active): ?>
                                                    <span class="text-success">Dipublish</span>
                                                    <?php if($webinar->isProgressing()): ?>
                                                        <div class="text-warning text-small font-600-bold">(Sedang Berlangsung)</div>
                                                    <?php elseif($webinar->start_date > time()): ?>
                                                        <div class="text-danger text-small font-600-bold">(Tidak dilakukan)</div>
                                                    <?php else: ?>
                                                        <span class="text-success text-small font-600-bold">(Selesai)</span>
                                                    <?php endif; ?>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\Webinar::$isDraft): ?>
                                                    <span class="text-dark">Draft</span>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\Webinar::$pending): ?>
                                                    <span class="text-warning">Menunggu</span>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\Webinar::$inactive): ?>
                                                    <span class="text-danger">ditolak</span>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <a href="/admin/webinars?type=webinar" class="ticket-item ticket-more">
                                        Lihat semua <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_recent_courses')): ?>
                <?php if(!empty($recentCourses)): ?>
                    <div class="col-md-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <h5>Pelatihan Terkini</h5>
                                <div class="card-description"><?php echo e($recentCourses['pendingReviews']); ?> Menunggu Tinjauan</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">


                                    <?php $__currentLoopData = $recentCourses['courses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="/admin/webinars/<?php echo e($course->id); ?>/edit" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4><?php echo e($course->title); ?></h4>
                                            </div>

                                            <div class="ticket-info">
                                                <div><?php echo e($course->teacher->full_name); ?></div>
                                                <div class="bullet"></div>
                                                <?php switch($course->status):
                                                    case (\App\Models\Webinar::$active): ?>
                                                    <span class="text-success">Dipublish</span>
                                                    <?php if($course->isProgressing()): ?>
                                                        <div class="text-warning text-small font-600-bold">(Sedang Berlangsung)</div>
                                                    <?php elseif($course->start_date > time()): ?>
                                                        <div class="text-danger text-small font-600-bold">(Tidak dilakukan)</div>
                                                    <?php else: ?>
                                                        <span class="text-success text-small font-600-bold">(Selesai)</span>
                                                    <?php endif; ?>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\Webinar::$isDraft): ?>
                                                    <span class="text-dark">Draft</span>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\Webinar::$pending): ?>
                                                    <span class="text-warning">Menunggu</span>
                                                    <?php break; ?>
                                                    <?php case (\App\Models\Webinar::$inactive): ?>
                                                    <span class="text-danger">ditolak</span>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    <a href="/admin/webinars?type=course" class="ticket-item ticket-more">
                                        Lihat semua <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/chartjs/chart.min.js"></script>
    <script src="/assets/admin/vendor/owl.carousel/owl.carousel.min.js"></script>

    <script src="/assets/admin/js/dashboard.min.js"></script>

    <script>
        (function ($) {
            "use strict";

            <?php if(!empty($getMonthAndYearSalesChart)): ?>
            makeStatisticsChart('saleStatisticsChart', saleStatisticsChart, 'Sale', <?php echo json_encode($getMonthAndYearSalesChart['labels'], 15, 512) ?>,<?php echo json_encode($getMonthAndYearSalesChart['data'], 15, 512) ?>);
            <?php endif; ?>

            <?php if(!empty($usersStatisticsChart)): ?>
            makeStatisticsChart('usersStatisticsChart', usersStatisticsChart, 'Users', <?php echo json_encode($usersStatisticsChart['labels'], 15, 512) ?>,<?php echo json_encode($usersStatisticsChart['data'], 15, 512) ?>);
            <?php endif; ?>

        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>