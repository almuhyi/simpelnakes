@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')

@endpush

@section('content')
    <section>
        <h2 class="section-title">Aktivitas saya</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/webinars.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $purchasedCount }}</strong>
                        <span class="font-16 text-gray font-weight-500">Pelatihan diikuti</span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/hours.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ convertMinutesToHourAndMinute($hours) }}</strong>
                        <span class="font-16 text-gray font-weight-500">Jam</span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/upcoming.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $upComing }}</strong>
                        <span class="font-16 text-gray font-weight-500">Mendatang</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-25">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Daftar pelatihan yang diikuti</h2>
        </div>

        @if(!empty($sales) and !$sales->isEmpty())
            @foreach($sales as $sale)
                @php
                    $item = !empty($sale->webinar) ? $sale->webinar : $sale->bundle;

                    $lastSession = !empty($sale->webinar) ? $sale->webinar->lastSession() : null;
                    $nextSession = !empty($sale->webinar) ? $sale->webinar->nextSession() : null;
                    $isProgressing = false;

                    if(!empty($sale->webinar) and $sale->webinar->start_date <= time() and !empty($lastSession) and $lastSession->date > time()) {
                        $isProgressing=true;
                    }
                @endphp

                @if(!empty($item))
                    <div class="row mt-30">
                        <div class="col-12">
                            <div class="webinar-card webinar-list d-flex">
                                <div class="image-box">
                                    <img src="{{ $item->getImage() }}" class="img-cover" alt="">

                                    @if(!empty($sale->webinar))
                                        @if($item->type == 'webinar')
                                            @if($item->start_date > time())
                                                <span class="badge badge-primary">Tidak dilakukan</span>
                                            @elseif($item->isProgressing())
                                                <span class="badge badge-secondary">Sedang berlangsung</span>
                                            @else
                                                <span class="badge badge-secondary">Selesai</span>
                                            @endif
                                        @elseif(!empty($item->downloadable))
                                            <span class="badge badge-secondary">Dapat diunduh</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $item->type }}</span>
                                        @endif

                                        @php
                                            $percent = $item->getProgress();

                                            if($item->isWebinar()){
                                                if($item->isProgressing()) {
                                                    $progressTitle =  $percent . '%' . ' ' . 'proses pelatihan';
                                                } else {
                                                    $progressTitle = $item->sales_count .'/'. $item->capacity .' '. 'Peserta';
                                                }
                                            } else {
                                                   $progressTitle = $percent . '%' . ' ' . 'proses pelatihan';
                                            }
                                        @endphp

                                        <div class="progress cursor-pointer" data-toggle="tooltip" data-placement="top" title="{{ $progressTitle }}">
                                            <span class="progress-bar" style="width: {{ $percent }}%"></span>
                                        </div>
                                    @else
                                        <span class="badge badge-secondary">Paket pelatihan</span>
                                    @endif
                                </div>

                                <div class="webinar-card-body w-100 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ url($item->getUrl()) }}">
                                            <h3 class="webinar-title font-weight-bold font-16 text-dark-blue">
                                                {{ $item->title }}

                                                @if(!empty($item->access_days))
                                                    @if(!$item->checkHasExpiredAccessDays($sale->created_at))
                                                        <span class="badge badge-outlined-danger ml-10">
                                                            Periode akses berakhir</span>
                                                    @else
                                                        <span class="badge badge-outlined-warning ml-10">Tanggal kadaluwarsa {{ dateTimeFormat($item->getExpiredAccessDays($sale->created_at),'j M Y') }}</span>
                                                    @endif
                                                @endif

                                                @if($sale->payment_method == \App\Models\Sale::$subscribe and $sale->checkExpiredPurchaseWithSubscribe($sale->buyer_id, $item->id, !empty($sale->webinar) ? 'webinar_id' : 'bundle_id'))
                                                    <span class="badge badge-outlined-danger ml-10">Langganan berakhir</span>
                                                @endif

                                                @if(!empty($sale->webinar))
                                                    <span class="badge badge-dark ml-10 status-badge-dark">{{ $item->type }}</span>
                                                @endif
                                            </h3>
                                        </a>

                                        <div class="btn-group dropdown table-actions">
                                            <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i data-feather="more-vertical" height="20"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                @if(!empty($item->access_days) and !$item->checkHasExpiredAccessDays($sale->created_at))
                                                    <a href="{{ url($item->getUrl()) }}" target="_blank" class="webinar-actions d-block mt-10">Daftar di pelatihan</a>
                                                @elseif(!empty($sale->webinar))
                                                    <a href="{{ url($item->getLearningPageUrl()) }}" target="_blank" class="webinar-actions d-block">Halaman Pembelajaran</a>

                                                    @if(!empty($item->start_date) and ($item->start_date > time() or ($item->isProgressing() and !empty($nextSession))))
                                                        <button type="button" data-webinar-id="{{ $item->id }}" class="join-purchase-webinar webinar-actions btn-transparent d-block mt-10">Bergabung</button>
                                                    @endif

                                                    @if(!empty($item->downloadable) or (!empty($item->files) and count($item->files)))
                                                        <a href="{{ url($item->getUrl()) }}?tab=content" target="_blank" class="webinar-actions d-block mt-10">Unduh</a>
                                                    @endif

                                                    @if($item->price > 0)
                                                        <a href="{{ url('') }}/panel/webinars/{{ $item->id }}/invoice" target="_blank" class="webinar-actions d-block mt-10">Faktur</a>
                                                    @endif
                                                @endif

                                                <a href="{{ url($item->getUrl()) }}?tab=reviews" target="_blank" class="webinar-actions d-block mt-10">Masukan</a>
                                            </div>
                                        </div>
                                    </div>

                                    @include(getTemplate() . '.includes.webinar.rate',['rate' => $item->getRate()])

                                    <div class="webinar-price-box mt-15">
                                        @if($item->price > 0)
                                            @if($item->bestTicket() < $item->price)
                                                <span class="real">{{ handlePrice($item->bestTicket()) }}</span>
                                                <span class="off ml-10">{{ handlePrice($item->price) }}</span>
                                            @else
                                                <span class="real">{{ handlePrice($item->price) }}</span>
                                            @endif
                                        @else
                                            <span class="real">Gratis</span>
                                        @endif
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">ID pelatihan:</span>
                                            <span class="stat-value">{{ $item->id }}</span>
                                        </div>

                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Kategori:</span>
                                            <span class="stat-value">{{ !empty($item->category_id) ? $item->category->title : '' }}</span>
                                        </div>

                                        @if(!empty($sale->webinar) and $item->type == 'webinar')
                                            @if($item->isProgressing() and !empty($nextSession))
                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title">
                                                        Tanggal mulai sesi berikutnya:</span>
                                                    <span class="stat-value">{{ convertMinutesToHourAndMinute($nextSession->duration) }} Jam</span>
                                                </div>

                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title">
                                                        Tanggal mulai sesi berikutnya:</span>
                                                    <span class="stat-value">{{ dateTimeFormat($nextSession->date,'j M Y') }}</span>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title">Durasi:</span>
                                                    <span class="stat-value">{{ convertMinutesToHourAndMinute($item->duration) }} Jam</span>
                                                </div>

                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title">Mulai tanggal:</span>
                                                    <span class="stat-value">{{ dateTimeFormat($item->start_date,'j M Y') }}</span>
                                                </div>
                                            @endif
                                        @elseif(!empty($sale->bundle))
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span class="stat-title">Durasi:</span>
                                                <span class="stat-value">{{ convertMinutesToHourAndMinute($item->getBundleDuration()) }} Jam</span>
                                            </div>
                                        @endif

                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Instruktur:</span>
                                            <span class="stat-value">{{ $item->teacher->full_name }}</span>
                                        </div>

                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">Tanggal daftar:</span>
                                            <span class="stat-value">{{ dateTimeFormat($sale->created_at,'j M Y') }}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            @include(getTemplate() . '.includes.no-result',[
            'file_name' => 'student.png',
            'title' => 'Tidak Ada pelatihan yang terdaftar!',
            'hint' => 'Mulailah pelatihan dari instruktur terbaik dan nikmati...',
            'btn' => ['url' => '/classes?sort=newest','text' => 'Cari pelatihan']
        ])
        @endif
    </section>

    <div class="my-30">
        {{ $sales->appends(request()->input())->links('vendor.pagination.panel') }}
    </div>

    @include('web.default.panel.webinar.join_webinar_modal')
@endsection

@push('scripts_bottom')
    <script>
        var undefinedActiveSessionLang = '{{ ('Sesi aktif yang tidak ditentukan') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/panel/join_webinar.min.js"></script>
@endpush
