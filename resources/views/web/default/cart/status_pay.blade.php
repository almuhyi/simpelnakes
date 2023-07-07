@extends(getTemplate().'.layouts.app')


@section('content')


    @if(!empty($order) && $order->status === \App\Models\Order::$paid)
        <div class="no-result default-no-result my-50 d-flex align-items-center justify-content-center flex-column">
            <div class="no-result-logo">
                <img src="{{ asset('') }}assets/default/img/no-results/search.png" alt="">
            </div>
            <div class="d-flex align-items-center flex-column mt-30 text-center">
                <h2>Selamat!</h2>
                <p class="mt-5 text-center">
                    Pembayaran Anda berhasil dilakukan...</p>
                <a href="{{ url('/panel') }}" class="btn btn-sm btn-primary mt-20">Panel saya</a>
            </div>
        </div>
    @endif

    @if(!empty($order) && $order->status === \App\Models\Order::$fail)
        <div class="no-result status-failed my-50 d-flex align-items-center justify-content-center flex-column">
            <div class="no-result-logo">
                <img src="{{ asset('') }}assets/default/img/no-results/failed_pay.png" alt="">
            </div>
            <div class="d-flex align-items-center flex-column mt-30 text-center">
                <h2>Pembayaran gagal!</h2>
                <p class="mt-5 text-center">Pembayaran gagal. Gerbang pembayaran tidak merespons.</p>
                <a href="{{ url('/panel') }}" class="btn btn-sm btn-primary mt-20">Panel saya</a>
            </div>
        </div>
    @endif


@endsection
