@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kontak kami</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Kontak kami</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ url('/admin/additional_page/contact_us') }}" method="post">
                                {{ csrf_field() }}

                                <div class="row">

                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="input-label">
                                                Latar Belakang Halaman Kontak</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button type="button" class="input-group-text admin-file-manager" data-input="background_record" data-preview="holder">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="value[background]" id="background_record" value="{{ (!empty($value) and !empty($value['background'])) ? $value['background'] : '' }}" class="form-control"/>
                                            </div>
                                        </div>

                                        {{-- <div class="form-group">
                                            <label class="input-label">{{ trans('admin/main.map_position') }}</label>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" name="value[latitude]" value="{{ (!empty($value) and !empty($value['latitude'])) ? $value['latitude'] : '' }}" class="form-control" placeholder="{{ trans('admin/main.map_position_latitude') }}"/>
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="value[longitude]" value="{{ (!empty($value) and !empty($value['longitude'])) ? $value['longitude'] : '' }}" class="form-control" placeholder="{{ trans('admin/main.map_position_longitude') }}"/>
                                                </div>
                                            </div>
                                        </div> --}}


                                        {{-- <div class="form-group">
                                            <label class="input-label">{{ trans('admin/main.map_zoom') }}</label>
                                            <input type="text" name="value[map_zoom]" value="{{ (!empty($value) and !empty($value['map_zoom'])) ? $value['map_zoom'] : '' }}" class="form-control" placeholder="{{ trans('admin/main.map_zoom') }}"/>
                                        </div> --}}

                                        <div class="form-group">
                                            <label class="input-label">No HP</label>
                                            <input type="text" name="value[phones]" value="{{ (!empty($value) and !empty($value['phones'])) ? $value['phones'] : '' }}" class="form-control" placeholder="No HP"/>
                                        </div>

                                        <div class="form-group">
                                            <label class="input-label">Email</label>
                                            <input type="text" name="value[emails]" value="{{ (!empty($value) and !empty($value['emails'])) ? $value['emails'] : '' }}" class="form-control" placeholder="Email"/>
                                        </div>

                                        <div class="form-group">
                                            <label class="input-label">Alamat</label>
                                            <textarea name="value[address]" rows="5" class="form-control" placeholder="Alamat">{{ (!empty($value) and !empty($value['address'])) ? $value['address'] : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script>
        var removeLang = '{{ ('menghapus') }}';
    </script>
    <script src="{{ asset('') }}assets/default/js/admin/contact_us.min.js"></script>
@endpush
