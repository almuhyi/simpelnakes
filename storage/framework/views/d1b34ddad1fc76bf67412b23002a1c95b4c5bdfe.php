<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <section class="topics-title-section mt-30 mt-md-50 px-20 px-md-30 py-25 py-md-35 rounded-lg">
            <h1 class="font-30 font-weight-bold text-white"><?php echo e(!empty($topic) ? ('Edit topik') : ('Topik baru')); ?></h1>
            <p class="font-14 text-white">Buat topik baru dan diskusikan dengan pengguna lain</p>
            <div class="mt-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item font-12 text-white"><a href="/" class="text-white"><?php echo e(getGeneralSettings('site_name')); ?></a></li>
                        <li class="breadcrumb-item font-12 text-white"><a href="/forums" class="text-white">Forum</a></li>
                        <li class="breadcrumb-item font-12 text-white font-weight-bold" aria-current="page"><?php echo e(!empty($topic) ? ('Edit topik') : ('Topik baru')); ?></li>
                    </ol>
                </nav>
            </div>
        </section>

        <form action="<?php echo e(!empty($topic) ? $topic->getEditUrl() : '/forums/create-topic'); ?>" method="post">
            <?php echo e(csrf_field()); ?>


            <div class="rounded-lg px-15 py-20 border bg-white mt-20">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label class="input-label">Judul topik</label>
                            <input type="text" name="title" value="<?php echo e(!empty($topic) ? $topic->title : old('title')); ?>" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Judul topik">
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label class="input-label">Forum</label>
                            <select name="forum_id" class="form-control <?php $__errorArgs = ['forum_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option selected disabled>Pilih kategori</option>

                                <?php $__currentLoopData = $forums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($forum->subForums) and count($forum->subForums)): ?>
                                        <?php
                                            $showOptgroup = false;

                                            foreach($forum->subForums as $subForum) {
                                                if($subForum->checkUserCanCreateTopic() and !$subForum->close) {
                                                    $showOptgroup = true;
                                                }
                                            }
                                        ?>

                                        <?php if($showOptgroup): ?>
                                            <optgroup label="<?php echo e($forum->title); ?>">
                                                <?php $__currentLoopData = $forum->subForums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subForum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($subForum->checkUserCanCreateTopic() and !$subForum->close): ?>
                                                        <option value="<?php echo e($subForum->id); ?>" <?php echo e(((!empty($topic) and $topic->forum_id == $subForum->id) or (request()->get('forum_id') == $subForum->id)) ? 'selected' : ''); ?>><?php echo e($subForum->title); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </optgroup>
                                        <?php endif; ?>
                                    <?php elseif($forum->checkUserCanCreateTopic() and !$forum->close): ?>
                                        <option value="<?php echo e($forum->id); ?>" <?php echo e((request()->get('forum_id') == $forum->id) ? 'selected' : ''); ?>><?php echo e($forum->title); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['forum_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="input-label">Deksripsi</label>
                            <textarea id="summernote" name="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo !empty($topic) ? $topic->description : old('description'); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback">
                                <?php echo e($message); ?>

                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div id="topicImagesInputs" class="create-topic-attachments form-group mt-15">
                            <label class="input-label mb-0">Lampiran file</label>

                            <div class="main-row input-group product-images-input-group mt-10">
                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text panel-file-manager" data-input="attachments_record" data-preview="holder">
                                        <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                    </button>
                                </div>
                                <input type="text" name="attachments[]" id="attachments_record" value="" class="form-control"/>

                                <button type="button" class="btn btn-primary btn-sm add-btn">
                                    <i data-feather="plus" width="18" height="18" class="text-white"></i>
                                </button>
                            </div>

                            <?php if(!empty($topic) and !empty($topic->attachments) and count($topic->attachments)): ?>
                                <?php $__currentLoopData = $topic->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topicAttachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="input-group product-images-input-group mt-10">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text panel-file-manager" data-input="attachments_<?php echo e($topicAttachment->id); ?>" data-preview="holder">
                                                <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="attachments[]" id="attachments_<?php echo e($topicAttachment->id); ?>" value="<?php echo e($topicAttachment->path); ?>" class="form-control" placeholder="Ukuran lampiran file"/>

                                        <button type="button" class="btn btn-sm btn-danger remove-btn">
                                            <i data-feather="x" width="18" height="18" class="text-white"></i>
                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block">
                                <?php echo e($message); ?>

                            </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-15 p-10 bg-info-light rounded-lg d-flex align-items-center justify-content-between">
                <div class="py-5">
                    <div class="font-14 font-weight-bold text-gray">Konfirmasi syarat dan aturan</div>
                    <p class="d-block font-14 text-gray mt-5">
                        Dengan memposting topik diskusi forum, Anda akan menerima syarat dan aturan komunitas.</p>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i data-feather="file" class="text-white" width="16" height="16"></i>
                    <span class="ml-1">Terbitkan topik</span>
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="/assets/default/js/parts/create_topics.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('web.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/forum/create_topic.blade.php ENDPATH**/ ?>