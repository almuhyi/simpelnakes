@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')

@endpush

@section('content')

    <section>
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="section-title">Pelatihan favorit</h2>
        </div>

        @if(!empty($favorites) and !$favorites->isEmpty())

            @foreach($favorites as $favorite)
                <div class="row mt-30">
                    <div class="col-12">
                        <div class="webinar-card webinar-list d-flex">
                            <div class="image-box">
                                <img src="{{ asset($favorite->webinar->getImage()) }}" class="img-cover" alt="">

                                @if($favorite->webinar->type == 'webinar')
                                    <div class="progress">
                                        <span class="progress-bar" style="width: {{ $favorite->webinar->getProgress() }}%"></span>
                                    </div>
                                @endif
                            </div>

                            <div class="webinar-card-body w-100 d-flex flex-column">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="{{ url($favorite->webinar->getUrl()) }}" target="_blank">
                                        <h3 class="font-16 text-dark-blue font-weight-bold">{{ $favorite->webinar->title }}</h3>
                                    </a>

                                    <div class="btn-group dropdown table-actions">
                                        <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i data-feather="more-vertical" height="20"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ url('') }}/panel/webinars/favorites/{{ $favorite->id }}/delete" class="webinar-actions d-block delete-action">Hapus</a>
                                        </div>
                                    </div>
                                </div>

                                @include(getTemplate() . '.includes.webinar.rate',['rate' => $favorite->webinar->getRate()])

                                {{-- <div class="webinar-price-box mt-15">
                                    @if($favorite->webinar->bestTicket() < $favorite->webinar->price)
                                        <span class="real">{{ handlePrice($favorite->webinar->bestTicket(), true, true) }}</span>
                                        <span class="off ml-10">{{ handlePrice($favorite->webinar->price, true, true) }}</span>
                                    @else
                                        <span class="real">{{ handlePrice($favorite->webinar->price, true, true) }}</span>
                                    @endif
                                </div> --}}

                                <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">ID pelatihan:</span>
                                        <span class="stat-value">{{ $favorite->webinar->id }}</span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">Kategori:</span>
                                        <span class="stat-value">{{ !empty($favorite->webinar->category_id) ? $favorite->webinar->category->title : '' }}</span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">Durasi:</span>
                                        <span class="stat-value">{{ convertMinutesToHourAndMinute($favorite->webinar->duration) }} Jam</span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        @if($favorite->webinar->isWebinar())
                                            <span class="stat-title">Tanggal mulai:</span>
                                        @else
                                            <span class="stat-title">Dibuat pada:</span>
                                        @endif
                                        <span class="stat-value">{{ dateTimeFormat(!empty($favorite->webinar->start_date) ? $favorite->webinar->start_date : $favorite->webinar->created_at,'j M Y') }}</span>
                                    </div>

                                    <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">Instruktur:</span>
                                        <span class="stat-value">{{ $favorite->webinar->teacher->full_name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            @include(getTemplate() . '.includes.no-result',[
                'file_name' => 'student.png',
                'title' => 'Tidak ada pelatihan favorit!',
                'hint' =>  'Anda dapat menambahkan pelatihan ke daftar favorit Anda dan mendaftar nanti.' ,
            ])
        @endif

    </section>

    <div class="my-30">
        {{ $favorites->appends(request()->input())->links('vendor.pagination.panel') }}
    </div>
@endsection
