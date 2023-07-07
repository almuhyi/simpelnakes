@extends(getTemplate().'.layouts.app')

@section('content')
    <div class="container">
        <div class="row login-container">
            <div class="col-12 col-md-6 pl-0">
                <img src="{{ getPageBackgroundSettings('remember_pass') }}" class="img-cover" alt="Login">
            </div>

            <div class="col-12 col-md-6">
                <div class="login-card">
                    <h1 class="font-20 font-weight-bold">Atur ulang kata sandi</h1>
                    <form method="post" action="{{ url('/reset-password') }}" class="mt-35">
                        {{ csrf_field() }}

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

                        <input hidden name="token" placeholder="token" value="{{ $token }}">

                        <button type="submit" class="btn btn-primary btn-block mt-20">Atur ulang kata sandi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
