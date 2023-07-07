<section class="mt-30">
    <h2 class="section-title after-line">Profesi</h2>

    <div class="mt-20 d-flex align-items-center flex-wrap">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="checkbox-button mr-15 mt-10">
                        <input type="checkbox" name="occupations[]" id="checkbox<?php echo e($subCategory->id); ?>" value="<?php echo e($subCategory->id); ?>" <?php if(in_array($subCategory->id,$occupations)): ?> checked="checked" <?php endif; ?>>
                        <label class="font-14" for="checkbox<?php echo e($subCategory->id); ?>"><?php echo e($subCategory->title); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="checkbox-button mr-15 mt-10">
                    <input type="checkbox" name="occupations[]" id="checkbox<?php echo e($category->id); ?>" value="<?php echo e($category->id); ?>" <?php if(in_array($category->id,$occupations)): ?> checked="checked" <?php endif; ?>>
                    <label class="font-14" for="checkbox<?php echo e($category->id); ?>"><?php echo e($category->title); ?></label>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-15">
        <p class="font-12 text-gray">- Memilih topik minat (untuk instruktur) akan membantu peserta menemukan Anda untuk pertemuan.</p>
        <p class="font-12 text-gray">- Jika Anda melakukan pertemuan, pilih topik yang lebih akurat yang disarankan.</p>
    </div>

</section>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/setting/setting_includes/occupations.blade.php ENDPATH**/ ?>