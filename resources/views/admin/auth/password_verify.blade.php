@extends('web.default.layouts.email')

@section('body')
    <!-- content -->
    <td valign="top" class="bodyContent" mc:edit="body_content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Verifikasi alamat email Anda</div>
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">

                                Tautan verifikasi baru telah dikirim ke alamat email Anda.
                            </div>
                            <a href="{{ url('/admin/reset-password/' . $token . '?email=' . $email) }}">klik disini</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
@endsection
