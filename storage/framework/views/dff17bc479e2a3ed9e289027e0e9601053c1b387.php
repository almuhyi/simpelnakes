<?php
    $progressSteps = [
        1 => [
            'name' => 'Basic informasi',
            'icon' => 'paper'
        ],

        2 => [
            'name' => 'extra_information',
            'icon' => 'paper_plus'
        ],

        3 => [
            'name' => 'pricing',
            'icon' => 'wallet'
        ],

        4 => [
            'name' => 'content',
            'icon' => 'folder'
        ],

        5 => [
            'name' => 'prerequisites',
            'icon' => 'video'
        ],

        6 => [
            'name' => 'faq',
            'icon' => 'tick_square'
        ],

        7 => [
            'name' => 'quiz_certificate',
            'icon' => 'ticket_star'
        ],

        8 => [
            'name' => 'message_to_reviewer',
            'icon' => 'shield_done'
        ],
    ];

    $currentStep = empty($currentStep) ? 1 : $currentStep;
?>


<div class="webinar-progress d-block d-lg-flex align-items-center p-15 panel-shadow bg-white rounded-sm">

    <?php $__currentLoopData = $progressSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="progress-item d-flex align-items-center">
            <button type="button" data-step="<?php echo e($key); ?>" class="js-get-next-step p-0 border-0 progress-icon p-10 d-flex align-items-center justify-content-center rounded-circle <?php echo e($key == $currentStep ? 'active' : ''); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e($step['name']); ?>">
                <img src="<?php echo e(asset('')); ?>assets/default/img/icons/<?php echo e($step['icon']); ?>.svg" class="img-cover" alt="">
            </button>

            <div class="ml-10 <?php echo e($key == $currentStep ? '' : 'd-lg-none'); ?>">
                <span class="font-14 text-gray">Langkah <?php echo e($key); ?> / 8</span>
                <h4 class="font-16 text-secondary font-weight-bold"><?php echo e($step['name']); ?></h4>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/create_includes/progress.blade.php ENDPATH**/ ?>