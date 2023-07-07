@extends('web.default.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.css">
@endpush

@section('content')
    <section class="mt-25">
        <h2 class="section-title">Filter komentar</h2>

        <div class="panel-section-card py-20 px-25 mt-20">
            <form action="{{ url('/panel/blog/comments') }}" method="get" class="row">
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
                <div class="col-12 col-lg-4">
                    <div class="form-group">
                        <label class="input-label">Postingan</label>
                        <select name="blog_id" class="form-control select2" data-placeholder="Pilih postingan">
                            <option {{ empty($selectedPost) ? 'selected' : '' }} value="">Semua</option>

                            @foreach($posts as $post)
                                <option value="{{ $post->id }}" {{ (!empty($selectedPost) and $selectedPost->id == $post->id) ? 'selected' : '' }}>{{ $post->title }}</option>
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
            <h2 class="section-title">Daftar komentar artikel</h2>
        </div>

        @if(!empty($comments) and !$comments->isEmpty())

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table custom-table text-center ">
                                <thead>
                                <tr>
                                    <th class="text-left">User</th>
                                    <th class="text-left">Postingan</th>
                                    <th class="text-center">Komentar</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($comments as $comment)
                                    <tr>
                                        <th class="text-left">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200">
                                                    <img src="{{ asset($comment->user->getAvatar()) }}" class="img-cover" alt="">
                                                </div>
                                                <span class="user-name ml-5 text-dark-blue font-weight-500">{{ $comment->user->full_name }}</span>
                                            </div>
                                        </th>
                                        <td class=" text-left align-middle" width="35%">
                                            <a href="{{ url($comment->blog->getUrl()) }}" target="_blank" class="text-dark-blue font-weight-500">{{ $comment->blog->title }}</a>
                                        </td>
                                        <td class="align-middle">
                                            <input type="hidden" id="commentDescription{{ $comment->id }}" value="{!! nl2br($comment->comment) !!}">
                                            <button type="button" data-comment-id="{{ $comment->id }}" class="js-view-comment btn btn-sm btn-gray200">Lihat</button>
                                        </td>
                                        <td class="align-middle">
                                            @if($comment->status == 'active')
                                                <span class="text-primary font-weight-500">Aktif</span>
                                            @else
                                                <span class="text-dark-blue font-weight-500">Tertunda</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ dateTimeFormat($comment->created_at,'j M Y | H:i') }}</td>
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
                'title' => ('Anda tidak punya komentar!'),
                'hint' =>  nl2br(('Ketika seorang peserta / user mengomentari pelatihan dan artikel Anda
                itu akan muncul dalam daftar ini.')) ,
            ])
        @endif
    </section>

    <div class="my-30">
        {{ $comments->appends(request()->input())->links('vendor.pagination.panel') }}
    </div>

@endsection

@push('scripts_bottom')
    <script>
        var commentLang = '{{ ('Komentar') }}';
    </script>

    <script src="{{ asset('') }}assets/default/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('') }}assets/default/js/panel/blog_comments.min.js"></script>
@endpush
