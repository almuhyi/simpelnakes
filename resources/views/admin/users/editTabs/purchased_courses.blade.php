<div class="tab-pane mt-3 fade" id="purchased_courses" role="tabpanel" aria-labelledby="purchased_courses-tab">
    <div class="row">

        @can('admin_enrollment_add_student_to_items')
            <div class="col-12 col-md-6">
                <h5 class="section-title after-line">Tambah ke dalam pelatihan</h5>

                <form action="{{ url('/admin/enrollments/store') }}" method="Post">

                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="form-group">
                        <label class="input-label">Pelatihan</label>
                        <select name="webinar_id" class="form-control search-webinar-select2"
                                data-placeholder="Pilih pelatihan">

                        </select>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class=" mt-4">
                        <button type="button" class="js-save-manual-add btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        @endcan

        <div class="col-12">
            <div class="mt-5">
                <h5 class="section-title after-line">Pelatihan yang Ditambahkan Secara Manual</h5>

                <div class="table-responsive mt-3">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>Pelatihan</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Instruktur</th>
                            <th class="text-center">
                                Tanggal Ditambahkan</th>
                            <th class="text-right">Aksi</th>
                        </tr>

                        @if(!empty($manualAddedClasses))
                            @foreach($manualAddedClasses as $manualAddedClass)

                                <tr>
                                    <td width="25%">
                                        <a href="{{ url(!empty($manualAddedClass->webinar) ? $manualAddedClass->webinar->getUrl() : '#1') }}" target="_blank" class="">{{ !empty($manualAddedClass->webinar) ? $manualAddedClass->webinar->title : 'Hapus' }}</a>
                                    </td>

                                    <td>
                                        @if(!empty($manualAddedClass->webinar))
                                            {{ $manualAddedClass->webinar->type }}
                                        @endif
                                    </td>

                                    <td>
                                        @if(!empty($manualAddedClass->webinar))
                                            {{ !empty($manualAddedClass->webinar->price) ? handlePrice($manualAddedClass->webinar->price) : '-' }}
                                        @else
                                            {{ !empty($manualAddedClass->amount) ? handlePrice($manualAddedClass->amount) : '-' }}
                                        @endif
                                    </td>

                                    <td width="25%">
                                        @if(!empty($manualAddedClass->webinar))
                                            <p>{{ $manualAddedClass->webinar->creator->full_name  }}</p>
                                        @else
                                            <p>{{ $manualAddedClass->seller->full_name  }}</p>
                                        @endif
                                    </td>

                                    <td class="text-center">{{ dateTimeFormat($manualAddedClass->created_at,'j M Y | H:i') }}</td>
                                    <td class="text-right">
                                        @can('admin_enrollment_block_access')
                                            @include('admin.includes.delete_button',[
                                                    'url' => '/admin/enrollments/'. $manualAddedClass->id .'/block-access',
                                                    'tooltip' => 'Hapus akses',
                                                    'btnIcon' => 'fa-times-circle'
                                                ])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    <p class="font-12 text-gray mt-1 mb-0">Daftar konten yang ditambahkan untuk peserta ke dalam pelatihan secara manual.</p>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="mt-5">
                <h5 class="section-title after-line">Pelatihan yang Dihapus Secara Manual</h5>

                <div class="table-responsive mt-3">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>Pelatihan</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Instruktur</th>
                            <th class="text-right">Aksi</th>
                        </tr>

                        @if(!empty($manualDisabledClasses))
                            @foreach($manualDisabledClasses as $manualDisabledClass)

                                <tr>
                                    <td width="25%">
                                        <a href="{{ url(!empty($manualDisabledClass->webinar) ? $manualDisabledClass->webinar->getUrl() : '#1') }}" target="_blank" class="">{{ !empty($manualDisabledClass->webinar) ? $manualDisabledClass->webinar->title : 'Hapus' }}</a>
                                    </td>

                                    <td>
                                        @if(!empty($manualDisabledClass->webinar))
                                            {{ $manualDisabledClass->webinar->type }}
                                        @endif
                                    </td>

                                    <td>
                                        @if(!empty($manualDisabledClass->webinar))
                                            {{ !empty($manualDisabledClass->webinar->price) ? handlePrice($manualDisabledClass->webinar->price) : '-' }}
                                        @else
                                            {{ !empty($manualDisabledClass->amount) ? handlePrice($manualDisabledClass->amount) : '-' }}
                                        @endif
                                    </td>

                                    <td width="25%">
                                        @if(!empty($manualDisabledClass->webinar))
                                            <p>{{ $manualDisabledClass->webinar->creator->full_name  }}</p>
                                        @else
                                            <p>{{ $manualDisabledClass->seller->full_name  }}</p>
                                        @endif
                                    </td>

                                    <td class="text-right">
                                        @can('admin_enrollment_block_access')
                                            @include('admin.includes.delete_button',[
                                                    'url' => '/admin/enrollments/'. $manualDisabledClass->id .'/enable-access',
                                                    'tooltip' => 'Aktifkan akses',
                                                ])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    <p class="font-12 text-gray mt-1 mb-0">Daftar konten yang dibeli / diikuti pengguna tetapi akses pengguna dihapus oleh admin.</p>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="mt-5">
                <h5 class="section-title after-line">Diikuti</h5>

                <div class="table-responsive mt-3">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>Pelatihan</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Instruktur</th>
                            <th class="text-center">
                                Tanggal Ditambahkan</th>
                            <th class="text-right">Aksi</th>
                        </tr>

                        @if(!empty($purchasedClasses))
                            @foreach($purchasedClasses as $purchasedClass)

                                <tr>
                                    <td width="25%">
                                        <a href="{{ url(!empty($purchasedClass->webinar) ? $purchasedClass->webinar->getUrl() : '#1') }}" target="_blank" class="">{{ !empty($purchasedClass->webinar) ? $purchasedClass->webinar->title : 'Hapus' }}</a>
                                    </td>

                                    <td>
                                        @if(!empty($purchasedClass->webinar))
                                            {{ $purchasedClass->webinar->type }}
                                        @endif
                                    </td>

                                    <td>
                                        @if(!empty($purchasedClass->webinar))
                                            {{ !empty($purchasedClass->webinar->price) ? handlePrice($purchasedClass->webinar->price) : '-' }}
                                        @else
                                            {{ !empty($purchasedClass->amount) ? handlePrice($purchasedClass->amount) : '-' }}
                                        @endif
                                    </td>

                                    <td width="25%">
                                        @if(!empty($purchasedClass->webinar))
                                            <p>{{ $purchasedClass->webinar->creator->full_name  }}</p>
                                        @else
                                            <p>{{ $purchasedClass->seller->full_name  }}</p>
                                        @endif
                                    </td>

                                    <td class="text-center">{{ dateTimeFormat($purchasedClass->created_at,'j M Y | H:i') }}</td>

                                    <td class="text-right">
                                        @can('admin_enrollment_block_access')
                                            @include('admin.includes.delete_button',[
                                                    'url' => '/admin/enrollments/'. $purchasedClass->id .'/block-access',
                                                    'tooltip' => 'Hapus akses',
                                                    'btnIcon' => 'fa-times-circle'
                                                ])
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    <p class="font-12 text-gray mt-1 mb-0">Daftar konten yang dibeli / diikuti pengguna secara normal.</p>
                </div>
            </div>
        </div>
    </div>
</div>
