<?php $__env->startSection('content'); ?>
    <div class="container">

        <div class="row login-container">
            <div class="col-12 col-md-6 pl-0">
                <img src="<?php echo e(getPageBackgroundSettings('become_instructor')); ?>" class="img-cover" alt="Login">
            </div>

            <div class="col-12 col-md-6">
                <div class="login-card">
                    <h1 class="font-20 font-weight-bold">Menjadi instruktur</h1>

                    <form method="Post" action="/become-instructor" class="mt-35">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label class="js-instructor-label font-weight-500 text-dark-blue <?php echo e(!$isInstructorRole ? 'd-none' : ''); ?>">
                                Bidang Kategori</label>
                            <label class="js-organization-label font-weight-500 text-dark-blue <?php echo e(!$isOrganizationRole ? 'd-none' : ''); ?>">jabatan organisasi</label>

                            <div class="d-flex flex-wrap mt-5">

                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                        <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="checkbox-button mr-15 mt-10 font-14">
                                                <input type="checkbox" name="occupations[]" id="checkbox<?php echo e($subCategory->id); ?>" value="<?php echo e($subCategory->id); ?>" <?php if(!empty($occupations) and in_array($subCategory->id,$occupations)): ?> checked="checked" <?php endif; ?>>
                                                <label for="checkbox<?php echo e($subCategory->id); ?>"><?php echo e($subCategory->title); ?></label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="checkbox-button mr-15 mt-10 font-14">
                                            <input type="checkbox" name="occupations[]" id="checkbox<?php echo e($category->id); ?>" value="<?php echo e($category->id); ?>" <?php if(!empty($occupations) and in_array($category->id,$occupations)): ?> checked="checked" <?php endif; ?>>
                                            <label for="checkbox<?php echo e($category->id); ?>"><?php echo e($category->title); ?></label>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($errors->has('occupations')): ?>
                                    <div class="text-danger font-14"><?php echo e($errors->first('occupations')); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="js-instructor-label font-weight-500 text-dark-blue <?php echo e(!$isInstructorRole ? 'd-none' : ''); ?>">Jenis</label>
                            <label class="js-organization-label font-weight-500 text-dark-blue <?php echo e(!$isOrganizationRole ? 'd-none' : ''); ?>">Jenis</label>

                            <select name="role" class="form-control <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option selected disabled>Pilih role</option>

                                <option value="<?php echo e(\App\Models\Role::$teacher); ?>" <?php echo e($isInstructorRole ? 'selected' : ''); ?>>Instruktur</option>
                                <option value="<?php echo e(\App\Models\Role::$organization); ?>" <?php echo e($isOrganizationRole ? 'selected' : ''); ?>>Organisasi</option>
                            </select>
                            <?php $__errorArgs = ['role'];
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

                        <div class="form-group">
                            <label class="js-instructor-label font-weight-500 text-dark-blue <?php echo e(!$isInstructorRole ? 'd-none' : ''); ?>">Sertifikat dan dokumen</label>
                            <label class="js-organization-label font-weight-500 text-dark-blue <?php echo e(!$isOrganizationRole ? 'd-none' : ''); ?>">Dokumen organisasi dan sertifikat</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text panel-file-manager" data-input="certificate" data-preview="holder">
                                        <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                                    </button>
                                </div>
                                <input type="text" name="certificate" id="certificate" value="<?php echo e(!empty($lastRequest) ? $lastRequest->certificate : old('certificate')); ?>" class="form-control "/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="js-instructor-label font-weight-500 text-dark-blue <?php echo e(!$isInstructorRole ? 'd-none' : ''); ?>">Pilih akun pembayaran</label>
                            <label class="js-organization-label font-weight-500 text-dark-blue <?php echo e(!$isOrganizationRole ? 'd-none' : ''); ?>">Pilih akun pembayaran</label>
                            <select name="account_type" class="form-control <?php $__errorArgs = ['account_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option selected disabled>Pilih akun pembayaran</option>

                                <?php if(!empty(getOfflineBanksTitle()) and count(getOfflineBanksTitle())): ?>
                                    <?php $__currentLoopData = getOfflineBanksTitle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accountType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($accountType); ?>" <?php if(!empty($user) and $user->account_type == $accountType): ?> selected="selected" <?php endif; ?>><?php echo e($accountType); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['account_type'];
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

                        <div class="form-group">
                            <label class="js-instructor-label font-weight-500 text-dark-blue <?php echo e(!$isInstructorRole ? 'd-none' : ''); ?>">IBAN</label>
                            <label class="js-organization-label font-weight-500 text-dark-blue <?php echo e(!$isOrganizationRole ? 'd-none' : ''); ?>">IBAN</label>
                            <input type="text" name="iban" value="<?php echo e((!empty($user)) ? $user->iban : old('iban')); ?>" class="form-control <?php $__errorArgs = ['iban'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder=""/>
                            <?php $__errorArgs = ['iban'];
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

                        <div class="form-group">
                            <label class="js-instructor-label font-weight-500 text-dark-blue <?php echo e(!$isInstructorRole ? 'd-none' : ''); ?>">ID Akun</label>
                            <label class="js-organization-label font-weight-500 text-dark-blue <?php echo e(!$isOrganizationRole ? 'd-none' : ''); ?>">ID Akun</label>
                            <input type="text" name="account_id" value="<?php echo e((!empty($user)) ? $user->account_id : old('account_id')); ?>" class="form-control <?php $__errorArgs = ['account_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder=""/>
                            <?php $__errorArgs = ['account_id'];
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

                        <div class="form-group">
                            <label class="js-instructor-label font-weight-500 text-dark-blue <?php echo e(!$isInstructorRole ? 'd-none' : ''); ?>">Pemindaian identitas</label>
                            <label class="js-organization-label font-weight-500 text-dark-blue <?php echo e(!$isOrganizationRole ? 'd-none' : ''); ?>">Pemindaian identitas</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text panel-file-manager" data-input="identity_scan" data-preview="holder">
                                        <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                                    </button>
                                </div>
                                <input type="text" name="identity_scan" id="identity_scan" value="<?php echo e((!empty($user)) ? $user->identity_scan : old('identity_scan')); ?>" class="form-control <?php $__errorArgs = ['identity_scan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"/>
                                <?php $__errorArgs = ['identity_scan'];
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
                        </div>

                        <div class="form-group">
                            <label class="js-instructor-label font-weight-500 text-dark-blue <?php echo e(!$isInstructorRole ? 'd-none' : ''); ?>">Informasi tambahan</label>
                            <label class="js-organization-label font-weight-500 text-dark-blue <?php echo e(!$isOrganizationRole ? 'd-none' : ''); ?>">Informasi tambahan</label>
                            <textarea name="description" rows="6" class="form-control"><?php echo e(!empty($lastRequest) ? $lastRequest->description : old('description')); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-20"><?php echo e((!empty(getRegistrationPackagesGeneralSettings('show_packages_during_registration')) and getRegistrationPackagesGeneralSettings('show_packages_during_registration')) ? ('Selanjutnya') : ('Kirim permintaan')); ?></button>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script src="/assets/default/js/parts/become_instructor.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate().'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/user/become_instructor/index.blade.php ENDPATH**/ ?>