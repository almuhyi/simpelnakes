<?php $__env->startPush('styles_top'); ?>

<?php $__env->stopPush(); ?>


<section class="mt-50">
    <div class="">
        <h2 class="section-title after-line">Kuis & Sertifikasi (Opsional)</h2>
    </div>

    <button id="webinarAddQuiz" data-webinar-id="<?php echo e($webinar->id); ?>" type="button" class="btn btn-primary btn-sm mt-15">Tambah kuis baru</button>

    <div class="row mt-10">
        <div class="col-12">

            <div class="accordion-content-wrapper mt-15" id="quizzesAccordion" role="tablist" aria-multiselectable="true">
                <?php if(!empty($webinar->quizzes) and count($webinar->quizzes)): ?>
                    <?php $__currentLoopData = $webinar->quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quizInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.quiz',['webinar' => $webinar,'quizInfo' => $quizInfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                        'file_name' => 'cert.png',
                        'title' => 'Tidak ada Kuis yang dibuat dan dipilih untuk pelatihan ini.',
                        'hint' => 'Dengan membuat kuis, Anda dapat mengevaluasi peserta dan memberikan sertifikat kepada mereka.',
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<div id="newQuizForm" class="d-none">
    <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.quiz',['webinar' => $webinar,'quizInfo' => null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>


<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var saveSuccessLang = '<?php echo e(('Item berhasil ditambahkan.')); ?>';
        var quizzesSectionLang = '<?php echo e(('Tidak ada Bagian')); ?>';
    </script>

    <script src="/assets/default/js/panel/quiz.min.js"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/create_includes/step_7.blade.php ENDPATH**/ ?>