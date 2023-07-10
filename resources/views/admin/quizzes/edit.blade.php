@extends('admin.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
@endpush

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Kuis</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('/admin/') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Kuis</div>
            </div>
        </div>

        <div class="section-body">


            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-body">

                            @include('admin.quizzes.create_quiz_form')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('scripts_bottom')
    <script src="{{ asset('') }}assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>

    <script>
        var saveSuccessLang = '{{ ('Item berhasil ditambahkan.') }}';
    </script>

    <script src="{{ asset('') }}assets/default/js/admin/quiz.min.js"></script>
@endpush
