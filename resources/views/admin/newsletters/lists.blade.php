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
                @can('admin_users_export_excel')
                    <a href="{{ url('/admin/newsletters/excel') }}" class="btn btn-primary">Export excel</a>
                @endcan
                <div class="h-10"></div>
            </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>Email</th>
                                        <th>Tanggal dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @foreach($newsletters as $newsletter)
                                        <tr>
                                            <td>{{$newsletter->email}}</td>
                                            <td>{{ dateTimeFormat($newsletter->created_at,'Y-m-d') }}</td>

                                            <td>
                                                @can('admin_newsletters_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/newsletters/'.$newsletter->id.'/delete' , 'btnClass' => 'btn-sm'])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $newsletters->appends(request()->input())->links('vendor.pagination.bootstrap-4')  }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

