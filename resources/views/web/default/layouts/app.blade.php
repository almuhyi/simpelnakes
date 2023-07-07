<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@php
    $rtlLanguages = !empty($generalSettings['rtl_languages']) ? $generalSettings['rtl_languages'] : [];

    $isRtl = ((in_array(mb_strtoupper(app()->getLocale()), $rtlLanguages)) or (!empty($generalSettings['rtl_layout']) and $generalSettings['rtl_layout'] == 1));
@endphp

<head>
    @include('web.default.includes.metas')
    <title>{{ $pageTitle ?? '' }}{{ !empty($generalSettings['site_name']) ? (' | '.$generalSettings['site_name']) : '' }}</title>

    <!-- General CSS File -->
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/toast/jquery.toast.min.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/vendors/simplebar/simplebar.css">
    <link rel="stylesheet" href="{{ asset('') }}assets/default/css/app.css">

    @if($isRtl)
        <link rel="stylesheet" href="{{ asset('') }}assets/default/css/rtl-app.css">
    @endif

    @stack('styles_top')
    @stack('scripts_top')

    <style>
        {!! !empty(getCustomCssAndJs('css')) ? getCustomCssAndJs('css') : '' !!}

        {!! getThemeFontsSettings() !!}

        {!! getThemeColorsSettings() !!}
    </style>


    @if(!empty($generalSettings['preloading']) and $generalSettings['preloading'] == '1')
        @include('admin.includes.preloading')
    @endif
</head>

<body class="@if($isRtl) rtl @endif">

<div id="app">

    @if(!isset($appHeader))
        @include('web.default.includes.top_nav')
        @include('web.default.includes.navbar')
    @endif

    @if(!empty($justMobileApp))
        @include('web.default.includes.mobile_app_top_nav')
    @endif

    @yield('content')

    @if(!isset($appFooter))
        @include('web.default.includes.footer')
    @endif

    @include('web.default.includes.advertise_modal.index')
</div>
<!-- Template JS File -->
<script type="text/javascript" src="{{ asset('') }}assets/default/js/app.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/default/vendors/feather-icons/dist/feather.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/default/vendors/moment.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/default/vendors/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/default/vendors/toast/jquery.toast.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/default/vendors/simplebar/simplebar.min.js"></script>
<script type="text/javascript" src="{{ asset('') }}assets/default/vendors/pace-loading/pace.min.js"></script>

@if(empty($justMobileApp) and checkShowCookieSecurityDialog())
    @include('web.default.includes.cookie-security')
@endif


<script>
    var deleteAlertTitle = '{{ ('Apa kamu yakin?') }}';
    var deleteAlertHint = '{{ ('Tindakan ini tidak bisa dibatalkan!') }}';
    var deleteAlertConfirm = '{{ ('Hapus') }}';
    var deleteAlertCancel = '{{ ('Batalkan') }}';
    var deleteAlertSuccess = '{{ ('Berhasil') }}';
    var deleteAlertFail = '{{ ('Gagal') }}';
    var deleteAlertFailHint = '{{ ('Terjadi kesalahan saat menghapus item!') }}';
    var deleteAlertSuccessHint = '{{ ('Item berhasil dihapus.') }}';
    var forbiddenRequestToastTitleLang = '{{ ('Permintaan ditolak!') }}';
    var forbiddenRequestToastMsgLang = '{{ ('Anda tidak mengakses pelatihan ini.') }}';
</script>

@if(session()->has('toast'))
    <script>
        (function () {
            "use strict";

            $.toast({
                heading: '{{ session()->get('toast')['title'] ?? '' }}',
                text: '{{ session()->get('toast')['msg'] ?? '' }}',
                bgColor: '@if(session()->get('toast')['status'] == 'success') #43d477 @else #f63c3c @endif',
                textColor: 'white',
                hideAfter: 10000,
                position: 'bottom-right',
                icon: '{{ session()->get('toast')['status'] }}'
            });
        })(jQuery)
    </script>
@endif

@stack('styles_bottom')
@stack('scripts_bottom')

<script src="{{ asset('') }}assets/default/js/parts/main.min.js"></script>

<script>
    @if(session()->has('registration_package_limited'))
    (function () {
        "use strict";

        handleLimitedAccountModal('{!! session()->get('registration_package_limited') !!}')
    })(jQuery)

    {{ session()->forget('registration_package_limited') }}
    @endif

    {!! !empty(getCustomCssAndJs('js')) ? getCustomCssAndJs('js') : '' !!}
</script>
</body>
</html>
