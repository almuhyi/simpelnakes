@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    @if(empty($new_user))
        @include('web.default.panel.setting.setting_includes.progress')
    @endif

    <form method="post" id="userSettingForm" class="mt-30" action="{{ url((!empty($new_user)) ? '/panel/manage/'. $user_type .'/new' : '/panel/setting') }}">
        {{ csrf_field() }}
        <input type="hidden" name="step" value="{{ !empty($currentStep) ? $currentStep : 1 }}">
        <input type="hidden" name="next_step" value="0">

        @if(!empty($organization_id))
            <input type="hidden" name="organization_id" value="{{ $organization_id }}">
            <input type="hidden" id="userId" name="user_id" value="{{ $user->id }}">
        @endif

        @if(!empty($new_user) or (!empty($currentStep) and $currentStep == 1))
            @include('web.default.panel.setting.setting_includes.basic_information')
        @endif

        @if(empty($new_user) and !empty($currentStep))
            @switch($currentStep)
                @case(2)
                @include('web.default.panel.setting.setting_includes.image')
                @break

                @case(3)
                @include('web.default.panel.setting.setting_includes.about')
                @break

                @case(4)
                @include('web.default.panel.setting.setting_includes.education')
                @break

                @case(5)
                @include('web.default.panel.setting.setting_includes.experiences')
                @break

                @case(6)
                @include('web.default.panel.setting.setting_includes.occupations')
                @break

                @case(7)
                @include('web.default.panel.setting.setting_includes.identity_and_financial')
                @break

                @case(8)
                @if(!$user->isUser())
                    @include('web.default.panel.setting.setting_includes.zoom_api')
                @endif
                @break

                @case(9)
                    @include('web.default.panel.setting.setting_includes.settings')
                @break
            @endswitch
        @endif
    </form>

    <div class="create-webinar-footer d-flex align-items-center justify-content-between mt-20 pt-15 border-top">
        <div class="d-flex align-items-center">
            @if(!empty($user) and empty($new_user))
                @if(!empty($currentStep) and $currentStep > 1)
                    <a href="{{ url('')}}/panel/setting/step/{{ ($currentStep - 1) }}" class="btn btn-sm btn-primary">Sebelumnya</a>
                @else
                    <a href="" class="btn btn-sm btn-primary disabled">Sebelumnya</a>
                @endif

                <button type="button" id="getNextStep" class="btn btn-sm btn-primary ml-15" @if(!empty($currentStep) and (($user->isUser() and $currentStep == 7) or (!$user->isUser() and $currentStep == 9))) disabled @endif>Selanjutnya</button>
            @endif
        </div>

        <div class="d-flex align-items-center">
            @if(empty($new_user) and empty($edit_new_user))
                <a href="{{ url('/panel/setting/deleteAccount') }}" class="delete-action btn btn-sm btn-danger" data-confirm="Ya, saya konfirmasi!" data-title="Setelah konfirmasi oleh staf, akun Anda akan dihapus dan informasi Anda tidak akan dipulihkan.">Hapus akun</a>
            @endif

            <button type="button" id="saveData" class="btn btn-sm btn-primary ml-15">Simpan</button>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/vendors/cropit/jquery.cropit.js"></script>
    <script src="{{ asset('') }}assets/default/js/parts/img_cropit.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/select2/select2.min.js"></script>

    <script>
        var editEducationLang = '{{ ('Edit pendidikan') }}';
        var editExperienceLang = '{{ ('Edit pengalaman') }}';
        var saveSuccessLang = '{{ ('Item berhasil ditambahkan.') }}';
        var saveErrorLang = '{{ ('Operasi gagal! Coba lagi nanti') }}';
        var notAccessToLang = '{{ ('Anda tidak memiliki akses ke konten ini!') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/panel/user_setting.min.js"></script>
@endpush
