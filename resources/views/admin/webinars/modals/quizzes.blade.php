<!-- Modal -->
<div class="d-none" id="quizzesModal">
    <h3 class="section-title after-line font-20 text-dark-blue mb-25">Kuis baru</h3>

    <div class="js-form" data-action="{{ url('/admin/webinar-quiz/store') }}">
        <input type="hidden" name="webinar_id" value="{{  !empty($webinar) ? $webinar->id :''  }}">

        <div class="form-group mt-15">
            <label class="input-label d-block">Pilih kuis</label>

            <select name="quiz_id" class="js-ajax-quiz_id form-control quiz-select2" data-placeholder="Tambah kuis">
                <option disabled selected></option>
                @if(!empty($webinar))
                    @foreach($teacherQuizzes as $quiz)
                        <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                    @endforeach
                @endif
            </select>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group">
            <label class="input-label">Bagian</label>
            <select class="js-ajax-chapter_id custom-select" name="chapter_id">
                <option value="">Tidak ada bagian</option>

                @if(!empty($chapters))
                    @foreach($chapters as $chapter)
                        <option value="{{ $chapter->id }}">{{ $chapter->title }}</option>
                    @endforeach
                @endif
            </select>
            <div class="invalid-feedback"></div>
        </div>

        <div class="mt-30 d-flex align-items-center justify-content-end">
            <button type="button" id="saveQuiz" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger ml-2 close-swl">Tutup</button>
        </div>
    </div>
</div>
