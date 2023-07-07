@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.css">
@endpush

@section('content')
    <section>
        <h2 class="section-title">Statistik sertifikat</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-6 col-lg-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/56.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $activeQuizzes }}</strong>
                        <span class="font-16 text-gray font-weight-500">Sertifikat aktif</span>
                    </div>
                </div>

                <div class="col-6 col-lg-3 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/57.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $achievementsCount }}</strong>
                        <span class="font-16 text-gray font-weight-500">Sertifikat keluar</span>
                    </div>
                </div>

                <div class="col-6 col-lg-3 d-flex align-items-center justify-content-center mt-5 mt-lg-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/60.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $failedResults }}</strong>
                        <span class="font-16 text-gray font-weight-500">Peserta gagal</span>
                    </div>
                </div>

                <div class="col-6 col-lg-3 d-flex align-items-center justify-content-center mt-5 mt-lg-0">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/hours.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $avgGrade }}</strong>
                        <span class="font-16 text-gray font-weight-500">Nilai rata-rata</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-25">
        <h2 class="section-title">Filter sertifikat</h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="" method="get" class="row">
                <div class="col-12 col-lg-4">
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

                <div class="col-12 col-lg-6">
                    <div class="row">
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
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label">Kuis</label>
                                        <select id="quizFilter" name="quiz_id" class="form-control" @if(empty(request()->get('quiz_id'))) disabled @endif>
                                            <option value="all">Semua kuis</option>

                                            @foreach($userAllQuizzes as $userQuiz)
                                                <option value="{{ $userQuiz->id }}" data-webinar-id="{{ $userQuiz->webinar_id }}" @if(request()->get('quiz_id','') == $userQuiz->id) selected @else class="d-none" @endif>{{ $userQuiz->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label class="input-label">Nilai</label>
                                        <input type="text" name="grade" value="{{ request()->get('grade','') }}" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            <h2 class="section-title">Sertifikat aktif</h2>
        </div>

        @if(!empty($quizzes) and count($quizzes))
            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <th>Kuis</th>
                                    <th class="text-center">Nilai</th>
                                    <th class="text-center">Rata-rata</th>
                                    <th class="text-center">Sertifikat keluar</th>
                                    <th class="text-center">Tanggal</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($quizzes as $quiz)
                                    <tr>
                                        <td class="text-left">
                                            <span class="d-block text-dark-blue font-weight-500">{{ $quiz->title }}</span>
                                            <span class="d-block mt-5 font-12 text-gray">{{ !empty($quiz->webinar) ? $quiz->webinar->title : 'Item yang dihapus' }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500">{{ $quiz->pass_mark }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500">{{ round($quiz->avg_grade, 2) }}</span>
                                        </td>
                                        <td class="text-dark-blue font-weight-500 align-middle">{{ count($quiz->certificates) }}</td>
                                        <td class="align-middle">
                                            <span class="text-dark-blue font-weight-500">{{ dateTimeFormat($quiz->created_at, 'j M Y') }}</span>
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
                'file_name' => 'certificate.png',
                'title' => ('Tidak ada sertifikat untuk pelatihan Anda!'),
                'hint' => nl2br(('Dengan membuat kuis yang menyertakan sertifikat, pelatihan Anda akan lebih berharga.')),
            ])
        @endif
    </section>

    <div class="my-30">
        {{ $quizzes->appends(request()->input())->links('vendor.pagination.panel') }}
    </div>

@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('') }}assets/default/js/panel/certificates.min.js"></script>
@endpush

