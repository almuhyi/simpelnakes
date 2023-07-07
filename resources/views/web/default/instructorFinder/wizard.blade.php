@extends('web.default.layouts.app',['appFooter' => false])

@section('content')
    <div class="instructor-finder-wizard row">
        <div class="col-12 col-lg-4 wizard-left-side d-none d-md-block" style="background-image: url('{{ getPageBackgroundSettings('instructor_finder_wizard') }}')">
            <div class="wizard-left-side-content position-relative w-100 h-100 d-flex align-items-end justify-content-center">
                <div class="">
                    <h1 class="font-36 font-weight-bold text-white">Mencari instruktur</h1>
                    <p class="text-white font-16">Temukan instruktur yang cocok untuk pertemuan individu atau kelompok dan pesan waktu secara online.</p>

                    <div class="mt-30 d-flex align-items-center justify-content-between">
                        <div class="d-flex flex-column align-items-center">
                            <span class="wizard-stat-icon d-flex align-items-center justify-content-center rounded-circle text-white">
                                <i data-feather="user" width="30" height="30" class="text-white"></i>
                            </span>
                            <span class="font-30 font-weight-bold text-white mt-10">{{ $instructorsCount }}</span>
                            <span class="font-14 text-white">Instruktur</span>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <span class="wizard-stat-icon d-flex align-items-center justify-content-center rounded-circle text-white">
                                <i data-feather="briefcase" width="30" height="30" class="text-white"></i>
                            </span>
                            <span class="font-30 font-weight-bold text-white mt-10">{{ $organizationsCount }}</span>
                            <span class="font-14 text-white">Organisasi</span>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <span class="wizard-stat-icon d-flex align-items-center justify-content-center rounded-circle text-white">
                                <i data-feather="map-pin" width="30" height="30" class="text-white"></i>
                            </span>
                            <span class="font-30 font-weight-bold text-white mt-10">{{ $citiesCount }}</span>
                            <span class="font-14 text-white">Kota</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8 bg-white">
            <div class="row wizard-content d-flex align-items-lg-center justify-content-lg-center">
                <div class="col-12 col-lg-5">

                    <form action="/instructor-finder/wizard?{{ http_build_query(request()->all()) }}" method="get">
                        @if(!empty(request()->all()) and count(request()->all()))
                            @foreach(request()->all() as $param => $value)
                                @if($param !== 'step')
                                    <input type="hidden" name="{{ $param }}" value="{{ $value }}">
                                @endif
                            @endforeach
                        @endif

                        <input type="hidden" name="step" value="{{ $step + 1 }}">

                        @include('web.default.instructorFinder.wizard.step_'.$step)

                        <div class="mt-50 pt-20 border-top border-gray300 d-flex align-items-center justify-content-end">
                            <a href="{{ url()->previous() }}" class="js-prev-btn btn btn-gray300 btn-sm text-gray {{ ($step == 1) ? 'disabled' : '' }}" >Sebelumnya</a>

                            <button type="submit" class="btn btn-primary btn-sm ml-10">Selanjutnya</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script>
        var selectProvinceLang = 'Pilih Provinsi';
        var selectCityLang = 'Pilih Kota';
        var selectDistrictLang = 'Pilih Daerah';
    </script>

    <script src="{{ asset('') }}assets/default/js/parts/get-regions.min.js"></script>
    <script src="{{ asset('') }}assets/default/js/parts/instructor-finder-wizard.min.js"></script>
@endpush
