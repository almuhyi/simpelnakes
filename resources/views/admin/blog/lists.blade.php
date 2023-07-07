@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Blog</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Blog</div>
            </div>
        </div>

        <div class="section-body">

            <section class="card">
                <div class="card-body">
                    <form action="/admin/blog" method="get" class="mb-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="input-label">Cari</label>
                                    <input name="title" type="text" class="form-control" value="{{ request()->get('title') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal mulai</label>
                                    <div class="input-group">
                                        <input type="date" id="from" class="text-center form-control" name="from" value="{{ request()->get('from') }}" placeholder="Start Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Tanggal akhir</label>
                                    <div class="input-group">
                                        <input type="date" id="to" class="text-center form-control" name="to" value="{{ request()->get('to') }}" placeholder="End Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Kategori</label>
                                    <select name="category_id" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Semua kategori</option>

                                        @foreach($blogCategories as $category)
                                            <option value="{{ $category->id }}" @if(request()->get('category_id') == $category->id) selected="selected" @endif>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Penulis</label>
                                    <select name="author_id" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Semua penulis</option>

                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}" @if(request()->get('author_id') == $author->id) selected="selected" @endif>{{ $author->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="input-label">Status</label>
                                    <select name="status" data-plugin-selectTwo class="form-control populate">
                                        <option value="">Semua status</option>
                                        <option value="pending" @if(request()->get('status') == 'pending') selected @endif>Draft</option>
                                        <option value="publish" @if(request()->get('status') == 'publish') selected @endif>Publish</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
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
                        <div class="card-header">
                            @can('admin_blog_create')
                                <a href="/admin/blog/create" class="btn btn-success">posting blog baru</a>
                            @endcan

                            @can('admin_blog_categories')
                                <a href="/admin/blog/categories" class="btn btn-primary ml-2">Kategori baru</a>
                            @endcan
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Penulis</th>
                                        <th>Komentar</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @foreach($blog as $post)
                                        <tr>
                                            <td>
                                                <a href="{{ $post->getUrl() }}" target="_blank">{{ $post->title }}</a>
                                            </td>
                                            <td>{{ $post->category->title }}</td>
                                            @if(!empty($post->author->full_name))
                                            <td>{{ $post->author->full_name }}</td>
                                            @else
                                            <td class="text-danger">Deleted</td>
                                            @endif
                                            <td>
                                                <a href="{{ $post->getUrl() }}" target="_blank">{{ $post->comments_count }}</a>
                                            </td>
                                            <td>{{ dateTimeFormat($post->created_at, 'j M Y | H:i') }}</td>
                                            <td>
                                                <span class="text-{{ ($post->status == 'pending') ? 'warning' : 'success' }}">
                                                    {{ ($post->status == 'pending') ? 'Tertunda' : 'Dipublish' }}
                                                </span>
                                            </td>

                                            <td width="150px">
                                                @can('admin_blog_edit')
                                                    <a href="/admin/blog/{{ $post->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('admin_blog_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/blog/'.$post->id.'/delete','btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $blog->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

