<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/vendors/leaflet/leaflet.css">
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/vendors/leaflet/leaflet.markercluster/markerCluster.css">
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/vendors/leaflet/leaflet.markercluster/markerCluster.Default.css">
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/vendors/wrunner-html-range-slider-with-2-handles/css/wrunner-default-theme.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="instructor-finder">

        

        <div class="container">

            <form id="filtersForm" action="<?php echo e(url('/instructor-finder?')); ?> <?php echo e(http_build_query(request()->all())); ?>" method="get">

                <?php echo $__env->make('web.default.instructorFinder.components.top_filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="row flex-lg-row-reverse">
                    <div class="col-12 col-lg-8">

                        <div id="instructorsList">
                            <?php if($instructors->isNotEmpty()): ?>
                                <?php $__currentLoopData = $instructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instructor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('web.default.instructorFinder.components.instructor_card', ['instructor' => $instructor], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('web.default.includes.no-result',[
                                           'file_name' => 'support.png',
                                           'title' => 'Pencarian instruktur tidak ada hasil',
                                           'hint' => nl2br('Maaf! Kami tidak menemukan instruktur. Coba kondisi yang berbeda.'),
                                       ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </div>

                        <div class="text-center">
                            <button type="button" id="loadMoreInstructors" data-url="<?php echo e(url('/instructor-finder')); ?>" class="btn btn-border-white mt-50 <?php echo e(($instructors->lastPage() <= $instructors->currentPage()) ? ' d-none' : ''); ?>">Lihat instruktur lainnya</button>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">

                        <?php echo $__env->make('web.default.instructorFinder.components.filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        

                        <?php echo $__env->make('web.default.instructorFinder.components.location_filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts_bottom'); ?>
    <script src="<?php echo e(asset('')); ?>assets/vendors/wrunner-html-range-slider-with-2-handles/js/wrunner-jquery.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/vendors/leaflet/leaflet.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/vendors/leaflet/leaflet.markercluster/leaflet.markercluster-src.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/swiper/swiper-bundle.min.js"></script>

    <script>
        var currency = '<?php echo e($currency); ?>';
        var profileLang = 'Profil';
        var hourLang = 'Jam';
        var mapUsers = JSON.parse(<?php echo json_encode($mapUsers->toJson(), 15, 512) ?>);
        var selectProvinceLang = 'Pilih Provinsi';
        var selectCityLang = 'Pilih Kota';
        var selectDistrictLang = 'Pilih Daerah';
    </script>

    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/get-regions.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/instructor-finder-wizard.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/instructors.min.js"></script>

    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/instructor-finder.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('web.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/instructorFinder/index.blade.php ENDPATH**/ ?>