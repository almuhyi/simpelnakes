@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.css">
@endpush

@section('content')
    <section>
        <h2 class="section-title">Aktivitas saya</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/webinars.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ !empty($webinars) ? $webinarsCount : 0}}</strong>
                        <span class="font-16 text-gray font-weight-500">Pelatihan</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/hours.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ convertMinutesToHourAndMinute($webinarHours) }}</strong>
                        <span class="font-16 text-gray font-weight-500">Jam</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/sales.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ addCurrencyToPrice($webinarSalesAmount) }}</strong>
                        <span class="font-16 text-gray font-weight-500">{{ 'Total' .' '. 'penjualan kelas Live' }}</span>
                    </div>
                </div>

                <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/download-sales.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ addCurrencyToPrice($courseSalesAmount) }}</strong>
                        <span class="font-16 text-gray font-weight-500">{{ 'Total' .' '. 'Penjualan pelatihan' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-25">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Pelatihan saya</h2>


        </div>

        @if(!empty($webinars) and !$webinars->isEmpty())
            @foreach($webinars as $webinar)
                @php
                    $lastSession = $webinar->lastSession();
                    $nextSession = $webinar->nextSession();
                    $isProgressing = false;

                    if($webinar->start_date <= time() and !empty($lastSession) and $lastSession->date > time()) {
                        $isProgressing=true;
                    }
                @endphp

                <div class="row mt-30">
                    <div class="col-12">
                        <div class="webinar-card webinar-list d-flex">
                            <div class="image-box">
                                <img src="{{ asset($webinar->getImage()) }}" class="img-cover" alt="">

                                @switch($webinar->status)
                                    @case(\App\Models\Webinar::$active)
                                    @if($webinar->isWebinar())
                                        @if($webinar->start_date > time())
                                            <span class="badge badge-primary">Tidak dilakukan</span>
                                        @elseif($webinar->isProgressing())
                                            <span class="badge badge-secondary">Sedang berlangsung</span>
                                        @else
                                            <span class="badge badge-secondary">Selesai</span>
                                        @endif
                                    @else
                                        <span class="badge badge-secondary">{{ $webinar->type }}</span>
                                    @endif
                                    @break
                                    @case(\App\Models\Webinar::$isDraft)
                                    <span class="badge badge-danger">
                                        draf</span>
                                    @break
                                    @case(\App\Models\Webinar::$pending)
                                    <span class="badge badge-warning">Menunggu</span>
                                    @break
                                    @case(\App\Models\Webinar::$inactive)
                                    <span class="badge badge-danger">Ditolak</span>
                                    @break
                                @endswitch

                                @if($webinar->isWebinar())
                                    <div class="progress">
                                        <span class="progress-bar" style="width: {{ $webinar->getProgress() }}%"></span>
                                    </div>
                                @endif
                            </div>

                            <div class="webinar-card-body w-100 d-flex flex-column">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="{{ url($webinar->getUrl()) }}" target="_blank">
                                        <h3 class="font-16 text-dark-blue font-weight-bold">{{ $webinar->title }}
                                            <span class="badge badge-dark ml-10 status-badge-dark">{{ $webinar->type }}</span>
                                        </h3>
                                    </a>

                                    @if($webinar->isOwner($authUser->id) or $webinar->isPartnerTeacher($authUser->id))
                                        <div class="btn-group dropdown table-actions">
                                            <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="more-vertical" height="20"></i>
                                            </button>
                                            <div class="dropdown-menu ">
                                                @if(!empty($webinar->start_date))
                                                    <button type="button" data-webinar-id="{{ $webinar->id }}" class="js-webinar-next-session webinar-actions btn-transparent d-block">Buat tautan bergabung</button>
                                                @endif

                                                <a href="{{ url($webinar->getLearningPageUrl()) }}" target="_blank" class="webinar-actions d-block mt-10">Halaman pembelajaran</a>

                                                <a href="{{ url('') }}/panel/webinars/{{ $webinar->id }}/edit" class="webinar-actions d-block mt-10">Edit</a>

                                                @if($webinar->isWebinar())
                                                    <a href="{{ url('') }}/panel/webinars/{{ $webinar->id }}/step/4" class="webinar-actions d-block mt-10">Sesi</a>
                                                @endif

                                                <a href="{{ url('') }}/panel/webinars/{{ $webinar->id }}/step/4" class="webinar-actions d-block mt-10">File</a>

                                                <a href="{{ url('') }}/panel/webinars/{{ $webinar->id }}/export-students-list" class="webinar-actions d-block mt-10">Export daftar peserta</a>

                                                @if($authUser->id == $webinar->creator_id)
                                                    <a href="{{ url('') }}/panel/webinars/{{ $webinar->id }}/duplicate" class="webinar-actions d-block mt-10">
                                                        Duplikat</a>
                                                @endif


                                                <a href="{{ url('') }}/panel/webinars/{{ $webinar->id }}/statistics" class="webinar-actions d-block mt-10">Statistik</a>

                                                @if($webinar->creator_id == $authUser->id)
                                                    <a href="{{ url('') }}/panel/webinars/{{ $webinar->id }}/delete" class="webinar-actions d-block mt-10 text-danger delete-action">Hapus</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                @include(getTemplate() . '.includes.webinar.rate',['rate' => $webinar->getRate()])

                                <div class="webinar-price-box mt-15">
                                    @if($webinar->price > 0)
                                        @if($webinar->bestTicket() < $webinar->price)
                                            <span class="real">{{ handlePrice($webinar->bestTicket()) }}</span>
                                            <span class="off ml-10">{{ handlePrice($webinar->price) }}</span>
                                        @else
                                            <span class="real">{{ handlePrice($webinar->price) }}</span>
                                        @endif
                                    @else
                                        <span class="real">Gratis</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">ID pelatihan:</span>
                                        <span class="stat-value">{{ $webinar->id }}</span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">Kategori:</span>
                                        <span class="stat-value">{{ !empty($webinar->category_id) ? $webinar->category->title : '' }}</span>
                                    </div>

                                    @if($webinar->isProgressing() and !empty($nextSession))
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">
                                                Durasi sesi berikutnya:</span>
                                            <span class="stat-value">{{ convertMinutesToHourAndMinute($nextSession->duration) }} Hrs</span>
                                        </div>

                                        @if($webinar->isWebinar())
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span class="stat-title">
                                                    Tanggal mulai sesi berikutnya:</span>
                                                <span class="stat-value">{{ dateTimeFormat($nextSession->date,'j M Y') }}</span>
                                            </div>
                                        @endif
                                    @else
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Durasi:</span>
                                            <span class="stat-value">{{ convertMinutesToHourAndMinute($webinar->duration) }} Hrs</span>
                                        </div>

                                        @if($webinar->isWebinar())
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span class="stat-title">Tanggal mulai:</span>
                                                <span class="stat-value">{{ dateTimeFormat($webinar->start_date,'j M Y') }}</span>
                                            </div>
                                        @endif
                                    @endif

                                    @if($webinar->isTextCourse() or $webinar->isCourse())
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">File:</span>
                                            <span class="stat-value">{{ $webinar->files->count() }}</span>
                                        </div>
                                    @endif

                                    @if($webinar->isTextCourse())
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Pelajaran teks:</span>
                                            <span class="stat-value">{{ $webinar->textLessons->count() }}</span>
                                        </div>
                                    @endif

                                    @if($webinar->isCourse())
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Dapat diunduh:</span>
                                            <span class="stat-value">{{ ($webinar->downloadable) ? 'Ya' : 'Tidak' }}</span>
                                        </div>
                                    @endif

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">Penjualan:</span>
                                        <span class="stat-value">{{ count($webinar->sales) }} ({{ (!empty($webinar->sales) and count($webinar->sales)) ? addCurrencyToPrice($webinar->sales->sum('amount')) : 0 }})</span>
                                    </div>

                                    @if(!empty($webinar->partner_instructor) and $webinar->partner_instructor and $authUser->id != $webinar->teacher_id and $authUser->id != $webinar->creator_id)
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Diundang oleh:</span>
                                            <span class="stat-value">{{ $webinar->teacher->full_name }}</span>
                                        </div>
                                    @elseif($authUser->id != $webinar->teacher_id and $authUser->id != $webinar->creator_id)
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Nama instruktur:</span>
                                            <span class="stat-value">{{ $webinar->teacher->full_name }}</span>
                                        </div>
                                    @elseif($authUser->id == $webinar->teacher_id and $authUser->id != $webinar->creator_id and $webinar->creator->isOrganization())
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Nama organisasi:</span>
                                            <span class="stat-value">{{ $webinar->creator->full_name }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="my-30">
                {{ $webinars->appends(request()->input())->links('vendor.pagination.panel') }}
            </div>

        @else
            @include(getTemplate() . '.includes.no-result',[
                'file_name' => 'webinar.png',
                'title' => 'Tidak ada pelatihan',
                'hint' =>  'Buat pelatihan pertama Anda dan biarkan orang lain belajar dari Anda.',
                'btn' => ['url' => '/panel/webinars/new','text' => 'Buat pelatihan' ]
            ])
        @endif

    </section>

    @include('web.default.panel.webinar.make_next_session_modal')
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>

    <script>
        var undefinedActiveSessionLang = '{{ ('Sesi aktif yang tidak ditentukan') }}';
        var saveSuccessLang = '{{ ('Item berhasil ditambahkan.') }}';
        var selectChapterLang = '{{ ('Pilih bab') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/panel/make_next_session.min.js"></script>
@endpush
