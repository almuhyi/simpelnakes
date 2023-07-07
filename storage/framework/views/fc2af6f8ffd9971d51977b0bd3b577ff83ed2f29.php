<div class="tab-pane mt-3 fade" id="registrationPackage" role="tabpanel" aria-labelledby="registrationPackage-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="/admin/users/groups/<?php echo e($group->id); ?>/groupRegistrationPackage" method="Post">
                <?php echo e(csrf_field()); ?>


                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0 d-flex align-items-center">
                        <input type="hidden" name="status" value="disabled">
                        <input type="checkbox" name="status" id="packageStatusSwitch" value="active" <?php echo e((!empty($groupRegistrationPackage) and $groupRegistrationPackage->status == 'active') ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="packageStatusSwitch">Aktif</label>
                    </label>
                    <div class="text-muted text-small mt-1">Dengan mengaktifkan opsi ini, parameter berikut akan diperiksa untuk pengguna ini</div>
                </div>

                <?php
                    $packageItems = ['instructors_count','students_count','courses_capacity','courses_count','meeting_count'];
                ?>

                <?php $__currentLoopData = $packageItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $str): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-group">
                        <label><?php echo e($str); ?></label>
                        <input type="text" class="form-control <?php $__errorArgs = [$str];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="<?php echo e($str); ?>" value="<?php echo e(!empty($groupRegistrationPackage) ? $groupRegistrationPackage->{$str} : ''); ?>">

                        <?php $__errorArgs = [$str];
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                <div class=" mt-4">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/users/groups/tabs/registration_package.blade.php ENDPATH**/ ?>