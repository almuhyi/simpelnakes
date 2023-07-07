<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="course-private-content text-center w-100 border rounded-lg">
            <div class="course-private-content-icon m-auto">
                <img src="/assets/default/img/course/private_content_icon.svg" alt="private content icon" class="img-cover">
            </div>

            <?php if(!empty($userNotAccess) and $userNotAccess): ?>
                <div class="mt-30">
                    <h2 class="font-20 text-dark-blue">manajemen akses</h2>
                    <p class="font-14 font-weight-500 text-gray">Harap tunggu persetujuan admin untuk mengakses materi pelatihan.</p>
                </div>
            <?php else: ?>
                <div class="mt-30">
                    <h2 class="font-20 font-weight-bold text-dark-blue">materi Pribadi</h2>
                    <p class="font-14 font-weight-500 text-gray">
                        Anda harus masuk untuk mengakses materi pelatihan.</p>
                </div>

                <a href="/login" class="btn btn-primary mt-15">Masuk</a>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/course/private_content.blade.php ENDPATH**/ ?>