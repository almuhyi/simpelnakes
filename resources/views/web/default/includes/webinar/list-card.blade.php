<div class="webinar-card webinar-list webinar-list-2 d-flex mt-30">
    <div class="image-box">


        <a href="{{ url($webinar->getUrl()) }}">
            <img src="{{ asset($webinar->getImage()) }}" class="img-cover" alt="{{ $webinar->title }}">
        </a>

        <div class="progress-and-bell d-flex align-items-center">

            @if($webinar->type == 'webinar')
                <a href="{{ url($webinar->addToCalendarLink()) }}" target="_blank" class="webinar-notify d-flex align-items-center justify-content-center">
                    <i data-feather="bell" width="20" height="20" class="webinar-icon"></i>
                </a>
            @endif

            @if($webinar->type == 'webinar')
                <div class="progress ml-10">
                    <span class="progress-bar" style="width: {{ $webinar->getProgress() }}%"></span>
                </div>
            @endif
        </div>
    </div>

    <div class="webinar-card-body w-100 d-flex flex-column">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ url($webinar->getUrl()) }}">
                <h3 class="mt-15 webinar-title font-weight-bold font-16 text-dark-blue">{{ clean($webinar->title,'title') }}</h3>
            </a>
        </div>

        @if(!empty($webinar->category))
            <span class="d-block font-14 mt-10">kategori <a href="{{ url($webinar->category->getUrl()) }}" target="_blank" class="text-decoration-underline">{{ $webinar->category->title }}</a></span>
        @endif

        <div class="user-inline-avatar d-flex align-items-center mt-10">
            <div class="avatar bg-gray200">
                <img src="{{ asset($webinar->teacher->getAvatar()) }}" class="img-cover" alt="{{ $webinar->teacher->full_name }}">
            </div>
            <a href="{{ url($webinar->teacher->getProfileUrl()) }}" target="_blank" class="user-name ml-5 font-14">{{ $webinar->teacher->full_name }}</a>
        </div>

        @include(getTemplate() . '.includes.webinar.rate',['rate' => $webinar->getRate()])

        <div class="d-flex justify-content-between mt-auto">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <i data-feather="clock" width="20" height="20" class="webinar-icon"></i>
                    <span class="duration ml-5 font-14">{{ convertMinutesToHourAndMinute($webinar->duration) }} Jam</span>
                </div>

                <div class="vertical-line h-25 mx-15"></div>

                <div class="d-flex align-items-center">
                    <i data-feather="calendar" width="20" height="20" class="webinar-icon"></i>
                    <span class="date-published ml-5 font-14">{{ dateTimeFormat(!empty($webinar->start_date) ? $webinar->start_date : $webinar->created_at,'j M Y') }}</span>
                </div>
            </div>


        </div>
    </div>
</div>
