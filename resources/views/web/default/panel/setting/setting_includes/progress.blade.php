@php
    $progressSteps = [
        1 => [
            'lang' => 'informasi dasar',
            'icon' => 'basic-info'
        ],

        2 => [
            'lang' => 'Gambar',
            'icon' => 'images'
        ],

        3 => [
            'lang' => 'Tentang',
            'icon' => 'about'
        ],

        4 => [
            'lang' => 'Pendidikan',
            'icon' => 'graduate'
        ],

        5 => [
            'lang' => 'Pengalaman',
            'icon' => 'experiences'
        ],

        6 => [
            'lang' => 'Profesi',
            'icon' => 'skills'
        ],

        7 => [
            'lang' => 'Identitas & finansial',
            'icon' => 'financial'
        ],

        9 => [
            'lang' => 'Informasi tambahan',
            'icon' => 'extra_info'
        ]
    ];

    if(!$user->isUser()) {
        $progressSteps[8] =[
            'lang' => 'Zoom API',
            'icon' => 'zoom'
        ];


    }

    $currentStep = empty($currentStep) ? 1 : $currentStep;
@endphp


<div class="webinar-progress d-block d-lg-flex align-items-center p-15 panel-shadow bg-white rounded-sm">

    @foreach($progressSteps as $key => $step)
        <div class="progress-item d-flex align-items-center">
            <a href="@if(!empty($organization_id))/panel/manage/{{ $user_type ?? 'instructors' }}/{{ $user->id }}/edit/step/{{ $key }} @else{{url('')}}/panel/setting/step/{{ $key }} @endif" class="progress-icon p-10 d-flex align-items-center justify-content-center rounded-circle {{ $key == $currentStep ? 'active' : '' }}" data-toggle="tooltip" data-placement="top" title="{{ trans($step['lang']) }}">
                <img src="{{ asset('') }}assets/default/img/icons/{{ $step['icon'] }}.svg" class="img-cover" alt="">
            </a>

            <div class="ml-10 {{ $key == $currentStep ? '' : 'd-lg-none' }}">
                <h4 class="font-16 text-secondary font-weight-bold">{{ $step['lang'] }}</h4>
            </div>
        </div>
    @endforeach
</div>
