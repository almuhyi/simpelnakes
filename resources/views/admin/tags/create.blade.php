@extends('admin.layouts.app')

@push('libraries_top')


@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{!empty($tag) ?'Edit': 'Baru' }} Tag</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active"><a href="{{ url('/admin/tags') }}">Tag</a>
                </div>
                <div
                    class="breadcrumb-item">{{!empty($tag) ?'Edit': 'Baru' }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('') }}/admin/tags/{{ !empty($tag) ? $tag->id.'/update' : 'store' }}"
                                  method="Post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" name="title"
                                           class="form-control  @error('title') is-invalid @enderror"
                                           value="{{ !empty($tag) ? $tag->title : old('title') }}"
                                           placeholder="Tag akan ditampilkan di halaman pelatihan"/>
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class=" mt-4">
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
