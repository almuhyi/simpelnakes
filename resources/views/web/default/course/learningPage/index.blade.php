@extends('web.default.layouts.app',['appFooter' => false, 'appHeader' => false])

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/learning_page/styles.css"/>
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/video/video-js.min.css">
@endpush

@section('content')

    <div class="learning-page">

        @include('web.default.course.learningPage.components.navbar')

        <div class="d-flex position-relative">
            <div class="learning-page-content flex-grow-1 bg-info-light p-15">
                @include('web.default.course.learningPage.components.content')
            </div>

            <div class="learning-page-tabs show">
                <ul class="nav nav-tabs py-15 d-flex align-items-center justify-content-around" id="tabs-tab" role="tablist">
                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center active" id="content-tab"
                           data-toggle="tab" href="#content" role="tab" aria-controls="content"
                           aria-selected="true">
                            <i class="learning-page-tabs-icons mr-5">
                                @include('web.default.panel.includes.sidebar_icons.webinars')
                            </i>
                            <span class="learning-page-tabs-link-text">Materi</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center" id="quizzes-tab" data-toggle="tab"
                           href="#quizzes" role="tab" aria-controls="quizzes"
                           aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                @include('web.default.panel.includes.sidebar_icons.quizzes')
                            </i>
                            <span class="learning-page-tabs-link-text">Kuis</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center" id="certificates-tab" data-toggle="tab"
                           href="#certificates" role="tab" aria-controls="certificates"
                           aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                @include('web.default.panel.includes.sidebar_icons.certificate')
                            </i>
                            <span class="learning-page-tabs-link-text">Sertifikat</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content h-100" id="nav-tabContent">
                    <div class="pb-20 tab-pane fade show active h-100" id="content" role="tabpanel"
                         aria-labelledby="content-tab">
                        @include('web.default.course.learningPage.components.content_tab.index')
                    </div>

                    <div class="pb-20 tab-pane fade  h-100" id="quizzes" role="tabpanel"
                         aria-labelledby="quizzes-tab">
                        @include('web.default.course.learningPage.components.quiz_tab.index')
                    </div>

                    <div class="pb-20 tab-pane fade  h-100" id="certificates" role="tabpanel"
                         aria-labelledby="certificates-tab">
                        @include('web.default.course.learningPage.components.certificate_tab.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/video/video.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/video/youtube.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/video/vimeo.js"></script>

    <script>
        var defaultItemType = '{{ request()->get('type') }}'
        var defaultItemId = '{{ request()->get('item') }}'
        var loadFirstContent = {{ (!empty($dontAllowLoadFirstContent) and $dontAllowLoadFirstContent) ? 'false' : 'true' }}; // allow to load first content when request item is empty

        var courseUrl = "{{ url($course->getUrl()) }}";

        // lang
        var pleaseWaitForTheContentLang = '{{ ('Harap tunggu hingga konten materi dimuat') }}';
        var downloadTheFileLang = '{{ ('Unduh file') }}';
        var downloadLang = '{{ ('Unduh') }}';
        var showHtmlFileLang = '{{ ('Play Pelatihan SCORM') }}';
        var showLang = '{{ ('Lihat') }}';
        var sessionIsLiveLang = '{{ ('Sesi siaran langsung!') }}';
        var youCanJoinTheLiveNowLang = '{{ ('Anda dapat bergabung dengan siaran langsung sekarang ...') }}';
        var joinTheClassLang = '{{ ('Bergabung dengan kelas') }}';
        var coursePageLang = '{{ ('Halaman pelatihan') }}';
        var quizPageLang = '{{ ('Halaman kuis') }}';
        var sessionIsNotStartedYetLang = '{{ ('Sesi belum dimulai') }}';
        var thisSessionWillBeStartedOnLang = '{{ ('Sesi ini akan dimulai') }}';
        var sessionIsFinishedLang = '{{ ('Sesi telah selesai') }}';
        var sessionIsFinishedHintLang = '{{ ('Sesi ini telah selesai. Anda tidak dapat bergabung dengannya.') }}';
        var goToTheQuizPageForMoreInformationLang = '{{ ('Buka halaman kuis untuk informasi lebih lanjut') }}';
        var downloadCertificateLang = '{{ ('Unduh sertifikat') }}';
        var enjoySharingYourCertificateWithOthersLang = '{{ ('Nikmati berbagi sertifikat Anda dengan orang lain...') }}';
        var attachmentsLang = '{{ ('Lampiran file') }}';
        var checkAgainLang = '{{ ('Periksa lagi') }}';
        var learningToggleLangSuccess = '{{ ('Status pembelajaran Anda berhasil diubah.') }}';
        var learningToggleLangError = '{{ ('Gagal mengubah status pembelajaran.') }}';
        var sequenceContentErrorModalTitle = '{{ ('Akses ditolak!') }}';
        var sendAssignmentSuccessLang = '{{ ('Berhasil dikirim') }}';
        var saveAssignmentRateSuccessLang = '{{ ('Nilai tugas berhasil disimpan') }}';
        var saveSuccessLang = '{{ ('Item berhasil ditambahkan.') }}';
        var changesSavedSuccessfullyLang = '{{ ('Perubahan berhasil disimpan.') }}';
        var oopsLang = '{{ ('Oops...') }}';
        var somethingWentWrongLang = '{{ ('Ada yang salah...') }}';
        var notAccessToastTitleLang = '{{ ('Akses ditolak!') }}';
        var notAccessToastMsgLang = '{{ ('Anda tidak memiliki akses ke konten materi ini.') }}';
        var cantStartQuizToastTitleLang = '{{ ('Permintaan gagal') }}';
        var cantStartQuizToastMsgLang = '{{ ('Anda tidak dapat memulai kuis ini.') }}';
        var learningPageEmptyContentTitleLang = '{{ ('Tidak ada isi konten materi!') }}';
        var learningPageEmptyContentHintLang = '{{ ('Pelatihan ini tidak menyertakan konten materi apa pun') }}';
    </script>
    <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="v5gxvm7qj1ku9la"></script>
    <script src="{{ asset('') }}vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <script src="{{ asset('') }}assets/default/js/parts/video_player_helpers.min.js"></script>
    <script src="{{ asset('') }}assets/learning_page/scripts.min.js"></script>

    @if((!empty($isForumPage) and $isForumPage) or (!empty($isForumAnswersPage) and $isForumAnswersPage))
        <script src="{{ asset('') }}assets/learning_page/forum.min.js"></script>
    @endif
@endpush
