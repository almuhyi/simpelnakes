@extends('web.default.panel.layouts.panel_layout')

@section('content')
    <section>
        <h2 class="section-title">Statistik artikel</h2>

        <div class="activities-container mt-25 p-20 p-lg-35">
            <div class="row">
                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/46.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $postsCount }}</strong>
                        <span class="font-16 text-gray font-weight-500">Artikel</span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/47.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $commentsCount }}</strong>
                        <span class="font-16 text-gray font-weight-500">Komentar</span>
                    </div>
                </div>

                <div class="col-4 d-flex align-items-center justify-content-center">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="{{ asset('') }}assets/default/img/activity/48.svg" width="64" height="64" alt="">
                        <strong class="font-30 text-dark-blue font-weight-bold mt-5">{{ $pendingPublishCount }}</strong>
                        <span class="font-16 text-gray font-weight-500">Tertunda untuk Publikasikan</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mt-35">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Artikel</h2>
        </div>

        @if($posts->count() > 0)

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <th class="text-left">Judul</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Komentar</th>
                                    <th class="text-center">Dilihat</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Tanggal dibuat</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($posts as $post)
                                    <tr>
                                        <td class="text-left">
                                            <a href="{{ url($post->getUrl()) }}" target="_blank">{{ $post->title }}</a>
                                        </td>
                                        <td class="text-center align-middle">{{ $post->category->title }}</td>
                                        <td class="text-center align-middle">{{ $post->comments_count }}</td>
                                        <td class="text-center align-middle">{{ $post->visit_count }}</td>

                                        <td class="text-center align-middle">
                                            @if($post->status == 'publish')
                                                <span class="text-primary">Dipublish</span>
                                            @else
                                                <span class="text-warning">Tertunda</span>
                                            @endif
                                        </td>

                                        <td class="text-center align-middle">{{ dateTimeFormat($post->created_at, 'j M Y H:i') }}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group dropdown table-actions">
                                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i data-feather="more-vertical" height="20"></i>
                                                </button>
                                                <div class="dropdown-menu font-weight-normal">
                                                    <a href="{{ url('') }}/panel/blog/posts/{{ $post->id }}/edit" class="webinar-actions d-block mt-10">Edit</a>
                                                    <a href="{{ url('') }}/panel/blog/posts/{{ $post->id }}/delete" data-item-id="1" class="webinar-actions d-block mt-10 delete-action">Hapus</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else

            @include(getTemplate() . '.includes.no-result',[
                'file_name' => 'quiz.png',
                'title' => ('Tidak ada artikel!'),
                'hint' => nl2br(('Buat artikel pertama Anda dan bagikan pengetahuan Anda.')),
                'btn' => ['url' => '/panel/blog/posts/new','text' => 'Buat artikel']
            ])

        @endif

    </section>

    <div class="my-30">
        {{ $posts->appends(request()->input())->links('vendor.pagination.panel') }}
    </div>
@endsection
