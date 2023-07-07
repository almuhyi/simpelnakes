@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.css">
    <link href="{{ asset('') }}assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush

<div class="row">
    <div class="col-12 col-md-6">

        <div class="form-group mt-30 d-flex align-items-center justify-content-between mb-5">
            <label class="cursor-pointer input-label" for="subscribeSwitch">Aktifkan Berlangganan</label>
            <div class="custom-control custom-switch">
                <input type="checkbox" name="subscribe" class="custom-control-input" id="subscribeSwitch" {{ !empty($webinar) && $webinar->subscribe ? 'checked' : (old('subscribe') ? 'checked' : '')  }}>
                <label class="custom-control-label" for="subscribeSwitch"></label>
            </div>
        </div>

        <div>
            <p class="font-12 text-gray">
                - peserta akan dapat berlangganan konten Anda selain pembelian langsung.</p>
        </div>

        <div class="form-group mt-15">
            <label class="input-label">
                Periode Akses (Hari) (Opsional)</label>
            <input type="number" name="access_days" value="{{ !empty($webinar) ? $webinar->access_days : old('access_days') }}" class="form-control @error('access_days')  is-invalid @enderror"/>
            @error('access_days')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <p class="font-12 text-gray mt-10">
                - Pengguna harus membeli kembali setelah periode akses pelatihan berakhir.</p>
        </div>

        <div class="form-group mt-15">
            <label class="input-label">Harga</label>
            <input type="number" name="price" value="{{ !empty($webinar) ? $webinar->price : old('price') }}" class="form-control @error('price')  is-invalid @enderror" placeholder="Masukan 0 untuk gratis"/>
            @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        @if($authUser->isOrganization() and $authUser->id == $webinar->creator_id)
            <div class="form-group mt-15">
                <label class="input-label">Harga organisasi</label>
                <input type="number" name="organization_price" value="{{ !empty($webinar) ? $webinar->organization_price : old('organization_price') }}" class="form-control @error('organization_price')  is-invalid @enderror" placeholder=""/>
                @error('organization_price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
                <p class="font-12 text-gray mt-5">
                    - Harga ini akan diterapkan untuk peserta organisasi.</p>
            </div>
        @endif
    </div>
</div>

<section class="mt-30">
    <div class="">
        <h2 class="section-title after-line">
            Paket Harga (Opsional)</h2>
        <div class="mt-15">
            <p class="font-12 text-gray">- Paket harga akan membantu Anda membuat harga yang bergantung pada waktu & kapasitas untuk konten Anda.</p>
            <p class="font-12 text-gray">- Anda dapat membuat paket harga untuk waktu terbatas atau jumlah peserta pelatihan yang terbatas.</p>
            <p class="font-12 text-gray">- Jika Anda tidak membuat rencana harga, harga dasar pelatihan Anda akan dipertimbangkan.</p>
        </div>
    </div>

    <button id="webinarAddTicket" data-webinar-id="{{ $webinar->id }}" type="button" class="btn btn-primary btn-sm mt-15">Rencana baru</button>

    <div class="row mt-10">
        <div class="col-12">

            <div class="accordion-content-wrapper mt-15" id="ticketsAccordion" role="tablist" aria-multiselectable="true">
                @if(!empty($webinar->tickets) and count($webinar->tickets))
                    <ul class="draggable-lists" data-order-table="tickets">
                        @foreach($webinar->tickets as $ticketInfo)
                            @include('web.default.panel.webinar.create_includes.accordions.ticket',['webinar' => $webinar,'ticket' => $ticketInfo])
                        @endforeach
                    </ul>
                @else
                    @include(getTemplate() . '.includes.no-result',[
                        'file_name' => 'ticket.png',
                        'title' => 'Tidak ada paket harga!',
                        'hint' => 'Dengan membuat rencana harga, Anda dapat menambahkan waktu dan harga yang bergantung pada kapasitas untuk pelatihan Anda.',
                    ])
                @endif
            </div>
        </div>
    </div>
</section>

<div id="newTicketForm" class="d-none">
    @include('web.default.panel.webinar.create_includes.accordions.ticket',['webinar' => $webinar])
</div>

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/sortable/jquery-ui.min.js"></script>
@endpush
