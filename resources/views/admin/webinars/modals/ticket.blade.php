<!-- Modal -->
<div class="d-none" id="webinarTicketModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">Tiket baru</h3>
    <div class="js-form" data-action="{{ url('/admin/tickets/store') }}">
        <input type="hidden" name="webinar_id" value="{{ !empty($webinar) ? $webinar->id :'' }}">

        @if(!empty(getGeneralSettings('content_translate')))
            <div class="form-group">
                <label class="input-label">Bahasa</label>
                <select name="locale" class="form-control ">
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
            <label class="input-label">Judul</label>
            <input type="text" name="title" class="js-ajax-title form-control" placeholder="Maksimal 64 karakter"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Tanggal</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="dateRangeLabel">
                        <i class="fa fa-calendar text-white"></i>
                    </span>
                </div>
                <input type="text" name="date" class="js-ajax-date form-control date-range-picker" aria-describedby="dateRangeLabel"/>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="input-label">Diskon <span class="braces">(%)</span></label>
            <input type="text" name="discount" class="js-ajax-discount form-control" placeholder="10"/>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Kapasitas</label>
            <input type="text" name="capacity" class="js-ajax-capacity form-control" placeholder="Biarkan kosong untuk kapasitas tidak terbatas."/>
            <div class="invalid-feedback"></div>
            <div class="text-muted text-small mt-1">Isi jika ingin membatasi jumlah tiket yang terjual. Contoh: Hanya 5 peserta yang mendapat diskon 50%.</div>
        </div>

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" id="saveTicket" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger ml-2 close-swl">Tutup</button>
        </div>
    </div>
</div>
