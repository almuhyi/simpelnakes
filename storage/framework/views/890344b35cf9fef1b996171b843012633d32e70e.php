<div class="">
    <div data-action="<?php echo e(!empty($quiz) ? '/panel/quizzes/'. $quiz->id .'/update' : '/panel/quizzes/store'); ?>" class="js-content-form quiz-form webinar-form">

        <section>
            <h2 class="section-title after-line"><?php echo e(!empty($quiz) ? ('Edit'.' ('. $quiz->title .')') : 'Kuis baru'); ?></h2>

            <div class="row">
                <div class="col-12 col-md-12">

                    <?php if(!empty(getGeneralSettings('content_translate'))): ?>
                        <div class="form-group mt-25">
                            <label class="input-label">Bahasa</label>
                            <select name="ajax[locale]"
                                    class="form-control <?php echo e(!empty($quiz) ? 'js-webinar-content-locale' : ''); ?>"
                                    data-webinar-id="<?php echo e(!empty($quiz) ? $quiz->webinar_id : ''); ?>"
                                    data-id="<?php echo e(!empty($quiz) ? $quiz->id : ''); ?>"
                                    data-relation="quizzes"
                                    data-fields="title"
                            >
                                <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($lang); ?>" <?php echo e((!empty($quiz) and !empty($quiz->locale)) ? (mb_strtolower($quiz->locale) == mb_strtolower($lang) ? 'selected' : '') : ($locale == $lang ? 'selected' : '')); ?>><?php echo e($language); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="ajax[locale]" value="<?php echo e($defaultLocale); ?>">
                    <?php endif; ?>

                    <?php if(empty($selectedWebinar)): ?>
                        <div class="form-group mt-25">
                            <label class="input-label">Pelatihan</label>
                            <select name="ajax[webinar_id]" class="js-ajax-webinar_id custom-select">
                                <option <?php echo e(!empty($quiz) ? 'disabled' : 'selected disabled'); ?> value="">Pilih pelatihan</option>
                                <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($webinar->id); ?>" <?php echo e((!empty($quiz) and $quiz->webinar_id == $webinar->id) ? 'selected' : ''); ?>><?php echo e($webinar->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="ajax[webinar_id]" value="<?php echo e($selectedWebinar->id); ?>">
                    <?php endif; ?>

                    <?php if(!empty($chapter) or !empty($webinarChapterPages)): ?>
                        <input type="hidden" name="ajax[chapter_id]" value="<?php echo e(!empty($chapter) ? $chapter->id :''); ?>" class="chapter-input">
                    <?php else: ?>
                        <div class="form-group mt-25">
                            <label class="input-label">Bagian</label>

                            <select name="ajax[chapter_id]" class="js-ajax-chapter_id custom-select">
                                <option value="">Tidak ada Bagian</option>

                                <?php if(!empty($chapters) and count($chapters)): ?>
                                    <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($chapter->id); ?>" <?php echo e((!empty($quiz) and $quiz->chapter_id == $chapter->id) ? 'selected' : ''); ?>><?php echo e($chapter->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <div class="form-group <?php if(!empty($selectedWebinar)): ?> mt-25 <?php endif; ?>">
                        <label class="input-label">Judul kuis</label>
                        <input type="text" value="<?php echo e(!empty($quiz) ? $quiz->title : old('title')); ?>" name="ajax[title]" class="js-ajax-title form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder=""/>
                        <div class="invalid-feedback">
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">Waktu<span class="braces">(Menit)</span></label>
                        <input type="number" value="<?php echo e(!empty($quiz) ? $quiz->time : old('time')); ?>" name="ajax[time]" class="js-ajax-time form-control <?php $__errorArgs = ['time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Biarkan kosong untuk waktu tidak terbatas."/>
                        <div class="invalid-feedback">
                            <?php $__errorArgs = ['time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">Jumlah percobaan</label>
                        <input type="number" name="ajax[attempt]" value="<?php echo e(!empty($quiz) ? $quiz->attempt : old('attempt')); ?>" class="js-ajax-attempt form-control <?php $__errorArgs = ['attempt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Biarkan kosong untuk percobaan tidak terbatas."/>
                        <div class="invalid-feedback">
                            <?php $__errorArgs = ['attempt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="input-label">Nilai lulus</label>
                        <input type="number" name="ajax[pass_mark]" value="<?php echo e(!empty($quiz) ? $quiz->pass_mark : old('pass_mark')); ?>" class="js-ajax-pass_mark form-control <?php $__errorArgs = ['pass_mark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder=""/>
                        <div class="invalid-feedback">
                            <?php $__errorArgs = ['pass_mark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="form-group mt-20 d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="certificateSwitch<?php echo e(!empty($quiz) ? $quiz->id : 'record'); ?>">Sertifikat disertakan</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="ajax[certificate]" class="js-ajax-certificate custom-control-input" id="certificateSwitch<?php echo e(!empty($quiz) ? $quiz->id : 'record'); ?>" <?php echo e(!empty($quiz) && $quiz->certificate ? 'checked' : ''); ?>>
                            <label class="custom-control-label" for="certificateSwitch<?php echo e(!empty($quiz) ? $quiz->id : 'record'); ?>"></label>
                        </div>
                    </div>

                    <div class="form-group mt-20 d-flex align-items-center justify-content-between">
                        <label class="cursor-pointer input-label" for="statusSwitch<?php echo e(!empty($quiz) ? $quiz->id : 'record'); ?>">Aktif</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="ajax[status]" class="js-ajax-status custom-control-input" id="statusSwitch<?php echo e(!empty($quiz) ? $quiz->id : 'record'); ?>" <?php echo e((!empty($quiz) && $quiz->status == 'active') ? 'checked' : ''); ?>>
                            <label class="custom-control-label" for="statusSwitch<?php echo e(!empty($quiz) ? $quiz->id : 'record'); ?>"></label>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <?php if(!empty($quiz)): ?>
            <section class="mt-30">
                <div class="d-block d-md-flex justify-content-between align-items-center pb-20">
                    <h2 class="section-title after-line">Pertanyaan</h2>

                    <div class="d-flex align-items-center mt-20 mt-md-0">
                        <button id="add_multiple_question" data-quiz-id="<?php echo e($quiz->id); ?>" type="button" class="quiz-form-btn btn btn-primary btn-sm ml-10">Tambahkan pilihan ganda</button>
                        <button id="add_descriptive_question" data-quiz-id="<?php echo e($quiz->id); ?>" type="button" class="quiz-form-btn btn btn-primary btn-sm ml-10">Tambahkan Deskriptif</button>
                    </div>
                </div>

                <?php if($quizQuestions): ?>
                    <?php $__currentLoopData = $quizQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="quiz-question-card d-flex align-items-center mt-20">
                            <div class="flex-grow-1">
                                <h4 class="question-title"><?php echo e($question->title); ?></h4>
                                <div class="font-12 mt-5 question-infos">
                                    <span><?php echo e($question->type === App\Models\QuizzesQuestion::$multiple ? 'Pilihan ganda' : 'Deskriptif'); ?> | Nilai: <?php echo e($question->grade); ?></span>
                                </div>
                            </div>

                            <div class="btn-group dropdown table-actions">
                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="more-vertical" height="20"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" data-question-id="<?php echo e($question->id); ?>" class="edit_question btn btn-sm btn-transparent d-block">Edit</button>
                                    <a href="/panel/quizzes-questions/<?php echo e($question->id); ?>/delete" class="delete-action btn btn-sm btn-transparent d-block">Hapus</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <input type="hidden" name="ajax[is_webinar_page]" value="<?php if(!empty($inWebinarPage) and $inWebinarPage): ?> 1 <?php else: ?> 0 <?php endif; ?>">

        <div class="mt-20 mb-20">
            <button type="button" class="js-submit-quiz-form btn btn-sm btn-primary"><?php echo e(!empty($quiz) ? 'Simpan' : 'Buat'); ?></button>

            <?php if(empty($quiz) and !empty($inWebinarPage)): ?>
                <button type="button" class="btn btn-sm btn-danger ml-10 cancel-accordion">Tutup</button>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal -->
<?php if(!empty($quiz)): ?>
    <?php echo $__env->make(getTemplate() .'.panel.quizzes.modals.multiple_question',['quiz' => $quiz], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make(getTemplate() .'.panel.quizzes.modals.descriptive_question',['quiz' => $quiz], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/quizzes/create_quiz_form.blade.php ENDPATH**/ ?>