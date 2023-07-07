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
                        <h1 class="text-white font-30 mb-15">Pelatihan</h1>
                        <span class="course-count-badge py-5 px-10 text-white rounded"><?php echo e($coursesCount); ?> Pelatihan</span>

                        <div class="search-input bg-white p-10 flex-grow-1">
                            <form action="<?php echo e(url('/search')); ?>" method="get">
                                <div class="form-group d-flex align-items-center m-0">
                                    <input type="text" name="search" class="form-control border-0" placeholder="Cari Pelatihan"/>
                                    <button type="submit" class="btn btn-primary rounded-pill">Cari</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-30">

        <section class="mt-lg-50 pt-lg-20 mt-md-40 pt-md-40">
            <form action="<?php echo e(url('/classes')); ?>" method="get" id="filtersForm">

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
                                <div class="form-group mt-20">

                                    <?php if(!empty($categories) and count($categories)): ?>
                                    <li class="mr-lg-25">
                                        <div class="menu-category">
                                            <ul>
                                                <li class="cursor-pointer user-select-none d-flex xs-categories-toggle">
                                                    <i data-feather="grid" width="20" height="20" class="mr-10 d-none d-lg-block"></i>
                                                    Kategori

                                                    <ul class="cat-dropdown-menu">
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <a href="<?php echo e(url((!empty($category->subCategories) and count($category->subCategories)) ? '#!' : $category->getUrl())); ?>">
                                                                    <div class="d-flex align-items-center">
                                                                        <img src="<?php echo e(asset($category->icon)); ?>" class="cat-dropdown-menu-icon mr-10" alt="<?php echo e($category->title); ?> icon">
                                                                        <?php echo e($category->title); ?>

                                                                    </div>

                                                                    <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                                        <i data-feather="chevron-right" width="20" height="20" class="d-none d-lg-inline-block ml-10"></i>
                                                                        <i data-feather="chevron-down" width="20" height="20" class="d-inline-block d-lg-none"></i>
                                                                    <?php endif; ?>
                                                                </a>

                                                                <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                                    <ul class="sub-menu" data-simplebar <?php if((!empty($isRtl) and $isRtl)): ?> data-simplebar-direction="rtl" <?php endif; ?>>
                                                                        <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li>
                                                                                <a href="<?php echo e(url($subCategory->getUrl())); ?>">
                                                                                    <?php if(!empty($subCategory->icon)): ?>
                                                                                    <img src="<?php echo e(asset($subCategory->icon)); ?>" class="cat-dropdown-menu-icon mr-10" alt="<?php echo e($subCategory->title); ?> icon">
                                                                                    <?php endif; ?>

                                                                                    <?php echo e($subCategory->title); ?>

                                                                                </a>
                                                                            </li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </ul>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endif; ?>

                                </div>



                                <div class="pt-10">
                                    <?php $__currentLoopData = ['bundle','Webinar','Pelatihan','teks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="d-flex align-items-center justify-content-between mt-20">
                                            <label class="cursor-pointer" for="filterLanguage<?php echo e($typeOption); ?>">
                                                <?php if($typeOption == 'bundle'): ?>
                                                    Paket Pelatihan
                                                <?php else: ?>
                                                    <?php echo e($typeOption); ?>

                                                <?php endif; ?>
                                            </label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="type[]" id="filterLanguage<?php echo e($typeOption); ?>" value="<?php echo e($typeOption); ?>" <?php if(in_array($typeOption, request()->get('type', []))): ?> checked="checked" <?php endif; ?> class="custom-control-input">
                                                <label class="custom-control-label" for="filterLanguage<?php echo e($typeOption); ?>"></label>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                            


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

<?php echo $__env->make(getTemplate().'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/pages/classes.blade.php ENDPATH**/ ?>