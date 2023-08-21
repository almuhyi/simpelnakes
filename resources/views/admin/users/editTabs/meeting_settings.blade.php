@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/leaflet/leaflet.css">
@endpush

<div class="tab-pane mt-3 fade" id="meetingSettings" role="tabpanel" aria-labelledby="meetingSettings-tab">
    <div class="row">
        <div class="col-12">
            <form action="{{ url('') }}/admin/users/{{ $user->id }}/meetingSettings" method="Post">
                {{ csrf_field() }}

                <div class="row mt-20">
                    <div class="col-12 col-lg-12">

                        <div class="form-group mb-30 mt-30">
                            <label class="input-label">Jenis kelamin:</label>

                            <div class="d-flex align-items-center">
                                <div class="custom-control mr-2 custom-radio">
                                    <input type="radio" name="gender" value="man" {{ (!empty($user->gender) and $user->gender == 'man') ? 'checked="checked"' : ''}} id="man" class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="man">Pria</label>
                                </div>

                                <div class="custom-control mr-2 custom-radio ml-15">
                                    <input type="radio" name="gender" value="woman" id="woman" {{ (!empty($user->gender) and $user->gender == 'woman') ? 'checked="checked"' : ''}} class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="woman">Wanita</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-30 col-lg-6">
                            <label class="input-label">Umur:</label>
                            <input type="number" name="age" value="{{ !empty($user->age) ? $user->age : ''}}" class="form-control">
                        </div>

                        @if(!$user->isUser())
                        <div class="form-group mb-30">
                            <label class="input-label">Jenis pertemuan:</label>

                            <div class="d-flex align-items-center">
                                <div class="custom-control mr-2 custom-radio">
                                    <input type="radio" name="meeting_type" value="in_person" id="in_person" {{ (!empty($user->meeting_type) and $user->meeting_type == 'in_person') ? 'checked="checked"' : ''}} class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="in_person">pertemuan Tatap muka</label>
                                </div>

                                <div class="custom-control mr-2 custom-radio ml-10">
                                    <input type="radio" name="meeting_type" value="online" id="online" {{ (!empty($user->meeting_type) and $user->meeting_type == 'online') ? 'checked="checked"' : ''}} class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="online">Pertemuan daring</label>
                                </div>

                                <div class="custom-control mr-2 custom-radio ml-10">
                                    <input type="radio" name="meeting_type" value="all" id="all" {{ (!empty($user->meeting_type) and $user->meeting_type == 'all') ? 'checked="checked"' : ''}} class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="all">Semua</label>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(!$user->isUser())
                        <div class="form-group mb-30">
                            <label class="input-label">Tingkat pelatihan:</label>

                            <div class="d-flex align-items-center">
                                <div class="custom-control mr-2 custom-checkbox">
                                    <input type="checkbox" name="level_of_training[]" value="beginner" id="beginner" {{ (!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('beginner',$user->level_of_training)) ? 'checked="checked"' : ''}} class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="beginner">Pemula</label>
                                </div>

                                <div class="custom-control mr-2 custom-checkbox ml-10">
                                    <input type="checkbox" name="level_of_training[]" value="middle" id="middle" {{ (!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('middle',$user->level_of_training)) ? 'checked="checked"' : ''}} class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="middle">Menengah</label>
                                </div>

                                <div class="custom-control mr-2 custom-checkbox ml-10">
                                    <input type="checkbox" name="level_of_training[]" value="expert" id="expert" {{ (!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('expert',$user->level_of_training)) ? 'checked="checked"' : ''}} class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="expert">Sulit/expert</label>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <h2 class="section-title after-line">
                    Wilayah</h2>

                <div class="row mt-30">
                    <div class="col-12 col-lg-4">
                        <div class="form-group ">
                            <label class="input-label">Negara:</label>

                            <select name="country_id" class="form-control " {{ empty($countries) ? 'disabled' : '' }}>
                                <option value="">Pilih negara</option>

                                @if(!empty($countries))
                                    @foreach($countries as $country)
                                        @php
                                            $country->geo_center = \Geo::get_geo_array($country->geo_center);
                                        @endphp

                                        <option value="{{ $country->id }}" data-center="{{ implode(',', $country->geo_center) }}" {{ (($user->country_id == $country->id) or old('country_id') == $country->id) ? 'selected' : '' }}>{{ $country->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group mt-30">
                            <label class="input-label">Provinsi:</label>

                            <select name="province_id" class="form-control " {{ empty($provinces) ? 'disabled' : '' }}>
                                <option value="">Pilih provinsi</option>

                                @if(!empty($provinces))
                                    @foreach($provinces as $province)
                                        @php
                                            $province->geo_center = \Geo::get_geo_array($province->geo_center);
                                        @endphp

                                        <option value="{{ $province->id }}" data-center="{{ implode(',', $province->geo_center) }}" {{ (($user->province_id == $province->id) or old('province_id') == $province->id) ? 'selected' : '' }}>{{ $province->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group mt-30">
                            <label class="input-label">Kota:</label>

                            <select name="city_id" class="form-control " {{ empty($cities) ? 'disabled' : '' }}>
                                <option value="">Pilih kota</option>

                                @if(!empty($cities))
                                    @foreach($cities as $city)
                                        @php
                                            $city->geo_center = \Geo::get_geo_array($city->geo_center);
                                        @endphp

                                        <option value="{{ $city->id }}" data-center="{{ implode(',', $city->geo_center) }}" {{ (($user->city_id == $city->id) or old('city_id') == $city->id) ? 'selected' : '' }}>{{ $city->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group mt-30">
                            <label class="input-label">Wilayah:</label>

                            <select name="district_id" class="form-control " {{ empty($districts) ? 'disabled' : '' }}>
                                <option value="">Pilih wilayah</option>

                                @if(!empty($districts))
                                    @foreach($districts as $district)
                                        @php
                                            $district->geo_center = \Geo::get_geo_array($district->geo_center);
                                        @endphp

                                        <option value="{{ $district->id }}" data-center="{{ implode(',', $district->geo_center) }}" {{ (($user->district_id == $district->id) or old('district_id') == $district->id) ? 'selected' : '' }}>{{ $district->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group mb-30">
                            <label class="input-label">Alamat:</label>
                            <input type="text" name="address" value="{{ !empty($user->address) ? $user->address : '' }}" class="form-control">
                        </div>
                    </div>


                </div>

                <div class=" mt-4">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/vendors/leaflet/leaflet.min.js"></script>

    <script>
        var selectProvinceLang = '{{ ('Pilih provinsi') }}';
        var selectCityLang = '{{ ('Pilih kota') }}';
        var selectDistrictLang = '{{ ('Pilih wilayah') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/panel/user_settings_tab.min.js"></script>
@endpush
