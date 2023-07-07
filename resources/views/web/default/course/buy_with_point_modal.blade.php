<div class="d-none" id="buyWithPointModal">
    <h3 class="section-title font-16 text-dark-blue mb-25">Beli dengan poin</h3>

    @if(!empty($user))
        <div class="text-center">
            <img src="{{ asset('') }}assets/default/img/rewards/medal-2.png" class="buy-with-points-modal-img" alt="medal">

            <p class="font-14 font-weight-500 text-gray mt-30">
                <span class="d-block">Pelatihan ini membutuhkan {{ $course->points }} poin</span>
                <span class="d-block">Anda memiliki {{ $user->getRewardPoints() }} poin</span>

                @if($user->getRewardPoints() >= $course->points)
                    <span class="d-block">
                        Apakah Anda ingin melanjutkan?</span>
                @else
                    <span class="d-block text-danger">Anda tidak memiliki cukup poin untuk mendaftar di pelatihan ini...</span>
                @endif
            </p>
        </div>

        <div class="d-flex align-items-center mt-25">
            <a href="{{ url(($user->getRewardPoints() >= $course->points) ? '/course/'. $course->slug .'/points/apply' : '#') }}" class="btn btn-sm flex-grow-1 {{ ($user->getRewardPoints() >= $course->points) ? 'btn-primary js-buy-course-with-point' : 'bg-gray300 text-gray disabled' }}">Beli</a>
            <a href="{{url ('/panel/rewards') }}" class="btn btn-outline-primary ml-15 btn-sm flex-grow-1">Poinku</a>
        </div>
    @endif
</div>
