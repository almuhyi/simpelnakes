<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <h2 class="section-title">Aktivitas saya</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/webinars.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e(!empty($webinars) ? $webinarsCount : 0); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Pelatihan</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/hours.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e(convertMinutesToHourAndMinute($webinarHours)); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Jam</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/sales.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e(addCurrencyToPrice($webinarSalesAmount)); ?></strong>
                        <span class="font-16 text-gray font-weight-500"><?php echo e('Total' .' '. 'penjualan kelas Live'); ?></span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="/assets/default/img/activity/download-sales.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e(addCurrencyToPrice($courseSalesAmount)); ?></strong>
                        <span class="font-16 text-gray font-weight-500"><?php echo e('Total' .' '. 'Penjualan pelatihan'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-25">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Pelatihan saya</h2>

            
        </div>

        <?php if(!empty($webinars) and !$webinars->isEmpty()): ?>
            <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $lastSession = $webinar->lastSession();
                    $nextSession = $webinar->nextSession();
                    $isProgressing = false;

                    if($webinar->start_date <= time() and !empty($lastSession) and $lastSession->date > time()) {
                        $isProgressing=true;
                    }
                ?>

                <div class="row mt-30">
                    <div class="col-12">
                        <div class="webinar-card webinar-list d-flex">
                            <div class="image-box">
                                <img src="<?php echo e($webinar->getImage()); ?>" class="img-cover" alt="">

                                <?php switch($webinar->status):
                                    case (\App\Models\Webinar::$active): ?>
                                    <?php if($webinar->isWebinar()): ?>
                                        <?php if($webinar->start_date > time()): ?>
                                            <span class="badge badge-primary">Tidak dilakukan</span>
                                        <?php elseif($webinar->isProgressing()): ?>
                                            <span class="badge badge-secondary">Sedang berlangsung</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Selesai</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge badge-secondary"><?php echo e($webinar->type); ?></span>
                                    <?php endif; ?>
                                    <?php break; ?>
                                    <?php case (\App\Models\Webinar::$isDraft): ?>
                                    <span class="badge badge-danger">
                                        draf</span>
                                    <?php break; ?>
                                    <?php case (\App\Models\Webinar::$pending): ?>
                                    <span class="badge badge-warning">Menunggu</span>
                                    <?php break; ?>
                                    <?php case (\App\Models\Webinar::$inactive): ?>
                                    <span class="badge badge-danger">Ditolak</span>
                                    <?php break; ?>
                                <?php endswitch; ?>

                                <?php if($webinar->isWebinar()): ?>
                                    <div class="progress">
                                        <span class="progress-bar" style="width: <?php echo e($webinar->getProgress()); ?>%"></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="webinar-card-body w-100 d-flex flex-column">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="<?php echo e($webinar->getUrl()); ?>" target="_blank">
                                        <h3 class="font-16 text-dark-blue font-weight-bold"><?php echo e($webinar->title); ?>

                                            <span class="badge badge-dark ml-10 status-badge-dark"><?php echo e($webinar->type); ?></span>
                                        </h3>
                                    </a>

                                    <?php if($webinar->isOwner($authUser->id) or $webinar->isPartnerTeacher($authUser->id)): ?>
                                        <div class="btn-group dropdown table-actions">
                                            <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="more-vertical" height="20"></i>
                                            </button>
                                            <div class="dropdown-menu ">
                                                <?php if(!empty($webinar->start_date)): ?>
                                                    <button type="button" data-webinar-id="<?php echo e($webinar->id); ?>" class="js-webinar-next-session webinar-actions btn-transparent d-block">Buat tautan bergabung</button>
                                                <?php endif; ?>

                                                <a href="<?php echo e($webinar->getLearningPageUrl()); ?>" target="_blank" class="webinar-actions d-block mt-10">Halaman pembelajaran</a>

                                                <a href="/panel/webinars/<?php echo e($webinar->id); ?>/edit" class="webinar-actions d-block mt-10">Edit</a>

                                                <?php if($webinar->isWebinar()): ?>
                                                    <a href="/panel/webinars/<?php echo e($webinar->id); ?>/step/4" class="webinar-actions d-block mt-10">Sesi</a>
                                                <?php endif; ?>

                                                <a href="/panel/webinars/<?php echo e($webinar->id); ?>/step/4" class="webinar-actions d-block mt-10">File</a>

                                                <a href="/panel/webinars/<?php echo e($webinar->id); ?>/export-students-list" class="webinar-actions d-block mt-10">Export daftar peserta</a>

                                                <?php if($authUser->id == $webinar->creator_id): ?>
                                                    <a href="/panel/webinars/<?php echo e($webinar->id); ?>/duplicate" class="webinar-actions d-block mt-10">
                                                        Duplikat</a>
                                                <?php endif; ?>


                                                <a href="/panel/webinars/<?php echo e($webinar->id); ?>/statistics" class="webinar-actions d-block mt-10">Statistik</a>

                                                <?php if($webinar->creator_id == $authUser->id): ?>
                                                    <a href="/panel/webinars/<?php echo e($webinar->id); ?>/delete" class="webinar-actions d-block mt-10 text-danger delete-action">Hapus</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php echo $__env->make(getTemplate() . '.includes.webinar.rate',['rate' => $webinar->getRate()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                <div class="webinar-price-box mt-15">
                                    <?php if($webinar->price > 0): ?>
                                        <?php if($webinar->bestTicket() < $webinar->price): ?>
                                            <span class="real"><?php echo e(handlePrice($webinar->bestTicket())); ?></span>
                                            <span class="off ml-10"><?php echo e(handlePrice($webinar->price)); ?></span>
                                        <?php else: ?>
                                            <span class="real"><?php echo e(handlePrice($webinar->price)); ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="real">Gratis</span>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">ID pelatihan:</span>
                                        <span class="stat-value"><?php echo e($webinar->id); ?></span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">Kategori:</span>
                                        <span class="stat-value"><?php echo e(!empty($webinar->category_id) ? $webinar->category->title : ''); ?></span>
                                    </div>

                                    <?php if($webinar->isProgressing() and !empty($nextSession)): ?>
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">
                                                Durasi sesi berikutnya:</span>
                                            <span class="stat-value"><?php echo e(convertMinutesToHourAndMinute($nextSession->duration)); ?> Hrs</span>
                                        </div>

                                        <?php if($webinar->isWebinar()): ?>
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span class="stat-title">
                                                    Tanggal mulai sesi berikutnya:</span>
                                                <span class="stat-value"><?php echo e(dateTimeFormat($nextSession->date,'j M Y')); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Durasi:</span>
                                            <span class="stat-value"><?php echo e(convertMinutesToHourAndMinute($webinar->duration)); ?> Hrs</span>
                                        </div>

                                        <?php if($webinar->isWebinar()): ?>
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span class="stat-title">Tanggal mulai:</span>
                                                <span class="stat-value"><?php echo e(dateTimeFormat($webinar->start_date,'j M Y')); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if($webinar->isTextCourse() or $webinar->isCourse()): ?>
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">File:</span>
                                            <span class="stat-value"><?php echo e($webinar->files->count()); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($webinar->isTextCourse()): ?>
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Pelajaran teks:</span>
                                            <span class="stat-value"><?php echo e($webinar->textLessons->count()); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($webinar->isCourse()): ?>
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Dapat diunduh:</span>
                                            <span class="stat-value"><?php echo e(($webinar->downloadable) ? 'Ya' : 'Tidak'); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">Penjualan:</span>
                                        <span class="stat-value"><?php echo e(count($webinar->sales)); ?> (<?php echo e((!empty($webinar->sales) and count($webinar->sales)) ? addCurrencyToPrice($webinar->sales->sum('amount')) : 0); ?>)</span>
                                    </div>

                                    <?php if(!empty($webinar->partner_instructor) and $webinar->partner_instructor and $authUser->id != $webinar->teacher_id and $authUser->id != $webinar->creator_id): ?>
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Diundang oleh:</span>
                                            <span class="stat-value"><?php echo e($webinar->teacher->full_name); ?></span>
                                        </div>
                                    <?php elseif($authUser->id != $webinar->teacher_id and $authUser->id != $webinar->creator_id): ?>
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Nama instruktur:</span>
                                            <span class="stat-value"><?php echo e($webinar->teacher->full_name); ?></span>
                                        </div>
                                    <?php elseif($authUser->id == $webinar->teacher_id and $authUser->id != $webinar->creator_id and $webinar->creator->isOrganization()): ?>
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Nama organisasi:</span>
                                            <span class="stat-value"><?php echo e($webinar->creator->full_name); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="my-30">
                <?php echo e($webinars->appends(request()->input())->links('vendor.pagination.panel')); ?>

            </div>

        <?php else: ?>
            <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                'file_name' => 'webinar.png',
                'title' => 'Tidak ada pelatihan',
                'hint' =>  'Buat pelatihan pertama Anda dan biarkan orang lain belajar dari Anda.',
                'btn' => ['url' => '/panel/webinars/new','text' => 'Buat pelatihan' ]
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </section>

    <?php echo $__env->make('web.default.panel.webinar.make_next_session_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>

    <script>
        var undefinedActiveSessionLang = '<?php echo e(('Sesi aktif yang tidak ditentukan')); ?>';
        var saveSuccessLang = '<?php echo e(('Item berhasil ditambahkan.')); ?>';
        var selectChapterLang = '<?php echo e(('Pilih bab')); ?>';
    </script>

    <script src="/assets/default/js/panel/make_next_session.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/index.blade.php ENDPATH**/ ?>