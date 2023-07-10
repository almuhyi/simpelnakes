@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active"><a href="{{ url('/admin/users') }}">Pengguna</a>
                </div>
                <div class="breadcrumb-item">Edit</div>
            </div>
        </div>

        @if(!empty(session()->has('msg')))
            <div class="alert alert-success my-25">
                {{ session()->get('msg') }}
            </div>
        @endif


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if(empty($becomeInstructor)) active @endif" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Umum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="true">Gambar</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="financial-tab" data-toggle="tab" href="#financial" role="tab" aria-controls="financial" aria-selected="true">Identitas</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="occupations-tab" data-toggle="tab" href="#occupations" role="tab" aria-controls="occupations" aria-selected="true">Profesi</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="badges-tab" data-toggle="tab" href="#badges" role="tab" aria-controls="badges" aria-selected="true">Lencana</a>
                                </li>

                                @if(!empty($user) and ($user->isOrganization() or $user->isTeacher()))
                                    @can('admin_update_user_registration_package')
                                        <li class="nav-item">
                                            <a class="nav-link" id="registrationPackage-tab" data-toggle="tab" href="#registrationPackage" role="tab" aria-controls="registrationPackage" aria-selected="true">Paket SaaS</a>
                                        </li>
                                    @endcan
                                @endif


                                <li class="nav-item">
                                    <a class="nav-link" id="meetingSettings-tab" data-toggle="tab" href="#meetingSettings" role="tab" aria-controls="meetingSettings" aria-selected="true">Pengaturan pertemuan</a>
                                </li>


                                @if(!empty($becomeInstructor))
                                    <li class="nav-item">
                                        <a class="nav-link @if(!empty($becomeInstructor)) active @endif" id="become_instructor-tab" data-toggle="tab" href="#become_instructor" role="tab" aria-controls="become_instructor" aria-selected="true">Detail Permintaan Instruktur</a>
                                    </li>
                                @endif


                                <li class="nav-item">
                                    <a class="nav-link" id="purchased_courses-tab" data-toggle="tab" href="#purchased_courses" role="tab" aria-controls="purchased_courses" aria-selected="true">Pelatihan</a>
                                </li>

                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="purchased_bundles-tab" data-toggle="tab" href="#purchased_bundles" role="tab" aria-controls="purchased_bundles" aria-selected="true">{{ trans('update.purchased_bundles') }}</a>
                                </li> --}}

                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="purchased_products-tab" data-toggle="tab" href="#purchased_products" role="tab" aria-controls="purchased_products" aria-selected="true">{{ trans('update.purchased_products') }}</a>
                                </li> --}}

                                <li class="nav-item">
                                    <a class="nav-link" id="topics-tab" data-toggle="tab" href="#topics" role="tab" aria-controls="topics" aria-selected="true">Forum</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent2">

                                @include('admin.users.editTabs.general')

                                @include('admin.users.editTabs.images')

                                @include('admin.users.editTabs.financial')

                                @include('admin.users.editTabs.occupations')

                                @include('admin.users.editTabs.badges')

                                @if(!empty($user) and ($user->isOrganization() or $user->isTeacher()))
                                    @can('admin_update_user_registration_package')
                                        @include('admin.users.editTabs.registration_package')
                                    @endcan
                                @endif


                                @include('admin.users.editTabs.meeting_settings')


                                @if(!empty($becomeInstructor))
                                    @include('admin.users.editTabs.become_instructor')
                                @endif

                                @include('admin.users.editTabs.purchased_courses')

                                @include('admin.users.editTabs.purchased_bundles')

                                @include('admin.users.editTabs.purchased_products')

                                @include('admin.users.editTabs.topics')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('') }}assets/default/vendors/select2/select2.min.js"></script>

    <script>
        var saveSuccessLang = '{{ ('Item berhasil ditambahkan.') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/admin/webinar_students.min.js"></script>
    <script src="{{ asset('') }}assets/default/js/admin/user_edit.min.js"></script>
@endpush
