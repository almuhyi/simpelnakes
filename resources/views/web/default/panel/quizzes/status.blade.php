@extends(getTemplate().'.layouts.app')

@section('content')
    <div class="container">
        <section class="mt-40">
            <h2 class="font-weight-bold font-16 text-dark-blue">
                identifikasi kuis</h2>
            <p class="text-gray font-14 mt-5">{{ $quiz->title }} | Oleh <span class="font-weight-bold">{{ $quiz->creator->full_name }}</span></p>

            <div class="activities-container shadow-sm rounded-lg mt-25 p-20 p-lg-35">
                <div class="row">
                    <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('') }}assets/default/img/activity/58.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5">{{  $quiz->pass_mark }}/{{  $quizQuestions->sum('grade') }}</strong>
                            <span class="font-16 text-gray font-weight-500">Minimal Nilai</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('') }}assets/default/img/activity/88.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5">{{ $attempt_count }}/{{ $quiz->attempt }}</strong>
                            <span class="font-16 text-gray font-weight-500">Percobaan</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('') }}assets/default/img/activity/45.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-secondary mt-5">{{  $quizResult->user_grade }}/{{  $quizQuestions->sum('grade') }}</strong>
                            <span class="font-16 text-gray font-weight-500">Nilai kamu</span>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mt-30 mt-md-0 d-flex align-items-center justify-content-center mt-5 mt-md-0">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('') }}assets/default/img/activity/44.svg" width="64" height="64" alt="">
                            <strong class="font-30 font-weight-bold text-{{ ($quizResult->status == 'passed') ? 'primary' : ($quizResult->status == 'waiting' ? 'warning' : 'danger') }} mt-5">
                                {{ $quizResult->status }}
                            </strong>
                            <span class="font-16 text-gray font-weight-500">Status</span>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="mt-30 rounded-lg shadow-sm py-25 px-20">

                @switch($quizResult->status)

                @case(\App\Models\QuizzesResult::$passed)
                    <div class="no-result default-no-result mt-50 d-flex align-items-center justify-content-center flex-column">
                        <div class="no-result-logo">
                            <img src="{{ asset('') }}assets/default/img/no-results/497.png" alt="">
                        </div>
                        <div class="d-flex align-items-center flex-column mt-30 text-center">
                            <h2 class="section-title">
                                Selamat! Anda lulus ujian ini.</h2>
                            <p class="mt-5 text-center">
                                Anda lulus ujian dengan nilai {!! $quizResult->user_grade.'/'.$quizQuestions->sum('grade') !!}</p>

                            @if($quiz->certificate)
                                <p>Sekarang Anda dapat mengunduh sertifikat Anda.</p>
                            @endif

                            <div class=" mt-25">
                                <a href="{{ url('/panel/quizzes/my-results') }}" class="btn btn-sm btn-primary">Lihat hasil</a>

                                @if($quiz->certificate)
                                    <a href="{{ url('') }}/panel/quizzes/results/{{ $quizResult->id }}/showCertificate" class="btn btn-sm btn-primary">Download sertifikat</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @break

                @case(\App\Models\QuizzesResult::$failed)
                    <div class="no-result status-failed mt-50 d-flex align-items-center justify-content-center flex-column">
                        <div class="no-result-logo">
                            <img src="{{ asset('') }}assets/default/img/no-results/339.png" alt="">
                        </div>
                        <div class="d-flex align-items-center flex-column mt-30 text-center">
                            <h2 class="section-title">
                                Maaf, Anda gagal dalam ujian.</h2>
                            <p class="mt-5 text-center">Nilai lulus kuis adalah {!! $quiz->pass_mark .'/'. $quizQuestions->sum('grade') !!} tetapi nilai anda adalah {!!  $quizResult->user_grade !!}</p>
                            @if($canTryAgain)
                                <p>Jangan khawatir, Anda bisa mencoba lagi.</p>
                            @endif
                            <div class=" mt-25">
                                @if($canTryAgain)
                                    <a href="{{ url('') }}/panel/quizzes/{{ $quiz->id }}/start" class="btn btn-sm btn-primary">Coba lagi</a>
                                @endif
                                <a href="{{ url('/panel/quizzes/my-results') }}" class="btn btn-sm btn-primary">Lihat hasil</a>
                            </div>
                        </div>
                    </div>
                @break

                @case(\App\Models\QuizzesResult::$waiting)
                    <div class="no-result status-waiting mt-50 d-flex align-items-center justify-content-center flex-column">
                        <div class="no-result-logo">
                            <img src="{{ asset('') }}assets/default/img/no-results/242.png" alt="">
                        </div>
                        <div class="d-flex align-items-center flex-column mt-30 text-center">
                            <h2 class="section-title">Tunggu hasilnya...</h2>
                            <p class="mt-5 text-center">Kuis ini memiliki beberapa pertanyaan deskriptif sehingga hasilnya \n akan diinformasikan kepada Anda setelah ditinjau.</p>
                            <div class=" mt-25">
                                <a href="{{ url('/panel/quizzes/my-results') }}" class="btn btn-sm btn-primary">Lihat hasil</a>
                            </div>
                        </div>
                    </div>
                @break
            @endswitch

        </section>

    </div>
@endsection
