@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')

@endpush

@section('content')
    <div class="">

        <form method="post" action="{{ url('') }}/panel/webinars/{{ !empty($webinar) ? $webinar->id .'/update' : 'store' }}" id="webinarForm" class="webinar-form">
            @include('web.default.panel.webinar.create_includes.progress')

            {{ csrf_field() }}
            <input type="hidden" name="current_step" value="{{ !empty($currentStep) ? $currentStep : 1 }}">
            <input type="hidden" name="draft" value="no" id="forDraft"/>
            <input type="hidden" name="get_next" value="no" id="getNext"/>
            <input type="hidden" name="get_step" value="0" id="getStep"/>


            @if($currentStep == 1)
                @include('web.default.panel.webinar.create_includes.step_1')
            @elseif(!empty($webinar))
                @include('web.default.panel.webinar.create_includes.step_'.$currentStep)
            @endif

        </form>


        <div class="create-webinar-footer d-flex flex-column flex-md-row align-items-center justify-content-between mt-20 pt-15 border-top">
            <div class="d-flex align-items-center">

                @if(!empty($webinar))
                    <a href="{{ url('') }}/panel/webinars/{{ $webinar->id }}/step/{{ ($currentStep - 1) }}" class="btn btn-sm btn-primary {{ $currentStep < 2 ? 'disabled' : '' }}">Sebelumnya</a>
                @else
                    <a href="" class="btn btn-sm btn-primary disabled">Sebelumnya</a>
                @endif

                <button type="button" id="getNextStep" class="btn btn-sm btn-primary ml-15" @if($currentStep >= 8) disabled @endif>Selanjutnya</button>
            </div>

            <div class="mt-20 mt-md-0">
                <button type="button" id="sendForReview" class="btn btn-sm btn-primary">
                    Kirim untuk ditinjau</button>

                <button type="button" id="saveAsDraft" class=" btn btn-sm btn-primary">
                Simpan sebagai draf</button>

                @if(!empty($webinar) and $webinar->creator_id == $authUser->id)
                    <a href="{{ url('') }}/panel/webinars/{{ $webinar->id }}/delete?redirect_to=/panel/webinars" class="delete-action webinar-actions btn btn-sm btn-danger mt-20 mt-md-0">Hapus</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script>
        var saveSuccessLang = '{{ ('Item berhasil ditambahkan.') }}';
        var zoomJwtTokenInvalid = '{{ ('Token Zoom JWT Anda tidak valid.') }}';
        var hasZoomApiToken = '{{ (!empty($authUser->zoomApi) and $authUser->zoomApi->jwt_token) ? 'true' : 'false' }}';
        var editChapterLang = '{{ ('Sunting Bagian') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/panel/webinar.min.js"></script>
    <script src="{{ asset('') }}assets/default/js/panel/webinar_content_locale.min.js"></script>
@endpush
