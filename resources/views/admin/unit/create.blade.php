@extends('admin.layouts.app')

@push('styles_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Unit kerja baru</div>
            </div>
        </div>


        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('') }}/admin/unit/{{ !empty($unit) ? $unit->id.'/update' : 'store' }}"
                                  method="Post">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label>Unit kerja</label>
                                    <input type="text" name="nama"
                                           class="form-control  @error('nama') is-invalid @enderror"
                                           value="{{ !empty($unit) ? $unit->nama : old('nama') }}"/>
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
                                           value="{{ !empty($unit) ? $unit->singkatan : old('singkatan') }}"/>
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
                                           value="{{ !empty($unit) ? $unit->alamat : old('alamat') }}"/>
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
                                           value="{{ !empty($unit) ? $unit->telp : old('telp') }}"/>
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
    </section>
@endsection

@push('scripts_bottom')

@endpush
