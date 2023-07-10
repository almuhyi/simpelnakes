@extends('admin.auth.auth_layout')

@section('content')
    @php
        $siteGeneralSettings = getGeneralSettings();
    @endphp

    <div class="p-4 m-3">
        <img src="{{ $siteGeneralSettings['logo'] ?? '' }}" alt="logo" width="40%" class="mb-5 mt-2">

        <h4>Lupa kata sandi</h4>

        <p class="text-muted">
            Kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda</p>

        <form method="POST" action="{{ url('/admin/forget-password') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" value="{{ old('email') }}" class="form-control  @error('email')  is-invalid @enderror"
                       name="email" tabindex="1"
                       required autofocus>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-20">Atur ulang kata sandi</button>
        </form>

        <div class="text-center mt-2">
            <span class=" d-inline-flex align-items-center justify-content-center">atau</span>
        </div>

        <div class="text-center mt-20">
            <span class="text-secondary">
                <a href="{{ url('/admin/login') }}" class="font-weight-bold">Masuk</a>
            </span>
        </div>
    </div>
@endsection
