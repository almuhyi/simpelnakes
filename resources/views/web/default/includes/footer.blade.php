@php
    $socials = getSocials();
    if (!empty($socials) and count($socials)) {
        $socials = collect($socials)->sortBy('order')->toArray();
    }

    $footerColumns = getFooterColumns();
@endphp

<footer class="footer bg-secondary position-relative user-select-none">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class=" footer-subscribe d-block d-md-flex align-items-center justify-content-between">
                    <div class="flex-grow-1">
                        <strong>Join Us Today</strong>
                        <span class="d-block mt-5 text-white">#ikuti kami untuk mendapatkan informasi terbaru melalui email</span>
                    </div>
                    <div class="subscribe-input bg-white p-10 flex-grow-1 mt-30 mt-md-0">
                        <form action="{{ url('/newsletters') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group d-flex align-items-center m-0">
                                <div class="w-100">
                                    <input type="text" name="newsletter_email" class="form-control border-0 @error('newsletter_email') is-invalid @enderror" placeholder="Masukan email disini."/>
                                    @error('newsletter_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary rounded-pill">Ikuti</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $columns = ['first_column','second_column','third_column'];
    @endphp

    <div class="container">
        <div class="row">

            {{-- @foreach($columns as $column)
                <div class="col-6 col-md-4">
                    @if(!empty($footerColumns[$column]))
                        @if(!empty($footerColumns[$column]['title']))
                            <span class="header d-block text-white font-weight-bold">{{ $footerColumns[$column]['title'] }}</span>
                        @endif

                        @if(!empty($footerColumns[$column]['value']))
                            <div class="mt-20">
                                {!! $footerColumns[$column]['value'] !!}
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach --}}

        </div>

        <div class="mt-40 border-blue py-25 d-flex align-items-center justify-content-between">
            <div class="footer-logo">
                <a href="{{ url('/') }}">
                    @if(!empty($generalSettings['footer_logo']))
                        <img src="{{ asset($generalSettings['footer_logo']) }}" class="img-cover" alt="footer logo">
                    @endif
                </a>
            </div>
            <div class="footer-social">
                @if(!empty($socials) and count($socials))
                    @foreach($socials as $social)
                        <a href="{{ url($social['link']) }}">
                            <img src="{{ asset($social['image']) }}" alt="{{ $social['title'] }}" class="mr-15">
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</footer>
