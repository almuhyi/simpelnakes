@extends('web.default.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/chartjs/chart.min.css"/>
@endpush

@section('content')
    <section>
        <h2 class="section-title">{{ $webinar->title }}</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/48.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5">{{ $studentsCount }}</strong>
                        <span class="font-16 text-gray font-weight-500">Peserta</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/125.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5">{{ $commentsCount }}</strong>
                        <span class="font-16 text-gray font-weight-500">Komentar</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-10 mt-md-0 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/sales.svg" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5">{{ $salesCount }}</strong>
                        <span class="font-16 text-gray font-weight-500">Penjualan</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-10 mt-md-0 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/33.png" width="64" height="64" alt="">
                        <strong class="font-30 font-weight-bold mt-5">{{ handlePrice($salesAmount) }}</strong>
                        <span class="font-16 text-gray font-weight-500">Jumlah penjualan</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="course-statistic-stat-icons row">

        <div class="col-6 col-md-3 mt-20">
            <div class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center">
                <div class="stat-icon stat-icon-chapters">
                    <img src="{{ asset('') }}assets/default/img/icons/course-statistics/1.svg" alt="">
                </div>
                <div class="d-flex flex-column ml-5 ml-md-15">
                    <span class="font-30 text-secondary">{{ $chaptersCount }}</span>
                    <span class="font-16 text-gray font-weight-500">Bagian</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3 mt-20">
            <div class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center">
                <div class="stat-icon stat-icon-sessions">
                    <img src="{{ asset('') }}assets/default/img/icons/course-statistics/2.svg" alt="">
                </div>
                <div class="d-flex flex-column ml-5 ml-md-15">
                    <span class="font-30 text-secondary">{{ $sessionsCount }}</span>
                    <span class="font-16 text-gray font-weight-500">Sesi</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3 mt-20">
            <div class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center">
                <div class="stat-icon stat-icon-pending-quizzes">
                    <img src="{{ asset('') }}assets/default/img/icons/course-statistics/3.svg" alt="">
                </div>
                <div class="d-flex flex-column ml-5 ml-md-15">
                    <span class="font-30 text-secondary">{{ $pendingQuizzesCount }}</span>
                    <span class="font-16 text-gray font-weight-500">Kuis tertunda</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3 mt-20">
            <div class="dashboard-stats rounded-sm panel-shadow p-10 p-md-20 d-flex align-items-center">
                <div class="stat-icon stat-icon-pending-assignments">
                    <img src="{{ asset('') }}assets/default/img/icons/course-statistics/4.svg" alt="">
                </div>
                <div class="d-flex flex-column ml-5 ml-md-15">
                    <span class="font-30 text-secondary">{{ $pendingAssignmentsCount }}</span>
                    <span class="font-16 text-gray font-weight-500">Tugas tertunda</span>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div class="row">
            <div class="col-12 col-md-3 mt-20">
                <div class="course-statistic-cards-shadow py-20 px-15 py-md-30 px-md-20 rounded-sm bg-white">
                    <div class="d-flex align-items-center flex-column">
                        <img src="{{ asset('') }}assets/default/img/activity/33.png" width="64" height="64" alt="">

                        <span class="font-30 text-secondary mt-25 font-weight-bold">{{ $courseRate }}</span>
                        @include('web.default.includes.webinar.rate',['rate' => $courseRate, 'className' => 'mt-5', 'dontShowRate' => true, 'showRateStars' => true])
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-20 pt-30 border-top font-16 font-weight-500">
                        <span class="text-gray">Total ulasan</span>
                        <span class="text-secondary">{{ $courseRateCount }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-20">
                <div class="course-statistic-cards-shadow py-20 px-15 py-md-30 px-md-20 rounded-sm bg-white">
                    <div class="d-flex align-items-center flex-column">
                        <img src="{{ asset('') }}assets/default/img/activity/88.svg" width="64" height="64" alt="">

                        <span class="font-30 text-secondary mt-25 font-weight-bold">{{ $webinar->quizzes->count() }}</span>
                        <span class="mt-5 font-16 font-weight-500 text-gray">Kuis}</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-20 pt-30 border-top font-16 font-weight-500">
                        <span class="text-gray">Nilai Rata-rata</span>
                        <span class="text-secondary">{{ $quizzesAverageGrade }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-20">
                <div class="course-statistic-cards-shadow py-20 px-15 py-md-30 px-md-20 rounded-sm bg-white">
                    <div class="d-flex align-items-center flex-column">
                        <img src="{{ asset('') }}assets/default/img/activity/homework.svg" width="64" height="64" alt="">

                        <span class="font-30 text-secondary mt-25 font-weight-bold">{{ $webinar->assignments->count() }}</span>
                        <span class="mt-5 font-16 font-weight-500 text-gray">Tugas</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-20 pt-30 border-top font-16 font-weight-500">
                        <span class="text-gray">Nilai Rata-rata</span>
                        <span class="text-secondary">{{ $assignmentsAverageGrade }}</span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3 mt-20">
                <div class="course-statistic-cards-shadow py-20 px-15 py-md-30 px-md-20 rounded-sm bg-white">
                    <div class="d-flex align-items-center flex-column">
                        <img src="{{ asset('') }}assets/default/img/activity/39.svg" width="64" height="64" alt="">

                        <span class="font-30 text-secondary mt-25 font-weight-bold">{{ $courseForumsMessagesCount }}</span>
                        <span class="mt-5 font-16 font-weight-500 text-gray">
                            Pesan Forum</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-20 pt-30 border-top font-16 font-weight-500">
                        <span class="text-gray">Peserta aktif forum</span>
                        <span class="text-secondary">{{ $courseForumsStudentsCount }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            @include('web.default.panel.webinar.course_statistics.includes.pie_charts',[
                'cardTitle' => 'Peran pengguna',
                'cardId' => 'studentsUserRolesChart',
                'cardPrimaryLabel' => 'Peserta',
                'cardSecondaryLabel' => 'Instruktur',
                'cardWarningLabel' => 'Organisasi',
            ])

            @include('web.default.panel.webinar.course_statistics.includes.pie_charts',[
                'cardTitle' => 'Kemajuan pelatihan',
                'cardId' => 'courseProgressChart',
                'cardPrimaryLabel' => 'Lengkap / Selesai',
                'cardSecondaryLabel' => 'Sedang berlangsung',
                'cardWarningLabel' => 'Belum mulai',
            ])

            @include('web.default.panel.webinar.course_statistics.includes.pie_charts',[
                'cardTitle' => 'Status kuis',
                'cardId' => 'quizStatusChart',
                'cardPrimaryLabel' => 'Lulus',
                'cardSecondaryLabel' => 'Tertunda',
                'cardWarningLabel' => 'Gagal',
            ])

            @include('web.default.panel.webinar.course_statistics.includes.pie_charts',[
                'cardTitle' => 'Status tugas',
                'cardId' => 'assignmentsStatusChart',
                'cardPrimaryLabel' => 'Lulus',
                'cardSecondaryLabel' => 'Tertunda',
                'cardWarningLabel' => 'Gagal',
            ])

        </div>
    </section>


    <section>
        <div class="row">
            <div class="col-12 col-md-6 mt-20">
                <div class="course-statistic-cards-shadow monthly-sales-card pt-15 px-15 pb-25 rounded-sm bg-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="font-16 text-dark-blue font-weight-bold">Penjualan bulanan</h3>

                        <span class="font-16 font-weight-500 text-gray">{{ dateTimeFormat(time(),'M Y') }}</span>
                    </div>

                    <div class="monthly-sales-chart mt-15">
                        <canvas id="monthlySalesChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 mt-20">
                <div class="course-statistic-cards-shadow monthly-sales-card pt-15 px-15 pb-25 rounded-sm bg-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="font-16 text-dark-blue font-weight-bold">Kemajuan pelatihan (%)</h3>
                    </div>

                    <div class="monthly-sales-chart mt-15">
                        <canvas id="courseProgressLineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-35">
        <h2 class="section-title">Daftar peserta</h2>

        @if(!empty($students) and !$students->isEmpty())
            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table custom-table text-center ">
                                <thead>
                                <tr>
                                    <th class="text-left text-gray">Peserta</th>
                                    <th class="text-center text-gray">Kemajuan</th>
                                    <th class="text-center text-gray">Lulus kuis</th>
                                    <th class="text-center text-gray">Tugas belum dikirim</th>
                                    <th class="text-center text-gray">Tugas tertunda</th>
                                    <th class="text-center text-gray">Tanggal daftar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($students as $user)

                                    <tr>
                                        <td class="text-left">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200">
                                                    <img src="{{ ($user->getAvatar()) }}" class="img-cover" alt="">
                                                </div>
                                                <div class=" ml-5">
                                                    <span class="d-block text-dark-blue font-weight-500">{{ $user->full_name }}</span>
                                                    <span class="mt-5 d-block font-12 text-gray">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500">{{ $user->course_progress }}%</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500">{{ $user->passed_quizzes }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500">{{ $user->unsent_assignments }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500">{{ $user->pending_assignments }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500">{{ dateTimeFormat($user->created_at,'j M Y | H:i') }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="my-30">
                {{ $students->appends(request()->input())->links('vendor.pagination.panel') }}
            </div>
        @else

            @include(getTemplate() . '.includes.no-result',[
                'file_name' => 'studentt.png',
                'title' => 'Belum ada peserta pada pelatihan ini!',
                'hint' =>  nl2br('tidak ada petunjuk hasil'),
            ])
        @endif

    </section>
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
