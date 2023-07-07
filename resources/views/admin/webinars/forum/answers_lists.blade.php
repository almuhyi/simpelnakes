@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Pelatihan</div>

                <div class="breadcrumb-item">{{ $pageTitle }}</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">

                        <div class="card-body ">

                            {{-- Question Card --}}
                            <div class="d-flex align-items-start mb-3 border rounded-lg p-2">
                                <img class="avatar mr-2" src="{{ $question->user->getAvatar() }}">

                                <div class="ml-2">
                                    <div class="font-weight-bold">{{ $question->user->full_name }}</div>

                                    <h3 class="mt-2 font-16 font-weight-bold">{{ $question->title }}</h3>
                                    <div class="mt-1">{!! $question->description !!}</div>

                                    <div class="mt-2">
                                        <span class="mr-2">{{ dateTimeFormat($question->created_at,'Y M j | H:i') }}</span>

                                        @if(!empty($question->attach))
                                            <a href="{{ $course->getForumPageUrl() }}/{{ $question->id }}/downloadAttach" target="_blank" class="text-success"><i class="fa fa-paperclip"></i> Buka Lampiran</a>
                                        @endif

                                        <button type="button" data-action="/admin/webinars/{{ $course->id }}/forums/{{ $question->id }}/edit" class="js-answer-edit btn-transparent ml-2 font-14 font-weight-500 text-gray">Edit</button>

                                        @include('admin.includes.delete_button', [
                                            'url' => "/admin/webinars/$course->id/forums/$question->id/delete",
                                            'btnText' => 'Hapus',
                                            'btnClass' => 'ml-2 font-14 font-weight-500 text-danger'
                                        ])
                                    </div>
                                </div>
                            </div>

                            {{-- Answers Cards --}}

                            @foreach($answers as $answer)
                                <div class="d-flex align-items-start mb-3 border rounded-lg p-2 {{ $answer->resolved ? 'border-danger' : '' }}">
                                    <img src="{{ $answer->user->getAvatar() }}">

                                    <div class="ml-2">

                                        <div class="font-weight-bold">{{ $answer->user->full_name }}</div>

                                        <div class="mt-1">{!! $answer->description !!}</div>

                                        <div class="d-flex align-items-center mt-2">
                                            <span class="">{{ dateTimeFormat($answer->created_at,'Y M j | H:i') }}</span>

                                            @if($answer->resolved)
                                                <span class="text-danger ml-2">Terselesaikan</span>
                                            @endif

                                            @if($answer->pin)
                                                <span class="text-success ml-2">Pin</span>
                                            @endif

                                            <button type="button" data-action="/admin/webinars/{{ $course->id }}/forums/{{ $question->id }}/answers/{{ $answer->id }}/edit" class="js-answer-edit btn-transparent ml-2 font-14 font-weight-500 text-gray">Edit</button>

                                            @include('admin.includes.delete_button', [
                                                'url' => "/admin/webinars/$course->id/forums/$question->id/answers/$answer->id/delete",
                                                'btnText' => 'Hapus',
                                                'btnClass' => 'ml-2 font-14 font-weight-500 text-danger'
                                            ])
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script>
        var editPostLang = '{{ ('Edit post') }}';
        var titleLang = '{{ ('Judul') }}';
        var descriptionLang = '{{ ('Deskripsi') }}';
        var sendLang = '{{ ('Kirim') }}';
        var oopsLang = '{{ ('oops...') }}';
        var somethingWentWrongLang = '{{ ('Ada yang salah...') }}';
        var editAttachmentLabelLang = '{{ ('Lampirkan file') }} ({{ ('Opsional') }})';
        var savedSuccessfullyLang = '{{ ('Perubahan berhasil disimpan.') }}'
    </script>
    <script src="/assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/assets/default/js/admin/course-forum-answers.min.js"></script>
@endpush
