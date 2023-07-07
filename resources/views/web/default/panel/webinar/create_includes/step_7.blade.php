@push('styles_top')

@endpush


<section class="mt-50">
    <div class="">
        <h2 class="section-title after-line">Kuis & Sertifikasi (Opsional)</h2>
    </div>

    <button id="webinarAddQuiz" data-webinar-id="{{ $webinar->id }}" type="button" class="btn btn-primary btn-sm mt-15">Tambah kuis baru</button>

    <div class="row mt-10">
        <div class="col-12">

            <div class="accordion-content-wrapper mt-15" id="quizzesAccordion" role="tablist" aria-multiselectable="true">
                @if(!empty($webinar->quizzes) and count($webinar->quizzes))
                    @foreach($webinar->quizzes as $quizInfo)
                        @include('web.default.panel.webinar.create_includes.accordions.quiz',['webinar' => $webinar,'quizInfo' => $quizInfo])
                    @endforeach
                @else
                    @include(getTemplate() . '.includes.no-result',[
                        'file_name' => 'cert.png',
                        'title' => 'Tidak ada Kuis yang dibuat dan dipilih untuk pelatihan ini.',
                        'hint' => 'Dengan membuat kuis, Anda dapat mengevaluasi peserta dan memberikan sertifikat kepada mereka.',
                    ])
                @endif
            </div>
        </div>
    </div>
</section>

<div id="newQuizForm" class="d-none">
    @include('web.default.panel.webinar.create_includes.accordions.quiz',['webinar' => $webinar,'quizInfo' => null])
</div>


@push('scripts_bottom')
    <script>
        var saveSuccessLang = '{{ ('Item berhasil ditambahkan.') }}';
        var quizzesSectionLang = '{{ ('Tidak ada Bagian') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/panel/quiz.min.js"></script>
@endpush
