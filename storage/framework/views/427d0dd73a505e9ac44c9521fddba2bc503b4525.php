<section class="mt-30">
    <h2 class="section-title after-line">
        Identitas</h2>
    <div class="mt-15">
        <?php if($user->financial_approval): ?>
            <p class="font-14 text-primary">Identitas & informasi keuangan Anda disetujui sehingga Anda tidak dapat mengubahnya. Jika Anda ingin mengubah, silakan hubungi dukungan.</p>
        <?php else: ?>
            <p class="font-14 text-danger">Identitas dan informasi keuangan Anda tidak diverifikasi sehingga dapat menyebabkan keterlambatan dalam proses pembayaran. Harap tentukan data dengan bidang berikut.</p>
        <?php endif; ?>
    </div>

    <div class="row mt-20">
        <div class="col-12 col-lg-4">

            

            <div class="form-group">
                <label class="input-label">
                    Pemindaian identitas</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="input-group-text <?php echo e(($user->financial_approval) ? '' : 'panel-file-manager'); ?>" data-input="identity_scan" data-preview="holder">
                            <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                        </button>
                    </div>
                    <input type="text" name="identity_scan" id="identity_scan" value="<?php echo e((!empty($user) and empty($new_user)) ? $user->identity_scan : old('identity_scan')); ?>" class="form-control <?php $__errorArgs = ['identity_scan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php echo e(($user->financial_approval) ? 'disabled' : ''); ?>/>
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
                <label class="input-label">Sertifikat & Dokumen</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="button" class="input-group-text panel-file-manager" data-input="certificate" data-preview="holder">
                            <i data-feather="arrow-up" width="18" height="18" class="text-white"></i>
                        </button>
                    </div>
                    <input type="text" name="certificate" id="certificate" value="<?php echo e((!empty($user) and empty($new_user)) ? $user->certificate : old('certificate')); ?>" class="form-control "/>
                </div>
            </div>

            <div class="form-group">
                <label class="input-label">Alamat</label>
                <input type="text" name="address" value="<?php echo e((!empty($user) and empty($new_user)) ? $user->address : old('address')); ?>" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder=""/>
                <?php $__errorArgs = ['address'];
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
    </div>

</section>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/setting/setting_includes/identity_and_financial.blade.php ENDPATH**/ ?>