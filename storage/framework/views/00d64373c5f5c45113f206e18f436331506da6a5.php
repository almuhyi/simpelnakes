<div class="d-none" id="courseShareModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">Bagikan</h3>

    <div class="text-center">
        <i data-feather="share-2" width="50" height="50" class="webinar-icon"></i>

        <p class="mt-20 font-14">
            Berbagi pelatihan dengan teman-teman Anda</p>

        <div class="position-relative d-flex align-items-center justify-content-between p-15 mt-15 border border-gray250 rounded-sm mt-5">
            <div class="js-course-share-link font-weight-bold px-16 text-ellipsis font-14"><?php echo e($bundle->getUrl()); ?></div>

            <button type="button" class="js-course-share-link-copy btn btn-primary btn-sm font-14 font-weight-500 flex-none" data-toggle="tooltip" data-placement="top" title="Salin">Salin</button>
        </div>

        <div class="mt-32 mt-lg-40 row align-items-center font-14">
            <a href="<?php echo e($bundle->getShareLink('telegram')); ?>" target="_blank" class="col text-center">
                <img src="/assets/default/img/social/telegram.svg" width="50" height="50" alt="telegram">
                <span class="mt-10 d-block">Telegram</span>
            </a>

            <a href="<?php echo e($bundle->getShareLink('whatsapp')); ?>" target="_blank" class="col text-center">
                <img src="/assets/default/img/social/whatsapp.svg" width="50" height="50" alt="whatsapp">
                <span class="mt-10 d-block">Whatsapp</span>
            </a>

            <a href="<?php echo e($bundle->getShareLink('facebook')); ?>" target="_blank" class="col text-center">
                <img src="/assets/default/img/social/facebook.svg" width="50" height="50" alt="facebook">
                <span class="mt-10 d-block">Facebook</span>
            </a>

            <a href="<?php echo e($bundle->getShareLink('twitter')); ?>" target="_blank" class="col text-center">
                <img src="/assets/default/img/social/twitter.svg" width="50" height="50" alt="twitter">
                <span class="mt-10 d-block">Twitter</span>
            </a>
        </div>
    </div>

    <div class="mt-30 d-flex align-items-center justify-content-end">
        <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">Tutp</button>
    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/bundle/share_modal.blade.php ENDPATH**/ ?>