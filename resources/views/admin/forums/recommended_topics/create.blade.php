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
                                    <form action="{{ url('') }}/admin/recommended-topics/{{ !empty($recommended) ? $recommended->id.'/update' : 'store'  }}" method="post">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label class="input-label">Judul</label>
                                            <input type="text" name="title" id="title" value="{{ (!empty($recommended)) ? $recommended->title : old('title') }}" class="form-control @error('title') is-invalid @enderror"/>
                                            @error('title')
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
                                                <input type="text" name="icon" id="icon" value="{{ (!empty($recommended)) ? $recommended->icon : old('icon') }}" class="form-control @error('icon') is-invalid @enderror"/>
                                                @error('icon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="input-label d-block">Topik</label>
                                            <select name="topic_ids[]" multiple="multiple" class="form-control search-forum-topic-select2 @error('topic_id') is-invalid @enderror" data-placeholder="Cari topik">
                                                @if(!empty($recommended) and !empty($recommended->topics) and count($recommended->topics))
                                                    @foreach($recommended->topics as $topic)
                                                        <option value="{{ $topic->id }}" selected>{{ $topic->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            @error('topic_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
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
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Topik yang Direkomendasikan</div>
                        <div class=" text-small font-600-bold mb-2">
                            Anda dapat menetapkan beberapa topik untuk setiap "Topik yang Direkomendasikan".</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="media-body">
                        <div class="text-primary mt-0 mb-1 font-weight-bold">Posisi Tampilan</div>
                        <div class=" text-small font-600-bold mb-2">Anda dapat menetapkan beberapa topik untuk setiap "Topik yang Direkomendasikan".</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts_bottom')

@endpush
