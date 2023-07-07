@extends('web.default.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.css">
@endpush

@section('content')
    <div class="container mt-35 mt-md-50">
        <section class="d-flex align-items-center justify-content-between px-15 px-md-30 py-15 py-md-25 border rounded-lg">
            <div class="flex-grow-1">
                <h2 class="font-20 font-weight-bold text-secondary">{{ $topic->title }}</h2>
                <span class="d-block font-14 font-weight-500 text-gray mt-5">Oleh <span class="font-weight-bold">{{ $topic->creator->full_name }}</span> Pada {{ dateTimeFormat($topic->created_at, 'j M Y | H:i') }}</span>
                <div class="mt-15 ">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 m-0">
                            <li class="breadcrumb-item font-12 text-gray"><a href="{{ url('/') }}">{{ getGeneralSettings('site_name') }}</a></li>
                            <li class="breadcrumb-item font-12 text-gray"><a href="{{ url('/forums') }}">Forum</a></li>
                            <li class="breadcrumb-item font-12 text-gray"><a href="{{ url($topic->forum->getUrl()) }}">{{ $topic->forum->title }}</a></li>
                            <li class="breadcrumb-item font-12 text-gray font-weight-bold" aria-current="page">{{ $topic->title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <button type="button" data-action="{{ url($topic->getBookmarkUrl()) }}" class="{{ !empty($authUser) ? 'js-topic-bookmark' : 'login-to-access' }} d-flex align-items-center flex-column btn-transparent {{ $topic->bookmarked ? 'text-warning' : '' }}">
                <i data-feather="bookmark" class="text-gray" width="22" height="22"></i>
                <span class="font-12 mt-5 text-gray">Bookmark</span>
            </button>
        </section>

        @include('web.default.forum.post_card')

        {{-- Topic Posts --}}
        @if(!empty($topic->posts) and count($topic->posts))
            @foreach($topic->posts as $postRow)
                @include('web.default.forum.post_card',['post' => $postRow])
            @endforeach
        @endif

        {{-- Reply to Topic  --}}
        @if(!auth()->check())
            <div class="reply-login-close-card d-flex flex-column align-items-center w-100 p-15 rounded-lg border bg-white mt-15 p-40">
                <div class="icon-card">
                    <img src="{{ asset('') }}assets/default/img/topics/login.svg" alt="login icon" class="img-cover">
                </div>

                <h4 class="font-20 font-weight-bold text-secondary">Masuk untuk membalas</h4>
                <p class="font-14 font-weight-500 text-gray mt-5">Harap masuk untuk membalas topik ini.</p>
            </div>
        @elseif($topic->close or $forum->close)
            <div class="reply-login-close-card d-flex flex-column align-items-center w-100 p-15 rounded-lg border bg-white mt-15 p-40">
                <div class="icon-card">
                    <img src="{{ asset('') }}assets/default/img/topics/closed.svg" alt="closed icon" class="img-cover">
                </div>

                <h4 class="font-20 font-weight-bold text-secondary">Topik tertutup</h4>
                <p class="font-14 font-weight-500 text-gray mt-5">Anda tidak dapat membalas topik tertutup</p>
            </div>
        @else
            <div class="mt-30">
                <h3 class="font-16 font-weight-bold text-secondary">Balas ke topik</h3>
                <div class="p-15 rounded-lg border bg-white mt-15">
                    <form action="{{ url($topic->getPostsUrl()) }}" method="post">
                        {{ csrf_field() }}

                        <div class="topic-posts-reply-card d-none position-relative px-20 py-15 rounded-sm bg-info-light mb-15">
                            <input type="hidden" name="reply_post_id" class="js-reply-post-id">
                            <div class="js-reply-post-title font-14 font-weight-500 text-gray">Anda membalas kepada <span></span></div>
                            <div class="js-reply-post-description mt-5 font-14 text-gray"></div>

                            <button type="button" class="js-close-reply-post btn-transparent">
                                <i data-feather="x" width="22" height="22"></i>
                            </button>
                        </div>


                        <div class="form-group">
                            <label class="input-label">Deskripsi</label>
                            <textarea id="summernote" name="description" class="form-control"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">

                                <div class="form-group">
                                    <label class="input-label">Lampirkan file (Opsional)</label>

                                    <div class="d-flex align-items-center">
                                        <div class="input-group mr-10">
                                            <div class="input-group-prepend">
                                                <button type="button" class="input-group-text panel-file-manager" data-input="postAttachmentInput" data-preview="holder">
                                                    <i data-feather="upload" width="18" height="18" class="text-white"></i>
                                                </button>
                                            </div>
                                            <input type="text" name="attach" id="postAttachmentInput" value="" class="form-control" placeholder="Pilih lampiran"/>
                                        </div>

                                        <button type="button" class="js-save-post btn btn-primary btn-sm">Kirim</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>


    <div id="topicReportModal" class="d-none">
        <h3 class="section-title after-line font-20 text-dark-blue">Laporkan</h3>

        <form action="{{ url($topic->getPostsUrl()) }}/report" method="post" class="mt-25">
            <input type="hidden" name="item_id" class="js-item-id-input"/>
            <input type="hidden" name="item_type" class="js-item-type-input"/>

            <div class="form-group">
                <label class="text-dark-blue font-14" for="message_to_reviewer">Pesan untuk pengulas</label>
                <textarea name="message" id="message_to_reviewer" class="form-control" rows="10"></textarea>
                <div class="invalid-feedback"></div>
            </div>
            <p class="text-gray font-16">Tolong jelaskan tentang laporan secara singkat dan jelas.</p>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button" class="js-topic-report-submit btn btn-sm btn-primary">Laporkan</button>
                <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">Tutup</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts_bottom')
    <script>
        var replyToTopicSuccessfullySubmittedLang = '{{ ('Balas ke topik berhasil dikirimkan') }}'
        var reportSuccessfullySubmittedLang = '{{ ('Laporan berhasil dikirim') }}';
        var changesSavedSuccessfullyLang = '{{ ('Perubahan berhasil disimpan.') }}';
        var oopsLang = '{{ ('oopsss.....') }}';
        var somethingWentWrongLang = '{{ ('Ada yang salah...') }}';
        var reportLang = '{{ ('Laporkan') }}';
        var descriptionLang = '{{ ('Deksripsi') }}';
        var editAttachmentLabelLang = '{{ ('Lampirkan file') }} ({{ ('Opsional') }})';
        var sendLang = '{{ ('Kirim') }}';
        var notLoginToastTitleLang = '{{ ('Materi yang Dibatasi') }}';
        var notLoginToastMsgLang = '{{ ('Silahkan masuk untuk mengakses materi.') }}';
        var topicBookmarkedSuccessfullyLang = '{{ ('Topik berhasil di-bookmark') }}';
        var topicUnBookmarkedSuccessfullyLang = '{{ ('Topik dihapus dari bookmark') }}';
        var editPostLang = '{{ ('Edit post') }}';
    </script>

    <script src="{{ asset('') }}assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="{{ asset('') }}vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('') }}assets/default/js/parts/topic_posts.min.js"></script>
@endpush
