<section class="mt-45">
    <h3 class="section-title">Pengiriman</h3>
    <div class="rounded-sm shadow mt-20 py-25 px-20">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="input-label font-weight-500">Negara</label>

                    <select name="country_id" class="form-control @error('country_id')  is-invalid @enderror">
                        <option value="">Pilih negara</option>

                        @if(!empty($countries))
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ (!empty($user) and $user->country_id == $country->id) ? 'selected' : '' }}>{{ $country->title }}</option>
                            @endforeach
                        @endif
                    </select>

                    @error('country_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="input-label font-weight-500">Provinsi</label>

                    <select name="province_id" class="form-control @error('province_id')  is-invalid @enderror" {{ (!empty($user) and $user->province_id) ? '' : 'disabled' }}>
                        <option value="">Pilih provinsi</option>

                        @if(!empty($provinces))
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" {{ (!empty($user) and $user->province_id == $province->id) ? 'selected' : '' }}>{{ $province->title }}</option>
                            @endforeach
                        @endif
                    </select>

                    @error('province_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="input-label font-weight-500">Kota</label>

                    <select name="city_id" class="form-control @error('city_id')  is-invalid @enderror" {{ (!empty($user) and $user->city_id) ? '' : 'disabled' }}>
                        <option value="">Pilih kota</option>

                        @if(!empty($cities))
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ (!empty($user) and $user->city_id == $city->id) ? 'selected' : '' }}>{{ $city->title }}</option>
                            @endforeach
                        @endif
                    </select>

                    @error('city_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="input-label font-weight-500">Daerah</label>

                    <select name="district_id" class="form-control @error('district_id')  is-invalid @enderror" {{ (!empty($user) and $user->district_id) ? '' : 'disabled' }}>
                        <option value="">Pilih daerah</option>

                        @if(!empty($districts))
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ (!empty($user) and $user->district_id == $district->id) ? 'selected' : '' }}>{{ $district->title }}</option>
                            @endforeach
                        @endif
                    </select>

                    @error('district_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="form-group">
                    <label class="input-label font-weight-500">Alamat</label>

                    <textarea name="address" rows="6" class="form-control @error('address')  is-invalid @enderror">{{ !empty($user) ? $user->address : '' }}</textarea>

                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="input-label font-weight-500">Pesan untuk penjual</label>

                    <textarea name="message_to_seller" rows="8" class="form-control @error('message_to_seller')  is-invalid @enderror"></textarea>

                    @error('message_to_seller')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</section>

@if(!empty($deliveryEstimateTime))
    <div class="d-flex align-items-center mt-30 rounded-lg border px-10 py-5">
        <div class="appointment-timezone-icon">
            <img src="{{ asset('') }}assets/default/img/icons/timezone.svg" alt="appointment timezone">
        </div>
        <div class="ml-15">
            <div class="font-16 font-weight-bold text-dark-blue">Perkiraan waktu pengiriman</div>
            <p class="font-14 font-weight-500 text-gray">Pesanan Anda sudah termasuk produk fisik dan estimasi waktu pengiriman adalah {{ $deliveryEstimateTime }} hari.</p>
        </div>
    </div>
@endif
