<div class="d-none" id="webinarNextSessionModal">
    <form action="/panel/sessions/store" method="post">
        <?php echo e(csrf_field()); ?>


        <input type="hidden" name="ajax[new][webinar_id]">
        <input type="hidden" name="ajax[new][chapter_id]">
        <input type="hidden" name="ajax[new][locale]">
        <input type="hidden" name="ajax[new][status]" value="on">
        <input type="hidden" name="ajax[new][agora_chat]">
        <input type="hidden" name="ajax[new][agora_rec]">

        <h3 class="section-title after-line font-16 text-dark-blue mb-25">
            Informasi sesi berikutnya</h3>

        <div class="mt-25">

            <div class="row">
                <div class="col-12 col-md-7">
                    <?php if(!empty(getGeneralSettings('content_translate'))): ?>
                        <div class="form-group">
                            <label class="input-label">Bahasa</label>
                            <select name="ajax[new][locale]"
                                    class="form-control"
                                    data-bundle-id=""
                                    data-id=""
                                    data-relation=""
                                    data-fields=""
                            >
                                <?php $__currentLoopData = getUserLanguagesLists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($lang); ?>" <?php echo e(app()->getLocale() == $lang ? 'selected' : ''); ?>><?php echo e($language); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="ajax[new][locale]" value="">
                    <?php endif; ?>
                </div>
                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <label class="input-label">Bagian</label>

                        <select name="ajax[new][chapter_id]" class="js-ajax-chapter_id form-control">

                        </select>

                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="form-group">
                        <label class="input-label">Judul sesi</label>
                        <input type="text" name="ajax[new][title]" class="js-ajax-title form-control" value=""/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-12 col-md-5">
                    <div class="form-group">
                        <label class="input-label">Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                            </span>
                            </div>
                            <input type="text" name="ajax[new][date]" value="" class="js-ajax-date form-control datetimepicker"/>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="input-label">Deskripsi</label>
                        <textarea name="ajax[new][description]" class="js-ajax-description form-control" rows="5"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="section-title after-line font-16 text-dark-blue mb-25">Informasi bergabung</h3>

        <div class="row">
            <div class="col-6 js-local-link">
                <div class="form-group">
                    <label class="input-label">Tautan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="input-group-text js-copy" data-input="ajax[new][link]" data-toggle="tooltip" data-placement="top" title="Salin" data-copy-text="Salin" data-done-text="Tersalin">
                                <i data-feather="copy" width="18" height="18" class="text-white"></i>
                            </button>
                        </div>
                        <input type="text" name="ajax[new][link]" value="" class="js-ajax-link form-control"/>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label class="input-label">Durasi</label>
                    <input type="text" name="ajax[new][duration]" value="" class="js-ajax-duration form-control"/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label class="input-label">Sistem</label>

                    <select name="ajax[new][session_api]" class="js-ajax-session_api form-control">
                        <option value="local">Custom</option>
                        <option value="big_blue_button">BigblueButton</option>
                        <option value="zoom">Zoom</option>
                        <option value="agora">Aplikasi kelas live</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="col-12 col-md-6 js-api-secret">
                <div class="form-group">
                    <label class="input-label">Kata sandi</label>
                    <input type="text" name="ajax[new][api_secret]" class="js-ajax-api_secret form-control" value=""/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="col-12 col-md-6 js-moderator-secret d-none">
                <div class="form-group">
                    <label class="input-label">Kata sandi moderator</label>
                    <input type="text" name="ajax[new][moderator_secret]" class="js-ajax-moderator_secret form-control" value=""/>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" class="js-save-next-session btn btn-sm btn-primary">Simpan</button>
            <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">Tutup</button>
        </div>
    </form>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/make_next_session_modal.blade.php ENDPATH**/ ?>