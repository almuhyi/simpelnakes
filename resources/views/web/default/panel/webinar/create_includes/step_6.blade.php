@push('styles_top')
    <link href="{{ asset('') }}assets/default/vendors/sortable/jquery-ui.min.css"/>
@endpush


<section class="mt-50">
    <div class="">
        <h2 class="section-title after-line">FAQ (Opsional)</h2>
    </div>

    <button id="webinarAddFAQ" data-webinar-id="{{ $webinar->id }}" type="button" class="btn btn-primary btn-sm mt-15">Tambah FAQ baru</button>

    <div class="row mt-10">
        <div class="col-12">

            <div class="accordion-content-wrapper mt-15" id="faqsAccordion" role="tablist" aria-multiselectable="true">
                @if(!empty($webinar->faqs) and count($webinar->faqs))
                    <ul class="draggable-lists" data-order-table="faqs">
                        @foreach($webinar->faqs as $faqInfo)
                            @include('web.default.panel.webinar.create_includes.accordions.faq',['webinar' => $webinar,'faq' => $faqInfo])
                        @endforeach
                    </ul>
                @else
                    @include(getTemplate() . '.includes.no-result',[
                        'file_name' => 'faq.png',
                        'title' => 'Tidak ada FAQ yang ditentukan!',
                        'hint' => 'Dengan membuat FAQ, Anda akan membantu pengguna mengetahui lebih banyak tentang pelatihan Anda.',
                    ])
                @endif
            </div>
        </div>
    </div>
</section>

<div id="newFaqForm" class="d-none">
    @include('web.default.panel.webinar.create_includes.accordions.faq',['webinar' => $webinar])
</div>

@foreach(\App\Models\WebinarExtraDescription::$types as $webinarExtraDescriptionType)
    <section class="mt-50">
        <div class="">
            <h2 class="section-title after-line">{{ $webinarExtraDescriptionType }} (Opsional)</h2>
        </div>

        <button id="add_new_{{ $webinarExtraDescriptionType }}" data-webinar-id="{{ $webinar->id }}" type="button" class="btn btn-primary btn-sm mt-15">Tambah {{ $webinarExtraDescriptionType }} baru</button>

        <div class="row mt-10">
            <div class="col-12">

                @php
                    $webinarExtraDescriptionValues = $webinar->webinarExtraDescription->where('type',$webinarExtraDescriptionType);
                @endphp

                <div class="accordion-content-wrapper mt-15" id="{{ $webinarExtraDescriptionType }}_accordion" role="tablist" aria-multiselectable="true">
                    @if(!empty($webinarExtraDescriptionValues) and count($webinarExtraDescriptionValues))
                        <ul class="draggable-content-lists draggable-lists-{{ $webinarExtraDescriptionType }}" data-drag-class="draggable-lists-{{ $webinarExtraDescriptionType }}" data-order-table="webinar_extra_descriptions_{{ $webinarExtraDescriptionType }}">
                            @foreach($webinarExtraDescriptionValues as $learningMaterialInfo)
                                @include('web.default.panel.webinar.create_includes.accordions.extra_description',
                                    [
                                        'webinar' => $webinar,
                                        'extraDescription' => $learningMaterialInfo,
                                        'extraDescriptionType' => $webinarExtraDescriptionType,
                                        'extraDescriptionParentAccordion' => $webinarExtraDescriptionType.'_accordion',
                                    ]
                                )
                            @endforeach
                        </ul>
                    @else
                        @include(getTemplate() . '.includes.no-result',[
                            'file_name' => 'faq.png',
                            'title' => "$webinarExtraDescriptionType",
                            'hint' => "$webinarExtraDescriptionType",
                        ])
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div id="new_{{ $webinarExtraDescriptionType }}_html" class="d-none">
        @include('web.default.panel.webinar.create_includes.accordions.extra_description',
            [
                'webinar' => $webinar,
                'extraDescriptionType' => $webinarExtraDescriptionType,
                'extraDescriptionParentAccordion' => $webinarExtraDescriptionType.'_accordion',
            ]
        )
    </div>
@endforeach


@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/sortable/jquery-ui.min.js"></script>
@endpush
