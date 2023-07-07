@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Paket baru</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Paket SaaS</div>
            </div>
        </div>


        <div class="section-body card">

            <div class="d-flex align-items-center justify-content-between">
                <div class="">
                    <h2 class="section-title ml-4">{{ !empty($package) ? 'Edit' : 'Baru' }}</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card-body">
                        <form action="/admin/financial/registration-packages/{{ !empty($package) ? $package->id.'/update' : 'store' }}" method="Post">
                            {{ csrf_field() }}

                            @if(!empty(getGeneralSettings('content_translate')))
                                <div class="form-group">
                                    <label class="input-label">Bahasa</label>
                                    <select name="locale" class="form-control {{ !empty($package) ? 'js-edit-content-locale' : '' }}">
                                        @foreach($userLanguages as $lang => $language)
                                            <option value="{{ $lang }}" @if(mb_strtolower(request()->get('locale', app()->getLocale())) == mb_strtolower($lang)) selected @endif>{{ $language }}</option>
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
                                <input type="text" name="title"
                                       class="form-control  @error('title') is-invalid @enderror"
                                       value="{{ !empty($package) ? $package->title : old('title') }}"/>
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" name="description"
                                       class="form-control @error('description') is-invalid @enderror"
                                       value="{{ !empty($package) ? $package->description : old('description') }}"
                                       placeholder="Misalnya disarankan untuk profesional"
                                />
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Hari</label>
                                <input type="text" name="days"
                                       class="form-control  @error('days') is-invalid @enderror"
                                       value="{{ !empty($package) ? $package->days : old('days') }}"/>
                                @error('days')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="price"
                                       class="form-control  @error('price') is-invalid @enderror"
                                       value="{{ !empty($package) ? $package->price : old('price') }}"/>
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group mt-15">
                                <label class="input-label">Icon</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="input-group-text admin-file-manager" data-input="icon" data-preview="holder">
                                            <i class="fa fa-chevron-up"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="icon" id="icon" value="{{ !empty($package->icon) ? $package->icon : old('icon') }}" class="form-control @error('icon') is-invalid @enderror"/>
                                    @error('icon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="input-group-append">
                                        <button type="button" class="input-group-text admin-file-view" data-input="icon">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="">Semua role</option>
                                    <option value="instructors" {{ ((!empty($package) and $package->role == 'instructors') or old('role') == 'instructors') ? 'selected' : '' }}>Instruktur</option>
                                    <option value="organizations" {{ ((!empty($package) and $package->role == 'organizations') or old('role') == 'organizations') ? 'selected' : '' }}>Organisasi</option>
                                </select>
                                @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group js-organization-inputs {{ ((!empty($package) and $package->role == 'organizations') or old('role') == 'organizations') ? '' : 'd-none' }}">
                                <label>Jumlah instruktur</label>
                                <input type="text" name="instructors_count"
                                       class="form-control  @error('instructors_count') is-invalid @enderror"
                                       value="{{ !empty($package) ? $package->instructors_count : old('instructors_count') }}"/>
                                @error('instructors_count')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group js-organization-inputs {{ ((!empty($package) and $package->role == 'organizations') or old('role') == 'organizations') ? '' : 'd-none' }}">
                                <label>Jumlah peserta</label>
                                <input type="text" name="students_count"
                                       class="form-control  @error('students_count') is-invalid @enderror"
                                       value="{{ !empty($package) ? $package->students_count : old('students_count') }}"/>
                                @error('students_count')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group js-organization-inputs js-instructor-inputs {{ ((!empty($package) and in_array($package->role, ['instructors', 'organizations'])) or in_array(old('role'), ['instructors', 'organizations'])) ? '' : 'd-none' }}">
                                <label>Jumlah kelas webinar</label>
                                <input type="text" name="courses_capacity"
                                       class="form-control  @error('courses_capacity') is-invalid @enderror"
                                       value="{{ !empty($package) ? $package->courses_capacity : old('courses_capacity') }}"/>
                                @error('courses_capacity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group js-organization-inputs js-instructor-inputs {{ ((!empty($package) and in_array($package->role, ['instructors', 'organizations'])) or in_array(old('role'), ['instructors', 'organizations'])) ? '' : 'd-none' }}">
                                <label>Jumlah pelatihan</label>
                                <input type="text" name="courses_count"
                                       class="form-control  @error('courses_count') is-invalid @enderror"
                                       value="{{ !empty($package) ? $package->courses_count : old('courses_count') }}"/>
                                @error('courses_count')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group js-organization-inputs js-instructor-inputs {{ ((!empty($package) and in_array($package->role, ['instructors', 'organizations'])) or in_array(old('role'), ['instructors', 'organizations'])) ? '' : 'd-none' }}">
                                <label>Slot waktu pertemuan</label>
                                <input type="text" name="meeting_count"
                                       class="form-control  @error('meeting_count') is-invalid @enderror"
                                       value="{{ !empty($package) ? $package->meeting_count : old('meeting_count') }}"/>
                                @error('meeting_count')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            {{-- <div class="form-group js-organization-inputs js-instructor-inputs {{ ((!empty($package) and in_array($package->role, ['instructors', 'organizations'])) or in_array(old('role'), ['instructors', 'organizations'])) ? '' : 'd-none' }}">
                                <label>{{ trans('update.product_count') }}</label>
                                <input type="text" name="product_count"
                                       class="form-control  @error('product_count') is-invalid @enderror"
                                       value="{{ !empty($package) ? $package->product_count : old('product_count') }}"/>
                                @error('product_count')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> --}}

                            <div class="form-group custom-switches-stacked">
                                <label class="custom-switch pl-0">
                                    <input type="hidden" name="status" value="disabled">
                                    <input type="checkbox" name="status" id="statusSwitch" value="active" {{ (!empty($package) and $package->status == 'active') ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description mb-0 cursor-pointer" for="statusSwitch">Status</label>
                                </label>
                            </div>

                            <div class=" mt-4">
                                <button class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

    <script src="/assets/default/js/admin/new_registration_packages.min.js"></script>
@endpush

