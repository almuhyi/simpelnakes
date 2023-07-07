<div id="changeChapterModalHtml" class="d-none">
    <div class="custom-modal-body">
        <h2 class="section-title after-line">Ubah Bab</h2>

        <div class="js-content-form change-chapter-form mt-20" data-action="{{ url('/panel/chapters/change') }}">

            <input type="hidden" name="ajax[webinar_id]" class="" value="{{ $webinar->id }}">
            <input type="hidden" name="ajax[item_id]" class="js-item-id" value="">
            <input type="hidden" name="ajax[item_type]" class="js-item-type" value="">

            <div class="form-group">
                <label class="input-label">
                    Bagian</label>

                <select name="ajax[chapter_id]" class="js-ajax-chapter_id custom-select">
                    <option value="">Pilih Bab</option>

                    @if(!empty($webinar->chapters) and count($webinar->chapters))
                        @foreach($webinar->chapters as $chapter)
                            <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="d-flex align-items-center justify-content-end mt-3">
                <button type="button" class="save-change-chapter btn btn-sm btn-primary">Simpan</button>
                <button type="button" class="close-swl btn btn-sm btn-danger ml-2">Tutup</button>
            </div>

        </div>
    </div>
</div>
