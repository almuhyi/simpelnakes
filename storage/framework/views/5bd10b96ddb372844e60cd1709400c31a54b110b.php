<div id="descriptiveQuestionModal" class="<?php if(!empty($quiz)): ?> descriptiveQuestionModal<?php echo e($quiz->id); ?> <?php endif; ?> <?php echo e(empty($question_edit) ? 'd-none' : ''); ?>">
    <div class="custom-modal-body">
        <h2 class="section-title after-line">
            Pertanyaan deskriptif baru</h2>

        <div class="quiz-questions-form" data-action="/panel/quizzes-questions/<?php echo e(empty($question_edit) ? 'store' : $question_edit->id.'/update'); ?>">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="ajax[quiz_id]" value="<?php echo e(!empty($quiz) ? $quiz->id :''); ?>">
            <input type="hidden" name="ajax[type]" value="<?php echo e(\App\Models\QuizzesQuestion::$descriptive); ?>">
            <div class="row mt-25">

                <?php if(!empty(getGeneralSettings('content_translate'))): ?>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="input-label">Bahasa</label>
                            <select name="ajax[locale]"
                                    class="form-control <?php echo e(!empty($question_edit) ? 'js-quiz-question-locale' : ''); ?>"
                                    data-id="<?php echo e(!empty($question_edit) ? $question_edit->id : ''); ?>"
                            >
                                <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($lang); ?>" <?php echo e((!empty($question_edit) and !empty($question_edit->locale)) ? (mb_strtolower($question_edit->locale) == mb_strtolower($lang) ? 'selected' : '') : ($locale == $lang ? 'selected' : '')); ?>><?php echo e($language); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                <?php else: ?>
                    <input type="hidden" name="ajax[locale]" value="<?php echo e($defaultLocale); ?>">
                <?php endif; ?>

                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <label class="input-label">Judul pertanyaan</label>
                        <input type="text" name="ajax[title]" class="js-ajax-title form-control" value="<?php echo e(!empty($question_edit) ? $question_edit->title : ''); ?>"/>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label class="input-label">Nilai</label>
                        <input type="text" name="ajax[grade]" class="js-ajax-grade form-control" value="<?php echo e(!empty($question_edit) ? $question_edit->grade : ''); ?>"/>
                        <span class="invalid-feedback"></span>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="input-label">Gambar (Opsional)</label>

                        <div class="input-group mr-10">
                            <div class="input-group-prepend">
                                <button type="button" class="input-group-text panel-file-manager" data-input="questionImageInput_<?php echo e(!empty($question_edit) ? $question_edit->id : 'record'); ?>" data-preview="holder">
                                    <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                </button>
                            </div>
                            <input type="text" name="ajax[image]" id="questionImageInput_<?php echo e(!empty($question_edit) ? $question_edit->id : 'record'); ?>" value="<?php echo e(!empty($question_edit) ? $question_edit->image : ''); ?>" class="js-ajax-image form-control" placeholder=""/>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="input-label">Video (Opsional)</label>

                        <div class="input-group mr-10">
                            <div class="input-group-prepend">
                                <button type="button" class="input-group-text panel-file-manager" data-input="questionVideoInput_<?php echo e(!empty($question_edit) ? $question_edit->id : 'record'); ?>" data-preview="holder">
                                    <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                </button>
                            </div>
                            <input type="text" name="ajax[video]" id="questionVideoInput_<?php echo e(!empty($question_edit) ? $question_edit->id : 'record'); ?>" value="<?php echo e(!empty($question_edit) ? $question_edit->video : ''); ?>" class="js-ajax-video form-control" placeholder=""/>
                            <span class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>
            </div>
            <p class="font-12 text-gray col-12 pb-10">
                Anda hanya dapat mengisi salah satu bidang gambar atau video. Hindari mengisi keduanya.</p>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="input-label">
                            Jawaban yang benar</label>
                        <textarea name="ajax[correct]" class="js-ajax-correct form-control" rows="10"><?php echo e(!empty($question_edit) ? $question_edit->correct : ''); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-end mt-25">
                <button type="button" class="save-question btn btn-sm btn-primary">Simpan</button>
                <button type="button" class="close-swl btn btn-sm btn-danger ml-10">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/quizzes/modals/descriptive_question.blade.php ENDPATH**/ ?>