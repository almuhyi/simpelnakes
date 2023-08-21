@extends(getTemplate() . '.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    @php
        $registerMethod = getGeneralSettings('register_method') ?? 'mobile';
        $showOtherRegisterMethod = getFeaturesSettings('show_other_register_method') ?? false;
        $showCertificateAdditionalInRegister = getFeaturesSettings('show_certificate_additional_in_register') ?? false;
    @endphp

    <div class="container">
        <div class="row login-container">
            <div class="col-12 col-md-6 pl-0">
                <img src="{{ asset(getPageBackgroundSettings('register')) }}" class="img-cover" alt="Login">
            </div>
            <div class="col-12 col-md-6">
                <div class="login-card">
                    <h1 class="font-20 font-weight-bold">
                        Mendaftar</h1>

                    <form method="post" action="{{ url('/register') }}" class="mt-35">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @if ($registerMethod == 'mobile')
                            @include('web.default.auth.register_includes.mobile_field')

                            @if ($showOtherRegisterMethod)
                                @include('web.default.auth.register_includes.email_field', [
                                    'optional' => true,
                                ])
                            @endif
                        @else
                            @include('web.default.auth.register_includes.email_field')

                            @if ($showOtherRegisterMethod)
                                @include('web.default.auth.register_includes.mobile_field', [
                                    'optional' => true,
                                ])
                            @endif
                        @endif

                        <div class="form-group">
                            <label>Nama lengkap:</label>
                            <input name="full_name" type="text" value="{{ old('full_name') }}"
                                class="form-control @error('full_name') is-invalid @enderror">
                            @error('full_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="password">Kata sandi:</label>
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                aria-describedby="passwordHelp">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label class="input-label" for="confirm_password">Ketik ulang kata sandi:</label>
                            <input name="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="confirm_password" aria-describedby="confirmPasswordHelp">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>



                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="term" value="1"
                                {{ (!empty(old('term')) and old('term') == '1') ? 'checked' : '' }}
                                class="custom-control-input @error('term') is-invalid @enderror" id="term">
                            <label class="custom-control-label font-14" for="term">
                                <a href="{{ url('pages/terms') }}" target="_blank"
                                    class="text-secondary font-weight-bold font-14">Saya setuju dengan syarat & aturan</a>
                            </label>

                            @error('term')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @error('term')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <button type="submit" class="btn btn-primary btn-block mt-20">Daftar</button>
                    </form>

                    <div class="text-center mt-20">
                        <span class="text-secondary">
                            Sudah memiliki akun?
                            <a href="{{ url('/login') }}" class="text-secondary font-weight-bold">Masuk</a>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/select2/select2.min.js"></script>
@endpush
