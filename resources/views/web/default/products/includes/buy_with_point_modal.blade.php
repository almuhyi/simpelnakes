<div class="d-none" id="buyWithPointModal">
    <h3 class="section-title font-16 text-dark-blue mb-25">Beli dengan poin</h3>

    @if(!empty($user))
        <div class="text-center">
            <img src="/assets/default/img/rewards/medal-2.png" class="buy-with-points-modal-img" alt="medal">

            <p class="font-14 font-weight-500 text-gray mt-30">
                <span class="js-product-require-point-text d-block">Produk ini membutuhkan {!! $product->point !!} poin</span>
                <span class="d-block">Kamu mempunyai {{ $user->getRewardPoints() }} poin</span>

                @if($user->getRewardPoints() >= $product->point)
                    <span class="d-block">
                        Apakah Anda ingin melanjutkan?</span>
                @else
                    <span class="d-block text-danger">
                        Anda tidak memiliki cukup poin untuk mendaftar di pelatihan ini...</span>
                @endif
            </p>
        </div>

        <div class="d-flex align-items-center mt-25">
            <a href="#!" class="btn btn-sm flex-grow-1 {{ ($user->getRewardPoints() >= $product->point) ? 'btn-primary js-buy-product-with-point-modal-btn' : 'bg-gray300 text-gray disabled' }}" data-action="{{ ($user->getRewardPoints() >= $product->point) ? '/products/'. $product->slug .'/points/apply' : '#' }}">Beli</a>
            <a href="/panel/rewards" class="btn btn-outline-primary ml-15 btn-sm flex-grow-1">Poin saya</a>
        </div>
    @endif
</div>
