<?php $__env->startPush('styles_top'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <section>
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="section-title">Pelatihan favorit</h2>
        </div>

        <?php if(!empty($favorites) and !$favorites->isEmpty()): ?>

            <?php $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row mt-30">
                    <div class="col-12">
                        <div class="webinar-card webinar-list d-flex">
                            <div class="image-box">
                                <img src="<?php echo e($favorite->webinar->getImage()); ?>" class="img-cover" alt="">

                                <?php if($favorite->webinar->type == 'webinar'): ?>
                                    <div class="progress">
                                        <span class="progress-bar" style="width: <?php echo e($favorite->webinar->getProgress()); ?>%"></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="webinar-card-body w-100 d-flex flex-column">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="<?php echo e($favorite->webinar->getUrl()); ?>" target="_blank">
                                        <h3 class="font-16 text-dark-blue font-weight-bold"><?php echo e($favorite->webinar->title); ?></h3>
                                    </a>

                                    <div class="btn-group dropdown table-actions">
                                        <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i data-feather="more-vertical" height="20"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="/panel/webinars/favorites/<?php echo e($favorite->id); ?>/delete" class="webinar-actions d-block delete-action">Hapus</a>
                                        </div>
                                    </div>
                                </div>

                                <?php echo $__env->make(getTemplate() . '.includes.webinar.rate',['rate' => $favorite->webinar->getRate()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                

                                <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">ID pelatihan:</span>
                                        <span class="stat-value"><?php echo e($favorite->webinar->id); ?></span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">Kategori:</span>
                                        <span class="stat-value"><?php echo e(!empty($favorite->webinar->category_id) ? $favorite->webinar->category->title : ''); ?></span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">Durasi:</span>
                                        <span class="stat-value"><?php echo e(convertMinutesToHourAndMinute($favorite->webinar->duration)); ?> Jam</span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <?php if($favorite->webinar->isWebinar()): ?>
                                            <span class="stat-title">Tanggal mulai:</span>
                                        <?php else: ?>
                                            <span class="stat-title">Dibuat pada:</span>
                                        <?php endif; ?>
                                        <span class="stat-value"><?php echo e(dateTimeFormat(!empty($favorite->webinar->start_date) ? $favorite->webinar->start_date : $favorite->webinar->created_at,'j M Y')); ?></span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">Instruktur:</span>
                                        <span class="stat-value"><?php echo e($favorite->webinar->teacher->full_name); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                'file_name' => 'student.png',
                'title' => 'Tidak ada pelatihan favorit!',
                'hint' =>  'Anda dapat menambahkan pelatihan ke daftar favorit Anda dan mendaftar nanti.' ,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

    </section>

    <div class="my-30">
        <?php echo e($favorites->appends(request()->input())->links('vendor.pagination.panel')); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() .'.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/favorites.blade.php ENDPATH**/ ?>