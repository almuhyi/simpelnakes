<div class="mt-20 p-20 rounded-sm shadow-lg border border-gray300 filters-container">
    <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">Filter</h3>

    <div class="form-group mt-20">
        <label for="category_id">Kategori</label>

        <select name="category_id" id="category_id" class="form-control">
            <option value="">Pilih Kategori</option>

            <?php if(!empty($categories)): ?>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                        <optgroup label="<?php echo e($category->title); ?>">
                            <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subCategory->id); ?>" <?php if(request()->get('category_id') == $subCategory->id): ?> selected="selected" <?php endif; ?>><?php echo e($subCategory->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </optgroup>
                    <?php else: ?>
                        <option value="<?php echo e($category->id); ?>" <?php if(request()->get('category_id') == $category->id): ?> selected="selected" <?php endif; ?>><?php echo e($category->title); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="level_of_training">Tingkat pelatihan</label>

        <select name="level_of_training" class="form-control">
            <option value="">Semua</option>
            <option value="beginner" <?php echo e((request()->get('level_of_training') == 'beginner') ? 'selected' : ''); ?>>Pemula</option>
            <option value="middle" <?php echo e((request()->get('level_of_training') == 'middle') ? 'selected' : ''); ?>>Menengah</option>
            <option value="expert" <?php echo e((request()->get('level_of_training') == 'expert') ? 'selected' : ''); ?>>Ahli</option>
        </select>
    </div>

    <div class="form-group">
        <label for="gender">Gender instruktur</label>

        <select name="gender" id="gender" class="form-control">
            <option value="">Semua</option>

            <option value="man" <?php echo e((request()->get('gender') == 'man') ? 'selected' : ''); ?>>Pria</option>
            <option value="woman" <?php echo e((request()->get('gender') == 'woman') ? 'selected' : ''); ?>>Wanita</option>
        </select>
    </div>

    <div class="form-group">
        <label for="instructor_type">Jenis instruktur</label>

        <select name="role" id="instructor_type" class="form-control">
            <option value="">Semua</option>
            <option value="<?php echo e(\App\Models\Role::$teacher); ?>" <?php echo e((request()->get('role') == \App\Models\Role::$teacher) ? 'selected' : ''); ?>>Instruktur</option>
            <option value="<?php echo e(\App\Models\Role::$organization); ?>" <?php echo e((request()->get('role') == \App\Models\Role::$organization) ? 'selected' : ''); ?>>Organisasi</option>
        </select>
    </div>

    

    

    
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/instructorFinder/components/filters.blade.php ENDPATH**/ ?>