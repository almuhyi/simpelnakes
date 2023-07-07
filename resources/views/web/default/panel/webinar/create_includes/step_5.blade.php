@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/select2/select2.min.css">
    <link href="{{ asset('') }}assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush


<section class="mt-50">
    <div class="">
        <h2 class="section-title after-line">Prasyarat (Opsional)</h2>
    </div>

    <button id="webinarAddPrerequisites" data-webinar-id="{{ $webinar->id }}" type="button" class="btn btn-primary btn-sm mt-15">Tambah prasyarat baru</button>

    <div class="row mt-10">
        <div class="col-12">

            <div class="accordion-content-wrapper mt-15" id="prerequisitesAccordion" role="tablist" aria-multiselectable="true">
                @if(!empty($webinar->prerequisites) and count($webinar->prerequisites))
                    <ul class="draggable-lists" data-order-table="prerequisites">
                        @foreach($webinar->prerequisites as $prerequisiteInfo)
                            @include('web.default.panel.webinar.create_includes.accordions.prerequisites',['webinar' => $webinar,'prerequisite' => $prerequisiteInfo])
                        @endforeach
                    </ul>
                @else
                    @include(getTemplate() . '.includes.no-result',[
                        'file_name' => 'comment.png',
                        'title' => 'Tidak ada prasyarat yang ditentukan!',
                        'hint' => 'Anda dapat membuat prasyarat yang diperlukan atau disarankan bagi siswa untuk belajar lebih baik.',
                    ])
                @endif
            </div>
        </div>
    </div>
</section>

<div id="newPrerequisiteForm" class="d-none">
    @include('web.default.panel.webinar.create_includes.accordions.prerequisites',['webinar' => $webinar])
</div>


@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/select2/select2.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/sortable/jquery-ui.min.js"></script>
@endpush
