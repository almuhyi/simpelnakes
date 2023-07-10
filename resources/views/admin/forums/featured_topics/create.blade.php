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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <form action="{{ url('') }}/admin/featured-topics/{{ !empty($feature) ? $feature->id.'/update' : 'store'  }}" method="post">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label class="input-label d-block">Topik</label>
                                            <select name="topic_id" class="form-control search-forum-topic-select2 @error('topic_id') is-invalid @enderror" data-placeholder="Cari topik">
                                                @if(!empty($feature))
                                                    <option value="{{ $feature->topic->id }}">{{ $feature->topic->title }}</option>
                                                @endif
                                            </select>

                                            @error('topic_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="input-label">Icon</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="input-group-text admin-file-manager" data-input="icon" data-preview="holder">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="icon" id="icon" value="{{ (!empty($feature)) ? $feature->icon : old('icon') }}" class="form-control"/>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="card">
        <div class="card-body">
            <div class="section-title ml-0 mt-0 mb-3"><h5>Petunjuk</h5></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Topik Unggulan</div>
                        <div class=" text-small font-600-bold mb-2">Topik unggulan akan ditampilkan berbeda dari topik normal untuk mendapatkan lebih banyak penayangan dan lalu lintas.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Posisi Tampilan</div>
                        <div class=" text-small font-600-bold mb-2">
                            Topik unggulan akan ditampilkan di beranda forum.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts_bottom')

@endpush
