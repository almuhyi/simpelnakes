<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/vendors/persian-datepicker/persian-datepicker.min.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/default/css/css-stars.css">
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <section class="site-top-banner position-relative">
        <img src="<?php echo e(asset($user->getCover())); ?>" class="img-cover" alt=""/>
    </section>


    <section class="container">
        <div class="rounded-lg shadow-sm px-25 py-20 px-lg-50 py-lg-35 position-relative user-profile-info bg-white">
            <div class="profile-info-box d-flex align-items-start justify-content-between">
                <div class="user-details d-flex align-items-center">
                    <div class="user-profile-avatar bg-gray200">
                        <img src="<?php echo e(asset($user->getAvatar(190))); ?>" class="img-cover" alt="<?php echo e($user["full_name"]); ?>"/>

                        <?php if($user->offline): ?>
                            <span class="user-circle-badge unavailable d-flex align-items-center justify-content-center">
                                <i data-feather="slash" width="20" height="20" class="text-white"></i>
                            </span>
                        <?php elseif($user->verified): ?>
                            <span class="user-circle-badge has-verified d-flex align-items-center justify-content-center">
                                <i data-feather="check" width="20" height="20" class="text-white"></i>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="ml-20 ml-lg-40">
                        <h1 class="font-24 font-weight-bold text-dark-blue"><?php echo e($user["full_name"]); ?></h1>
                        <span class="text-gray"><?php echo e($user["headline"]); ?></span>

                        <div class="stars-card d-flex align-items-center mt-5">
                            <?php echo $__env->make('web.default.includes.webinar.rate',['rate' => $userRates], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <div class="w-100 mt-10 d-flex align-items-center justify-content-center justify-content-lg-start">
                            <div class="d-flex flex-column followers-status">
                                <span class="font-20 font-weight-bold text-dark-blue"><?php echo e($userFollowers->count()); ?></span>
                                <span class="font-14 text-gray">Pengikut</span>
                            </div>

                            <div class="d-flex flex-column ml-25 pl-5 following-status">
                                <span class="font-20 font-weight-bold text-dark-blue"><?php echo e($userFollowing->count()); ?></span>
                                <span class="font-14 text-gray">Mengikuti</span>
                            </div>
                        </div>

                        <div class="user-reward-badges d-flex flex-wrap align-items-center mt-15">
                            <?php if(!empty($userBadges)): ?>
                                <?php $__currentLoopData = $userBadges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userBadge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mr-15" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<?php echo (!empty($userBadge->badge_id) ? nl2br($userBadge->badge->description) : nl2br($userBadge->description)); ?>">
                                        <img src="<?php echo e(asset(!empty($userBadge->badge_id) ? $userBadge->badge->image : $userBadge->image)); ?>" width="32" height="32" alt="<?php echo e(!empty($userBadge->badge_id) ? $userBadge->badge->title : $userBadge->title); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="user-actions d-flex flex-column">
                    <button type="button" id="followToggle" data-user-id="<?php echo e($user['id']); ?>" class="btn btn-<?php echo e((!empty($authUserIsFollower) and $authUserIsFollower) ? 'danger' : 'primary'); ?> btn-sm">
                        <?php if(!empty($authUserIsFollower) and $authUserIsFollower): ?>
                            Berhenti mengikuti
                        <?php else: ?>
                            Ikuti
                        <?php endif; ?>
                    </button>

                    <?php if($user->public_message): ?>
                        <button type="button" class="js-send-message btn btn-border-white rounded btn-sm mt-15">Kirim Pesan</button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mt-40 border-top"></div>

            <div class="row mt-30 w-100 d-flex align-items-center justify-content-around">
                <div class="col-6 col-md-3 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon orange p-15 rounded-lg">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/profile/students.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($user->students_count); ?></span>
                    <span class="font-14 text-gray">Siswa / Peserta</span>
                </div>

                <div class="col-6 col-md-3 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon blue p-15 rounded-lg">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/profile/webinars.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e(count($webinars)); ?></span>
                    <span class="font-14 text-gray">Kelas / Pelatihan</span>
                </div>

                <div class="col-6 col-md-3 mt-20 mt-md-0 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon green p-15 rounded-lg">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/profile/reviews.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($user->reviewsCount()); ?></span>
                    <span class="font-14 text-gray">Ulasan</span>
                </div>


                <div class="col-6 col-md-3 mt-20 mt-md-0 user-profile-state d-flex flex-column align-items-center">
                    <div class="state-icon royalblue p-15 rounded-lg">
                        <img src="<?php echo e(asset('')); ?>assets/default/img/profile/appointments.svg" alt="">
                    </div>
                    <span class="font-20 text-dark-blue font-weight-bold mt-5"><?php echo e($appointments); ?></span>
                    <span class="font-14 text-gray">Janji pertemuan</span>
                </div>

            </div>
        </div>
    </section>

    <div class="container mt-30">
        <section class="rounded-lg border px-10 pb-35 pt-5 position-relative">
            <ul class="nav nav-tabs d-flex align-items-center px-20 px-lg-50 pb-15" id="tabs-tab" role="tablist">
                <li class="nav-item mr-20 mr-lg-50 mt-30">
                    <a class="position-relative text-dark-blue font-weight-500 font-16 <?php echo e((empty(request()->get('tab')) or request()->get('tab') == 'about') ? 'active' : ''); ?>" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">Profil</a>
                </li>
                <li class="nav-item mr-20 mr-lg-50 mt-30">
                    <a class="position-relative text-dark-blue font-weight-500 font-16 <?php echo e((request()->get('tab') == 'webinars') ? 'active' : ''); ?>" id="webinars-tab" data-toggle="tab" href="#webinars" role="tab" aria-controls="webinars" aria-selected="false">Pelatihan</a>
                </li>

                <?php if($user->isOrganization()): ?>
                    <li class="nav-item mr-20 mr-lg-50 mt-30">
                        <a class="position-relative text-dark-blue font-weight-500 font-16 <?php echo e((request()->get('tab') == 'instructors') ? 'active' : ''); ?>" id="instructors-tab" data-toggle="tab" href="#instructors" role="tab" aria-controls="instructors" aria-selected="false">Instruktur</a>
                    </li>
                <?php endif; ?>

                

                <li class="nav-item mr-20 mr-lg-50 mt-30">
                    <a class="position-relative text-dark-blue font-weight-500 font-16 <?php echo e((request()->get('tab') == 'posts') ? 'active' : ''); ?>" id="webinars-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Artikel</a>
                </li>

                <?php if(!empty(getFeaturesSettings('forums_status')) and getFeaturesSettings('forums_status')): ?>
                    <li class="nav-item mr-20 mr-lg-50 mt-30">
                        <a class="position-relative text-dark-blue font-weight-500 font-16 <?php echo e((request()->get('tab') == 'forum') ? 'active' : ''); ?>" id="webinars-tab" data-toggle="tab" href="#forum" role="tab" aria-controls="forum" aria-selected="false">Forum</a>
                    </li>
                <?php endif; ?>

                

                <li class="nav-item mr-20 mr-lg-50 mt-30">
                    <a class="position-relative text-dark-blue font-weight-500 font-16 <?php echo e((request()->get('tab') == 'appointments') ? 'active' : ''); ?>" id="appointments-tab" data-toggle="tab" href="#appointments" role="tab" aria-controls="appointments" aria-selected="false">Buat jadwal pertemuan</a>
                </li>
            </ul>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade px-20 px-lg-50 <?php echo e((empty(request()->get('tab')) or request()->get('tab') == 'about') ? 'show active' : ''); ?>" id="about" role="tabpanel" aria-labelledby="about-tab">
                    <?php echo $__env->make('web.default.user.profile_tabs.about', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="tab-pane fade" id="webinars" role="tabpanel" aria-labelledby="webinars-tab">
                    <?php echo $__env->make('web.default.user.profile_tabs.webinars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <?php if($user->isOrganization()): ?>
                    <div class="tab-pane fade" id="instructors" role="tabpanel" aria-labelledby="instructors-tab">
                        <?php echo $__env->make('web.default.user.profile_tabs.instructors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endif; ?>

                <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                    <?php echo $__env->make('web.default.user.profile_tabs.posts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <?php if(!empty(getFeaturesSettings('forums_status')) and getFeaturesSettings('forums_status')): ?>
                    <div class="tab-pane fade" id="forum" role="tabpanel" aria-labelledby="forum-tab">
                        <?php echo $__env->make('web.default.user.profile_tabs.forum', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endif; ?>

                <?php if(!empty(getStoreSettings('status')) and getStoreSettings('status')): ?>
                    <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
                        <?php echo $__env->make('web.default.user.profile_tabs.products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                <?php endif; ?>

                <div class="tab-pane fade" id="badges" role="tabpanel" aria-labelledby="badges-tab">
                    <?php echo $__env->make('web.default.user.profile_tabs.badges', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="tab-pane fade px-20 px-lg-50 <?php echo e((request()->get('tab') == 'appointments') ? 'show active' : ''); ?>" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
                    <?php echo $__env->make('web.default.user.profile_tabs.appointments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </section>
    </div>

    <?php echo $__env->make('web.default.user.send_message_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var unFollowLang = 'Berhenti mengikuti';
        var followLang = 'Ikuti';
        var reservedLang = 'Pertemuan dijadwalkan';
        var availableDays = <?php echo e(json_encode($times)); ?>;
        var messageSuccessSentLang = 'Pesan berhasil terkirim';
    </script>

    <script src="<?php echo e(asset('')); ?>assets/default/vendors/persian-datepicker/persian-date.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/default/vendors/persian-datepicker/persian-datepicker.js"></script>

    <script src="<?php echo e(asset('')); ?>assets/default/js/parts/profile.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate().'.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/user/profile.blade.php ENDPATH**/ ?>