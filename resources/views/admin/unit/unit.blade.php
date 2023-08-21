@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Unit kerja</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Unit kerja</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body col-12">
                    <div class="tabs">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#list" data-toggle="tab">Unit kerja </a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#newitem" data-toggle="tab">tambah unit kerja</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="list" class="tab-pane active">
                                <div class="table-responsive">
                                    <table class="table table-striped font-14">

                                        <tr>
                                            <th>Unit kerja</th>
                                            <th>Singkatan</th>
                                            <th>Alamat</th>
                                            <th class="text-center" width="200">Telepon</th>
                                            <th class="text-center" width="200">Jumlah nakes</th>
                                            <th class="text-center" width="100">Aksi</th>
                                        </tr>

                                        @foreach ($units as $unit)
                                            <tr>
                                                <td>
                                                    <span>{{ $unit->nama }}</span>
                                                </td>

                                                <td>
                                                    <span>{{ $unit->singkatan }}</span>
                                                </td>

                                                <td>
                                                    <span>{{ $unit->alamat }}</span>
                                                </td>

                                                <td>
                                                    <span>{{ $unit->telp }}</span>
                                                </td>

                                                <td>{{ $unit->user_count }}</td>

                                                <td class="text-center">
                                                    @can('admin_unit_edit')
                                                        <a href="{{ url('') }}/admin/unit/{{ $unit->id }}/edit"
                                                            class="btn-transparent text-primary" data-toggle="tooltip"
                                                            data-placement="top" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan

                                                    @can('admin_unit_delete')
                                                        @include('admin.includes.delete_button', [
                                                            'url' =>
                                                                '/admin/unit/' .
                                                                $unit->id .
                                                                '/delete',
                                                            'btnClass' => '',
                                                        ])
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>
                                </div>

                                <div class="text-center mt-2">
                                    {{ $units->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}
                                </div>
                            </div>

                            <div id="newitem" class="tab-pane ">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <form action="{{ url('/admin/unit/store') }}" method="Post">
                                            {{ csrf_field() }}


                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama"
                                                    class="form-control  @error('nama') is-invalid @enderror"
                                                    value="{{ old('nama') }}" />
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Singkatan</label>
                                                <input type="text" name="singkatan"
                                                    class="form-control  @error('singkatan') is-invalid @enderror"
                                                    value="{{ old('singkatan') }}" />
                                                @error('singkatan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" name="alamat"
                                                    class="form-control  @error('alamat') is-invalid @enderror"
                                                    value="{{ old('alamat') }}" />
                                                @error('alamat')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label>Telp</label>
                                                <input type="text" name="telp"
                                                    class="form-control  @error('telp') is-invalid @enderror"
                                                    value="{{ old('telp') }}" />
                                                @error('telp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="text-right mt-4">
                                                <button class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
@endpush
