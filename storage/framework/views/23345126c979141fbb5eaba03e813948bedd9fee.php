<div id="chapterModalHtml" class="d-none">
    <div class="custom-modal-body">
        <h2 class="section-title after-line">Bagian baru </h2>

        <div class="js-content-form chapter-form mt-20" data-action="<?php echo e(url('/admin/chapters/store')); ?>">

            <input type="hidden" name="ajax[chapter][webinar_id]" class="js-chapter-webinar-id" value="">
            

            <?php if(!empty(getGeneralSettings('content_translate'))): ?>

                <div class="form-group">
                    <label class="input-label">Bahasa</label>
                    <select name="ajax[chapter][locale]"
                            class="form-control js-chapter-locale"
                            data-webinar-id="<?php echo e(!empty($webinar) ? $webinar->id : ''); ?>"
                            data-id=""
                            data-relation="chapters"
                            data-fields="title"
                    >
                        <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lang); ?>"><?php echo e($language); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php else: ?>
                <input type="hidden" name="ajax[chapter][locale]" value="<?php echo e($defaultLocale); ?>">
            <?php endif; ?>


            <div class="form-group">
                <label class="input-label">
                    Judul Bagian</label>
                <input type="text" name="ajax[chapter][title]" class="form-control js-ajax-title" value=""/>
                <span class="invalid-feedback"></span>
            </div>

            <div class="form-group mt-2 d-flex align-items-center justify-content-between js-switch-parent">
                <label class="js-switch cursor-pointer" for="chapterStatus_record">Aktif</label>

                <div class="custom-control custom-switch">
                    <input id="chapterStatus_record" type="checkbox" checked name="ajax[chapter][status]" class="custom-control-input js-chapter-status-switch">
                    <label class="custom-control-label" for="chapterStatus_record"></label>
                </div>
            </div>

            <?php if(getFeaturesSettings('sequence_content_status')): ?>
                <div class="form-group mt-2 d-flex align-items-center justify-content-between js-switch-parent">
                    <label class="js-switch cursor-pointer" for="checkAllContentsPassSwitch_record">Peserta harus melewati semua bagian</label>

                    <div class="custom-control custom-switch">
                        <input id="checkAllContentsPassSwitch_record" type="checkbox" name="ajax[chapter][check_all_contents_pass]" class="custom-control-input js-chapter-check-all-contents-pass">
                        <label class="custom-control-label" for="checkAllContentsPassSwitch_record"></label>
                    </div>
                </div>
            <?php endif; ?>

            <div class="d-flex align-items-center justify-content-end mt-3">
                <button type="button" class="save-chapter btn btn-sm btn-primary">Simpan</button>
                <button type="button" class="close-swl btn btn-sm btn-danger ml-2">Tutup</button>
            </div>

        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/webinars/create_includes/chapter_modal.blade.php ENDPATH**/ ?>