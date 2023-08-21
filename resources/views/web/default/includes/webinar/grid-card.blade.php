<div class="webinar-card">
    <figure>
        <div class="image-box">


            <a href="{{ url($webinar->getUrl()) }}">
                <img src="{{ asset($webinar->getImage()) }}" class="img-cover" alt="{{ $webinar->title }}">
            </a>

            @if($webinar->type == 'webinar')
                <div class="progress">
                    <span class="progress-bar" style="width: {{ $webinar->getProgress() }}%"></span>
                </div>

                <a href="{{ url($webinar->addToCalendarLink()) }}" target="_blank" class="webinar-notify d-flex align-items-center justify-content-center">
                    <i data-feather="bell" width="20" height="20" class="webinar-icon"></i>
                </a>
            @endif
        </div>

        <figcaption class="webinar-card-body">
            <div class="user-inline-avatar d-flex align-items-center">
                <div class="avatar bg-gray200">
                    <img src="{{ asset($webinar->teacher->getAvatar()) }}" class="img-cover" alt="{{ $webinar->teacher->full_name }}">
                </div>
                <a href="{{ url($webinar->teacher->getProfileUrl()) }}" target="_blank" class="user-name ml-5 font-14">{{ $webinar->teacher->full_name }}</a>
            </div>

            <a href="{{ url($webinar->getUrl()) }}">
                <h3 class="mt-15 webinar-title font-weight-bold font-16 text-dark-blue">{{ clean($webinar->title,'title') }}</h3>
            </a>

            @if(!empty($webinar->category))
                <span class="d-block font-14 mt-10">Kategori <a href="{{ url($webinar->category->getUrl()) }}" target="_blank" class="text-decoration-underline">{{ $webinar->category->title }}</a></span>
            @endif

            @include(getTemplate() . '.includes.webinar.rate',['rate' => $webinar->getRate()])

            <div class="d-flex justify-content-between mt-20">
                <div class="d-flex align-items-center">
                    <i data-feather="clock" width="20" height="20" class="webinar-icon"></i>
                    <span class="duration font-14 ml-5">{{ convertMinutesToHourAndMinute($webinar->duration) }} Jam</span>
                </div>

                <div class="vertical-line mx-15"></div>

                <div class="d-flex align-items-center">
                    <i data-feather="calendar" width="20" height="20" class="webinar-icon"></i>
                    <span class="date-published font-14 ml-5">{{ dateTimeFormat(!empty($webinar->start_date) ? $webinar->start_date : $webinar->created_at,'j M Y') }}</span>
                </div>
            </div>

        </figcaption>
    </figure>
</div>
