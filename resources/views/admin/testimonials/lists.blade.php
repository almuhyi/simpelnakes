@extends('admin.layouts.app')

@push('libraries_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Testimoni</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Testimoni</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            @can('admin_testimonials_create')
                                <a href="{{ url('/admin/testimonials/create') }}" class="btn btn-primary">Tambah baru</a>
                            @endcan
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Rating</th>
                                        <th class="text-center">Isi</th>
                                        <th class="text-center">Status</th>
                                        <th>Tanggal dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @foreach($testimonials as $testimonial)
                                        <tr>
                                            <td>
                                                <img src="{{ $testimonial->user_avatar }}" alt="" width="56" height="56" class="rounded-circle">
                                            </td>
                                            <td>{{ $testimonial->user_name }}</td>
                                            <td>{{ $testimonial->rate }}</td>
                                            <td class="text-center" width="30%">{!! truncate($testimonial->comment, 150, true) !!}</td>

                                            <td class="text-center">
                                                @if($testimonial->status == 'active')
                                                    <span class="text-success">Aktif</span>
                                                @else
                                                    <span class="text-warning">Tidak aktif</span>
                                                @endif
                                            </td>
                                            <td>{{ dateTimeFormat($testimonial->created_at, 'j M Y | H:i') }}</td>
                                            <td width="150px">

                                                @can('admin_supports_reply')
                                                    <a href="{{ url('') }}/admin/testimonials/{{ $testimonial->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_supports_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/testimonials/'.$testimonial->id.'/delete' , 'btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $testimonials->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
