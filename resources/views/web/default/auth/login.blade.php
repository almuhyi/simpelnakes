@extends(getTemplate().'.layouts.app')

@section('content')
    <div class="container">
        @if(!empty(session()->has('msg')))
            <div class="alert alert-info alert-dismissible fade show mt-30" role="alert">
                {{ session()->get('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row login-container">

            <div class="col-12 col-md-6 pl-0">
                <img src="{{ asset(getPageBackgroundSettings('login')) }}" class="img-cover" alt="Login">
            </div>
            <div class="col-12 col-md-6">
                <div class="login-card">
                    <h1 class="font-20 font-weight-bold"> Masuk ke akun Anda</h1>
                    <form method="Post" action="{{ url('/login') }}" class="mt-35">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="input-label" for="username">Email atau No Hp:</label>
                            <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                                   value="{{ old('username') }}" aria-describedby="emailHelp">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="password">Kata sandi:</label>
                            <input name="password" type="password" class="form-control @error('password')  is-invalid @enderror" id="password" aria-describedby="passwordHelp">

                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-20">Masuk</button>
                    </form>

                    {{-- <div class="text-center mt-20">
                        <span class="badge badge-circle-gray300 text-secondary d-inline-flex align-items-center justify-content-center">Atau</span>
                    </div> --}}

                    {{-- <a href="/google" target="_blank" class="social-login mt-20 p-10 text-center d-flex align-items-center justify-content-center">
                        <img src="{{ asset('') }}assets/default/img/auth/google.svg" class="mr-auto" alt=" google svg"/>
                        <span class="flex-grow-1">Masuk dengan akun google</span>
                    </a>

                    <a href="{{url('/facebook/redirect')}}" target="_blank" class="social-login mt-20 p-10 text-center d-flex align-items-center justify-content-center ">
                        <img src="{{ asset('') }}assets/default/img/auth/facebook.svg" class="mr-auto" alt="facebook svg"/>
                        <span class="flex-grow-1">Masuk dengan akun facebook</span>
                    </a> --}}

                    <div class="mt-30 text-center">
                        <a href="{{ url('/forget-password') }}" target="_blank">Lupa kata sandi?</a>
                    </div>

                    <div class="mt-20 text-center">
                        <span>Belum punya akun?</span>
                        <a href="{{ url('/register') }}" class="text-secondary font-weight-bold">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
