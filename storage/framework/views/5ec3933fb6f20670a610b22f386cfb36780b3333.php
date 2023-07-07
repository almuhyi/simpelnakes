<?php
    $percent = $course->getProgress(true);
?>

<div class="learning-page-navbar d-flex align-items-lg-center justify-content-between flex-column flex-lg-row px-15 px-lg-35 py-10">
    <div class="d-flex align-items-lg-center flex-column flex-lg-row flex-grow-1">

        <div class="learning-page-logo-card d-flex align-items-center justify-content-between justify-content-lg-start">
            <a class="navbar-brand d-flex align-items-center justify-content-center mr-0" href="/">
                <?php if(!empty($generalSettings['logo'])): ?>
                    <img src="<?php echo e(asset($generalSettings['logo'])); ?>" class="img-cover" alt="site logo">
                <?php endif; ?>
            </a>

            <div class="d-flex align-items-center d-lg-none ml-20">
                <a href="<?php echo e(url($course->getUrl())); ?>" class="btn learning-page-navbar-btn btn-sm border-gray200 d-none d-md-block">Hal pelatihan</a>

                <a href="<?php echo e(url('/panel/webinars/purchases')); ?>" class="btn learning-page-navbar-btn btn-sm border-gray200 ml-0 ml-md-10">Pelatihan saya</a>
            </div>
        </div>

        <div class="learning-page-progress-card d-flex flex-column">
            <a href="<?php echo e(url($course->getUrl())); ?>" class="learning-page-navbar-title">
                <span class="font-weight-bold"><?php echo e($course->title); ?></span>
            </a>

            <div class="d-flex align-items-center">
                <div class="progress course-progress d-flex align-items-center flex-grow-1 bg-white border border-gray200 rounded-sm shadow-none mt-5">
                    <span class="progress-bar rounded-sm bg-warning" style="width: <?php echo e($percent); ?>%"></span>
                </div>

                <span class="ml-10 font-weight-500 font-14 text-gray"><?php echo e($percent); ?>% Proses</span>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center mt-5 mt-md-0">

        <?php if(!empty($course->noticeboards_count) and $course->noticeboards_count > 0): ?>
            <a href="<?php echo e(url($course->getNoticeboardsPageUrl())); ?>" target="_blank" class="btn learning-page-navbar-btn noticeboard-btn btn-sm border-gray200 mr-10">
                <i data-feather="bell" class="" width="16" height="16"></i>

                <span class="noticeboard-btn-badge d-flex align-items-center justify-content-center text-white bg-danger rounded-circle font-12"><?php echo e($course->noticeboards_count); ?></span>
            </a>
        <?php endif; ?>

        <?php if($course->forum): ?>
            <a href="<?php echo e(url($course->getForumPageUrl())); ?>" class="btn learning-page-navbar-btn btn-sm border-gray200 mr-10">Forum pelatihan</a>
        <?php endif; ?>

        <div class="d-none align-items-center d-lg-flex">
            <a href="<?php echo e(url($course->getUrl())); ?>" class="btn learning-page-navbar-btn btn-sm border-gray200">Hal pelatihan</a>

            <a href="<?php echo e(url('/panel/webinars/purchases')); ?>" class="btn learning-page-navbar-btn btn-sm border-gray200 ml-10">Pelatihan saya</a>
        </div>

        <button id="collapseBtn" type="button" class="btn-transparent ml-auto ml-lg-20">
            <i data-feather="menu" width="20" height="20" class=""></i>
        </button>
    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/course/learningPage/components/navbar.blade.php ENDPATH**/ ?>