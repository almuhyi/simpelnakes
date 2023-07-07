<div class="d-none" id="joinMeetingLinkModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">
        Bergabung dengan pertemuan</h3>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="form-group">
                <label class="input-label">Url</label>
                <input type="text" readonly name="link" class="form-control"/>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="form-group">
                <label class="input-label">Password (Opsional)</label>
                <input type="text" readonly name="password" class="form-control"/>
                <div class="invalid-feedback"></div>
            </div>
        </div>
    </div>
    <p class="font-weight-500 text-gray">Anda dapat menggunakan tautan Zoom, Bigbluebutton, dll</p>

    <div class="mt-30 d-flex align-items-center justify-content-end">
        <a href="" target="_blank" class="js-join-meeting-link btn btn-sm btn-primary">Bergabung</a>
        <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">Tutup</button>
    </div>
</div>
@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/js/panel/meeting/join_modal.min.js"></script>
@endpush
