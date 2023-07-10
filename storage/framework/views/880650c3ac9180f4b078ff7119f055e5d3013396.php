<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo e(url('/')); ?>">
                <?php if(!empty($generalSettings['site_name'])): ?>
                    <?php echo e(strtoupper($generalSettings['site_name'])); ?>

                <?php else: ?>
                    Platform Title
                <?php endif; ?>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo e(url('/')); ?>">
                <?php if(!empty($generalSettings['site_name'])): ?>
                    <?php echo e(strtoupper(substr($generalSettings['site_name'],0,2))); ?>

                <?php endif; ?>
            </a>
        </div>

        <ul class="sidebar-menu">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_show')): ?>
                <li class="<?php echo e((request()->is('admin/')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/admin')); ?>" class="nav-link">
                        <i class="fas fa-fire"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_marketing_dashboard')): ?>
                <li class="<?php echo e((request()->is('admin/marketing')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/admin/marketing')); ?>" class="nav-link">
                        <i class="fas fa-chart-pie"></i>
                        <span>Marketing</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($authUser->can('admin_webinars') or
                $authUser->can('admin_bundles') or
                $authUser->can('admin_categories') or
                $authUser->can('admin_filters') or
                $authUser->can('admin_quizzes') or
                $authUser->can('admin_certificate') or
                $authUser->can('admin_reviews_lists') or
                $authUser->can('admin_webinar_assignments') or
                $authUser->can('admin_enrollment')
            ): ?>
                <li class="menu-header">Pendidikan</li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/webinars*') and !request()->is('admin/webinars/comments*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Pelatihan</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_list')): ?>
                            <li class="<?php echo e((request()->is('admin/webinars') and request()->get('type') == 'pelatihan') ? 'active' : ''); ?>">
                                <a class="nav-link <?php if(!empty($sidebarBeeps['courses']) and $sidebarBeeps['courses']): ?> beep beep-sidebar <?php endif; ?>" href="<?php echo e(url('/admin/webinars?type=pelatihan')); ?>">Pelatihan</a>
                            </li>

                            <li class="<?php echo e((request()->is('admin/webinars') and request()->get('type') == 'webinar') ? 'active' : ''); ?>">
                                <a class="nav-link <?php if(!empty($sidebarBeeps['webinars']) and $sidebarBeeps['webinars']): ?> beep beep-sidebar <?php endif; ?>" href="<?php echo e(url('/admin/webinars?type=webinar')); ?>">Webinar</a>
                            </li>

                            <li class="<?php echo e((request()->is('admin/webinars') and request()->get('type') == 'teks') ? 'active' : ''); ?>">
                                <a class="nav-link <?php if(!empty($sidebarBeeps['textLessons']) and $sidebarBeeps['textLessons']): ?> beep beep-sidebar <?php endif; ?>" href="<?php echo e(url('/admin/webinars?type=teks')); ?>">Materi teks</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinars_create')): ?>
                            <li class="<?php echo e((request()->is('admin/webinars/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/webinars/create')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_agora_history_list')): ?>
                            <li class="<?php echo e((request()->is('admin/agora_history')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/agora_history')); ?>">Riwayat sesi live</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_quizzes')): ?>
                <li class="<?php echo e((request()->is('admin/quizzes*')) ? 'active' : ''); ?>">
                    <a class="nav-link " href="<?php echo e(url('/admin/quizzes')); ?>">
                        <i class="fas fa-file"></i>
                        <span>Kuis</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_certificate')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/certificates*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-certificate"></i>
                        <span>Sertifikat</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_certificate_list')): ?>
                            <li class="<?php echo e((request()->is('admin/certificates')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/certificates')); ?>">Sertifikat kuis</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_course_certificate_list')): ?>
                            <li class="<?php echo e((request()->is('admin/certificates/course-competition')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/certificates/course-competition')); ?>">Sertifikat penyelesaian</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_certificate_template_list')): ?>
                            <li class="<?php echo e((request()->is('admin/certificates/templates')) ? 'active' : ''); ?>">
                                <a class="nav-link"
                                   href="<?php echo e(url('/admin/certificates/templates')); ?>">Templat sertifikat</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_certificate_template_create')): ?>
                            <li class="<?php echo e((request()->is('admin/certificates/templates/new')) ? 'active' : ''); ?>">
                                <a class="nav-link"
                                   href="<?php echo e(url('/admin/certificates/templates/new')); ?>">Templat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinar_assignments')): ?>
                <li class="<?php echo e((request()->is('admin/assignments')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/admin/assignments')); ?>" class="nav-link">
                        <i class="fas fa-pen"></i>
                        <span>Tugas</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_course_question_forum_list')): ?>
                <li class="<?php echo e((request()->is('admin/webinars/course_forums')) ? 'active' : ''); ?>">
                    <a class="nav-link " href="<?php echo e(url('/admin/webinars/course_forums')); ?>">
                        <i class="fas fa-comment-alt"></i>
                        <span>Forum pelatihan</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_course_noticeboards_list')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/course-noticeboards*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-clipboard-check"></i>
                        <span>Pemberitahuan</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_course_noticeboards_list')): ?>
                            <li class="<?php echo e((request()->is('admin/course-noticeboards')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/course-noticeboards')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_course_noticeboards_send')): ?>
                            <li class="<?php echo e((request()->is('admin/course-noticeboards/send')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/course-noticeboards/send')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_enrollment')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/enrollments*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-user-plus"></i>
                        <span>Pendaftaran</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_enrollment_history')): ?>
                            <li class="<?php echo e((request()->is('admin/enrollments/history')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/enrollments/history')); ?>">Riwayat</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_enrollment_add_student_to_items')): ?>
                            <li class="<?php echo e((request()->is('admin/enrollments/add-student-to-class')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/enrollments/add-student-to-class')); ?>">Tambah peserta</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_categories')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/categories*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-th"></i>
                        <span>Kategori</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_categories_list')): ?>
                            <li class="<?php echo e((request()->is('admin/categories')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/categories')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_categories_create')): ?>
                            <li class="<?php echo e((request()->is('admin/categories/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/categories/create')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_trending_categories')): ?>
                            <li class="<?php echo e((request()->is('admin/categories/trends')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/categories/trends')); ?>">Trend</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_filters')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/filters*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-filter"></i>
                        <span>Filter</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_filters_list')): ?>
                            <li class="<?php echo e((request()->is('admin/filters')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/filters')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_filters_create')): ?>
                            <li class="<?php echo e((request()->is('admin/filters/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/filters/create')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_reviews_lists')): ?>
                <li class="<?php echo e((request()->is('admin/reviews')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/admin/reviews')); ?>" class="nav-link <?php if(!empty($sidebarBeeps['reviews']) and $sidebarBeeps['reviews']): ?> beep beep-sidebar <?php endif; ?>">
                        <i class="fas fa-star"></i>
                        <span>Ulasan</span>
                    </a>
                </li>
            <?php endif; ?>






            <?php if($authUser->can('admin_consultants_lists') or
                $authUser->can('admin_appointments_lists')
            ): ?>
                <li class="menu-header">Pertemuan</li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_consultants_lists')): ?>
                <li class="<?php echo e((request()->is('admin/consultants')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/admin/consultants')); ?>" class="nav-link">
                        <i class="fas fa-id-card"></i>
                        <span>Daftar konsultan</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_appointments_lists')): ?>
                <li class="<?php echo e((request()->is('admin/appointments')) ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/admin/appointments')); ?>">
                        <i class="fas fa-address-book"></i>
                        <span>Pertemuan</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($authUser->can('admin_users') or
                $authUser->can('admin_roles') or
                $authUser->can('admin_users_not_access_content') or
                $authUser->can('admin_group') or
                $authUser->can('admin_users_badges') or
                $authUser->can('admin_become_instructors_list') or
                $authUser->can('admin_delete_account_requests')
            ): ?>
                <li class="menu-header">Pengguna</li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/staffs') or request()->is('admin/students') or request()->is('admin/instructors') or request()->is('admin/organizations')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-users"></i>
                        <span>Pengguna</span>
                    </a>

                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_staffs_list')): ?>
                            <li class="<?php echo e((request()->is('admin/staffs')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/staffs')); ?>">Staf</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_list')): ?>
                            <li class="<?php echo e((request()->is('admin/students')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/students')); ?>">Peserta</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_instructors_list')): ?>
                            <li class="<?php echo e((request()->is('admin/instructors')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/instructors')); ?>">Instruktur</a>
                            </li>
                        <?php endif; ?>

                        

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_create')): ?>
                            <li class="<?php echo e((request()->is('admin/users/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/users/create')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_not_access_content_lists')): ?>
                <li class="<?php echo e((request()->is('admin/users/not-access-to-content')) ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/admin/users/not-access-to-content')); ?>">
                        <i class="fas fa-user-lock"></i> <span>Manajemen akses</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_delete_account_requests')): ?>
                <li class="nav-item <?php echo e((request()->is('admin/users/delete-account-requests*')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/admin/users/delete-account-requests')); ?>" class="nav-link">
                        <i class="fa fa-user-times"></i>
                        <span>Permintaan hapus akun</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_roles')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/roles*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> <span>Role pengguna</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_roles_list')): ?>
                            <li class="<?php echo e((request()->is('admin/roles')) ? 'active' : ''); ?>">
                                <a class="nav-link active" href="<?php echo e(url('/admin/roles')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_roles_create')): ?>
                            <li class="<?php echo e((request()->is('admin/roles/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/roles/create')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_group')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/users/groups*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-sitemap"></i>
                        <span>Group</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_group_list')): ?>
                            <li class="<?php echo e((request()->is('admin/users/groups')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/users/groups')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_group_create')): ?>
                            <li class="<?php echo e((request()->is('admin/users/groups/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/users/groups/create')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_users_badges')): ?>
                <li class="<?php echo e((request()->is('admin/users/badges')) ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/admin/users/badges')); ?>">
                        <i class="fas fa-trophy"></i>
                        <span>Lencana</span>
                    </a>
                </li>
            <?php endif; ?>



            

            <?php if(
                $authUser->can('admin_forum') or
                $authUser->can('admin_featured_topics')
                ): ?>
                <li class="menu-header">Forum</li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/forums*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-comment-dots"></i>
                        <span>Forum</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum_list')): ?>
                            <li class="<?php echo e((request()->is('admin/forums')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/forums')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum_create')): ?>
                            <li class="<?php echo e((request()->is('admin/forums/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/forums/create')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_featured_topics')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/featured-topics*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-comment"></i>
                        <span>Topik unggulan</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_featured_topics_list')): ?>
                            <li class="<?php echo e((request()->is('admin/featured-topics')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/featured-topics')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_featured_topics_create')): ?>
                            <li class="<?php echo e((request()->is('admin/featured-topics/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/featured-topics/create')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_recommended_topics')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/recommended-topics*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-thumbs-up"></i>
                        <span>Rekomendasi topik</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_recommended_topics_list')): ?>
                            <li class="<?php echo e((request()->is('admin/recommended-topics')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/recommended-topics')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_recommended_topics_create')): ?>
                            <li class="<?php echo e((request()->is('admin/recommended-topics/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/recommended-topics/create')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if($authUser->can('admin_supports') or
                $authUser->can('admin_comments') or
                $authUser->can('admin_reports') or
                $authUser->can('admin_contacts') or
                $authUser->can('admin_noticeboards') or
                $authUser->can('admin_notifications')
            ): ?>
                <li class="menu-header">Bantuan</li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_supports')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/supports*') and request()->get('type') != 'course_conversations') ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-headphones"></i>
                        <span>Bantuan</span>
                    </a>

                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_supports_list')): ?>
                            <li class="<?php echo e((request()->is('admin/supports')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/supports')); ?>">Tiket</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_support_send')): ?>
                            <li class="<?php echo e((request()->is('admin/supports/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/supports/create')); ?>">Buat tiket baru</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_support_departments')): ?>
                            <li class="<?php echo e((request()->is('admin/supports/departments')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/supports/departments')); ?>">Departement</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_support_course_conversations')): ?>
                    <li class="<?php echo e((request()->is('admin/supports*') and request()->get('type') == 'course_conversations') ? 'active' : ''); ?>">
                        <a class="nav-link" href="<?php echo e(url('/admin/supports?type=course_conversations')); ?>">
                            <i class="fas fa-envelope-square"></i>
                            <span>Dukungan pelatihan</span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_comments')): ?>
                <li class="nav-item dropdown <?php echo e(!request()->is('/admin/comments/products') and (request()->is('admin/comments*') and !request()->is('admin/comments/webinars/reports')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-comments"></i> <span>Komentar</span></a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinar_comments')): ?>
                            <li class="<?php echo e((request()->is('admin/comments/webinars')) ? 'active' : ''); ?>">
                                <a class="nav-link <?php if(!empty($sidebarBeeps['classesComments']) and $sidebarBeeps['classesComments']): ?> beep beep-sidebar <?php endif; ?>" href="<?php echo e(url('/admin/comments/webinars')); ?>">Komentar pelatihan</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_blog_comments')): ?>
                            <li class="<?php echo e((request()->is('admin/comments/blog')) ? 'active' : ''); ?>">
                                <a class="nav-link <?php if(!empty($sidebarBeeps['blogComments']) and $sidebarBeeps['blogComments']): ?> beep beep-sidebar <?php endif; ?>" href="<?php echo e(url('/admin/comments/blog')); ?>">Komentar blog</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_reports')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/reports*') or request()->is('admin/comments/webinars/reports') or request()->is('admin/comments/blog/reports')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-info-circle"></i> <span>Laporan</span></a>

                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinar_reports')): ?>
                            <li class="<?php echo e((request()->is('admin/reports/webinars')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/reports/webinars')); ?>">Pelatihan</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_webinar_comments_reports')): ?>
                            <li class="<?php echo e((request()->is('admin/comments/webinars/reports')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/comments/webinars/reports')); ?>">Komentar pelatihan</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_blog_comments_reports')): ?>
                            <li class="<?php echo e((request()->is('admin/comments/blog/reports')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/comments/blog/reports')); ?>">Komentar blog</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_report_reasons')): ?>
                            <li class="<?php echo e((request()->is('admin/reports/reasons')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/reports/reasons')); ?>">Alasan melaporkan</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_forum_topic_post_reports')): ?>
                            <li class="<?php echo e((request()->is('admin/reports/forum-topics')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/reports/forum-topics')); ?>">Topik forum</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_contacts')): ?>
                <li class="<?php echo e((request()->is('admin/contacts*')) ? 'active' : ''); ?>">
                    <a class="nav-link" href="<?php echo e(url('/admin/contacts')); ?>">
                        <i class="fas fa-phone-square"></i>
                        <span>Pesan kontak</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_noticeboards')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/noticeboards*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-sticky-note"></i> <span>Pemberitahuan</span></a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_noticeboards_list')): ?>
                            <li class="<?php echo e((request()->is('admin/noticeboards')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/noticeboards')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_noticeboards_send')): ?>
                            <li class="<?php echo e((request()->is('admin/noticeboards/send')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/noticeboards/send')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_notifications')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/notifications*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span>Notifikasi</span>
                    </a>

                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_notifications_list')): ?>
                            <li class="<?php echo e((request()->is('admin/notifications')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/notifications')); ?>">Riwayat</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_notifications_posted_list')): ?>
                            <li class="<?php echo e((request()->is('admin/notifications/posted')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/notifications/posted')); ?>">Diposting</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_notifications_send')): ?>
                            <li class="<?php echo e((request()->is('admin/notifications/send')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/notifications/send')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_notifications_templates')): ?>
                            <li class="<?php echo e((request()->is('admin/notifications/templates')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/notifications/templates')); ?>">Templat</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_notifications_template_create')): ?>
                            <li class="<?php echo e((request()->is('admin/notifications/templates/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/notifications/templates/create')); ?>">Buat templat</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if($authUser->can('admin_blog') or
                $authUser->can('admin_pages') or
                $authUser->can('admin_additional_pages') or
                $authUser->can('admin_testimonials') or
                $authUser->can('admin_tags') or
                $authUser->can('admin_regions') or
                $authUser->can('admin_store')
            ): ?>
                <li class="menu-header">Konten</li>
            <?php endif; ?>

            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_blog')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/blog*') and !request()->is('admin/blog/comments')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-rss-square"></i>
                        <span>Blog</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_blog_lists')): ?>
                            <li class="<?php echo e((request()->is('admin/blog')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/blog')); ?>">Postingan</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_blog_create')): ?>
                            <li class="<?php echo e((request()->is('admin/blog/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/blog/create')); ?>">Buat post baru</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_blog_categories')): ?>
                            <li class="<?php echo e((request()->is('admin/blog/categories')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/blog/categories')); ?>">Kategori</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_pages')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/pages*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-pager"></i>
                        <span>Halaman</span>
                    </a>

                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_pages_list')): ?>
                            <li class="<?php echo e((request()->is('admin/pages')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/pages')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_pages_create')): ?>
                            <li class="<?php echo e((request()->is('admin/pages/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/pages/create')); ?>">Buat halaman</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_additional_pages')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/additional_page*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-plus-circle"></i> <span> Hal tambahan</span></a>
                    <ul class="dropdown-menu">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_additional_pages_404')): ?>
                            <li class="<?php echo e((request()->is('admin/additional_page/404')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/additional_page/404')); ?>">Halaman 404</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_additional_pages_contact_us')): ?>
                            <li class="<?php echo e((request()->is('admin/additional_page/contact_us')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/additional_page/contact_us')); ?>">Kontak</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_additional_pages_footer')): ?>
                            <li class="<?php echo e((request()->is('admin/additional_page/footer')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/additional_page/footer')); ?>">Kontak</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_additional_pages_navbar_links')): ?>
                            <li class="<?php echo e((request()->is('admin/additional_page/navbar_links')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/additional_page/navbar_links')); ?>">Top navbar</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_testimonials')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/testimonials*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-address-card"></i>
                        <span>Testimoni</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_testimonials_list')): ?>
                            <li class="<?php echo e((request()->is('admin/testimonials')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/testimonials')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_testimonials_create')): ?>
                            <li class="<?php echo e((request()->is('admin/testimonials/create')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/testimonials/create')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_tags')): ?>
                <li class="<?php echo e((request()->is('admin/tags')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/admin/tags')); ?>" class="nav-link">
                        <i class="fas fa-tags"></i>
                        <span>Tag</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_regions')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/regions*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-map-marked"></i>
                        <span>Wilayah</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_regions_countries')): ?>
                            <li class="<?php echo e((request()->is('admin/regions/countries')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/regions/countries')); ?>">Negara</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_regions_provinces')): ?>
                            <li class="<?php echo e((request()->is('admin/regions/provinces')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/regions/provinces')); ?>">Provinsi</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_regions_cities')): ?>
                            <li class="<?php echo e((request()->is('admin/regions/cities')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/regions/cities')); ?>">Kota</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_regions_districts')): ?>
                            <li class="<?php echo e((request()->is('admin/regions/districts')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/regions/districts')); ?>">Daerah</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if($authUser->can('admin_documents') or
                $authUser->can('admin_sales_list') or
                $authUser->can('admin_payouts') or
                $authUser->can('admin_offline_payments_list') or
                $authUser->can('admin_subscribe') or
                $authUser->can('admin_registration_packages')
            ): ?>
                <li class="menu-header">Keuangan</li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_documents')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/financial/documents*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Saldo</span>
                    </a>
                    <ul class="dropdown-menu">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_documents_list')): ?>
                            <li class="<?php echo e((request()->is('admin/financial/documents')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/financial/documents')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_documents_create')): ?>
                            <li class="<?php echo e((request()->is('admin/financial/documents/new')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/financial/documents/new')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_sales_list')): ?>
                <li class="<?php echo e((request()->is('admin/financial/sales*')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/admin/financial/sales')); ?>" class="nav-link">
                        <i class="fas fa-list-ul"></i>
                        <span>Daftar penjualan</span>
                    </a>
                </li>
            <?php endif; ?>

            

            

            


            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_registration_packages')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/financial/registration-packages*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fa fa-gem"></i>
                        <span><?php echo e(trans('update.saas')); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_registration_packages_lists')): ?>
                            <li class="<?php echo e((request()->is('admin/financial/registration-packages')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/financial/registration-packages')); ?>">Paket</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_registration_packages_new')): ?>
                            <li class="<?php echo e((request()->is('admin/financial/registration-packages/new')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/financial/registration-packages/new')); ?>">Tambah paket</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_registration_packages_reports')): ?>
                            <li class="<?php echo e((request()->is('admin/financial/registration-packages/reports')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/financial/registration-packages/reports')); ?>">Laporan</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_registration_packages_settings')): ?>
                            <li class="<?php echo e((request()->is('admin/financial/registration-packages/settings')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/financial/registration-packages/settings')); ?>">Pengaturan</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if($authUser->can('admin_discount_codes') or
                $authUser->can('admin_product_discount') or
                $authUser->can('admin_feature_webinars') or
                $authUser->can('admin_promotion') or
                $authUser->can('admin_advertising') or
                $authUser->can('admin_newsletters') or
                $authUser->can('admin_advertising_modal')
            ): ?>
                <li class="menu-header">Marketing</li>
            <?php endif; ?>

            

            

            

            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_advertising')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/advertising*') and !request()->is('admin/advertising_modal*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-file-image"></i>
                        <span>Banner</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_advertising_banners')): ?>
                            <li class="<?php echo e((request()->is('admin/advertising/banners')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/advertising/banners')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_advertising_banners_create')): ?>
                            <li class="<?php echo e((request()->is('admin/advertising/banners/new')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/advertising/banners/new')); ?>">Buat baru</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_newsletters')): ?>
                <li class="nav-item dropdown <?php echo e((request()->is('admin/newsletters*')) ? 'active' : ''); ?>">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i class="fas fa-newspaper"></i>
                        <span>Berita email</span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_newsletters_lists')): ?>
                            <li class="<?php echo e((request()->is('admin/newsletters')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/newsletters')); ?>">Daftar</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_newsletters_send')): ?>
                            <li class="<?php echo e((request()->is('admin/newsletters/send')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/newsletters/send')); ?>">Kirim</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_newsletters_history')): ?>
                            <li class="<?php echo e((request()->is('admin/newsletters/history')) ? 'active' : ''); ?>">
                                <a class="nav-link" href="<?php echo e(url('/admin/newsletters/history')); ?>">Riwayat</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_advertising_modal_config')): ?>
                <li class="nav-item <?php echo e((request()->is('admin/advertising_modal*')) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/admin/advertising_modal')); ?>" class="nav-link">
                        <i class="fa fa-ad"></i>
                        <span>Iklan</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if($authUser->can('admin_settings')): ?>
                <li class="menu-header">Pengaturan</li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_settings')): ?>
                <?php
                    $settingClass ='';

                    if (request()->is('admin/settings*') and
                            !(
                                request()->is('admin/settings/404') or
                                request()->is('admin/settings/contact_us') or
                                request()->is('admin/settings/footer') or
                                request()->is('admin/settings/navbar_links')
                            )
                        ) {
                            $settingClass = 'active';
                        }
                ?>

                <li class="nav-item <?php echo e($settingClass ?? ''); ?>">
                    <a href="<?php echo e(url('/admin/settings')); ?>" class="nav-link">
                        <i class="fas fa-cogs"></i>
                        <span>Pengaturan}</span>
                    </a>
                </li>
            <?php endif; ?>


            <li>
                <a class="nav-link" href="<?php echo e(url('/admin/logout')); ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

        </ul>
        <br><br><br>
    </aside>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/includes/sidebar.blade.php ENDPATH**/ ?>