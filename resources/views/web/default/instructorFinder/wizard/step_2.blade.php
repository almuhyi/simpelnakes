<div class="wizard-step-1">
    <h3 class="font-20 text-dark font-weight-bold">Jenis pertemuan</h3>

    <span class="d-block mt-30 text-gray wizard-step-num">
        Langkah 2/3
    </span>

    <span class="d-block font-16 font-weight-500 mt-30">Jenis pertemuan mana yang Anda sukai?</span>

    <div class="form-group mt-10">
        <label class="input-label">Jenis pertemuan</label>

        <div class="d-flex align-items-center wizard-custom-radio mt-5">
            <div class="wizard-custom-radio-item">
                <input type="radio" name="meeting_type" checked value="all" id="all" class="">
                <label class="font-12 cursor-pointer" for="all">Semua</label>
            </div>

            <div class="wizard-custom-radio-item">
                <input type="radio" name="meeting_type" value="in_person" id="in_person" class="">
                <label class="font-12 cursor-pointer" for="in_person">offline</label>
            </div>

            <div class="wizard-custom-radio-item">
                <input type="radio" name="meeting_type" value="online" id="online" class="">
                <label class="font-12 cursor-pointer" for="online">online</label>
            </div>
        </div>
    </div>

    <div id="regionCard" class="d-none">
        <div class="form-group mt-30">
            <label class="input-label font-weight-500">Negara</label>

            <select name="country_id" class="form-control">
                <option value="">Pilih negara</option>

                @if(!empty($countries))
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->title }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group mt-30">
            <label class="input-label font-weight-500">Provinsi</label>

            <select name="province_id" class="form-control" disabled>
                <option value="">Pilih provinsi</option>
            </select>
        </div>

        <div class="form-group mt-30">
            <label class="input-label font-weight-500">Kota</label>

            <select name="city_id" class="form-control" disabled>
                <option value="">Pilih kota</option>
            </select>
        </div>

        <div class="form-group mt-30">
            <label class="input-label font-weight-500">Daerah</label>

            <select name="district_id" class="form-control" disabled>
                <option value="">Pilih daerah</option>
            </select>
        </div>
    </div>

    <div class="">
        <label class="input-label">Pilihan pertemuan</label>

        <div class="d-flex align-items-center wizard-custom-radio mt-5">
            <div class="wizard-custom-radio-item">
                <input type="radio" name="population" value="all" checked id="population_all" class="">
                <label class="font-12 cursor-pointer" for="population_all">Semua</label>
            </div>

            <div class="wizard-custom-radio-item">
                <input type="radio" name="population" value="single" id="population_single" class="">
                <label class="font-12 cursor-pointer" for="population_single">Individu</label>
            </div>

            <div class="wizard-custom-radio-item">
                <input type="radio" name="population" value="group" id="population_group" class="">
                <label class="font-12 cursor-pointer" for="population_group">Grup</label>
            </div>
        </div>
    </div>
</div>
