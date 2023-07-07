@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.css">
@endpush

@section('content')

    <section class="mt-25">
        <h2 class="section-title">Filter sertifikat</h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="" method="get" class="row">
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="input-label">Dari</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="dateInputGroupPrepend">
                                            <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="from" autocomplete="off" class="form-control @if(!empty(request()->get('from'))) datepicker @else datefilter @endif" value="{{ request()->get('from','') }}" aria-describedby="dateInputGroupPrepend"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="input-label">Sampai</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="dateInputGroupPrepend">
                                            <i data-feather="calendar" width="18" height="18" class="text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="to" autocomplete="off" class="form-control @if(!empty(request()->get('to'))) datepicker @else datefilter @endif" value="{{ request()->get('to','') }}" aria-describedby="dateInputGroupPrepend"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label class="input-label">Pelatihan</label>
                        <select name="webinar_id" class="form-control">
                            <option value="all">Semua pelatihan</option>

                            @foreach($userWebinars as $userWebinar)
                                <option value="{{ $userWebinar->id }}" @if(request()->get('webinar_id','') == $userWebinar->id) selected @endif>{{ $userWebinar->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-2 d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Lihat hasil</button>
                </div>
            </form>
        </div>
    </section>

    <section class="mt-35">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Sertifikat saya</h2>
        </div>

        @if(!empty($certificates) and count($certificates))
            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <th>Pelatihan</th>
                                    <th class="text-center">ID sertifikat</th>
                                    <th class="text-center">Tanggal</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($certificates as $certificate)
                                    <tr>
                                        <td class="text-left">
                                            <span class="d-block text-dark-blue font-weight-500">{{ $certificate->webinar->title }}</span>
                                        </td>
                                        <td class="align-middle">
                                            {{ $certificate->id }}
                                        </td>

                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500">{{ dateTimeFormat($certificate->created_at, 'j M Y') }}</span>
                                        </td>
                                        <td class="align-middle font-weight-normal">
                                            <div class="btn-group dropdown table-actions">
                                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" height="20"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ url('') }}/panel/certificates/webinars/{{ $certificate->id }}/show" target="_blank" class="webinar-actions d-block">Buka</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @include(getTemplate() . '.includes.no-result',[
                'file_name' => 'cert.png',
                'title' => ('Anda tidak memiliki sertifikat!'),
                'hint' => nl2br(('Anda dapat memperoleh sertifikat yang valid dengan mendaftar di pelatihan.')),
            ])
        @endif
    </section>

    <div class="my-30">
        {{ $certificates->appends(request()->input())->links('vendor.pagination.panel') }}
    </div>

@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('') }}assets/default/js/panel/certificates.min.js"></script>
@endpush
