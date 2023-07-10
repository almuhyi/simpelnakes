@extends('admin.layouts.app')

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

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <form action="{{ url('/admin/enrollments/store') }}" method="Post">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label class="input-label">Pelatihan</label>
                                            <select name="webinar_id" class="form-control search-webinar-select2"
                                                    data-placeholder="Search classes">

                                            </select>

                                            @error('webinar_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="input-label d-block">Pengguna</label>
                                            <select name="user_id" class="form-control search-user-select2" data-placeholder="Cari pengguna">

                                            </select>
                                            @error('user_id')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class=" mt-4">
                                            <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

