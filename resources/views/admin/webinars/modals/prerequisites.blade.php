<!-- Modal -->
<div class="d-none" id="webinarPrerequisitesModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">Prasyarat Baru</h3>

    <div class="js-prerequisites-form" data-action="{{ url('/admin/prerequisites/store') }}" >
        <input type="hidden" name="webinar_id" value="{{  !empty($webinar) ? $webinar->id :''  }}">

        <div class="form-group mt-15">
            <label class="input-label d-block">Pilih prasyarat</label>
            <select id="prerequisitesSelect" name="prerequisite_id" class="js-ajax-prerequisite_id form-control prerequisites-select" data-webinar-id="{{  !empty($webinar) ? $webinar->id : '' }}" data-placeholder="Cari prasyarat">

            </select>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group mt-30 d-flex align-items-center justify-content-between">
            <label class="" for="str_requiredPrerequisitesSwitch">Diperlukan</label>
            <div class="custom-control custom-switch">
                <input type="checkbox" name="required" class="custom-control-input" id="str_requiredPrerequisitesSwitch">
                <label class="custom-control-label" for="str_requiredPrerequisitesSwitch"></label>
            </div>
        </div>

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" id="savePrerequisites" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger ml-2 close-swl">Tutup</button>
        </div>
    </div>
</div>
