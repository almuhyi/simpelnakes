@extends('web.default.layouts.app')

@section('content')
    <section class="forum-hero-section mt-50 position-relative">
        <div class="container forum-hero-section__container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1 class="font-36 text-secondary">
                        <span>Butuh bantuan?</span><br/>
                        <span>Buat topik di forum...</span>
                    </h1>
                    <p class="font-14 text-gray mt-15">Jika Anda memerlukan bantuan untuk topik diskusi apa pun yang disertakan, Anda dapat membuat topik di forum dan memulai diskusi dengan pengguna lain.</p>

                    <div class="search-input bg-white p-10 flex-grow-1 mt-25">
                        <form action="{{ url('/forums/search') }}" method="get">
                            <div class="form-group d-flex align-items-center m-0">
                                <input type="text" name="search" class="form-control border-0" placeholder="Cari topik diskusi"/>
                                <button type="submit" class="btn btn-primary rounded-pill">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="forum-hero-section__image">
            <img src="{{ asset('') }}assets/default/img/forum/hero.png" class="img-cover" alt="forum hero">
        </div>
    </section>

    <div class="container mt-40">
        <div class="forum-stat-section rounded-lg bg-white p-20">
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <img src="{{ asset('') }}assets/default/img/forum/1.svg" alt="Forum" class="forum-stat-icon"/>
                        <span class="font-30 font-weight-bold text-secondary">{{ $forumsCount }}</span>
                        <span class="font-16 font-weight-500 text-gray">Forum</span>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <img src="{{ asset('') }}assets/default/img/forum/2.svg" alt="Topik" class="forum-stat-icon"/>
                        <span class="font-30 font-weight-bold text-secondary">{{ $topicsCount }}</span>
                        <span class="font-16 font-weight-500 text-gray">Topik</span>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <img src="{{ asset('') }}assets/default/img/forum/3.svg" alt="Post" class="forum-stat-icon"/>
                        <span class="font-30 font-weight-bold text-secondary">{{ $postsCount }}</span>
                        <span class="font-16 font-weight-500 text-gray">Post</span>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <img src="{{ asset('') }}assets/default/img/forum/4.svg" alt="Anggota" class="forum-stat-icon"/>
                        <span class="font-30 font-weight-bold text-secondary">{{ $membersCount }}</span>
                        <span class="font-16 font-weight-500 text-gray">Anggota</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($featuredTopics) and count($featuredTopics))
        <section class="container forums-featured-section mt-30 mt-md-50">

            <div class="text-center mb-30">
                <h2 class="font-30 font-weight-bold text-secondary">Topic unggulan</h2>
                <p class="font-14 text-gray">Jelajahi topik unggulan dan terlibat dalam percakapan</p>
            </div>

            @foreach($featuredTopics as $featuredTopic)
                <div class="forums-featured-card d-flex align-items-center bg-white p-20 p-md-35 rounded-lg mt-15">
                    <div class="forums-featured-card-icon">
                        <img src="{{ asset($featuredTopic->icon) }}" alt="{{ $featuredTopic->topic->title }}" class="img-cover">
                    </div>

                    <div class="ml-15">
                        <a href="{{ url($featuredTopic->topic->getPostsUrl()) }}" class="">
                            <h4 class="font-16 font-weight-bold text-dark">{{ $featuredTopic->topic->title }}</h4>
                        </a>
                        <p class="font-14 text-gray">{!! truncate(strip_tags($featuredTopic->topic->description),100) !!}</p>
                        <div class="mt-15 d-flex align-items-end">
                            @if($featuredTopic->topic->posts_count > 0 or (!empty($featuredTopic->usersAvatars) and count($featuredTopic->usersAvatars)))
                                <div class="forums-featured-card-users-avatar d-flex align-items-center mr-10">
                                    @foreach($featuredTopic->usersAvatars as $userAvatar)
                                        <div class="user-avatar-card rounded-circle">
                                            <img src="{{ asset($userAvatar->getAvatar(32)) }}" class="img-cover rounded-circle" alt="{{ $userAvatar->full_name }}">
                                        </div>
                                    @endforeach

                                    @if(($featuredTopic->topic->posts_count - count($featuredTopic->usersAvatars)) > 0)
                                        <span class="topics-count d-flex align-items-center justify-content-center font-12 text-gray rounded-circle">+{{ ($featuredTopic->topic->posts_count - count($featuredTopic->usersAvatars)) }}</span>
                                    @endif
                                </div>
                            @endif

                            <div class="d-flex align-items-center">
                                <div class="text-gray font-12">dibuat oleh <span class="font-weight-bold">{{ $featuredTopic->topic->creator->full_name }}</span></div>

                                <div class="text-gray font-12 ml-5 pl-5 border-left">{{ $featuredTopic->topic->posts_count }} Post</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="forums-featured-bg-box"></div>
        </section>
    @endif



    @if(!empty($recommendedTopics) and count($recommendedTopics))
        <section class="container forum-recommended-topics-section position-relative mt-25">
            <div class="text-center">
                <h2 class="font-30 font-weight-bold text-secondary">Topik yang direkomendasikan</h2>
                <p class="font-14 text-gray">Jelajahi topik paling populer di komunitas, nikmati & bagikan ide hebat Anda dengan orang lain.</p>
            </div>

            <div class="row mt-20 position-relative">
                @foreach($recommendedTopics as $recommendedTopic)
                    <div class="col-12 col-md-3 mt-15">
                        <div class="forum-recommended-topics__card position-relative rounded-lg bg-white px-20 py-30">
                            <div class="forum-recommended-topics__icon">
                                <img src="{{ asset($recommendedTopic->icon) }}" alt="{{ $recommendedTopic->title }}" class="img-cover">
                            </div>

                            <h4 class="font-16 font-weight-bold text-secondary mt-10">{{ $recommendedTopic->title }}</h4>

                            <div class="forum-recommended-topics__lists mt-5">
                                @foreach($recommendedTopic->topics as $topic)
                                    <a href="{{ url($topic->getPostsUrl()) }}" class="d-flex align-items-center text-gray font-14 font-weight-500 mt-15">
                                        <i data-feather="chevron-right" class="mr-5 text-primary" width="16" height="16"></i>
                                        <span>{{ truncate($topic->title,25) }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="forums-recommended-topics-bg-box"></div>
        </section>
    @endif

    <section class="container forum-question-section bg-info-light rounded-lg mt-25 mt-md-45">
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="px-10 px-md-25 py-25 p-md-50">
                    <h1 class="font-36 font-weight-bold text-secondary">
                        <span class="d-block">Punya pertanyaan?</span>
                        <span class="d-block">Tanyakan dan diskusikan di forum dan dapatkan jawabannya.</span>
                    </h1>

                    <p class="mt-15 text-gray font-14">Forum kami membantu Anda membuat pertanyaan dalam berbagai topik dan berdiskusi dengan pengguna forum lainnya.
                        Pengguna kami akan membantu Anda mendapatkan jawaban terbaik!</p>

                    <div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center mt-15">
                        <a href="{{ url('/forums/create-topic') }}" class="btn btn-primary">
                            <i data-feather="file" class="mr-5 text-white" width="16" height="16"></i>
                            Buat topik baru
                        </a>

                        <a href="" class="btn btn-outline-primary ml-0 ml-md-20 mt-15 mt-md-0">
                            Cari topik diskusi
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-5 d-none d-md-block position-relative">
                <div class="forum-question-section__img">
                    <img src="{{ asset('') }}assets/default/img/forum/question-section.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>
@endsection
