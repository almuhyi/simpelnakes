@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.css">
@endpush

@section('content')

    <section>
        <h2 class="section-title">Filter komentar</h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="" method="get" class="row">
                <div class="col-12 col-lg-5">
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
                                    <input type="text" name="from" autocomplete="off" value="{{ request()->get('from') }}" class="form-control {{ !empty(request()->get('from')) ? 'datepicker' : 'datefilter' }}" aria-describedby="dateInputGroupPrepend"/>
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
                                    <input type="text" name="to" autocomplete="off" value="{{ request()->get('to') }}" class="form-control {{ !empty(request()->get('to')) ? 'datepicker' : 'datefilter' }}" aria-describedby="dateInputGroupPrepend"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="form-group">
                        <label class="input-label">Pelatihan</label>
                        <input type="text" name="webinar" value="{{ request()->get('webinar') }}" class="form-control"/>
                    </div>
                </div>
                <div class="col-12 col-lg-2 d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary w-100 mt-2">Lihat hasil</button>
                </div>
            </form>
        </div>
    </section>

    <section class="mt-35">
        <h2 class="section-title">Komentar saya</h2>

        @if(!empty($comments) and !$comments->isEmpty())

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table custom-table text-center ">
                                <thead>
                                <tr>
                                    <th class="text-left text-gray">Pelatihan</th>
                                    <th class="text-gray text-center">Komentar</th>
                                    <th class="text-gray text-center">Status</th>
                                    <th class="text-gray text-center">Tanggal</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($comments as $comment)
                                    <tr>
                                        <td class="text-left align-middle" width="35%">
                                            <a class="text-dark-blue font-weight-500" href="{{ url($comment->webinar->getUrl()) }}" target="_blank">{{ $comment->webinar->title }}</a>
                                        </td>
                                        <td class="align-middle">
                                            <button type="button" data-comment-id="{{ $comment->id }}" class="js-view-comment btn btn-sm btn-gray200">Lihat</button>
                                        </td>

                                        <td class="align-middle">
                                            @if($comment->status == 'active')
                                                <span class="text-primary text-dark-blue font-weight-500">Publish</span>
                                            @else
                                                <span class="text-warning text-dark-blue font-weight-500">Tertunda</span>
                                            @endif
                                        </td>

                                        <td class="text-dark-blue font-weight-500 align-middle">{{ dateTimeFormat($comment->created_at,'j M Y | H:i') }}</td>
                                        <td class="align-middle text-right">
                                            <input type="hidden" id="commentDescription{{ $comment->id }}" value="{!! nl2br($comment->comment) !!}">
                                            <div class="btn-group dropdown table-actions">
                                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" height="20"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button type="button" data-comment-id="{{ $comment->id }}" class="js-edit-comment btn-transparent">Edit</button>
                                                    <a href="{{ url('') }}/panel/webinars/comments/{{ $comment->id }}/delete" class="delete-action btn-transparent d-block mt-10">Hapus</a>
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
                'file_name' => 'comment.png',
                'title' => ('Anda tidak membuat komentar apa pun!'),
                'hint' =>  nl2br('Komentar Anda akan membantu meningkatkan kualitas pelatihan...') ,
            ])

        @endif
    </section>

    <div class="my-30">
        {{ $comments->appends(request()->input())->links('vendor.pagination.panel') }}
    </div>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/moment.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var commentLang = '{{ ('Komentar') }}';
        var replyToCommentLang = '{{ ('Balas komentar') }}';
        var editCommentLang = '{{ ('Edit komentar') }}';
        var saveLang = '{{ ('Simpan') }}';
        var closeLang = '{{ ('Tutup') }}';
        var failedLang = '{{ ('Gagal') }}';
    </script>
    <script src="{{ asset('') }}assets/default/js/panel/comments.min.js"></script>
@endpush
