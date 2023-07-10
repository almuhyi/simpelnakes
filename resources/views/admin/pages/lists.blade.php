@extends('admin.layouts.app')

@push('libraries_top')

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
                        <div class="card-header">
                            @can('admin_pages_create')
                                <a href="{{ url('/admin/pages/create') }}" class="btn btn-primary">Tambah baru</a>
                            @endcan
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>Nama</th>
                                        <th>URL</th>
                                        <th class="text-center">Akses Robot SEO</th>
                                        <th class="text-center">Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @foreach($pages as $page)
                                        <tr>
                                            <td>{{ $page->name }}</td>
                                            <td>{{ $page->link }}</td>
                                            <td class="text-center">
                                                @if($page->robot)
                                                    <span class="text-success">Mengikuti</span>
                                                @else
                                                    <span class="text-danger">Tidak mengikuti</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if($page->status == 'publish')
                                                    <span class="text-success">Publish</span>
                                                @else
                                                    <span class="text-warning">Draft</span>
                                                @endif
                                            </td>
                                            <td>{{ dateTimeFormat($page->created_at, 'j M Y | H:i') }}</td>
                                            <td width="150px">

                                                @can('admin_pages_edit')
                                                    <a href="{{ url('') }}/admin/pages/{{ $page->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_pages_toggle')
                                                    <a href="{{ url('') }}/admin/pages/{{ $page->id }}/toggle" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="{{ ($page->status == 'draft') ? 'Publish' : 'Draft' }}">
                                                        @if($page->status == 'draft')
                                                            <i class="fa fa-arrow-up"></i>
                                                        @else
                                                            <i class="fa fa-arrow-down"></i>
                                                        @endif
                                                    </a>
                                                @endcan

                                                @can('admin_pages_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/pages/'.$page->id.'/delete' , 'btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $pages->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

