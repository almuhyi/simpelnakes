<?php if(!empty($forumTopics) and !$forumTopics->isEmpty()): ?>
    <div class="px-15 py-20">

        <?php $__currentLoopData = $forumTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="topics-lists-card row align-items-center py-10">
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="topic-user-avatar rounded-circle">
                            <img src="<?php echo e(asset($user->getAvatar())); ?>" class="img-cover rounded-circle" alt="<?php echo e($user->full_name); ?>">
                        </div>
                        <div class="ml-10 mw-100">
                            <a href="<?php echo e(url($topic->getPostsUrl())); ?>" class="">
                                <h4 class="font-16 font-weight-bold text-secondary text-ellipsis"><?php echo e($topic->title); ?></h4>
                            </a>
                            <span class="d-block font-14 text-gray">Oleh <?php echo e($user->full_name); ?> pada <?php echo e(dateTimeFormat($topic->created_at,'j M Y | H:i')); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-3 text-center">
                            <span class="d-block font-14 text-gray font-weight-bold"><?php echo e($topic->posts_count); ?></span>
                            <span class="d-block font-12 text-gray">Post</span>
                        </div>
                        <div class="col-3 d-flex align-items-center">
                            <?php if($topic->pin): ?>
                                <div class="topics-lists-card__icons rounded-circle mr-10">
                                    <img src="<?php echo e(asset('')); ?>assets/default/img/learning/un_pin.svg" alt="" class="img-cover rounded-circle">
                                </div>
                            <?php endif; ?>

                            <?php if($topic->close): ?>
                                <div class="topics-lists-card__icons rounded-circle">
                                    <img src="<?php echo e(asset('')); ?>assets/default/img/learning/lock.svg" alt="" class="img-cover rounded-circle">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 col-md-6">
                            <?php if(!empty($topic->lastPost)): ?>
                                <div class="d-flex align-items-center">
                                    <div class="topic-last-post-user-avatar rounded-circle">
                                        <img src="<?php echo e(asset($topic->lastPost->user->getAvatar(30))); ?>" class="img-cover rounded-circle" alt="<?php echo e($topic->lastPost->user->full_name); ?>">
                                    </div>
                                    <div class="ml-10">
                                        <h4 class="font-14 font-weight-500 text-gray"><?php echo e($topic->lastPost->user->full_name); ?></h4>
                                        <span class="d-block font-12 font-weight-500 text-gray">pada <?php echo e(dateTimeFormat($topic->lastPost->created_at,'j M Y | H:i')); ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <?php echo $__env->make(getTemplate() . '.includes.no-result',[
        'file_name' => 'webinar.png',
        'title' => ('Instruktur tidak memiliki topik forum apa pun!'),
        'hint' => '',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/user/profile_tabs/forum.blade.php ENDPATH**/ ?>