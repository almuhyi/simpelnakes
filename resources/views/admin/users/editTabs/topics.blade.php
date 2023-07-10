<div class="tab-pane mt-3 fade" id="topics" role="tabpanel" aria-labelledby="topics-tab">
    <div class="row">

        <div class="col-12">
            <h5 class="section-title after-line">Topik forum</h5>

            <div class="table-responsive mt-5">
                <table class="table table-striped table-md">
                    <tr>
                        <th>Topik</th>
                        <th>Kategori</th>
                        <th>Post</th>
                        <th>
                            Tanggal Dibuat</th>
                        <th>Tanggal Diperbarui</th>
                        <th class="text-right">Aksi</th>
                    </tr>

                    @if(!empty($topics))
                        @foreach($topics as $topic)

                            <tr>
                                <td width="25%">
                                    <a href="{{ url($topic->getPostsUrl()) }}" target="_blank" class="">{{ $topic->title }}</a>
                                </td>

                                <td>
                                    {{ $topic->forum->title }}
                                </td>
                                <td>{{ $topic->posts_count }}</td>
                                <td class="text-center">{{ dateTimeFormat($topic->created_at,'j M Y | H:i') }}</td>
                                <td class="text-center">{{ (!empty($topic->posts) and count($topic->posts)) ? dateTimeFormat($topic->posts->first()->created_at,'j M Y | H:i') : '-' }}</td>
                                <td class="text-right">

                                    @can('admin_forum_topics_lists')
                                        @if(!$topic->close)
                                            @include('admin.includes.delete_button',[
                                                'url' => "/admin/forums/{$topic->forum_id}/topics/{$topic->id}/close",
                                                'tooltip' => 'Tutup',
                                                'btnClass' => 'mr-1',
                                                'btnIcon' => 'fa-lock'
                                            ])
                                        @else
                                            @include('admin.includes.delete_button',[
                                                'url' => "/admin/forums/{$topic->forum_id}/topics/{$topic->id}/open",
                                                'tooltip' => 'Buka',
                                                'btnClass' => 'mr-1',
                                                'btnIcon' => 'fa-unlock'
                                            ])
                                        @endif
                                    @endcan

                                    @can('admin_forum_topics_posts')
                                        <a href="{{ url('') }}/admin/forums/{{ $topic->forum_id }}/topics/{{ $topic->id }}/posts"
                                           class="btn-transparent btn-sm text-primary mr-1"
                                           data-toggle="tooltip" data-placement="top" title="Post"
                                        >
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endcan

                                    @can('admin_enrollment_block_access')
                                        @include('admin.includes.delete_button',[
                                                'url' => "/admin/forums/{$topic->forum_id}/topics/{$topic->id}/delete?no_redirect=true",
                                            ])
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
