@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/chartjs/chart.min.css"/>
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ url('/admin/webinars') }}">Pelatihan</a></div>
                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>
    </section>

    <div class="section-body">
        <section>
            <h2 class="section-title">{{ $webinar->title }}</h2>

            <div class="activities-container mt-3 p-3 p-lg-3">
                <div class="row">
                    <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('') }}assets/default/img/activity/48.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-dark mt-1">{{ $studentsCount }}</strong>
                            <span class="font-16 text-gray font-weight-500">Peserta</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('') }}assets/default/img/activity/125.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-dark mt-1">{{ $commentsCount }}</strong>
                            <span class="font-16 text-gray font-weight-500">Komentar</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('') }}assets/default/img/activity/sales.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-dark mt-1">{{ $salesCount }}</strong>
                            <span class="font-16 text-gray font-weight-500">Penjualan</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('') }}assets/default/img/activity/33.png" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-dark mt-1">{{ handlePrice($salesAmount) }}</strong>
                            <span class="font-16 text-gray font-weight-500">Jumlah penjualan</span>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="row">

            <div class="col-6 col-md-3 mt-3">
                <div class="dashboard-stats rounded-sm panel-shadow p-10 p-md-3 d-flex align-items-center">
                    <div class="stat-icon stat-icon-chapters">
                        <img src="{{ asset('') }}assets/default/img/icons/course-statistics/1.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-2">
                        <span class="font-30 font-weight-bold text-dark">{{ $chaptersCount }}</span>
                        <span class="font-16 text-gray font-weight-500">Bagian</span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 mt-3">
                <div class="dashboard-stats rounded-sm panel-shadow p-10 p-md-3 d-flex align-items-center">
                    <div class="stat-icon stat-icon-sessions">
                        <img src="{{ asset('') }}assets/default/img/icons/course-statistics/2.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-2">
                        <span class="font-30 font-weight-bold text-dark">{{ $sessionsCount }}</span>
                        <span class="font-16 text-gray font-weight-500">Sesi</span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 mt-3">
                <div class="dashboard-stats rounded-sm panel-shadow p-10 p-md-3 d-flex align-items-center">
                    <div class="stat-icon stat-icon-pending-quizzes">
                        <img src="{{ asset('') }}assets/default/img/icons/course-statistics/3.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-2">
                        <span class="font-30 font-weight-bold text-dark">{{ $pendingQuizzesCount }}</span>
                        <span class="font-16 text-gray font-weight-500">Kuis Tertunda</span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 mt-3">
                <div class="dashboard-stats rounded-sm panel-shadow p-10 p-md-3 d-flex align-items-center">
                    <div class="stat-icon stat-icon-pending-assignments">
                        <img src="{{ asset('') }}assets/default/img/icons/course-statistics/4.svg" alt="">
                    </div>
                    <div class="d-flex flex-column ml-2">
                        <span class="font-30 font-weight-bold text-dark">{{ $pendingAssignmentsCount }}</span>
                        <span class="font-16 text-gray font-weight-500">Tugas tertunda</span>
                    </div>
                </div>
            </div>

        </section>

        <section>
            <div class="row">
                <div class="col-12 col-md-3 mt-3">
                    <div class="course-statistic-cards-shadow py-3 px-2 py-md-3 px-md-3 rounded-sm bg-white">
                        <div class="d-flex align-items-center flex-column">
                            <img src="{{ asset('') }}assets/default/img/activity/33.png" width="64" height="64" alt="">

                            <span class="font-30 text-dark mt-3 font-weight-bold">{{ $courseRate }}</span>
                            @include('admin.webinars.includes.rate',['rate' => $courseRate, 'className' => 'mt-2', 'dontShowRate' => true, 'showRateStars' => true])
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top font-16 font-weight-500">
                            <span class="text-gray">Total ulasan</span>
                            <span class="text-dark font-weight-bold">{{ $courseRateCount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mt-3">
                    <div class="course-statistic-cards-shadow py-3 px-2 py-md-3 px-md-3 rounded-sm bg-white">
                        <div class="d-flex align-items-center flex-column">
                            <img src="{{ asset('') }}assets/default/img/activity/88.svg" width="64" height="64" alt="">

                            <span class="font-30 text-dark mt-3 font-weight-bold">{{ $webinar->quizzes->count() }}</span>
                            <span class="mt-2 font-16 font-weight-500 text-gray">Kuis</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top font-16 font-weight-500">
                            <span class="text-gray">Nilai rata-rata</span>
                            <span class="text-dark font-weight-bold">{{ $quizzesAverageGrade }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mt-3">
                    <div class="course-statistic-cards-shadow py-3 px-2 py-md-3 px-md-3 rounded-sm bg-white">
                        <div class="d-flex align-items-center flex-column">
                            <img src="{{ asset('') }}assets/default/img/activity/homework.svg" width="64" height="64" alt="">

                            <span class="font-30 text-dark mt-3 font-weight-bold">{{ $webinar->assignments->count() }}</span>
                            <span class="mt-2 font-16 font-weight-500 text-gray">Tugas</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top font-16 font-weight-500">
                            <span class="text-gray">Nilai rata-rata</span>
                            <span class="text-dark font-weight-bold">{{ $assignmentsAverageGrade }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mt-3">
                    <div class="course-statistic-cards-shadow py-3 px-2 py-md-3 px-md-3 rounded-sm bg-white">
                        <div class="d-flex align-items-center flex-column">
                            <img src="{{ asset('') }}assets/default/img/activity/39.svg" width="64" height="64" alt="">

                            <span class="font-30 text-dark mt-3 font-weight-bold">{{ $courseForumsMessagesCount }}</span>
                            <span class="mt-2 font-16 font-weight-500 text-gray">Pesan Forum</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top font-16 font-weight-500">
                            <span class="text-gray">Forum peserta Aktif</span>
                            <span class="text-dark font-weight-bold">{{ $courseForumsStudentsCount }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="row">
                @include('admin.webinars.course_statistics.includes.pie_charts',[
                    'cardTitle' => 'Peran pengguna peserta',
                    'cardId' => 'studentsUserRolesChart',
                    'cardPrimaryLabel' => 'Peserta',
                    'cardSecondaryLabel' => 'Instruktur',
                    'cardWarningLabel' => 'Organisasi',
                ])

                @include('admin.webinars.course_statistics.includes.pie_charts',[
                    'cardTitle' => 'Kemajuan pelatihan',
                    'cardId' => 'courseProgressChart',
                    'cardPrimaryLabel' => 'Selesai',
                    'cardSecondaryLabel' => 'Sedang berlangsung',
                    'cardWarningLabel' => 'Belum mulai',
                ])

                @include('admin.webinars.course_statistics.includes.pie_charts',[
                    'cardTitle' => 'Status kuis',
                    'cardId' => 'quizStatusChart',
                    'cardPrimaryLabel' => 'Lulus',
                    'cardSecondaryLabel' => 'Tertunda',
                    'cardWarningLabel' => 'Gagal',
                ])

                @include('admin.webinars.course_statistics.includes.pie_charts',[
                    'cardTitle' => 'Status tugas',
                    'cardId' => 'assignmentsStatusChart',
                    'cardPrimaryLabel' => 'Lulus',
                    'cardSecondaryLabel' => 'Tertunda',
                    'cardWarningLabel' => 'Gagal',
                ])

            </div>
        </section>


        <section class="mt-5">
            <h2 class="section-title">Daftar peserta</h2>

            @if(!empty($students) and !$students->isEmpty())
                <div class="panel-section-card py-3 px-3 mt-3">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="table-responsive">
                                <table class="table custom-table text-center ">
                                    <thead>
                                    <tr>
                                        <th class="text-left text-gray">Peserta</th>
                                        <th class="text-center text-gray">Kemajuan</th>
                                        <th class="text-center text-gray">Lulus kuis</th>
                                        <th class="text-center text-gray">
                                            Tugas Tidak Terkirim</th>
                                        <th class="text-center text-gray">Tugas Tertunda</th>
                                        <th class="text-center text-gray">Tanggal daftar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $user)

                                        <tr>
                                            <td class="text-left">
                                                <div class="user-inline-avatar d-flex align-items-center">
                                                    <div class="avatar bg-gray200">
                                                        <img src="{{ $user->getAvatar() }}" class="img-cover" alt="">
                                                    </div>
                                                    <div class=" ml-2">
                                                        <span class="d-block text-dark font-weight-500">{{ $user->full_name }}</span>
                                                        <span class="mt-2 d-block font-12 text-gray">{{ $user->email }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark font-weight-500">{{ $user->course_progress }}%</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark font-weight-500">{{ $user->passed_quizzes }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark font-weight-500">{{ $user->unsent_assignments }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark font-weight-500">{{ $user->pending_assignments }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <span class="text-dark font-weight-500">{{ dateTimeFormat($user->created_at,'j M Y | H:i') }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-3">
                    {{ $students->appends(request()->input())->links('vendor.pagination.bootstrap-4')  }}
                </div>
            @else

                @include(getTemplate() . '.includes.no-result',[
                    'file_name' => 'studentt.png',
                    'title' => 'Tidak ada peserta dalam pelatihan ini',
                    'hint' =>  nl2br(('Peserta statistik pelatihan tidak ada petunjuk hasil')),
                ])
            @endif

        </section>
    </div>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/chartjs/chart.min.js"></script>
    <script src="{{ asset('') }}assets/default/js/panel/course_statistics.min.js"></script>

    <script>
        (function ($) {
            "use strict";

            @if(!empty($studentsUserRolesChart))
            makePieChart('studentsUserRolesChart', @json($studentsUserRolesChart['labels']),@json($studentsUserRolesChart['data']));
            @endif

            @if(!empty($courseProgressChart))
            makePieChart('courseProgressChart', @json($courseProgressChart['labels']),@json($courseProgressChart['data']));
            @endif

            @if(!empty($quizStatusChart))
            makePieChart('quizStatusChart', @json($quizStatusChart['labels']),@json($quizStatusChart['data']));
            @endif

            @if(!empty($assignmentsStatusChart))
            makePieChart('assignmentsStatusChart', @json($assignmentsStatusChart['labels']),@json($assignmentsStatusChart['data']));
            @endif


            @if(!empty($monthlySalesChart))
            handleMonthlySalesChart(@json($monthlySalesChart['labels']),@json($monthlySalesChart['data']));
            @endif

            @if(!empty($courseProgressLineChart))
            handleCourseProgressChart(@json($courseProgressLineChart['labels']),@json($courseProgressLineChart['data']));
            @endif

            // handleCourseProgressChartChart();
        })(jQuery)
    </script>
@endpush
