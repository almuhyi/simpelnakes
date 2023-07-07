@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle}}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            @can('admin_advertising_banners_create')
                                <a href="/admin/advertising/banners/new" class="btn btn-primary">Banner baru</a>
                            @endcan
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>Judul</th>
                                        <th class="text-center">Posisi</th>
                                        <th class="text-center">Ukuran banner</th>
                                        <th class="text-center">Dipublish</th>
                                        <th class="text-center">Tanggal dibuay</th>
                                        <th>Aksi</th>
                                    </tr>

                                    @foreach($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->title }}</td>
                                            <td class="text-center">{{ $banner->position }}</td>
                                            <td class="text-center">{{ \App\Models\AdvertisingBanner::$size[$banner->size] }}</td>
                                            <td class="text-center">
                                                @if($banner->published)
                                                    <span class="text-success fas fa-check"></span>
                                                @else
                                                    <span class="text-danger fas fa-times"></span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ dateTimeFormat($banner->created_at, 'Y M j | H:i') }}</td>
                                            <td>
                                                @can('admin_advertising_banners_edit')
                                                    <a href="/admin/advertising/banners/{{ $banner->id }}/edit" class="btn-sm btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_advertising_banners_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/advertising/banners/'. $banner->id.'/delete','btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $banners->appends(request()->input())->links('vendor.pagination.bootstrap-4')  }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
