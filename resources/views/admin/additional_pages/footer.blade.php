@extends('admin.layouts.app')

@php
    $columns = ['first_column','second_column','third_column','forth_column']
@endphp

@push('styles_top')
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Footer</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a></div>
                <div class="breadcrumb-item">Footer</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                @foreach($columns as $column)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $loop->iteration == 1 ? 'active' : '' }}" id="{{ $column }}-tab" data-toggle="tab" href="#{{ $column }}" role="tab" aria-controls="{{ $column }}" aria-selected="true">{{ $column }}</a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content" id="myTabContent2">
                                @foreach($columns as $column)
                                    <div class="tab-pane mt-3 fade {{ $loop->iteration == 1 ? 'show active' : '' }}" id="{{ $column }}" role="tabpanel" aria-labelledby="{{ $column }}-tab">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <form action="/admin/additional_page/footer/store" method="post">
                                                    {{ csrf_field() }}

                                                    @if(!empty(getGeneralSettings('content_translate')))
                                                        <div class="form-group">
                                                            <label class="input-label">Bahasa</label>
                                                            <select name="locale" class="form-control js-edit-content-locale">
                                                                @foreach($userLanguages as $lang => $language)
                                                                    <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale', $selectedLocal)) == mb_strtolower($lang)) selected @endif>{{ $language }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('locale')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    @else
                                                        <input type="hidden" name="locale" value="{{ getDefaultLocale() }}">
                                                    @endif

                                                    <div class="form-group">
                                                        <label>Judul</label>
                                                        <input type="text" name="value[{{ $column }}][title]" value="{{ (!empty($value) and !empty($value[$column]) and !empty($value[$column]['title'])) ? $value[$column]['title'] : old('title') }}" class="form-control "/>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Isi</label>
                                                        <textarea type="text" name="value[{{ $column }}][value]" class="summernote form-control">{{ (!empty($value) and !empty($value[$column]) and !empty($value[$column]['value'])) ? $value[$column]['value'] : old('value') }}</textarea>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
@endpush
