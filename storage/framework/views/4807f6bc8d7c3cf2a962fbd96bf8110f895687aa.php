<section>
    <h3 class="section-title after-line mt-35">Tentang</h3>

    <div class="row mt-20">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label class="input-label">
                    Biografi</label>
                <textarea name="about" rows="9" class="form-control <?php $__errorArgs = ['about'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo (!empty($user) and empty($new_user)) ? $user->about : old('about'); ?></textarea>
                <?php $__errorArgs = ['about'];
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
                <label class="input-label">Judul pekerjaan</label>
                <textarea name="bio" rows="3" class="form-control <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e($user->bio); ?></textarea>
                <?php $__errorArgs = ['bio'];
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

                <div class="mt-15">
                     <p class="font-12 text-gray">- "Jabatan" akan ditampilkan di bagian bawah nama Anda pada kartu profil.</p>
                     <p class="font-12 text-gray">
                        - Singkat (2 atau 3 kata) Misalnya "Desainer produk, Perawat".</p>
                </div>

            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/setting/setting_includes/about.blade.php ENDPATH**/ ?>