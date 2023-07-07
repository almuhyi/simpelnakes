<div class="d-none" id="buyWithPointModal">
    <h3 class="section-title font-16 text-dark-blue mb-25">Beli dengan poin</h3>

    <?php if(!empty($user)): ?>
        <div class="text-center">
            <img src="/assets/default/img/rewards/medal-2.png" class="buy-with-points-modal-img" alt="medal">

            <p class="font-14 font-weight-500 text-gray mt-30">
                <span class="d-block">Pelatihan ini membutuhkan<?php echo e($bundle->points); ?> poin</span>
                <span class="d-block">Anda memiliki <?php echo e($user->getRewardPoints()); ?> poin</span>

                <?php if($user->getRewardPoints() >= $bundle->points): ?>
                <span class="d-block">
                    Apakah Anda ingin melanjutkan?</span>
                <?php else: ?>
                    <span class="d-block text-danger">Anda tidak memiliki cukup poin untuk mendaftar di pelatihan ini...</span>
                <?php endif; ?>
            </p>
        </div>

        <div class="d-flex align-items-center mt-25">
            <a href="<?php echo e(($user->getRewardPoints() >= $bundle->points) ? '/bundles/'. $bundle->slug .'/points/apply' : '#'); ?>" class="btn btn-sm flex-grow-1 <?php echo e(($user->getRewardPoints() >= $bundle->points) ? 'btn-primary js-buy-course-with-point' : 'bg-gray300 text-gray disabled'); ?>">Beli</a>
            <a href="/panel/rewards" class="btn btn-outline-primary ml-15 btn-sm flex-grow-1">Poinku</a>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/bundle/buy_with_point_modal.blade.php ENDPATH**/ ?>