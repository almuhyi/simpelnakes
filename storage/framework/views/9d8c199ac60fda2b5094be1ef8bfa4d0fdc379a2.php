<?php
    $progressSteps = [
        1 => [
            'lang' => 'informasi dasar',
            'icon' => 'basic-info'
        ],

        2 => [
            'lang' => 'Gambar',
            'icon' => 'images'
        ],

        3 => [
            'lang' => 'Tentang',
            'icon' => 'about'
        ],

        4 => [
            'lang' => 'Pendidikan',
            'icon' => 'graduate'
        ],

        5 => [
            'lang' => 'Pengalaman',
            'icon' => 'experiences'
        ],

        6 => [
            'lang' => 'Profesi',
            'icon' => 'skills'
        ],

        7 => [
            'lang' => 'Identitas & finansial',
            'icon' => 'financial'
        ],

        9 => [
            'lang' => 'Informasi tambahan',
            'icon' => 'extra_info'
        ]
    ];

    if(!$user->isUser()) {
        $progressSteps[8] =[
            'lang' => 'Zoom API',
            'icon' => 'zoom'
        ];


    }

    $currentStep = empty($currentStep) ? 1 : $currentStep;
?>


<div class="webinar-progress d-block d-lg-flex align-items-center p-15 panel-shadow bg-white rounded-sm">

    <?php $__currentLoopData = $progressSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="progress-item d-flex align-items-center">
            <a href="<?php if(!empty($organization_id)): ?>/panel/manage/<?php echo e($user_type ?? 'instructors'); ?>/<?php echo e($user->id); ?>/edit/step/<?php echo e($key); ?> <?php else: ?><?php echo e(url('')); ?>/panel/setting/step/<?php echo e($key); ?> <?php endif; ?>" class="progress-icon p-10 d-flex align-items-center justify-content-center rounded-circle <?php echo e($key == $currentStep ? 'active' : ''); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans($step['lang'])); ?>">
                <img src="<?php echo e(asset('')); ?>assets/default/img/icons/<?php echo e($step['icon']); ?>.svg" class="img-cover" alt="">
            </a>

            <div class="ml-10 <?php echo e($key == $currentStep ? '' : 'd-lg-none'); ?>">
                <h4 class="font-16 text-secondary font-weight-bold"><?php echo e($step['lang']); ?></h4>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/setting/setting_includes/progress.blade.php ENDPATH**/ ?>