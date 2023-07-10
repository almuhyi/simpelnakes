@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Grup pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Grup pengguna</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped font-14">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">Nama</th>
                                        <th>Pengguna</th>
                                        <th>Komisi</th>
                                        <th>Diskon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>

                                    @foreach($groups as $group)
                                        <tr>
                                            <td>{{ $group->id }}</td>
                                            <td class="text-left">
                                                <span>{{ $group->name }}</span>
                                            </td>
                                            <td>{{ $group->groupUsers->count() }}</td>
                                            <td>{{ $group->commission ?? 0 }}%</td>
                                            <td>{{ $group->discount ?? 0 }}%</td>
                                            <td>
                                                <span class="{{ $group->status == 'active' ? 'text-success' : 'text-danger' }}">{{ $group->status }}</span>
                                            </td>
                                            <td>
                                                @can('admin_group_edit')
                                                    <a href="{{ url('') }}/admin/users/groups/{{ $group->id }}/edit" class="btn-transparent text-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @endcan

                                                @can('admin_group_delete')
                                                    @include('admin.includes.delete_button',['url' => '/admin/users/groups/'. $group->id.'/delete','btnClass' => ''])
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $groups->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
