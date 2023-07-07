<?php
    if (!empty($session->agora_settings)) {
        $session->agora_settings = json_decode($session->agora_settings);
    }
?>

<li data-id="<?php echo e(!empty($chapterItem) ? $chapterItem->id :''); ?>" class="accordion-row bg-white rounded-sm border border-gray300 mt-20 py-15 py-lg-30 px-10 px-lg-20">
    <div class="d-flex align-items-center justify-content-between " role="tab" id="session_<?php echo e(!empty($session) ? $session->id :'record'); ?>">
        <div class="d-flex align-items-center" href="#collapseSession<?php echo e(!empty($session) ? $session->id :'record'); ?>" aria-controls="collapseSession<?php echo e(!empty($session) ? $session->id :'record'); ?>" data-parent="#chapterContentAccordion<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" role="button" data-toggle="collapse" aria-expanded="true">
            <span class="chapter-icon chapter-content-icon mr-10">
                <i data-feather="file-text" class=""></i>
            </span>

            <div class="font-weight-bold text-dark-blue d-block"><?php echo e(!empty($session) ? $session->title : 'Tambah sesi live baru'); ?></div>
        </div>

        <div class="d-flex align-items-center">

            <?php if(!empty($session) and $session->status != \App\Models\WebinarChapter::$chapterActive): ?>
                <span class="disabled-content-badge mr-10">Nonaktifkan</span>
            <?php endif; ?>

            <?php if(!empty($session)): ?>
                <button type="button" data-item-id="<?php echo e($session->id); ?>" data-item-type="<?php echo e(\App\Models\WebinarChapterItem::$chapterSession); ?>" data-chapter-id="<?php echo e(!empty($chapter) ? $chapter->id : ''); ?>" class="js-change-content-chapter btn btn-sm btn-transparent text-gray mr-10">
                    <i data-feather="grid" class="" height="20"></i>
                </button>
            <?php endif; ?>

            <i data-feather="move" class="move-icon mr-10 cursor-pointer" height="20"></i>

            <?php if(!empty($session)): ?>
                <a href="/panel/sessions/<?php echo e($session->id); ?>/delete" class="delete-action btn btn-sm btn-transparent text-gray">
                    <i data-feather="trash-2" class="mr-10 cursor-pointer" height="20"></i>
                </a>
            <?php endif; ?>

            <i class="collapse-chevron-icon" data-feather="chevron-down" height="20" href="#collapseSession<?php echo e(!empty($session) ? $session->id :'record'); ?>" aria-controls="collapseSession<?php echo e(!empty($session) ? $session->id :'record'); ?>" data-parent="#chapterContentAccordion<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" role="button" data-toggle="collapse" aria-expanded="true"></i>
        </div>
    </div>

    <div id="collapseSession<?php echo e(!empty($session) ? $session->id :'record'); ?>" aria-labelledby="session_<?php echo e(!empty($session) ? $session->id :'record'); ?>" class=" collapse <?php if(empty($session)): ?> show <?php endif; ?>" role="tabpanel">
        <div class="panel-collapse text-gray">
            <div class="js-content-form session-form" data-action="/panel/sessions/<?php echo e(!empty($session) ? $session->id . '/update' : 'store'); ?>">
                <input type="hidden" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][webinar_id]" value="<?php echo e(!empty($webinar) ? $webinar->id :''); ?>">
                <input type="hidden" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][chapter_id]" value="<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" class="chapter-input">

                <div class="row">
                    <div class="col-12 col-lg-6">

                        <div class="form-group">
                            <label class="input-label">
                                Pilih aplikasi penyedia live</label>

                            <div class="js-session-api">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][session_api]" id="localApi<?php echo e(!empty($session) ? $session->id : ''); ?>" value="local" <?php if(empty($session) or $session->session_api == 'local'): ?> checked <?php endif; ?> class="js-api-input custom-control-input" <?php echo e((!empty($session) and $session->session_api != 'local') ? 'disabled' :''); ?>>
                                    <label class="custom-control-label" for="localApi<?php echo e(!empty($session) ? $session->id : ''); ?>">Custom</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][session_api]" id="bigBlueButton<?php echo e(!empty($session) ? $session->id : ''); ?>" value="big_blue_button" <?php if(!empty($session) and $session->session_api == 'big_blue_button'): ?> checked <?php endif; ?> class="js-api-input custom-control-input" <?php echo e((!empty($session) and $session->session_api != 'local') ? 'disabled' :''); ?>>
                                    <label class="custom-control-label" for="bigBlueButton<?php echo e(!empty($session) ? $session->id : ''); ?>">BigBlueButton</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][session_api]" id="zoomApi<?php echo e(!empty($session) ? $session->id : ''); ?>" value="zoom" <?php if(!empty($session) and $session->session_api == 'zoom'): ?> checked <?php endif; ?> class="js-api-input custom-control-input" <?php echo e((!empty($session) and $session->session_api != 'local') ? 'disabled' :''); ?>>
                                    <label class="custom-control-label" for="zoomApi<?php echo e(!empty($session) ? $session->id : ''); ?>">Zoom</label>
                                </div>

                                <?php if(getFeaturesSettings('agora_live_streaming') and (!empty($webinar->price) or getFeaturesSettings('agora_in_free_courses'))): ?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][session_api]" id="agoraApi<?php echo e(!empty($session) ? $session->id : ''); ?>" value="agora" <?php if(!empty($session) and $session->session_api == 'agora'): ?> checked <?php endif; ?> class="js-api-input custom-control-input" <?php echo e((!empty($session) and $session->session_api != 'local') ? 'disabled' :''); ?>>
                                        <label class="custom-control-label" for="agoraApi<?php echo e(!empty($session) ? $session->id : ''); ?>">Kelas live dalam aplikasi</label>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="invalid-feedback"></div>

                            <div class="js-zoom-not-complete-alert mt-10 text-danger d-none">
                                Harap selesaikan pengaturan Zoom Anda untuk membuat sesi langsung.
                                <a href="/panel/setting/step/8" class="text-primary" target="_blank">Pergi ke pengaturan</a>
                            </div>
                        </div>

                        <?php if(!empty(getGeneralSettings('content_translate'))): ?>
                            <div class="form-group">
                                <label class="input-label">Bahasa</label>
                                <select name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][locale]"
                                        class="form-control <?php echo e(!empty($session) ? 'js-webinar-content-locale' : ''); ?>"
                                        data-webinar-id="<?php echo e(!empty($webinar) ? $webinar->id : ''); ?>"
                                        data-id="<?php echo e(!empty($session) ? $session->id : ''); ?>"
                                        data-relation="sessions"
                                        data-fields="title,description"
                                >
                                    <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($lang); ?>" <?php echo e((!empty($session) and !empty($session->locale)) ? (mb_strtolower($session->locale) == mb_strtolower($lang) ? 'selected' : '') : ($locale == $lang ? 'selected' : '')); ?>><?php echo e($language); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][locale]" value="<?php echo e($defaultLocale); ?>">
                        <?php endif; ?>

                        <div class="form-group js-api-secret <?php echo e((!empty($session) and ($session->session_api == 'zoom' or $session->session_api == 'agora')) ? 'd-none' :''); ?>">
                            <label class="input-label">Kata sandi</label>
                            <input type="text" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][api_secret]" class="js-ajax-api_secret form-control" value="<?php echo e(!empty($session) ? $session->api_secret : ''); ?>" <?php echo e((!empty($session) and $session->session_api != 'local') ? 'disabled' :''); ?>/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group js-moderator-secret <?php echo e((empty($session) or $session->session_api != 'big_blue_button') ? 'd-none' :''); ?>">
                            <label class="input-label">Kata sandi moderator</label>
                            <input type="text" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][moderator_secret]" class="js-ajax-moderator_secret form-control" value="<?php echo e(!empty($session) ? $session->moderator_secret : ''); ?>" <?php echo e((!empty($session) and $session->session_api == 'big_blue_button') ? 'disabled' :''); ?>/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">Judul</label>
                            <input type="text" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][title]" class="js-ajax-title form-control" value="<?php echo e(!empty($session) ? $session->title : ''); ?>" placeholder="Maksimal 255 karakter"/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">Tanggal</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="dateRangeLabel">
                                        <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                    </span>
                                </div>
                                <input type="text" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][date]" class="js-ajax-date form-control datetimepicker" value="<?php echo e(!empty($session) ? dateTimeFormat($session->date, 'Y-m-d H:i', false) : ''); ?>" aria-describedby="dateRangeLabel" <?php echo e((!empty($session) and $session->session_api != 'local') ? 'disabled' :''); ?>/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">Durasi <span class="braces">(Menit)</span></label>
                            <input type="text" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][duration]" class="js-ajax-duration form-control" value="<?php echo e(!empty($session) ? $session->duration : ''); ?>" <?php echo e((!empty($session) and $session->session_api != 'local') ? 'disabled' :''); ?>/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group js-local-link <?php echo e((!empty($session) and $session->session_api == 'agora') ? 'd-none' : ''); ?>">
                            <label class="input-label">Tautan</label>
                            <input type="text" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][link]" class="js-ajax-link form-control" value="<?php echo e(!empty($session) ? $session->getJoinLink() : ''); ?>" <?php echo e((!empty($session) and $session->session_api != 'local') ? 'disabled' :''); ?>/>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label class="input-label">Deskripsi</label>
                            <textarea name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][description]" class="js-ajax-description form-control" rows="6"><?php echo e(!empty($session) ? $session->description : ''); ?></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <?php if(!empty(getFeaturesSettings('extra_time_to_join_status')) and getFeaturesSettings('extra_time_to_join_status')): ?>
                            <div class="form-group">
                                <label class="input-label">Waktu Tunda live <span class="braces">(Menit)</span></label>
                                <input type="text" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][extra_time_to_join]" value="<?php echo e((!empty($session) and $session->extra_time_to_join) ? $session->extra_time_to_join : getFeaturesSettings('extra_time_to_join_default_value')); ?>" class="js-ajax-extra_time_to_join form-control" placeholder=""/>
                                <div class="invalid-feedback"></div>
                            </div>
                        <?php elseif(!empty(getFeaturesSettings('extra_time_to_join_default_value'))): ?>
                            <input type="hidden" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][extra_time_to_join]" value="<?php echo e((!empty($session) and $session->extra_time_to_join) ? $session->extra_time_to_join : getFeaturesSettings('extra_time_to_join_default_value')); ?>" class="js-ajax-extra_time_to_join form-control" placeholder=""/>
                        <?php endif; ?>

                        <div class="form-group mt-20">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="cursor-pointer input-label" for="sessionStatusSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>">Aktif</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][status]" class="custom-control-input" id="sessionStatusSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>" <?php echo e((empty($session) or $session->status == \App\Models\Session::$Active) ? 'checked' : ''); ?>>
                                    <label class="custom-control-label" for="sessionStatusSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>"></label>
                                </div>
                            </div>
                        </div>

                        <div class="js-agora-chat-and-rec  <?php echo e((empty($session) or $session->session_api !== 'agora') ? 'd-none' : ''); ?>">
                            <?php if(getFeaturesSettings('agora_chat')): ?>
                                <div class="form-group mt-20">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="cursor-pointer input-label" for="sessionAgoraChatSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>">Obrolan</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][agora_chat]" class="custom-control-input" id="sessionAgoraChatSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>" <?php echo e((!empty($session) and !empty($session->agora_settings) and $session->agora_settings->chat) ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="sessionAgoraChatSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>"></label>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            

                        </div>

                        <?php if(getFeaturesSettings('sequence_content_status')): ?>
                            <div class="form-group mt-20">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="cursor-pointer input-label" for="SequenceContentSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>">Lanjutan</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][sequence_content]" class="js-sequence-content-switch custom-control-input" id="SequenceContentSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>" <?php echo e((!empty($session) and ($session->check_previous_parts or !empty($session->access_after_day))) ? 'checked' : ''); ?>>
                                        <label class="custom-control-label" for="SequenceContentSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>"></label>
                                    </div>
                                </div>
                            </div>

                            <div class="js-sequence-content-inputs pl-5 <?php echo e((!empty($session) and ($session->check_previous_parts or !empty($session->access_after_day))) ? '' : 'd-none'); ?>">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="cursor-pointer input-label" for="checkPreviousPartsSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>">Paksa peserta untuk melewati bagian sebelumnya</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][check_previous_parts]" class="custom-control-input" id="checkPreviousPartsSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>" <?php echo e((empty($session) or $session->check_previous_parts) ? 'checked' : ''); ?>>
                                            <label class="custom-control-label" for="checkPreviousPartsSwitch<?php echo e(!empty($session) ? $session->id : '_record'); ?>"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="input-label">Batas akses (hari)</label>
                                    <input type="number" name="ajax[<?php echo e(!empty($session) ? $session->id : 'new'); ?>][access_after_day]" value="<?php echo e((!empty($session)) ? $session->access_after_day : ''); ?>" class="js-ajax-access_after_day form-control" placeholder="misalnya '10' untuk mengizinkan peserta mengakses bagian ini setelah 10 hari."/>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mt-30 d-flex align-items-center">
                    <button type="button" class="js-save-session btn btn-sm btn-primary">Simpan</button>

                    <?php if(!empty($session)): ?>
                        <?php if(!$session->isFinished()): ?>
                            <a href="<?php echo e($session->getJoinLink(true)); ?>" target="_blank" class="ml-10 btn btn-sm btn-secondary">Bergabung</a>
                        <?php else: ?>
                            <button type="button" class="js-session-has-ended ml-10 btn btn-sm btn-secondary disabled">Bergabung</button>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(empty($session)): ?>
                        <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion">Tutup</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</li>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/create_includes/accordions/session.blade.php ENDPATH**/ ?>