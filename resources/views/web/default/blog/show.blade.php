@extends(getTemplate().'.layouts.app')

@section('content')
    <section class="cart-banner position-relative text-center">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">

                    <h1 class="font-30 text-white font-weight-bold">{{ $post->title }}</h1>

                    <div class="d-flex flex-column flex-sm-row align-items-center align-sm-items-start justify-content-center">
                        @if(!empty($post->author))
                            <span class="mt-10 mt-md-20 font-16 font-weight-500 text-white">Dibuat oleh
                                @if($post->author->isTeacher())
                                    <a href="{{ url($post->author->getProfileUrl()) }}" target="_blank" class="text-white">{{ $post->author->full_name }}</a>
                                @elseif(!empty($post->author->full_name))
                                    <span class="text-white">{{ $post->author->full_name }}</span>
                                @endif
                                Pada

                                {{ dateTimeFormat($post->created_at, 'j M Y') }}
                            </span>
                        @endif
                    </div>
                    <span class="mt-10 font-16 font-weight-500 text-white">Kategori</span>
                    <a href="{{ url($post->category->getUrl()) }}" class="text-white text-decoration-underline">{{ $post->category->title }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-10 mt-md-40">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="post-show mt-30">

                    <div class="post-img pb-30">
                        <img src="{{ asset($post->image) }}" alt="">
                    </div>

                    {!! nl2br($post->content) !!}
                </div>

                {{-- post Comments --}}
                @if($post->enable_comment)
                    @include('web.default.includes.comments',[
                            'comments' => $post->comments,
                            'inputName' => 'blog_id',
                            'inputValue' => $post->id
                        ])
                @endif
                {{-- ./ post Comments --}}

            </div>
            <div class="col-12 col-lg-4">
                @if(!empty($post->author) and !empty($post->author->full_name))
                    <div class="rounded-lg shadow-sm mt-35 p-20 course-teacher-card d-flex align-items-center flex-column">
                        <div class="teacher-avatar mt-5">
                            <img src="{{ asset($post->author->getAvatar(100)) }}" class="img-cover" alt="">
                        </div>
                        <h3 class="mt-10 font-20 font-weight-bold text-secondary">{{ $post->author->full_name }}</h3>

                        @if(!empty($post->author->role))
                            <span class="mt-5 font-weight-500 font-14 text-gray">{{ $post->author->role->caption }}</span>
                        @endif

                        <div class="mt-25 d-flex align-items-center  w-100">
                            <a href="{{ url('') }}/blog?author={{ $post->author->id }}" class="btn btn-sm btn-primary btn-block px-15">Penulis</a>
                        </div>
                    </div>
                @endif

                {{-- categories --}}
                <div class="p-20 mt-30 rounded-sm shadow-lg border border-gray300">
                    <h3 class="category-filter-title font-16 font-weight-bold text-dark-blue">Kategori</h3>

                    <div class="pt-15">
                        @foreach($blogCategories as $blogCategory)
                            <a href="{{ url($blogCategory->getUrl()) }}" class="font-14 text-dark-blue d-block mt-15">{{ $blogCategory->title }}</a>
                        @endforeach
                    </div>
                </div>

                {{-- recent_posts --}}
                <div class="p-20 mt-30 rounded-sm shadow-lg border border-gray300">
                    <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">Tulisan Terbaru</h3>

                    <div class="pt-15">

                        @foreach($popularPosts as $popularPost)
                            <div class="popular-post d-flex align-items-start mt-20">
                                <div class="popular-post-image rounded">
                                    <img src="{{ asset($popularPost->image) }}" class="img-cover rounded" alt="{{ $popularPost->title }}">
                                </div>
                                <div class="popular-post-content d-flex flex-column ml-10">
                                    <a href="{{ url($popularPost->getUrl()) }}">
                                        <h3 class="font-14 text-dark-blue">{{ truncate($popularPost->title,40) }}</h3>
                                    </a>
                                    <span class="mt-auto font-12 text-gray">{{ dateTimeFormat($popularPost->created_at, 'j M Y') }}</span>
                                </div>
                            </div>
                        @endforeach

                        <a href="{{ url('/blog') }}" class="btn btn-sm btn-primary btn-block mt-30">Lihat semua post</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script>
        var webinarDemoLang = '{{ ('Demo pelatihan') }}';
        var replyLang = '{{ ('Balas') }}';
        var closeLang = '{{ ('Tutup') }}';
        var saveLang = '{{ ('Menyimpan') }}';
        var reportLang = '{{ ('Laporkan') }}';
        var reportSuccessLang = '{{ ('Laporan sukses') }}';
        var messageToReviewerLang = '{{ ('Pesan untuk pengulas') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/parts/comment.min.js"></script>
@endpush
