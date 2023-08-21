@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
@endpush

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ url('/admin/quizzes/store') }}" id="webinarForm" class="webinar-form">
                                {{ csrf_field() }}
                                <section>

                                    <div class="row">
                                        <div class="col-12 col-md-12">

                                            <div class="form-group">
                                                <label class="input-label d-block">Pelatihan</label>
                                                <select name="webinar_id" class="form-control search-webinar-select2 @error('webinar_id') is-invalid @enderror" data-placeholder="Cari pelatihan">

                                                </select>

                                                @error('webinar_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="input-label">Judul kuis</label>
                                                <input type="text" value="{{ old('title') }}" name="title" class="form-control @error('title')  is-invalid @enderror" placeholder=""/>
                                                @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="input-label">Waktu <span class="braces">(Menit)</span></label>
                                                <input type="text" value="{{ old('time') }}" name="time" class="form-control @error('time')  is-invalid @enderror" placeholder="Biarkan kosong untuk waktu tidak terbatas"/>
                                                @error('time')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="input-label">Jumlah percobaan</label>
                                                <input type="text" name="attempt" value="{{ old('attempt') }}" class="form-control @error('attempt')  is-invalid @enderror" placeholder="biarkan kosong untuk jumlah percobaan tidak terbatas"/>
                                                @error('attempt')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="input-label">Nilai lulus</label>
                                                <input type="text" name="pass_mark" value="{{ old('pass_mark') }}" class="form-control @error('pass_mark')  is-invalid @enderror" placeholder=""/>
                                                @error('pass_mark')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-4 d-flex align-items-center justify-content-between">
                                                <label class="cursor-pointer" for="certificateSwitch">Sertifikat disertakan</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="certificate" class="custom-control-input" id="certificateSwitch">
                                                    <label class="custom-control-label" for="certificateSwitch"></label>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4 d-flex align-items-center justify-content-between">
                                                <label class="cursor-pointer" for="statusSwitch">Kuis aktif</label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="status" class="custom-control-input" id="statusSwitch">
                                                    <label class="custom-control-label" for="statusSwitch"></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </section>

                                <div class="mt-5 mb-5">
                                    <button type="submit" class="btn btn-primary">{{ !empty($quiz) ? 'Simpan' : 'Buat' }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>

    <script>
        var saveSuccessLang = '{{ ('Item berhasil ditambahkan.') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/admin/quiz.min.js"></script>
@endpush
