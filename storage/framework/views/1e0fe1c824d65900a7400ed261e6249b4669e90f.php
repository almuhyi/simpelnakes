<div class="webinar-card webinar-list webinar-list-2 d-flex mt-30">
    <div class="image-box">
        

        <a href="<?php echo e(url($webinar->getUrl())); ?>">
            <img src="<?php echo e(asset($webinar->getImage())); ?>" class="img-cover" alt="<?php echo e($webinar->title); ?>">
        </a>

        <div class="progress-and-bell d-flex align-items-center">

            <?php if($webinar->type == 'webinar'): ?>
                <a href="<?php echo e(url($webinar->addToCalendarLink())); ?>" target="_blank" class="webinar-notify d-flex align-items-center justify-content-center">
                    <i data-feather="bell" width="20" height="20" class="webinar-icon"></i>
                </a>
            <?php endif; ?>

            <?php if($webinar->type == 'webinar'): ?>
                <div class="progress ml-10">
                    <span class="progress-bar" style="width: <?php echo e($webinar->getProgress()); ?>%"></span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="webinar-card-body w-100 d-flex flex-column">
        <div class="d-flex align-items-center justify-content-between">
            <a href="<?php echo e(url($webinar->getUrl())); ?>">
                <h3 class="mt-15 webinar-title font-weight-bold font-16 text-dark-blue"><?php echo e(clean($webinar->title,'title')); ?></h3>
            </a>
        </div>

        <?php if(!empty($webinar->category)): ?>
            <span class="d-block font-14 mt-10">kategori <a href="<?php echo e(url($webinar->category->getUrl())); ?>" target="_blank" class="text-decoration-underline"><?php echo e($webinar->category->title); ?></a></span>
        <?php endif; ?>

        <div class="user-inline-avatar d-flex align-items-center mt-10">
            <div class="avatar bg-gray200">
                <img src="<?php echo e(asset($webinar->teacher->getAvatar())); ?>" class="img-cover" alt="<?php echo e($webinar->teacher->full_name); ?>">
            </div>
            <a href="<?php echo e(url($webinar->teacher->getProfileUrl())); ?>" target="_blank" class="user-name ml-5 font-14"><?php echo e($webinar->teacher->full_name); ?></a>
        </div>

        <?php echo $__env->make(getTemplate() . '.includes.webinar.rate',['rate' => $webinar->getRate()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="d-flex justify-content-between mt-auto">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <i data-feather="clock" width="20" height="20" class="webinar-icon"></i>
                    <span class="duration ml-5 font-14"><?php echo e(convertMinutesToHourAndMinute($webinar->duration)); ?> Jam</span>
                </div>

                <div class="vertical-line h-25 mx-15"></div>

                <div class="d-flex align-items-center">
                    <i data-feather="calendar" width="20" height="20" class="webinar-icon"></i>
                    <span class="date-published ml-5 font-14"><?php echo e(dateTimeFormat(!empty($webinar->start_date) ? $webinar->start_date : $webinar->created_at,'j M Y')); ?></span>
                </div>
            </div>

            
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/includes/webinar/list-card.blade.php ENDPATH**/ ?>