@extends('admin.layouts.app')

@push('styles_top')

@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ url('/admin/assignments') }}">Tugas</a></div>
                <div class="breadcrumb-item"><a href="{{ url('') }}/admin/assignments/{{ $assignment->id }}/students">Peserta</a></div>
                <div class="breadcrumb-item">Percakapan</div>
            </div>
        </div>


        <div class="section-body">

            <div class="row">
                <div class="col-12 ">
                    <div class="card chat-box" id="mychatbox2">

                        <div class="card-body chat-content">

                            @foreach($conversations as $conversation)
                                <div class="chat-item chat-{{ !empty($conversation->sender_id == $assignment->creator_id) ? 'right' : 'left' }}">
                                    <img src="{{ asset($conversation->sender->getAvatar(50)) }}">

                                    <div class="chat-details">

                                        <div class="chat-time">{{ $conversation->sender->full_name }}</div>

                                        <div class="chat-text">{!! $conversation->message !!}</div>
                                        <div class="chat-time">
                                            <span class="mr-2">{{ dateTimeFormat($conversation->created_at,'Y M j | H:i') }}</span>

                                            @if(!empty($conversation->file_path))
                                                <a href="{{ $conversation->getDownloadUrl($assignment->id) }}" target="_blank" class="text-success">
                                                    <i class="fa fa-paperclip"></i>
                                                    Buka lampiran
                                                </a>
                                            @endif
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


@endpush
