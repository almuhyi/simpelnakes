<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <section class="mt-25">
        <h2 class="section-title">Filter pelatihan</h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="/panel/webinars/organization_classes" method="get" class="row">
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
                                    <input type="text" name="from" autocomplete="off" value="<?php echo e(request()->get('from')); ?>" class="form-control <?php echo e(!empty(request()->get('from')) ? 'datepicker' : 'datefilter'); ?>" aria-describedby="dateInputGroupPrepend"/>
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
                                    <input type="text" name="to" autocomplete="off" value="<?php echo e(request()->get('to')); ?>" class="form-control <?php echo e(!empty(request()->get('to')) ? 'datepicker' : 'datefilter'); ?>" aria-describedby="dateInputGroupPrepend"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 col-lg-5">
                            <div class="form-group">
                                <label class="input-label d-block">Tipe pelatihan</label>

                                <select name="type" class="custom-select">
                                    <option value="">Semua</option>
                                    <option value="webinar" <?php if(request()->get('type') == 'webinar'): ?> selected <?php endif; ?>>Webinar</option>
                                    <option value="course" <?php if(request()->get('type') == 'course'): ?> selected <?php endif; ?>>Pelatihan</option>
                                    <option value="text_lesson" <?php if(request()->get('type') == 'text_lesson'): ?> selected <?php endif; ?>>Pembelajaran teks</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7">
                            <div class="form-group">
                                <label class="input-label">Sortir</label>
                                <select name="sort" class="form-control">
                                    <option value="">Semua</option>
                                    <option value="newest" <?php if(request()->get('sort', null) == 'newest'): ?> selected="selected" <?php endif; ?>>Terbaru</option>
                                    <option value="expensive" <?php if(request()->get('sort', null) == 'expensive'): ?> selected="selected" <?php endif; ?>>Harga tertinggi</option>
                                    <option value="inexpensive" <?php if(request()->get('sort', null) == 'inexpensive'): ?> selected="selected" <?php endif; ?>>Harga terendah</option>
                                    <option value="bestsellers" <?php if(request()->get('sort', null) == 'bestsellers'): ?> selected="selected" <?php endif; ?>>Penjualan terbaik</option>
                                    <option value="best_rates" <?php if(request()->get('sort', null) == 'best_rates'): ?> selected="selected" <?php endif; ?>>Nilai terbaik</option>
                                </select>
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


    <section class="mt-25">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Pelatihan organisasi</h2>

            <form action="" method="get">
                <div class="d-flex align-items-center flex-row-reverse flex-md-row justify-content-start justify-content-md-center mt-20 mt-md-0">
                    <label class="cursor-pointer mb-0 mr-10 text-gray font-14 font-weight-500" for="freeClassesSwitch">Hanya pelatihan gratis</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="free" <?php if(request()->get('free','') == 'on'): ?> checked <?php endif; ?> class="custom-control-input" id="freeClassesSwitch">
                        <label class="custom-control-label" for="freeClassesSwitch"></label>
                    </div>
                </div>
            </form>
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
                                    <?php if($webinar->type == 'webinar'): ?>
                                        <?php if($webinar->start_date > time()): ?>
                                            <span class="badge badge-primary">Tidak dilakukan</span>
                                        <?php elseif($webinar->isProgressing()): ?>
                                            <span class="badge badge-secondary">
                                                Sedang berlangsung</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Selesai</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="badge badge-secondary"><?php echo e($webinar->type); ?></span>
                                    <?php endif; ?>
                                    <?php break; ?>
                                    <?php case (\App\Models\Webinar::$isDraft): ?>
                                    <span class="badge badge-danger">Draft</span>
                                    <?php break; ?>
                                    <?php case (\App\Models\Webinar::$pending): ?>
                                    <span class="badge badge-warning">Menunggu</span>
                                    <?php break; ?>
                                    <?php case (\App\Models\Webinar::$inactive): ?>
                                    <span class="badge badge-danger">Ditolak</span>
                                    <?php break; ?>
                                <?php endswitch; ?>

                                <?php if($webinar->type == 'webinar'): ?>
                                    <div class="progress">
                                        <span class="progress-bar" style="width: <?php echo e($webinar->getProgress()); ?>%"></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="webinar-card-body w-100 d-flex flex-column">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="<?php echo e($webinar->getUrl()); ?>" target="_blank">
                                        <h3 class="font-16 text-dark-blue font-weight-bold"><?php echo e($webinar->title); ?>

                                            <span class="badge badge-dark status-badge-dark ml-10"><?php echo e($webinar->type); ?></span>

                                            <?php if($webinar->private): ?>
                                                <span class="badge badge-danger status-badge-danger ml-10">
                                                    Pribadi</span>
                                            <?php endif; ?>
                                        </h3>
                                    </a>
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
                                            <span class="stat-title">Durasi sesi berikutnya::</span>
                                            <span class="stat-value"><?php echo e(convertMinutesToHourAndMinute($nextSession->duration)); ?> Hrs</span>
                                        </div>

                                        <?php if($webinar->isWebinar()): ?>
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span class="stat-title">Tanggal mulai sesi berikutnya:</span>
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

                                    <?php if($authUser->id != $webinar->teacher_id and $authUser->id != $webinar->creator_id): ?>
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Instruktur:</span>
                                            <span class="stat-value"><?php echo e($webinar->teacher->full_name); ?></span>
                                        </div>
                                    <?php elseif($authUser->id == $webinar->teacher_id and $authUser->id != $webinar->creator_id and $webinar->creator->isOrganization()): ?>
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Organisasi:</span>
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

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/organization_classes.blade.php ENDPATH**/ ?>