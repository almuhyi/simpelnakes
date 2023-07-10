<!-- Modal -->
<div class="d-none" id="extraDescriptionForm">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">Tambahkan item</h3>

    <div class="js-form" data-action="<?php echo e(url('/admin/webinar-extra-description/store')); ?>">
        <input type="hidden" name="webinar_id" value="<?php echo e(!empty($webinar) ? $webinar->id :''); ?>">
        <input type="hidden" name="type">

        <div class="js-form-groups">
            <?php if(!empty(getGeneralSettings('content_translate'))): ?>
                <div class="js-no-company-input form-group">
                    <label class="input-label">Bahasa</label>
                    <select name="locale" class="form-control ">
                        <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lang); ?>" <?php if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)): ?> selected <?php endif; ?>><?php echo e($language); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['locale'];
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
            <?php else: ?>
                <input type="hidden" name="locale" value="<?php echo e(getDefaultLocale()); ?>">
            <?php endif; ?>

            <div class="js-no-company-input form-group">
                <label class="input-label">Judul</label>
                <input type="text" name="value" class="js-ajax-title form-control"/>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" id="saveExtraDescription" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger ml-2 close-swl">Tutup</button>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/webinars/modals/extra_description.blade.php ENDPATH**/ ?>