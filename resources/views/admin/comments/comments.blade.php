@extends('admin.layouts.app')


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Komentar</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-comment"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total komentar</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalComments }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-eye"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>
                                Komentar Dipublish</h4>
                        </div>
                        <div class="card-body">
                            {{ $publishedComments }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-hourglass-start"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>
                                Komentar Tertunda</h4>
                        </div>
                        <div class="card-body">
                            {{ $pendingComments }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-flag"></i></div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Laporan Komentar</h4>
                        </div>
                        <div class="card-body">
                            {{ $commentReports }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">

            <section class="card">
                <div class="card-body">
                    <form method="get" class="mb-0">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input type="text" class="form-control" name="title" value="{{ request()->get('title') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" id="fsdate" class="text-center form-control" name="date" value="{{ request()->get('date') }}" placeholder="Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">Status</label>
                                    <select name="status" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Semua status</option>
                                        <option value="pending" @if(request()->get('status') == 'pending') selected @endif>Tertunda</option>
                                        <option value="active" @if(request()->get('status') == 'active') selected @endif>Dipublish</option>
                                    </select>
                                </div>
                            </div>

                            @if($page == 'webinars')
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">Pelatihan</label>
                                        <select name="webinar_ids[]" multiple="multiple" class="form-control search-webinar-select2 " data-placeholder="Cari pelatihan">

                                            @if(!empty($webinars) and $webinars->count() > 0)
                                                @foreach($webinars as $webinar)
                                                    <option value="{{ $webinar->id }}" selected>{{ $webinar->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @elseif($page == 'blog')
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="input-label">Blog</label>
                                        <select name="post_ids[]" multiple="multiple" class="form-control search-blog-select2 " data-placeholder="Cari blog">

                                            @if(!empty($products) and $blog->count() > 0)
                                                @foreach($blog as $post)
                                                    <option value="{{ $post->id }}" selected>{{ $post->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="input-label">Pengguna</label>
                                    <select name="user_ids[]" multiple="multiple" class="form-control search-user-select2"
                                            data-placeholder="Cari pengguna">

                                        @if(!empty($users) and $users->count() > 0)
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" selected>{{ $user->full_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mt-1">
                                    <label class="input-label mb-4"> </label>
                                    <input type="submit" class="text-center btn btn-primary w-100" value="Lihat hasil">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </section>


            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14" id="dataTable" width="100%" cellspacing="0">
                                    <tr>
                                        <th>Komentar</th>
                                        <th>
                                            Tanggal Dibuat</th>
                                        <th class="text-left">Pengguna</th>
                                        @if($page == 'webinars')
                                            <th class="text-left">Pelatihan</th>
                                        @elseif($page == 'blog')
                                            <th class="text-left">Blog</th>
                                        @endif
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th width="150">Aksi</th>
                                    </tr>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>
                                                <button type="button" class="js-show-description btn btn-outline-primary">Lihat</button>
                                                <input type="hidden" value="{!! nl2br($comment->comment) !!}">
                                            </td>
                                            <td>{{ dateTimeFormat($comment->created_at, 'j M Y | H:i') }}</td>
                                            <td class="text-left">
                                                <a href="{{ url($comment->user->getProfileUrl()) }}" target="_blank" class="">{{ $comment->user->full_name }}</a>
                                            </td>

                                            <td class="text-left">
                                                <a href="{{ url($comment->$itemRelation->getUrl()) }}" target="_blank">
                                                    {{ $comment->$itemRelation->title }}
                                                </a>
                                            </td>

                                            <td>
                                                <span>
                                                    {{ (empty($comment->reply_id)) ? 'Komentar Utama' : 'Balasan' }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="text-{{ ($comment->status == 'pending') ? 'warning' : 'success' }}">
                                                    {{ ($comment->status == 'pending') ? 'Tertunda' : 'Dipublish' }}
                                                </span>
                                            </td>

                                            <td width="150px" class="text-center">

                                                @can('admin_'. $itemRelation .'_comments_status')
                                                    <a href="{{ url('') }}/admin/comments/{{ $page }}/{{ $comment->id }}/toggle" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="{{ (($comment->status == 'pending') ? 'publish' : 'pending') }}">
                                                        @if($comment->status == 'pending')
                                                            <i class="fa fa-eye"></i>
                                                        @else
                                                            <i class="fa fa-eye-slash"></i>
                                                        @endif
                                                    </a>
                                                @endcan

                                                @can('admin_'. $itemRelation .'_comments_reply')
                                                    <a href="{{ url('') }}/admin/comments/{{ $page }}/{{ !empty($comment->reply_id) ? $comment->reply_id : $comment->id }}/reply" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Balas">
                                                        <i class="fa fa-reply"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_'. $itemRelation .'_comments_edit')
                                                    <a href="{{ url('') }}/admin/comments/{{ $page }}/{{ $comment->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_'. $itemRelation .'_comments_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/comments/'. $page .'/'.$comment->id.'/delete','btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $comments->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="contactMessage" tabindex="-1" aria-labelledby="contactMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactMessageLabel">Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/js/admin/comments.min.js"></script>
@endpush
