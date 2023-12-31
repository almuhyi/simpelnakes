<html lang="{{ app()->getLocale() }}">
@php
    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $isRtl = ((in_array(mb_strtoupper(app()->getLocale()), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
@endphp
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $pageTitle ?? '' }} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- General CSS File -->
    <link rel="stylesheet" href="{{ asset('') }}assets/admin/vendor/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/fontawesome/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/toast/jquery.toast.min.css">


    @stack('libraries_top')

    <link rel="stylesheet" href="{{ asset('') }}assets/admin/css/style.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/admin/css/custom.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/admin/css/components.css">
    @if($isRtl)
        <link rel="stylesheet" href="{{ asset('') }}assets/admin/css/rtl.css">
    @endif
    <link rel="stylesheet" href="{{ asset('') }}assets/admin/vendor/daterangepicker/daterangepicker.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/select2/select2.min.css">

    @stack('styles_top')
    @stack('scripts_top')

    @yield('styles')

    <style>
        {!! !empty(getCustomCssAndJs('css')) ? getCustomCssAndJs('css') : '' !!}

        {!! getThemeColorsSettings(true) !!}
    </style>
</head>
<body class="@if($isRtl) rtl @endif">

<div id="app">
    <div class="main-wrapper">
        @include('admin.includes.navbar')

        @include('admin.includes.sidebar')


        <div class="main-content">

            @yield('content')

        </div>
    </div>

    <div class="modal fade" id="fileViewModal" tabindex="-1" aria-labelledby="fileViewModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <img src="" class="w-100" height="350px" alt="">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- General JS Scripts -->
<script src="{{ asset('') }}assets/admin/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="{{ asset('') }}assets/admin/vendor/poper/popper.min.js"></script>
<script src="{{ asset('') }}assets/admin/vendor/bootstrap/bootstrap.min.js"></script>
<script src="{{ asset('') }}assets/admin/vendor/nicescroll/jquery.nicescroll.min.js"></script>
<script src="{{ asset('') }}assets/admin/vendor/moment/moment.min.js"></script>
<script src="{{ asset('') }}assets/admin/js/stisla.js"></script>
<script src="{{ asset('') }}assets/default/vendors/toast/jquery.toast.min.js"></script>

<script>
    (function () {
        "use strict";

        window.csrfToken = $('meta[name="csrf-token"]');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @if(session()->has('toast'))
        $.toast({
            heading: '{{ session()->get('toast')['title'] ?? '' }}',
            text: '{{ session()->get('toast')['msg'] ?? '' }}',
            bgColor: '@if(session()->get('toast')['status'] == 'success') #43d477 @else #f63c3c @endif',
            textColor: 'white',
            hideAfter: 10000,
            position: 'bottom-right',
            icon: '{{ session()->get('toast')['status'] }}'
        });
        @endif
    })(jQuery);
</script>

<script src="{{ asset('') }}assets/admin/vendor/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('') }}assets/default/vendors/select2/select2.min.js"></script>

<script src="{{ asset('') }}vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<!-- Template JS File -->
<script src="{{ asset('') }}assets/admin/js/scripts.js"></script>

@stack('styles_bottom')
@stack('scripts_bottom')

<script>
    var deleteAlertTitle = '{{ ('Apa kamu yakin?') }}';
    var deleteAlertHint = '{{ ('Tindakan ini tidak bisa dibatalkan!') }}';
    var deleteAlertConfirm = '{{ ('Hapus') }}';
    var deleteAlertCancel = '{{ ('Batal') }}';
    var deleteAlertSuccess = '{{ ('Berhasil') }}';
    var deleteAlertFail = '{{ ('Gagal') }}';
    var deleteAlertFailHint = '{{ ('Terjadi kesalahan saat menghapus item!') }}';
    var deleteAlertSuccessHint = '{{ ('Item berhasil dihapus.') }}';
    var forbiddenRequestToastTitleLang = '{{ ('Permintaan "DILARANG".') }}';
    var forbiddenRequestToastMsgLang = '{{ ('Anda tidak mengakses konten ini.') }}';
</script>

<script src="{{ asset('') }}assets/admin/js/custom.js"></script>
<script>
    {!! !empty(getCustomCssAndJs('js')) ? getCustomCssAndJs('js') : '' !!}
</script>
</body>
</html>
