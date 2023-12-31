<section class="mt-30">
    <div class="d-flex justify-content-between align-items-center mb-10">
        <h2 class="section-title after-line">Pendidikan</h2>
        <button id="userAddEducations" type="button" class="btn btn-primary btn-sm">Tambah pendidikan</button>
    </div>

    <div id="userListEducations">

        @if(!empty($educations) and !$educations->isEmpty())
            @foreach($educations as $education)
                <div class="row mt-20">
                    <div class="col-12">
                        <div class="education-card py-15 py-lg-30 px-10 px-lg-25 rounded-sm panel-shadow bg-white d-flex align-items-center justify-content-between">
                            <div class="col-8 text-secondary text-left font-weight-500 education-value">{{ $education->value }}</div>
                            <div class="col-2 text-right">
                                <div class="btn-group dropdown table-actions">
                                    <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical" height="20"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button type="button" data-education-id="{{ $education->id }}" data-user-id="{{ (!empty($user) and empty($new_user)) ? $user->id : '' }}" class="d-block btn-transparent edit-education">Edit</button>
                                        <a href="{{ url('') }}/panel/setting/metas/{{ $education->id }}/delete?user_id={{ (!empty($user) and empty($new_user)) ? $user->id : '' }}" class="delete-action d-block mt-10 btn-transparent">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else

            @include(getTemplate() . '.includes.no-result',[
                'file_name' => 'edu.png',
                'title' => ('Tidak ada data pendidikan yang ditentukan!'),
                'hint' => ('Pendidikan Anda akan ditampilkan di halaman profil Anda.'),
            ])
        @endif
    </div>

</section>

<div class="d-none" id="newEducationModal">
    <h3 class="section-title after-line">Tambah pendidikan baru</h3>
    <div class="mt-20 text-center">
        <img src="{{ asset('') }}assets/default/img/info.png" width="108" height="96" class="rounded-circle" alt="">
        <h4 class="font-16 mt-20 text-dark-blue font-weight-bold">Jelaskan gelar pendidikan Anda dalam satu baris.</h4>
        <span class="d-block mt-10 text-gray font-14">
            Contoh: PhD Kedokteran dari universitas ....</span>
        <div class="form-group mt-15 px-50">
            <input type="text" id="new_education_val" class="form-control">
            <div class="invalid-feedback">Kolom wajib diisi.</div>
        </div>
    </div>

    <div class="mt-30 d-flex align-items-center justify-content-end">
        <button type="button" id="saveEducation" class="btn btn-sm btn-primary">Simpan</button>
        <button type="button" class="btn btn-sm btn-danger ml-10 close-swl">Tutup</button>
    </div>
</div>
