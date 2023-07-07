<?php $__env->startPush('styles_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section>
        <h2 class="section-title">Aktivitas saya</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/webinars.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($purchasedCount); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Pelatihan diikuti</span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/hours.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e(convertMinutesToHourAndMinute($hours)); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Jam</span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/activity/upcoming.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5"><?php echo e($upComing); ?></strong>
                        <span class="font-16 text-gray font-weight-500">Mendatang</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-25">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Daftar pelatihan yang diikuti</h2>
        </div>

        <?php if(!empty($sales) and !$sales->isEmpty()): ?>
            <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $item = !empty($sale->webinar) ? $sale->webinar : $sale->bundle;

                    $lastSession = !empty($sale->webinar) ? $sale->webinar->lastSession() : null;
                    $nextSession = !empty($sale->webinar) ? $sale->webinar->nextSession() : null;
                    $isProgressing = false;

                    if(!empty($sale->webinar) and $sale->webinar->start_date <= time() and !empty($lastSession) and $lastSession->date > time()) {
                        $isProgressing=true;
                    }
                ?>

                <?php if(!empty($item)): ?>
                    <div class="row mt-30">
                        <div class="col-12">
                            <div class="webinar-card webinar-list d-flex">
                                <div class="image-box">
                                    <img src="<?php echo e($item->getImage()); ?>" class="img-cover" alt="">

                                    <?php if(!empty($sale->webinar)): ?>
                                        <?php if($item->type == 'webinar'): ?>
                                            <?php if($item->start_date > time()): ?>
                                                <span class="badge badge-primary">Tidak dilakukan</span>
                                            <?php elseif($item->isProgressing()): ?>
                                                <span class="badge badge-secondary">Sedang berlangsung</span>
                                            <?php else: ?>
                                                <span class="badge badge-secondary">Selesai</span>
                                            <?php endif; ?>
                                        <?php elseif(!empty($item->downloadable)): ?>
                                            <span class="badge badge-secondary">Dapat diunduh</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary"><?php echo e($item->type); ?></span>
                                        <?php endif; ?>

                                        <?php
                                            $percent = $item->getProgress();

                                            if($item->isWebinar()){
                                                if($item->isProgressing()) {
                                                    $progressTitle =  $percent . '%' . ' ' . 'proses pelatihan';
                                                } else {
                                                    $progressTitle = $item->sales_count .'/'. $item->capacity .' '. 'Peserta';
                                                }
                                            } else {
                                                   $progressTitle = $percent . '%' . ' ' . 'proses pelatihan';
                                            }
                                        ?>

                                        <div class="progress cursor-pointer" data-toggle="tooltip" data-placement="top" title="<?php echo e($progressTitle); ?>">
                                            <span class="progress-bar" style="width: <?php echo e($percent); ?>%"></span>
                                        </div>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Paket pelatihan</span>
                                    <?php endif; ?>
                                </div>

                                <div class="webinar-card-body w-100 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="<?php echo e($item->getUrl()); ?>">
                                            <h3 class="webinar-title font-weight-bold font-16 text-dark-blue">
                                                <?php echo e($item->title); ?>


                                                <?php if(!empty($item->access_days)): ?>
                                                    <?php if(!$item->checkHasExpiredAccessDays($sale->created_at)): ?>
                                                        <span class="badge badge-outlined-danger ml-10">
                                                            Periode akses berakhir</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-outlined-warning ml-10">Tanggal kadaluwarsa <?php echo e(dateTimeFormat($item->getExpiredAccessDays($sale->created_at),'j M Y')); ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <?php if($sale->payment_method == \App\Models\Sale::$subscribe and $sale->checkExpiredPurchaseWithSubscribe($sale->buyer_id, $item->id, !empty($sale->webinar) ? 'webinar_id' : 'bundle_id')): ?>
                                                    <span class="badge badge-outlined-danger ml-10">Langganan berakhir</span>
                                                <?php endif; ?>

                                                <?php if(!empty($sale->webinar)): ?>
                                                    <span class="badge badge-dark ml-10 status-badge-dark"><?php echo e($item->type); ?></span>
                                                <?php endif; ?>
                                            </h3>
                                        </a>

                                        <div class="btn-group dropdown table-actions">
                                            <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="more-vertical" height="20"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                <?php if(!empty($item->access_days) and !$item->checkHasExpiredAccessDays($sale->created_at)): ?>
                                                    <a href="<?php echo e($item->getUrl()); ?>" target="_blank" class="webinar-actions d-block mt-10">Daftar di pelatihan</a>
                                                <?php elseif(!empty($sale->webinar)): ?>
                                                    <a href="<?php echo e($item->getLearningPageUrl()); ?>" target="_blank" class="webinar-actions d-block">Halaman Pembelajaran</a>

                                                    <?php if(!empty($item->start_date) and ($item->start_date > time() or ($item->isProgressing() and !empty($nextSession)))): ?>
                                                        <button type="button" data-webinar-id="<?php echo e($item->id); ?>" class="join-purchase-webinar webinar-actions btn-transparent d-block mt-10">Bergabung</button>
                                                    <?php endif; ?>

                                                    <?php if(!empty($item->downloadable) or (!empty($item->files) and count($item->files))): ?>
                                                        <a href="<?php echo e($item->getUrl()); ?>?tab=content" target="_blank" class="webinar-actions d-block mt-10">Unduh</a>
                                                    <?php endif; ?>

                                                    <?php if($item->price > 0): ?>
                                                        <a href="/panel/webinars/<?php echo e($item->id); ?>/invoice" target="_blank" class="webinar-actions d-block mt-10">Faktur</a>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                <a href="<?php echo e($item->getUrl()); ?>?tab=reviews" target="_blank" class="webinar-actions d-block mt-10">Masukan</a>
                                            </div>
                                        </div>
                                    </div>

                                    <?php echo $__env->make(getTemplate() . '.includes.webinar.rate',['rate' => $item->getRate()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <div class="webinar-price-box mt-15">
                                        <?php if($item->price > 0): ?>
                                            <?php if($item->bestTicket() < $item->price): ?>
                                                <span class="real"><?php echo e(handlePrice($item->bestTicket())); ?></span>
                                                <span class="off ml-10"><?php echo e(handlePrice($item->price)); ?></span>
                                            <?php else: ?>
                                                <span class="real"><?php echo e(handlePrice($item->price)); ?></span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <span class="real">Gratis</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">ID pelatihan:</span>
                                            <span class="stat-value"><?php echo e($item->id); ?></span>
                                        </div>

                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Kategori:</span>
                                            <span class="stat-value"><?php echo e(!empty($item->category_id) ? $item->category->title : ''); ?></span>
                                        </div>

                                        <?php if(!empty($sale->webinar) and $item->type == 'webinar'): ?>
                                            <?php if($item->isProgressing() and !empty($nextSession)): ?>
                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title">
                                                        Tanggal mulai sesi berikutnya:</span>
                                                    <span class="stat-value"><?php echo e(convertMinutesToHourAndMinute($nextSession->duration)); ?> Jam</span>
                                                </div>

                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title">
                                                        Tanggal mulai sesi berikutnya:</span>
                                                    <span class="stat-value"><?php echo e(dateTimeFormat($nextSession->date,'j M Y')); ?></span>
                                                </div>
                                            <?php else: ?>
                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title">Durasi:</span>
                                                    <span class="stat-value"><?php echo e(convertMinutesToHourAndMinute($item->duration)); ?> Jam</span>
                                                </div>

                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title">Mulai tanggal:</span>
                                                    <span class="stat-value"><?php echo e(dateTimeFormat($item->start_date,'j M Y')); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        <?php elseif(!empty($sale->bundle)): ?>
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span class="stat-title">Durasi:</span>
                                                <span class="stat-value"><?php echo e(convertMinutesToHourAndMinute($item->getBundleDuration())); ?> Jam</span>
                                            </div>
                                        <?php endif; ?>

                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Instruktur:</span>
                                            <span class="stat-value"><?php echo e($item->teacher->full_name); ?></span>
                                        </div>

                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Tanggal daftar:</span>
                                            <span class="stat-value"><?php echo e(dateTimeFormat($sale->created_at,'j M Y')); ?></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php echo $__env->make(getTemplate() . '.includes.no-result',[
            'file_name' => 'student.png',
            'title' => 'Tidak Ada pelatihan yang terdaftar!',
            'hint' => 'Mulailah pelatihan dari instruktur terbaik dan nikmati...',
            'btn' => ['url' => '/classes?sort=newest','text' => 'Cari pelatihan']
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </section>

    <div class="my-30">
        <?php echo e($sales->appends(request()->input())->links('vendor.pagination.panel')); ?>

    </div>

    <?php echo $__env->make('web.default.panel.webinar.join_webinar_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var undefinedActiveSessionLang = '<?php echo e(('Sesi aktif yang tidak ditentukan')); ?>';
    </script>

    <script src="<?php echo e(asset('')); ?>assets/default/js/panel/join_webinar.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/purchases.blade.php ENDPATH**/ ?>