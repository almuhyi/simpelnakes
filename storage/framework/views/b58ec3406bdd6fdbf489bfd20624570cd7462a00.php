<li data-id="<?php echo e(!empty($chapterItem) ? $chapterItem->id :''); ?>" class="accordion-row bg-white rounded-sm border border-gray300 mt-20 py-15 py-lg-30 px-10 px-lg-20">
    <div class="d-flex align-items-center justify-content-between " role="tab" id="file_<?php echo e(!empty($file) ? $file->id :'record'); ?>">
        <div class="d-flex align-items-center" href="#collapseFile<?php echo e(!empty($file) ? $file->id :'record'); ?>" aria-controls="collapseFile<?php echo e(!empty($file) ? $file->id :'record'); ?>" data-parent="#chapterContentAccordion<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" role="button" data-toggle="collapse" aria-expanded="true">
            <span class="chapter-icon chapter-content-icon mr-10">
                <i data-feather="<?php echo e(!empty($file) ? $file->getIconByType() : 'file'); ?>" class=""></i>
            </span>

            <div class="font-weight-bold text-dark-blue d-block"><?php echo e(!empty($file) ? $file->title . ($file->accessibility == 'free' ? " (". 'Gratis' .")" : '') : 'Tambahkan file baru'); ?></div>
        </div>

        <div class="d-flex align-items-center">
            <?php if(!empty($file) and $file->status != \App\Models\WebinarChapter::$chapterActive): ?>
                <span class="disabled-content-badge mr-10">Nonaktifkan</span>
            <?php endif; ?>

            <?php if(!empty($file)): ?>
                <button type="button" data-item-id="<?php echo e($file->id); ?>" data-item-type="<?php echo e(\App\Models\WebinarChapterItem::$chapterFile); ?>" data-chapter-id="<?php echo e(!empty($chapter) ? $chapter->id : ''); ?>" class="js-change-content-chapter btn btn-sm btn-transparent text-gray mr-10">
                    <i data-feather="grid" class="" height="20"></i>
                </button>
            <?php endif; ?>

            <i data-feather="move" class="move-icon mr-10 cursor-pointer" height="20"></i>

            <?php if(!empty($file)): ?>
                <a href="/panel/files/<?php echo e($file->id); ?>/delete" class="delete-action btn btn-sm btn-transparent text-gray">
                    <i data-feather="trash-2" class="mr-10 cursor-pointer" height="20"></i>
                </a>
            <?php endif; ?>

            <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseFile<?php echo e(!empty($file) ? $file->id :'record'); ?>" aria-controls="collapseFile<?php echo e(!empty($file) ? $file->id :'record'); ?>" data-parent="#chapterContentAccordion<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" role="button" data-toggle="collapse" aria-expanded="true"></i>
        </div>
    </div>

    <div id="collapseFile<?php echo e(!empty($file) ? $file->id :'record'); ?>" aria-labelledby="file_<?php echo e(!empty($file) ? $file->id :'record'); ?>" class=" collapse <?php if(empty($file)): ?> show <?php endif; ?>" role="tabpanel">
        <div class="panel-collapse text-gray">
            <div class="js-content-form file-form" data-action="/panel/files/<?php echo e(!empty($file) ? $file->id . '/update' : 'store'); ?>">
                <input type="hidden" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][webinar_id]" value="<?php echo e(!empty($webinar) ? $webinar->id :''); ?>">
                <input type="hidden" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][chapter_id]" value="<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" class="chapter-input">
                <input type="hidden" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][storage]" value="upload_archive" class="">
                <input type="hidden" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][file_type]" value="archive" class="">

                <div class="row">
                    <div class="col-12 col-lg-12">

                        <?php if(!empty(getGeneralSettings('content_translate'))): ?>
                            <div class="form-group">
                                <label class="input-label">Bahasa</label>
                                <select name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][locale]"
                                        class="form-control <?php echo e(!empty($file) ? 'js-webinar-content-locale' : ''); ?>"
                                        data-webinar-id="<?php echo e(!empty($webinar) ? $webinar->id : ''); ?>"
                                        data-id="<?php echo e(!empty($file) ? $file->id : ''); ?>"
                                        data-relation="files"
                                        data-fields="title,description"
                                >
                                    <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lang); ?>" <?php echo e((!empty($file) and !empty($file->locale)) ? (mb_strtolower($file->locale) == mb_strtolower($lang) ? 'selected' : '') : ($locale == $lang ? 'selected' : '')); ?>><?php echo e($language); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][locale]" value="<?php echo e($defaultLocale); ?>">
                        <?php endif; ?>


                        <div class="form-group">
                            <label class="input-label">Judul</label>
                            <input type="text" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][title]" class="js-ajax-title form-control" value="<?php echo e(!empty($file) ? $file->title : ''); ?>"  placeholder="Maksimal 255 karakter"/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">
                                Tipe SCORM</label>
                            <select name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][interactive_type]" class="js-interactive-type form-control">
                                <option value="adobe_captivate" <?php echo e((!empty($file) and $file->interactive_type == 'adobe_captivate') ? 'selected' : ''); ?>>Adobe captivate</option>
                                <option value="i_spring" <?php echo e((!empty($file) and $file->interactive_type == 'i_spring') ? 'selected' : ''); ?>>iSpring</option>
                                <option value="custom" <?php echo e((!empty($file) and $file->interactive_type == 'custom') ? 'selected' : ''); ?>>Custom</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="js-interactive-file-name-input form-group <?php echo e((!empty($file) and $file->interactive_type == 'custom') ? '' : 'd-none'); ?>">
                            <label class="input-label">nama file indeks SCORM</label>
                            <input type="text" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][interactive_file_name]" class="js-ajax-interactive_file_name form-control" value="<?php echo e(!empty($file) ? $file->interactive_file_name : ''); ?>" placeholder="misalnya scorm.html"/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">Aksesibilitas</label>

                            <div class="d-flex align-items-center js-ajax-accessibility">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][accessibility]" value="free" <?php if(empty($file) or (!empty($file) and $file->accessibility == 'free')): ?> checked="checked" <?php endif; ?> id="accessibilityRadio1_<?php echo e(!empty($file) ? $file->id : 'record'); ?>" class="custom-control-input">
                                    <label class="custom-control-label font-14 cursor-pointer" for="accessibilityRadio1_<?php echo e(!empty($file) ? $file->id : 'record'); ?>">Gratis</label>
                                </div>

                                <div class="custom-control custom-radio ml-15">
                                    <input type="radio" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][accessibility]" value="paid" <?php if(!empty($file) and $file->accessibility == 'paid'): ?> checked="checked" <?php endif; ?> id="accessibilityRadio2_<?php echo e(!empty($file) ? $file->id : 'record'); ?>" class="custom-control-input">
                                    <label class="custom-control-label font-14 cursor-pointer" for="accessibilityRadio2_<?php echo e(!empty($file) ? $file->id : 'record'); ?>">Berbayar</label>
                                </div>
                            </div>

                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group js-file-path-input">
                            <div class="local-input input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text panel-file-manager text-white" data-input="file_path<?php echo e(!empty($file) ? $file->id : 'record'); ?>" data-preview="holder">
                                        <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                    </button>
                                </div>
                                <input type="text" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][file_path]" id="file_path<?php echo e(!empty($file) ? $file->id : 'record'); ?>" value="<?php echo e((!empty($file)) ? $file->file : ''); ?>" class="js-ajax-file_path form-control" placeholder="Pilih file zip"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">Deskripsi</label>
                            <textarea name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][description]" class="js-ajax-description form-control" rows="6"><?php echo e(!empty($file) ? $file->description : ''); ?></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group mt-20">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="cursor-pointer input-label" for="fileStatusSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>">Aktif</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][status]" class="custom-control-input" id="fileStatusSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>" <?php echo e((empty($file) or $file->status == \App\Models\File::$Active) ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="fileStatusSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-30 d-flex align-items-center">
                    <button type="button" class="js-save-file btn btn-sm btn-primary">Simpan</button>

                    <?php if(empty($file)): ?>
                        <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion">Tutup</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</li>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var filePathPlaceHolderBySource = {
            upload: '<?php echo e(('Mengunggah file dari komputer Anda')); ?>',
            youtube: '<?php echo e(('Tempel tautan Youtube')); ?>',
            vimeo: '<?php echo e(('Tempel tautan Youtube')); ?>',
            external_link: '<?php echo e(('Tempel tautan eksternal')); ?>',
            google_drive: '<?php echo e(('Tautan pratinjau drive (Sematan) dimulai dengan tag iframe')); ?>',
            dropbox: '<?php echo e(('Unggah file dari sumber dropbox')); ?>',
            iframe: '<?php echo e(('Rekatkan seluruh kode iframe')); ?>',
            s3: '<?php echo e(('Unggah file dari komputer Anda ke S3')); ?>',
        }
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/create_includes/accordions/new_interactive_file.blade.php ENDPATH**/ ?>