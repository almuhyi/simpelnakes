@extends(getTemplate().'.layouts.app')


@section('content')
    <section class="cart-banner position-relative text-center">
        <h1 class="font-30 text-white font-weight-bold">Keranjang belanja</h1>
        <span class="payment-hint font-20 text-white d-block"> {{ addCurrencyToPrice(handlePriceFormat($subTotal)) . ' ' . 'untuk' . ' ' . $carts->count() }} barang</span>
    </section>

    <div class="container">
        <section class="mt-45">
            <h2 class="section-title">Barang keranjang</h2>

            <div class="rounded-sm shadow mt-20 py-25 px-10 px-md-30">
                @if($carts->count() > 0)
                    <div class="row d-none d-md-flex">
                        <div class="col-12 col-lg-8"><span
                                class="text-gray font-weight-500">Barang</span></div>
                        <div class="col-6 col-lg-2 text-center"><span
                                class="text-gray font-weight-500">Harga</span></div>
                        <div class="col-6 col-lg-2 text-center"><span
                                class="text-gray font-weight-500">Hapus</span></div>
                    </div>
                @endif
                @foreach($carts as $cart)
                    <div class="row mt-5 cart-row">
                        <div class="col-12 col-lg-8 mb-15 mb-md-0">
                            <div class="webinar-card webinar-list-cart row">
                                <div class="col-4">
                                    <div class="image-box">
                                        @php
                                            $cartItemInfo = $cart->getItemInfo();
                                        @endphp
                                        <img src="{{ asset($cartItemInfo['imgPath']) }}" class="img-cover" alt="user avatar">
                                    </div>
                                </div>

                                <div class="col-8">
                                    <div class="webinar-card-body p-0 w-100 h-100 d-flex flex-column">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ url($cartItemInfo['itemUrl'] ?? '#!') }}" target="_blank">
                                                <h3 class="font-16 font-weight-bold text-dark-blue">{{ $cartItemInfo['title'] }}</h3>
                                            </a>
                                        </div>

                                        @if(!empty($cart->reserve_meeting_id))
                                            <div class="mt-10">
                                                <span class="text-gray font-12 border rounded-pill py-5 px-10">{{ $cart->reserveMeeting->day .' '. $cart->reserveMeeting->meetingTime->time }} ({{ $cart->reserveMeeting->meeting->getTimezone() }})</span>
                                            </div>

                                            @if($cart->reserveMeeting->meeting->getTimezone() != getTimezone())
                                                <div class="mt-10">
                                                    <span class="text-danger font-12 border border-danger rounded-pill py-5 px-10">{{ $cart->reserveMeeting->day .' '. dateTimeFormat($cart->reserveMeeting->start_at,'h:iA',false).'-'.dateTimeFormat($cart->reserveMeeting->end_at,'h:iA',false) }} ({{ getTimezone() }})</span>
                                                </div>
                                            @endif
                                        @endif

                                        <span class="text-gray font-14 mt-auto">
                                            Oleh
                                            <a href="{{ url($cartItemInfo['profileUrl']) }}" target="_blank" class="text-gray text-decoration-underline">{{ $cartItemInfo['teacherName'] }}</a>
                                        </span>

                                        @include('web.default.includes.webinar.rate',['rate' => $cartItemInfo['rate']])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-lg-2 d-flex flex-md-column align-items-center justify-content-center">
                            <span class="text-gray d-inline-block d-md-none">Harga :</span>

                            @if(!empty($cartItemInfo['discountPrice']))
                                <span class="text-gray text-decoration-line-through mx-10 mx-md-0">{{ handlePrice($cartItemInfo['price'], true, true) }}</span>
                                <span class="font-20 text-primary mt-0 mt-md-5 font-weight-bold">{{ handlePrice($cartItemInfo['discountPrice'], true, true) }}</span>
                            @else
                                <span class="font-20 text-primary mt-0 mt-md-5 font-weight-bold">{{ handlePrice($cartItemInfo['price'], true, true) }}</span>
                            @endif

                            @if(!empty($cartItemInfo['quantity']))
                                <span class="font-12 text-warning font-weight-500 mt-0 mt-md-5">({{ $cartItemInfo['quantity'] }} Produk)</span>
                            @endif
                        </div>

                        <div class="col-6 col-lg-2 d-flex flex-md-column align-items-center justify-content-center">
                            <span class="text-gray d-inline-block d-md-none mr-10 mr-md-0">Hapus :</span>

                            <a href="{{ url('') }}/cart/{{ $cart->id }}/delete" class="delete-action btn-cart-list-delete d-flex align-items-center justify-content-center">
                                <i data-feather="x" width="20" height="20" class=""></i>
                            </a>
                        </div>
                    </div>
                @endforeach

                <button type="button" onclick="window.history.back()" class="btn btn-sm btn-primary mt-25">Lanjutkan belanja</button>
            </div>
        </section>

        <form action="{{ url('/cart/checkout') }}" method="post" id="cartForm">
            {{ csrf_field() }}
            <input type="hidden" name="discount_id" value="">

            @if($hasPhysicalProduct)
                @include('web.default.cart.includes.shipping_and_delivery')
            @endif

            <div class="row mt-30">
                <div class="col-12 col-lg-6">
                    <section class="mt-45">
                        <h3 class="section-title">Kode kupon</h3>
                        <div class="rounded-sm shadow mt-20 py-25 px-20">
                            <p class="text-gray font-14">
                                Jika Anda memiliki kode kupon, masukkan kode di input berikut dan klik tombol "Validasi".</p>
                            @if(!empty($userGroup) and !empty($userGroup->discount))
                                <p class="text-gray mt-25">Anda berada di grup "{{ $userGroup->name }}" dan Anda akan mendapatkan diskon tambahan {{ $userGroup->discount }}%</p>
                            @endif

                            <form action="{{ url('/carts/coupon/validate') }}" method="Post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="coupon" id="coupon_input" class="form-control mt-25"
                                           placeholder="Masukkan kodemu di sini">
                                    <span class="invalid-feedback">Kode kupon tidak berlaku.</span>
                                    <span class="valid-feedback">Kode kupon berlaku.</span>
                                </div>

                                <button type="submit" id="checkCoupon"
                                        class="btn btn-sm btn-primary mt-50">Validasi</button>
                            </form>
                        </div>
                    </section>
                </div>

                <div class="col-12 col-lg-6">
                    <section class="mt-45">
                        <h3 class="section-title">Total keranjang</h3>
                        <div class="rounded-sm shadow mt-20 pb-20 px-20">

                            <div class="cart-checkout-item">
                                <h4 class="text-secondary font-14 font-weight-500">Subtotal</h4>
                                <span class="font-14 text-gray font-weight-bold">{{ addCurrencyToPrice(handlePriceFormat($subTotal)) }}</span>
                            </div>

                            <div class="cart-checkout-item">
                                <h4 class="text-secondary font-14 font-weight-500">Diskon</h4>
                                <span class="font-14 text-gray font-weight-bold">
                                <span id="totalDiscount">{{ addCurrencyToPrice(handlePriceFormat($totalDiscount)) }}</span>
                            </span>
                            </div>

                            <div class="cart-checkout-item">
                                <h4 class="text-secondary font-14 font-weight-500">Pajak
                                    @if(!$taxIsDifferent)
                                        <span class="font-14 text-gray ">({{ $tax }}%)</span>
                                    @endif
                                </h4>
                                <span class="font-14 text-gray font-weight-bold"><span id="taxPrice">{{ addCurrencyToPrice(handlePriceFormat($taxPrice)) }}</span></span>
                            </div>

                            @if(!empty($productDeliveryFee))
                                <div class="cart-checkout-item">
                                    <h4 class="text-secondary font-14 font-weight-500">Biaya pengiriman
                                    </h4>
                                    <span class="font-14 text-gray font-weight-bold"><span id="taxPrice">{{ addCurrencyToPrice(handlePriceFormat($productDeliveryFee)) }}</span></span>
                                </div>
                            @endif

                            <div class="cart-checkout-item border-0">
                                <h4 class="text-secondary font-14 font-weight-500">Total</h4>
                                <span class="font-14 text-gray font-weight-bold"><span id="totalAmount">{{ addCurrencyToPrice(handlePriceFormat($total)) }}</span></span>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary mt-15">Periksa</button>
                        </div>
                    </section>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts_bottom')
    <script>
        var couponInvalidLng = '{{ ('Kode kupon tidak berlaku') }}';
        var selectProvinceLang = '{{ ('Pilih provinsi') }}';
        var selectCityLang = '{{ ('Pilih Kota') }}';
        var selectDistrictLang = '{{ ('Pilih daerah') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/parts/get-regions.min.js"></script>
    <script src="{{ asset('') }}assets/default/js/parts/cart.min.js"></script>
@endpush
