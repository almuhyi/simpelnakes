<?php
    $getPanelSidebarSettings = getPanelSidebarSettings();
?>

<div class="xs-panel-nav d-flex d-lg-none justify-content-between py-5 px-15">
    <div class="user-info d-flex align-items-center justify-content-between">
        <div class="user-avatar bg-gray200">
            <img src="<?php echo e(asset($authUser->getAvatar(100))); ?>" class="img-cover" alt="<?php echo e($authUser->full_name); ?>">
        </div>

        <div class="user-name ml-15">
            <h3 class="font-16 font-weight-bold"><?php echo e($authUser->full_name); ?></h3>
        </div>
    </div>

    <button class="sidebar-toggler btn-transparent d-flex flex-column-reverse justify-content-center align-items-center p-5 rounded-sm sidebarNavToggle" type="button">
        <span>Menu</span>
        <i data-feather="menu" width="16" height="16"></i>
    </button>
</div>

<div class="panel-sidebar pt-50 pb-25 px-25" id="panelSidebar">
    <button class="btn-transparent panel-sidebar-close sidebarNavToggle">
        <i data-feather="x" width="24" height="24"></i>
    </button>

    <div class="user-info d-flex align-items-center flex-row flex-lg-column justify-content-lg-center">
        <a href="<?php echo e(url('/panel')); ?>" class="user-avatar bg-gray200">
            <img src="<?php echo e(asset($authUser->getAvatar(100))); ?>" class="img-cover" alt="<?php echo e($authUser->full_name); ?>">
        </a>

        <div class="d-flex flex-column align-items-center justify-content-center">
            <a href="<?php echo e(url('/panel')); ?>" class="user-name mt-15">
                <h3 class="font-16 font-weight-bold text-center"><?php echo e($authUser->full_name); ?></h3>
            </a>

            <?php if(!empty($authUser->getUserGroup())): ?>
                <span class="create-new-user mt-10"><?php echo e($authUser->getUserGroup()->name); ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="d-flex sidebar-user-stats pb-10 ml-20 pb-lg-20 mt-15 mt-lg-30">
        <div class="sidebar-user-stat-item d-flex flex-column">
            <strong class="text-center"><?php echo e($authUser->webinars()->count()); ?></strong>
            <span class="font-12">Pelatihan</span>
        </div>

        <div class="border-left mx-30"></div>

        <?php if($authUser->isUser()): ?>
            <div class="sidebar-user-stat-item d-flex flex-column">
                <strong class="text-center"><?php echo e($authUser->following()->count()); ?></strong>
                <span class="font-12">Mengikuti</span>
            </div>
        <?php else: ?>
            <div class="sidebar-user-stat-item d-flex flex-column">
                <strong class="text-center"><?php echo e($authUser->followers()->count()); ?></strong>
                <span class="font-12">Pengikut</span>
            </div>
        <?php endif; ?>
    </div>

    <ul id="panel-sidebar-scroll" class="sidebar-menu pt-10 <?php if(!empty($authUser->userGroup)): ?> has-user-group <?php endif; ?> <?php if(empty($getPanelSidebarSettings) or empty($getPanelSidebarSettings['background'])): ?> without-bottom-image <?php endif; ?>" <?php if((!empty($isRtl) and $isRtl)): ?> data-simplebar-direction="rtl" <?php endif; ?>>

        <li class="sidenav-item <?php echo e((request()->is('panel')) ? 'sidenav-item-active' : ''); ?>">
            <a href="<?php echo e(url('/panel')); ?>" class="d-flex align-items-center">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Dashboard</span>
            </a>
        </li>

        <?php if($authUser->isOrganization()): ?>
            <li class="sidenav-item <?php echo e((request()->is('panel/instructors') or request()->is('panel/manage/instructors*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#instructorsCollapse" role="button" aria-expanded="false" aria-controls="instructorsCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.teachers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                    <span class="font-14 text-dark-blue font-weight-500">Instruktur</span>
                </a>

                <div class="collapse <?php echo e((request()->is('panel/instructors') or request()->is('panel/manage/instructors*')) ? 'show' : ''); ?>" id="instructorsCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="mt-5 <?php echo e((request()->is('panel/instructors/new')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/manage/instructors/new')); ?>">Baru</a>
                        </li>
                        <li class="mt-5 <?php echo e((request()->is('panel/manage/instructors')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/manage/instructors')); ?>">Daftar</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidenav-item <?php echo e((request()->is('panel/students') or request()->is('panel/manage/students*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#studentsCollapse" role="button" aria-expanded="false" aria-controls="studentsCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.students', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                    <span class="font-14 text-dark-blue font-weight-500">Peserta</span>
                </a>

                <div class="collapse <?php echo e((request()->is('panel/students') or request()->is('panel/manage/students*')) ? 'show' : ''); ?>" id="studentsCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="mt-5 <?php echo e((request()->is('panel/manage/students/new')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/manage/students/new')); ?>">Baru</a>
                        </li>
                        <li class="mt-5 <?php echo e((request()->is('panel/manage/students')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/manage/students')); ?>">Daftar</a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <li class="sidenav-item <?php echo e((request()->is('panel/webinars') or request()->is('panel/webinars/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="d-flex align-items-center" data-toggle="collapse" href="#webinarCollapse" role="button" aria-expanded="false" aria-controls="webinarCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.webinars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Pelatihan</span>
            </a>

            <div class="collapse <?php echo e((request()->is('panel/webinars') or request()->is('panel/webinars/*')) ? 'show' : ''); ?>" id="webinarCollapse">
                <ul class="sidenav-item-collapse">
                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="mt-5 <?php echo e((request()->is('panel/webinars/new')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/webinars/new')); ?>">Baru</a>
                        </li>

                        <li class="mt-5 <?php echo e((request()->is('panel/webinars')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/webinars')); ?>">Pelatihan saya</a>
                        </li>

                        <li class="mt-5 <?php echo e((request()->is('panel/webinars/invitations')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/webinars/invitations')); ?>">Pelatihan yang diundang</a>
                        </li>
                    <?php endif; ?>

                    <?php if(!empty($authUser->organ_id)): ?>
                        <li class="mt-5 <?php echo e((request()->is('panel/webinars/organization_classes')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/webinars/organization_classes')); ?>">Pelatihan organisasi</a>
                        </li>
                    <?php endif; ?>

                    <li class="mt-5 <?php echo e((request()->is('panel/webinars/purchases')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/webinars/purchases')); ?>">Pembelian saya</a>
                    </li>

                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="mt-5 <?php echo e((request()->is('panel/webinars/comments')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/webinars/comments')); ?>">Komentar pelatihan saya</a>
                        </li>
                    <?php endif; ?>

                    <li class="mt-5 <?php echo e((request()->is('panel/webinars/my-comments')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/webinars/my-comments')); ?>">Komentar saya</a>
                    </li>

                    <li class="mt-5 <?php echo e((request()->is('panel/webinars/favorites')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/webinars/favorites')); ?>">Favorit</a>
                    </li>
                </ul>
            </div>
        </li>

        

        <?php if(getFeaturesSettings('webinar_assignment_status')): ?>
            <li class="sidenav-item <?php echo e((request()->is('panel/assignments') or request()->is('panel/assignments/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#assignmentCollapse" role="button" aria-expanded="false" aria-controls="assignmentCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.assignments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                    <span class="font-14 text-dark-blue font-weight-500">Tugas</span>
                </a>

                <div class="collapse <?php echo e((request()->is('panel/assignments') or request()->is('panel/assignments/*')) ? 'show' : ''); ?>" id="assignmentCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 <?php echo e((request()->is('panel/assignments/my-assignments')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/assignments/my-assignments')); ?>">Tugas saya</a>
                        </li>

                        <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                            <li class="mt-5 <?php echo e((request()->is('panel/assignments/my-courses-assignments')) ? 'active' : ''); ?>">
                                <a href="<?php echo e(url('/panel/assignments/my-courses-assignments')); ?>">Tugas peserta</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
        <?php endif; ?>


        <li class="sidenav-item <?php echo e((request()->is('panel/meetings') or request()->is('panel/meetings/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="d-flex align-items-center" data-toggle="collapse" href="#meetingCollapse" role="button" aria-expanded="false" aria-controls="meetingCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.requests', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Pertemuan</span>
            </a>

            <div class="collapse <?php echo e((request()->is('panel/meetings') or request()->is('panel/meetings/*')) ? 'show' : ''); ?>" id="meetingCollapse">
                <ul class="sidenav-item-collapse">

                    <li class="mt-5 <?php echo e((request()->is('panel/meetings/reservation')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/meetings/reservation')); ?>">Reservasi saya</a>
                    </li>

                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="mt-5 <?php echo e((request()->is('panel/meetings/requests')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/meetings/requests')); ?>">Permintaan</a>
                        </li>

                        <li class="mt-5 <?php echo e((request()->is('panel/meetings/settings')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/meetings/settings')); ?>">Pengaturan</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </li>

        <li class="sidenav-item <?php echo e((request()->is('panel/quizzes') or request()->is('panel/quizzes/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="d-flex align-items-center" data-toggle="collapse" href="#quizzesCollapse" role="button" aria-expanded="false" aria-controls="quizzesCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.quizzes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Kuis</span>
            </a>

            <div class="collapse <?php echo e((request()->is('panel/quizzes') or request()->is('panel/quizzes/*')) ? 'show' : ''); ?>" id="quizzesCollapse">
                <ul class="sidenav-item-collapse">
                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="mt-5 <?php echo e((request()->is('panel/quizzes/new')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/quizzes/new')); ?>">Kuis baru</a>
                        </li>
                        <li class="mt-5 <?php echo e((request()->is('panel/quizzes')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/quizzes')); ?>">Daftar</a>
                        </li>
                        <li class="mt-5 <?php echo e((request()->is('panel/quizzes/results')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/quizzes/results')); ?>">Hasil kuis</a>
                        </li>
                    <?php endif; ?>

                    <li class="mt-5 <?php echo e((request()->is('panel/quizzes/my-results')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/quizzes/my-results')); ?>">Hasil kuis saya</a>
                    </li>

                    <li class="mt-5 <?php echo e((request()->is('panel/quizzes/opens')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/quizzes/opens')); ?>">Tidak Berpartisipasi</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="sidenav-item <?php echo e((request()->is('panel/certificates') or request()->is('panel/certificates/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="d-flex align-items-center" data-toggle="collapse" href="#certificatesCollapse" role="button" aria-expanded="false" aria-controls="certificatesCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.certificate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Sertifikat</span>
            </a>

            <div class="collapse <?php echo e((request()->is('panel/certificates') or request()->is('panel/certificates/*')) ? 'show' : ''); ?>" id="certificatesCollapse">
                <ul class="sidenav-item-collapse">
                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="mt-5 <?php echo e((request()->is('panel/certificates')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/certificates')); ?>">Daftar</a>
                        </li>
                    <?php endif; ?>

                    <li class="mt-5 <?php echo e((request()->is('panel/certificates/achievements')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/certificates/achievements')); ?>">Penghargaan</a>
                    </li>

                    <li class="mt-5">
                        <a href="<?php echo e(url('/certificate_validation')); ?>">Validasi sertifikat</a>
                    </li>

                    <li class="mt-5 <?php echo e((request()->is('panel/certificates/webinars')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/certificates/webinars')); ?>">Sertifikat Penyelesaian</a>
                    </li>

                </ul>
            </div>
        </li>

        

        

        <li class="sidenav-item <?php echo e((request()->is('panel/support') or request()->is('panel/support/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="d-flex align-items-center" data-toggle="collapse" href="#supportCollapse" role="button" aria-expanded="false" aria-controls="supportCollapse">
                <span class="sidenav-item-icon assign-fill mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.support', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Bantuan</span>
            </a>

            <div class="collapse <?php echo e((request()->is('panel/support') or request()->is('panel/support/*')) ? 'show' : ''); ?>" id="supportCollapse">
                <ul class="sidenav-item-collapse">
                    <li class="mt-5 <?php echo e((request()->is('panel/support/new')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/support/new')); ?>">Baru</a>
                    </li>
                    <li class="mt-5 <?php echo e((request()->is('panel/support')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/support')); ?>">Bantuan pelatihan</a>
                    </li>
                    <li class="mt-5 <?php echo e((request()->is('panel/support/tickets')) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/panel/support/tickets')); ?>">Tiket</a>
                    </li>
                </ul>
            </div>
        </li>

        

        <?php if(getFeaturesSettings('forums_status')): ?>
            <li class="sidenav-item <?php echo e((request()->is('panel/forums') or request()->is('panel/forums/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#forumsCollapse" role="button" aria-expanded="false" aria-controls="forumsCollapse">
                <span class="sidenav-item-icon assign-fill mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.forums', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                    <span class="font-14 text-dark-blue font-weight-500">Forum</span>
                </a>

                <div class="collapse <?php echo e((request()->is('panel/forums') or request()->is('panel/forums/*')) ? 'show' : ''); ?>" id="forumsCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="mt-5 <?php echo e((request()->is('/forums/create-topic')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/forums/create-topic')); ?>">Buat topik baru</a>
                        </li>
                        <li class="mt-5 <?php echo e((request()->is('panel/forums/topics')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/forums/topics')); ?>">Topik saya</a>
                        </li>

                        <li class="mt-5 <?php echo e((request()->is('panel/forums/posts')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/forums/posts')); ?>">Topik yang diikuti</a>
                        </li>

                        <li class="mt-5 <?php echo e((request()->is('panel/forums/bookmarks')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/forums/bookmarks')); ?>">Bookmarks</a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>


        <?php if($authUser->isTeacher()): ?>
            <li class="sidenav-item <?php echo e((request()->is('panel/blog') or request()->is('panel/blog/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#blogCollapse" role="button" aria-expanded="false" aria-controls="blogCollapse">
                <span class="sidenav-item-icon assign-fill mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                    <span class="font-14 text-dark-blue font-weight-500">Artikel</span>
                </a>

                <div class="collapse <?php echo e((request()->is('panel/blog') or request()->is('panel/blog/*')) ? 'show' : ''); ?>" id="blogCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="mt-5 <?php echo e((request()->is('panel/blog/posts/new')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/blog/posts/new')); ?>">Buat artikel baru</a>
                        </li>

                        <li class="mt-5 <?php echo e((request()->is('panel/blog/posts')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/blog/posts')); ?>">Artikel saya</a>
                        </li>

                        <li class="mt-5 <?php echo e((request()->is('panel/blog/comments')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/blog/comments')); ?>">Komentar</a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
            <li class="sidenav-item <?php echo e((request()->is('panel/noticeboard*') or request()->is('panel/course-noticeboard*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#noticeboardCollapse" role="button" aria-expanded="false" aria-controls="noticeboardCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.noticeboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>

                    <span class="font-14 text-dark-blue font-weight-500">Pemberitahuan</span>
                </a>

                <div class="collapse <?php echo e((request()->is('panel/noticeboard*') or request()->is('panel/course-noticeboard*')) ? 'show' : ''); ?>" id="noticeboardCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="mt-5 <?php echo e((request()->is('panel/noticeboard')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/noticeboard')); ?>">Riwayat</a>
                        </li>

                        <li class="mt-5 <?php echo e((request()->is('panel/noticeboard/new')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/noticeboard/new')); ?>">Baru</a>
                        </li>

                        <li class="mt-5 <?php echo e((request()->is('panel/course-noticeboard')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/course-noticeboard')); ?>">Pemberitahuan pelatihan</a>
                        </li>

                        <li class="mt-5 <?php echo e((request()->is('panel/course-noticeboard/new')) ? 'active' : ''); ?>">
                            <a href="<?php echo e(url('/panel/course-noticeboard/new')); ?>">Pemberitahuan pelatihan baru</a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php
            $rewardSetting = getRewardsSettings();
        ?>

        

        <li class="sidenav-item <?php echo e((request()->is('panel/notifications')) ? 'sidenav-item-active' : ''); ?>">
            <a href="<?php echo e(url('/panel/notifications')); ?>" class="d-flex align-items-center">
            <span class="sidenav-notification-icon sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Notifikasi</span>
            </a>
        </li>

        <li class="sidenav-item <?php echo e((request()->is('panel/setting')) ? 'sidenav-item-active' : ''); ?>">
            <a href="<?php echo e(url('/panel/setting')); ?>" class="d-flex align-items-center">
                <span class="sidenav-setting-icon sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Pengaturan</span>
            </a>
        </li>

        <?php if($authUser->isTeacher() or $authUser->isOrganization()): ?>
            <li class="sidenav-item ">
                <a href="<?php echo e(url($authUser->getProfileUrl())); ?>" class="d-flex align-items-center">
                <span class="sidenav-item-icon assign-strock mr-10">
                    <i data-feather="user" stroke="#0d6a37" stroke-width="1.5" width="24" height="24" class="mr-10 webinar-icon"></i>
                </span>
                    <span class="font-14 text-dark-blue font-weight-500">Profil saya</span>
                </a>
            </li>
        <?php endif; ?>

        <li class="sidenav-item">
            <a href="<?php echo e(url('/logout')); ?>" class="d-flex align-items-center">
                <span class="sidenav-logout-icon sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.logout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Keluar</span>
            </a>
        </li>
    </ul>

    <?php if(!empty($getPanelSidebarSettings) and !empty($getPanelSidebarSettings['background'])): ?>
        <div class="sidebar-create-class d-none d-md-block">
            <a href="<?php echo e(url(!empty($getPanelSidebarSettings['link']) ? $getPanelSidebarSettings['link'] : '')); ?>" class="sidebar-create-class-btn d-block text-right p-5">
                <img src="<?php echo e(asset(!empty($getPanelSidebarSettings['background']) ? $getPanelSidebarSettings['background'] : '')); ?>" alt="">
            </a>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/includes/sidebar.blade.php ENDPATH**/ ?>