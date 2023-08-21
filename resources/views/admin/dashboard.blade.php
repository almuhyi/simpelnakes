@extends('admin.layouts.app')

@push('libraries_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/admin/vendor/owl.carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/admin/vendor/owl.carousel/owl.theme.min.css">

@endpush

@section('content')


    <section class="section">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="hero text-white hero-bg-image hero-bg" data-background="{{ asset(!empty(getPageBackgroundSettings('admin_dashboard')) ? getPageBackgroundSettings('admin_dashboard') : '') }}">
                    <div class="hero-inner">
                        <h2>Selamat Datang, {{ $authUser->full_name }}!</h2>

                        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between">
                            @can('admin_general_dashboard_quick_access_links')
                                <div>
                                    <p class="lead">Gunakan tombol akses dibawah untuk memudahkan mengatur relasi.</p>

                                    <div class="mt-2 mb-2 d-flex flex-column flex-md-row">
                                        <a href="{{ url('/admin/comments/webinars') }}" class="mt-2 mt-md-0 btn btn-outline-white btn-lg btn-icon icon-left ml-0 ml-md-2"><i class="far fa-comment"></i>Komentar </a>
                                        <a href="{{ url('/admin/supports') }}" class="mt-2 mt-md-0 btn btn-outline-white btn-lg btn-icon icon-left ml-0 ml-md-2"><i class="far fa-envelope"></i>Pengajuan Bantuan</a>
                                        <a href="{{ url('/admin/reports/webinars') }}" class="mt-2 mt-md-0 btn btn-outline-white btn-lg btn-icon icon-left ml-0 ml-md-2"><i class="fas fa-info"></i>Laporan</a>
                                    </div>
                                </div>
                            @endcan

                            @can('admin_clear_cache')
                                <div class="w-xs-to-lg-100">
                                    <p class="lead d-none d-lg-block">&nbsp;</p>

                                    @include('admin.includes.delete_button',[
                                             'url' => '/admin/clear-cache',
                                             'btnClass' => 'btn btn-outline-white btn-lg btn-icon icon-left mt-2 w-100',
                                             'btnText' => 'Bersihkan cache',
                                             'hideDefaultClass' => true
                                          ])
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">

            @can('admin_general_dashboard_new_sales')
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <a href="{{ url('/admin/financial/sales') }}" class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pelatihan</h4>
                            </div>
                            <div class="card-body">
                                {{ $getNewSalesCount }}
                            </div>
                        </div>
                    </a>
                </div>
            @endcan

            @can('admin_general_dashboard_new_comments')
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <a href="{{ url('/admin/comments/webinars') }}" class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-comment"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Komentar</h4>
                            </div>
                            <div class="card-body">
                                {{ $getNewCommentsCount }}
                            </div>
                        </div>
                    </a>
                </div>
            @endcan

            @can('admin_general_dashboard_new_tickets')
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <a href="{{ url('/admin/supports') }}" class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-envelope"></i></div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Bantuan</h4>
                            </div>
                            <div class="card-body">
                                {{ $getNewTicketsCount }}
                            </div>
                        </div>
                    </a>
                </div>
            @endcan



        </div>


        <div class="row">


            @can('admin_general_dashboard_recent_comments')
                <div class="col-lg-12 col-md-12 col-12 col-sm-12 @if(count($recentComments) < 6) pb-30 @endif">
                    <div class="card @if(count($recentComments) < 6) h-100 @endif">
                        <div class="card-header">
                            <h4>Komentar Terkini</h4>
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <ul class="list-unstyled list-unstyled-border">
                                @foreach($recentComments as $recentComment)
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" height="50" src="{{ asset($recentComment->user->getAvatar()) }}" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right text-primary font-12">{{ dateTimeFormat($recentComment->created_at, 'j M Y | H:i') }}</div>
                                            <div class="media-title">{{ $recentComment->user->full_name }}</div>
                                            <span class="text-small text-muted">{!! truncate($recentComment->comment, 150) !!}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="text-center pt-1 pb-1">
                                <a href="{{ url('/admin/comments/webinars') }}" class="btn btn-primary btn-lg btn-round ">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>


        <div class="row">

            @can('admin_general_dashboard_recent_tickets')
                @if(!empty($recentTickets))
                    <div class="col-md-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h5>Bantuan Terkini</h5>
                                <div class="card-description">{{ $recentTickets['pendingReply'] }} Menunggu Jawaban</div>
                            </div>

                            <div class="card-body p-0">
                                <div class="tickets-list">

                                    @foreach($recentTickets['tickets'] as $ticket)
                                        <a href="{{ url('') }}/admin/supports/{{ $ticket->id }}/conversation" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>{{ $ticket->title }}</h4>
                                            </div>
                                            <div class="ticket-info">
                                                <div>{{ $ticket->user->full_name }}</div>
                                                <div class="bullet"></div>
                                                @if($ticket->status == 'replied' or $ticket->status == 'open')
                                                    <span class="text-warning  text-small font-600-bold">Menunggu Jawaban</span>
                                                @elseif($ticket->status == 'close')
                                                    <span class="text-danger  text-small font-600-bold">Selesai</span>
                                                @else
                                                    <span class="text-primary  text-small font-600-bold">Sedang Berlangsung</span>
                                                @endif
                                            </div>
                                        </a>
                                    @endforeach

                                    <a href="{{ url('/admin/supports') }}" class="ticket-item ticket-more">
                                        Lihat semua <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan

            @can('admin_general_dashboard_recent_webinars')
                @if(!empty($recentWebinars))
                    <div class="col-md-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5>Kelas webinar Terkini</h5>
                                <div class="card-description">{{ $recentWebinars['pendingReviews'] }} Menunggu Tinjauan</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    @foreach($recentWebinars['webinars'] as $webinar)
                                        <a href="{{ url('') }}/admin/webinars/{{ $webinar->id }}/edit" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>{{ $webinar->title }}</h4>
                                            </div>

                                            <div class="ticket-info">
                                                <div>{{ $webinar->teacher->full_name }}</div>
                                                <div class="bullet"></div>
                                                @switch($webinar->status)
                                                    @case(\App\Models\Webinar::$active)
                                                    <span class="text-success">Dipublish</span>
                                                    @if($webinar->isProgressing())
                                                        <div class="text-warning text-small font-600-bold">(Sedang Berlangsung)</div>
                                                    @elseif($webinar->start_date > time())
                                                        <div class="text-danger text-small font-600-bold">(Tidak dilakukan)</div>
                                                    @else
                                                        <span class="text-success text-small font-600-bold">(Selesai)</span>
                                                    @endif
                                                    @break
                                                    @case(\App\Models\Webinar::$isDraft)
                                                    <span class="text-dark">Draft</span>
                                                    @break
                                                    @case(\App\Models\Webinar::$pending)
                                                    <span class="text-warning">Menunggu</span>
                                                    @break
                                                    @case(\App\Models\Webinar::$inactive)
                                                    <span class="text-danger">ditolak</span>
                                                    @break
                                                @endswitch
                                            </div>
                                        </a>
                                    @endforeach

                                    <a href="{{ url('/admin/webinars?type=webinar') }}" class="ticket-item ticket-more">
                                        Lihat semua <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan

            @can('admin_general_dashboard_recent_courses')
                @if(!empty($recentCourses))
                    <div class="col-md-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-play-circle"></i>
                                </div>
                                <h5>Pelatihan Terkini</h5>
                                <div class="card-description">{{ $recentCourses['pendingReviews'] }} Menunggu Tinjauan</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">


                                    @foreach($recentCourses['courses'] as $course)
                                        <a href="{{ url('') }}/admin/webinars/{{ $course->id }}/edit" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4>{{ $course->title }}</h4>
                                            </div>

                                            <div class="ticket-info">
                                                <div>{{ $course->teacher->full_name }}</div>
                                                <div class="bullet"></div>
                                                @switch($course->status)
                                                    @case(\App\Models\Webinar::$active)
                                                    <span class="text-success">Dipublish</span>
                                                    @if($course->isProgressing())
                                                        <div class="text-warning text-small font-600-bold">(Sedang Berlangsung)</div>
                                                    @elseif($course->start_date > time())
                                                        <div class="text-danger text-small font-600-bold">(Tidak dilakukan)</div>
                                                    @else
                                                        <span class="text-success text-small font-600-bold">(Selesai)</span>
                                                    @endif
                                                    @break
                                                    @case(\App\Models\Webinar::$isDraft)
                                                    <span class="text-dark">Draft</span>
                                                    @break
                                                    @case(\App\Models\Webinar::$pending)
                                                    <span class="text-warning">Menunggu</span>
                                                    @break
                                                    @case(\App\Models\Webinar::$inactive)
                                                    <span class="text-danger">ditolak</span>
                                                    @break
                                                @endswitch
                                            </div>
                                        </a>
                                    @endforeach


                                    <a href="{{ url('/admin/webinars?type=course') }}" class="ticket-item ticket-more">
                                        Lihat semua <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan
        </div>


    </section>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/chartjs/chart.min.js"></script>
    <script src="{{ asset('') }}assets/admin/vendor/owl.carousel/owl.carousel.min.js"></script>

    <script src="{{ asset('') }}assets/admin/js/dashboard.min.js"></script>

    <script>
        (function ($) {
            "use strict";

            @if(!empty($getMonthAndYearSalesChart))
            makeStatisticsChart('saleStatisticsChart', saleStatisticsChart, 'Sale', @json($getMonthAndYearSalesChart['labels']),@json($getMonthAndYearSalesChart['data']));
            @endif

            @if(!empty($usersStatisticsChart))
            makeStatisticsChart('usersStatisticsChart', usersStatisticsChart, 'Users', @json($usersStatisticsChart['labels']),@json($usersStatisticsChart['data']));
            @endif

        })(jQuery)
    </script>
@endpush
