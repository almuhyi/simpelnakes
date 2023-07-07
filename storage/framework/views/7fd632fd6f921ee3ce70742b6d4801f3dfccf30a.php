<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/select2/select2.min.css">
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <section class="site-top-banner search-top-banner opacity-04 position-relative">
        <img src="<?php echo e(asset(getPageBackgroundSettings('categories'))); ?>" class="img-cover" alt=""/>

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-white font-30 mb-15"><?php echo e(!empty($category) ? $category->title : $pageTitle); ?></h1>
                        <span class="course-count-badge py-5 px-10 text-white rounded"><?php echo e($webinarsCount); ?> Pelatihan</span>

                        <div class="search-input bg-white p-10 flex-grow-1">
                            <form action="<?php echo e(url('/search')); ?>" method="get">
                                <div class="form-group d-flex align-items-center m-0">
                                    <input type="text" name="search" class="form-control border-0" placeholder="Cari pelatihan dan instruktur...."/>
                                    <button type="submit" class="btn btn-primary rounded-pill">Temukan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-30">

        <?php if(!empty($featureWebinars) and !$featureWebinars->isEmpty()): ?>
            <section class="mb-25 mb-lg-0">
                <h2 class="font-24 text-dark-blue">Pelatihan unggulan</h2>
                <span class="font-14 text-gray font-weight-400">
                    #Pelatihan yang baru-baru ini diterbitkan</span>
                <div class="position-relative mt-20">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                            <?php $__currentLoopData = $featureWebinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featureWebinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <?php echo $__env->make('web.default.includes.webinar.grid-card',['webinar' => $featureWebinar->webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

            </section>
        <?php endif; ?>

        <section class="mt-lg-50 pt-lg-20 mt-md-40 pt-md-40">
            <form action="<?php echo e(url($sortFormAction)); ?>" method="get" id="filtersForm">

                <?php echo $__env->make('web.default.pages.includes.top_filters', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="row mt-20">
                    <div class="col-12 col-lg-8">

                        <?php if(empty(request()->get('card')) or request()->get('card') == 'grid'): ?>
                            <div class="row">
                                <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-12 col-lg-6 mt-20">
                                        <?php echo $__env->make('web.default.includes.webinar.grid-card',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        <?php elseif(!empty(request()->get('card')) and request()->get('card') == 'list'): ?>

                            <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('web.default.includes.webinar.list-card',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </div>


                    <div class="col-12 col-lg-4">
                        <div class="mt-20 p-20 rounded-sm shadow-lg border border-gray300 filters-container">

                            <div class="">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">Tipe</h3>

                                <div class="pt-10">
                                    <?php $__currentLoopData = ['Webinar','Pelatihan','Pelatihan teks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="d-flex align-items-center justify-content-between mt-20">
                                            <label class="cursor-pointer" for="filterLanguage<?php echo e($typeOption); ?>"><?php echo e($typeOption); ?></label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="type[]" id="filterLanguage<?php echo e($typeOption); ?>" value="<?php echo e($typeOption); ?>" <?php if(in_array($typeOption, request()->get('type', []))): ?> checked="checked" <?php endif; ?> class="custom-control-input">
                                                <label class="custom-control-label" for="filterLanguage<?php echo e($typeOption); ?>"></label>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            <?php if(!empty($category) and !empty($category->filters)): ?>
                                <?php $__currentLoopData = $category->filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mt-25 pt-25 border-top border-gray300">
                                        <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue"><?php echo e($filter->title); ?></h3>

                                        <?php if(!empty($filter->options)): ?>
                                            <div class="pt-10">
                                                <?php $__currentLoopData = $filter->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="d-flex align-items-center justify-content-between mt-20">
                                                        <label class="cursor-pointer" for="filterLanguage<?php echo e($option->id); ?>"><?php echo e($option->title); ?></label>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="filter_option[]" id="filterLanguage<?php echo e($option->id); ?>" value="<?php echo e($option->id); ?>" <?php if(in_array($option->id, request()->get('filter_option', []))): ?> checked="checked" <?php endif; ?> class="custom-control-input">
                                                            <label class="custom-control-label" for="filterLanguage<?php echo e($option->id); ?>"></label>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            


                            <button type="submit" class="btn btn-sm btn-primary btn-block mt-30">Filter</button>
                        </div>
                    </div>
                </div>

            </form>
            <div class="mt-50 pt-30">
                <?php echo e($webinars->appends(request()->input())->links('vendor.pagination.panel')); ?>

            </div>
        </section>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/select2/select2.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/swiper/swiper-bundle.min.js"></script>

    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/categories.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate().'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/pages/categories.blade.php ENDPATH**/ ?>