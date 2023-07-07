<?php $__env->startPush('styles_top'); ?>
    <link href="/assets/default/vendors/sortable/jquery-ui.min.css"/>
<?php $__env->stopPush(); ?>


<section class="mt-50">
    <div class="">
        <h2 class="section-title after-line">FAQ (Opsional)</h2>
    </div>

    <button id="webinarAddFAQ" data-webinar-id="<?php echo e($webinar->id); ?>" type="button" class="btn btn-primary btn-sm mt-15">Tambah FAQ baru</button>

    <div class="row mt-10">
        <div class="col-12">

            <div class="accordion-content-wrapper mt-15" id="faqsAccordion" role="tablist" aria-multiselectable="true">
                <?php if(!empty($webinar->faqs) and count($webinar->faqs)): ?>
                    <ul class="draggable-lists" data-order-table="faqs">
                        <?php $__currentLoopData = $webinar->faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faqInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.faq',['webinar' => $webinar,'faq' => $faqInfo], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                        'file_name' => 'faq.png',
                        'title' => 'Tidak ada FAQ yang ditentukan!',
                        'hint' => 'Dengan membuat FAQ, Anda akan membantu pengguna mengetahui lebih banyak tentang pelatihan Anda.',
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<div id="newFaqForm" class="d-none">
    <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.faq',['webinar' => $webinar], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php $__currentLoopData = \App\Models\WebinarExtraDescription::$types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinarExtraDescriptionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <section class="mt-50">
        <div class="">
            <h2 class="section-title after-line"><?php echo e($webinarExtraDescriptionType); ?> (Opsional)</h2>
        </div>

        <button id="add_new_<?php echo e($webinarExtraDescriptionType); ?>" data-webinar-id="<?php echo e($webinar->id); ?>" type="button" class="btn btn-primary btn-sm mt-15">Tambah <?php echo e($webinarExtraDescriptionType); ?> baru</button>

        <div class="row mt-10">
            <div class="col-12">

                <?php
                    $webinarExtraDescriptionValues = $webinar->webinarExtraDescription->where('type',$webinarExtraDescriptionType);
                ?>

                <div class="accordion-content-wrapper mt-15" id="<?php echo e($webinarExtraDescriptionType); ?>_accordion" role="tablist" aria-multiselectable="true">
                    <?php if(!empty($webinarExtraDescriptionValues) and count($webinarExtraDescriptionValues)): ?>
                        <ul class="draggable-content-lists draggable-lists-<?php echo e($webinarExtraDescriptionType); ?>" data-drag-class="draggable-lists-<?php echo e($webinarExtraDescriptionType); ?>" data-order-table="webinar_extra_descriptions_<?php echo e($webinarExtraDescriptionType); ?>">
                            <?php $__currentLoopData = $webinarExtraDescriptionValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $learningMaterialInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.extra_description',
                                    [
                                        'webinar' => $webinar,
                                        'extraDescription' => $learningMaterialInfo,
                                        'extraDescriptionType' => $webinarExtraDescriptionType,
                                        'extraDescriptionParentAccordion' => $webinarExtraDescriptionType.'_accordion',
                                    ]
                                , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <?php echo $__env->make(getTemplate() . '.includes.no-result',[
                            'file_name' => 'faq.png',
                            'title' => "$webinarExtraDescriptionType",
                            'hint' => "$webinarExtraDescriptionType",
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <div id="new_<?php echo e($webinarExtraDescriptionType); ?>_html" class="d-none">
        <?php echo $__env->make('web.default.panel.webinar.create_includes.accordions.extra_description',
            [
                'webinar' => $webinar,
                'extraDescriptionType' => $webinarExtraDescriptionType,
                'extraDescriptionParentAccordion' => $webinarExtraDescriptionType.'_accordion',
            ]
        , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/sortable/jquery-ui.min.js"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/webinar/create_includes/step_6.blade.php ENDPATH**/ ?>