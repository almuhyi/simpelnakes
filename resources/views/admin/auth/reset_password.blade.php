@extends('admin.auth.auth_layout')

@section('content')
    @php
        $siteGeneralSettings = getGeneralSettings();
    @endphp

    <div class="p-4 m-3">
        <img src="{{ $siteGeneralSettings['logo'] ?? '' }}" alt="logo" width="40%" class="mb-5 mt-2">

        <h4>Atur ulang kata sandi</h4>

        <form method="POST" action="{{ url('/admin/reset-password') }}">
            {{ csrf_field() }}

            <input hidden name="token" placeholder="token" value="{{ $token }}">

            <div class="form-group">
                <label class="input-label" for="email">Email:</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                       value="{{ request()->get('email') }}" aria-describedby="emailHelp">
                @error('email')
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

            <div class="form-group">
                <label class="input-label" for="confirm_password">Ketik ulang kata sandi:</label>
                <input name="password_confirmation" type="password"
                       class="form-control @error('password_confirmation') is-invalid @enderror" id="confirm_password"
                       aria-describedby="confirmPasswordHelp">
                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-20">Atur ulang kata sandi</button>
        </form>
    </div>
@endsection
