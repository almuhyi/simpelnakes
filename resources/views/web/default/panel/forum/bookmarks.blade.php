@extends('web.default.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.css">
@endpush

@section('content')

    <section class="mt-35">
        <div class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
            <h2 class="section-title">Bookmarks</h2>
        </div>

        @if($topics->count() > 0)

            <div class="panel-section-card py-20 px-25 mt-20">
                <div class="row">
                    <div class="col-12 ">
                        <div class="table-responsive">
                            <table class="table text-center custom-table">
                                <thead>
                                <tr>
                                    <th class="text-left">Topik</th>
                                    <th class="text-center">Forum</th>
                                    <th class="text-center">Balasan</th>
                                    <th class="text-center">Tanggal dipublish</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($topics as $topic)
                                    <tr>
                                        <td class="text-left align-middle">
                                            <div class="user-inline-avatar d-flex align-items-center">
                                                <div class="avatar bg-gray200">
                                                    <img src="{{ asset($topic->creator->getAvatar(48)) }}" class="img-cover" alt="">
                                                </div>
                                                <a href="{{ url($topic->getPostsUrl()) }}" target="_blank" class="">
                                                    <div class=" ml-5">
                                                        <span class="d-block font-16 font-weight-500 text-dark-blue">{{ $topic->title }}</span>
                                                        <span class="font-12 text-gray mt-5">Oleh {{ $topic->creator->full_name }}</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">{{ $topic->forum->title }}</td>
                                        <td class="text-center align-middle">{{ $topic->posts_count }}</td>
                                        <td class="text-center align-middle">{{ dateTimeFormat($topic->created_at, 'j M Y H:i') }}</td>
                                        <td class="text-center align-middle">
                                            <a
                                                href="{{ url('') }}/panel/forums/topics/{{ $topic->id }}/removeBookmarks"
                                                data-title="Topik ini akan dihapus dari bookmark Anda"
                                                data-confirm="Konfirmasi"
                                                class="panel-remove-bookmark-btn delete-action d-flex align-items-center justify-content-center p-5 rounded-circle">
                                                <i data-feather="bookmark" width="18" height="18" class="text-danger"></i>
                                            </a>
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
                'file_name' => 'comment.png',
                'title' => ('Tidak ada Bookmark!'),
                'hint' => nl2br(('Anda dapat menjelajahi forum dan menandai topik untuk penggunaan di masa mendatang.')),
            ])

        @endif

    </section>

    <div class="my-30">
        {{ $topics->appends(request()->input())->links('vendor.pagination.panel') }}
    </div>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>
@endpush
