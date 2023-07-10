<?php $__env->startSection('content'); ?>
    <?php
        $siteGeneralSettings = getGeneralSettings();
    ?>

    <div class="p-4 m-3">
        <img src="<?php echo e($siteGeneralSettings['logo'] ?? ''); ?>" alt="logo" width="40%" class="mb-5 mt-2">

        <h4>Lupa kata sandi</h4>

        <p class="text-muted">
            Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda</p>

        <form method="POST" action="<?php echo e(url('/admin/forget-password')); ?>">
            <?php echo e(csrf_field()); ?>


            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" value="<?php echo e(old('email')); ?>" class="form-control  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       name="email" tabindex="1"
                       required autofocus>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback">
                    <?php echo e($message); ?>

                </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-20">Atur ulang kata sandi</button>
        </form>

        <div class="text-center mt-2">
            <span class=" d-inline-flex align-items-center justify-content-center">atau</span>
        </div>

        <div class="text-center mt-20">
            <span class="text-secondary">
                <a href="<?php echo e(url('/admin/login')); ?>" class="font-weight-bold">Masuk</a>
            </span>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.auth.auth_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/auth/forgot_password.blade.php ENDPATH**/ ?>