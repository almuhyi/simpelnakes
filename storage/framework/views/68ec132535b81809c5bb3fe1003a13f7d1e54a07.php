<?php if(!empty($file) and $file->storage == 'upload_archive'): ?>
    <?php echo $__env->make('admin.webinars.create_includes.accordions.new_interactive_file',['file' => $file], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
    <li data-id="<?php echo e(!empty($chapterItem) ? $chapterItem->id :''); ?>" class="accordion-row bg-white rounded-sm border border-gray300 mt-20 py-15 py-lg-30 px-10 px-lg-20">
        <div class="d-flex align-items-center justify-content-between " role="tab" id="file_<?php echo e(!empty($file) ? $file->id :'record'); ?>">
            <div class="d-flex align-items-center" href="#collapseFile<?php echo e(!empty($file) ? $file->id :'record'); ?>" aria-controls="collapseFile<?php echo e(!empty($file) ? $file->id :'record'); ?>" data-parent="#chapterContentAccordion<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" role="button" data-toggle="collapse" aria-expanded="true">
            <span class="chapter-icon chapter-content-icon mr-10">
                <i data-feather="<?php echo e(!empty($file) ? $file->getIconByType() : 'file'); ?>" class=""></i>
            </span>

                <div class="font-weight-bold text-dark-blue d-block cursor-pointer"><?php echo e(!empty($file) ? $file->title . ($file->accessibility == 'free' ? " (". 'Gratis' .")" : '') : 'Tambah file baru'); ?></div>
            </div>

            <div class="d-flex align-items-center">

                <?php if(!empty($file) and $file->status != \App\Models\WebinarChapter::$chapterActive): ?>
                    <span class="disabled-content-badge mr-10">Tidak aktif</span>
                <?php endif; ?>

                <?php if(!empty($file)): ?>
                    <button type="button" data-item-id="<?php echo e($file->id); ?>" data-item-type="<?php echo e(\App\Models\WebinarChapterItem::$chapterFile); ?>" data-chapter-id="<?php echo e(!empty($chapter) ? $chapter->id : ''); ?>" class="js-change-content-chapter btn btn-sm btn-transparent text-gray mr-10">
                        <i data-feather="grid" class="" height="20"></i>
                    </button>
                <?php endif; ?>

                <i data-feather="move" class="move-icon mr-10 cursor-pointer" height="20"></i>

                <?php if(!empty($file)): ?>
                    <a href="<?php echo e(url('')); ?>/admin/files/<?php echo e($file->id); ?>/delete" class="delete-action btn btn-sm btn-transparent text-gray">
                        <i data-feather="trash-2" class="mr-10 cursor-pointer" height="20"></i>
                    </a>
                <?php endif; ?>

                <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseFile<?php echo e(!empty($file) ? $file->id :'record'); ?>" aria-controls="collapseFile<?php echo e(!empty($file) ? $file->id :'record'); ?>" data-parent="#chapterContentAccordion<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" role="button" data-toggle="collapse" aria-expanded="true"></i>
            </div>
        </div>

        <div id="collapseFile<?php echo e(!empty($file) ? $file->id :'record'); ?>" aria-labelledby="file_<?php echo e(!empty($file) ? $file->id :'record'); ?>" class=" collapse <?php if(empty($file)): ?> show <?php endif; ?>" role="tabpanel">
            <div class="panel-collapse text-gray">
                <div class="js-content-form file-form" data-action="<?php echo e(url('')); ?>/admin/files/<?php echo e(!empty($file) ? $file->id . '/update' : 'store'); ?>">
                    <input type="hidden" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][webinar_id]" value="<?php echo e(!empty($webinar) ? $webinar->id :''); ?>">
                    <input type="hidden" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][chapter_id]" value="<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" class="chapter-input">

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
                                            <option value="<?php echo e($lang); ?>" <?php echo e((!empty($file) and !empty($file->locale)) ? (mb_strtolower($file->locale) == mb_strtolower($lang) ? 'selected' : '') : (app()->getLocale() == $lang ? 'selected' : '')); ?>><?php echo e($language); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            <?php else: ?>
                                <input type="hidden" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][locale]" value="<?php echo e($defaultLocale); ?>">
                            <?php endif; ?>


                            <div class="form-group">
                                <label class="input-label">Judul</label>
                                <input type="text" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][title]" class="js-ajax-title form-control" value="<?php echo e(!empty($file) ? $file->title : ''); ?>" placeholder="Maksimal 255 karakter"/>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label class="input-label">
                                    Sumber</label>
                                <select name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][storage]"
                                        class="js-file-storage form-control"
                                >
                                    <?php $__currentLoopData = \App\Models\File::$fileSources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($source); ?>" <?php if(!empty($file) and $file->storage == $source): ?> selected <?php endif; ?>><?php echo e($source); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="input-label">
                                    Aksesibilitas</label>

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


                            <div class="form-group js-file-path-input <?php echo e((!empty($file) and $file->storage == 's3') ? 'd-none' : ''); ?>">
                                <div class="local-input input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text admin-file-manager " data-input="file_path<?php echo e(!empty($file) ? $file->id : 'record'); ?>" data-preview="holder">
                                            <i data-feather="upload" width="18" height="18" class=""></i>
                                        </button>
                                    </div>
                                    <input type="text" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][file_path]" id="file_path<?php echo e(!empty($file) ? $file->id : 'record'); ?>" value="<?php echo e((!empty($file)) ? $file->file : ''); ?>" class="js-ajax-file_path form-control" placeholder="Unggah file dari PC anda"/>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="form-group js-s3-file-path-input <?php echo e((!empty($file) and $file->storage == 's3') ? '' : 'd-none'); ?>">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text text-white">
                                            <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                        </button>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][s3_file]" class="js-s3-file-input custom-file-input cursor-pointer" id="s3File<?php echo e(!empty($file) ? $file->id : 'record'); ?>">
                                        <label class="custom-file-label cursor-pointer" for="s3File<?php echo e(!empty($file) ? $file->id : 'record'); ?>">Pilih file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group js-file-type-volume d-none">
                                <div class="col-6">
                                    <label class="input-label">Jenis file</label>
                                    <select name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][file_type]" class="js-ajax-file_type form-control">
                                        <option value="">Pilih file</option>

                                        <?php $__currentLoopData = \App\Models\File::$fileTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fileType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($fileType); ?>" <?php if(!empty($file) and $file->file_type == $fileType): ?> selected <?php endif; ?>><?php echo e($fileType); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-6">
                                    <label class="input-label">Volume (MB)</label>
                                    <input type="text" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][volume]" value="<?php echo e((!empty($file)) ? $file->volume : ''); ?>" class="js-ajax-volume form-control" placeholder="Tulis file volume (MB)"/>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="input-label">Deskripsi</label>
                                <textarea name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][description]" class="js-ajax-description form-control" rows="6"><?php echo e(!empty($file) ? $file->description : ''); ?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="js-online_viewer-input form-group mt-20">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="cursor-pointer input-label" for="online_viewerSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>">
                                        Penampil daring</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][online_viewer]" class="custom-control-input" id="online_viewerSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>" <?php echo e((!empty($file) and $file->online_viewer) ? 'checked' : ''); ?>>
                                        <label class="custom-control-label" for="online_viewerSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="js-downloadable-input form-group mt-20">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="cursor-pointer input-label" for="downloadableSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>">Dapat diunduh</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][downloadable]" class="custom-control-input" id="downloadableSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>" <?php echo e((empty($file) or $file->downloadable) ? 'checked' : ''); ?>>
                                        <label class="custom-control-label" for="downloadableSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>"></label>
                                    </div>
                                </div>
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

                            <?php if(getFeaturesSettings('sequence_content_status')): ?>
                                <div class="form-group mt-20">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="cursor-pointer input-label" for="SequenceContentSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>">Lainnya</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][sequence_content]" class="js-sequence-content-switch custom-control-input" id="SequenceContentSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>" <?php echo e((!empty($file) and ($file->check_previous_parts or !empty($file->access_after_day))) ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="SequenceContentSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="js-sequence-content-inputs pl-5 <?php echo e((!empty($file) and ($file->check_previous_parts or !empty($file->access_after_day))) ? '' : 'd-none'); ?>">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="cursor-pointer input-label" for="checkPreviousPartsSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>">
                                                Paksa peserta untuk melewati bagian sebelumnya</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][check_previous_parts]" class="custom-control-input" id="checkPreviousPartsSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>" <?php echo e((empty($file) or $file->check_previous_parts) ? 'checked' : ''); ?>>
                                                <label class="custom-control-label" for="checkPreviousPartsSwitch<?php echo e(!empty($file) ? $file->id : '_record'); ?>"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="input-label">
                                            Batas hari akses</label>
                                        <input type="number" name="ajax[<?php echo e(!empty($file) ? $file->id : 'new'); ?>][access_after_day]" value="<?php echo e((!empty($file)) ? $file->access_after_day : ''); ?>" class="js-ajax-access_after_day form-control" placeholder="
                                        misalnya 10 untuk mengizinkan peserta mengakses bagian ini setelah 10 hari."/>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            <?php endif; ?>
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
                upload: '<?php echo e(('Unggah file dari PC Anda')); ?>',
            youtube: '<?php echo e(('Tempel tautan Youtube')); ?>',
            vimeo: '<?php echo e(('Tempel tautan Youtube')); ?>',
            external_link: '<?php echo e(('Tempel tautan eksternal')); ?>',
            google_drive: '<?php echo e(('Tautan pratinjau Drive (Sematan) dimulai dengan tag iframe')); ?>',
            dropbox: '<?php echo e(('Tempel tautan dropbox')); ?>',
            iframe: '<?php echo e(('Rekatkan seluruh kode iframe')); ?>',
            s3: '<?php echo e(('Unggah file dari PC Anda ke S3')); ?>',
            }
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/webinars/create_includes/accordions/file.blade.php ENDPATH**/ ?>