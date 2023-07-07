@php
    $cookieSecuritySettings = getCookieSettings();
@endphp

<div class="cookie-security-dialog p-20 bg-gray rounded-lg">
    <h3 class="font-14 font-weight-bold text-white">Privasi anda sangat penting</h3>
    <p class="mt-5 text-white font-12">Cookie dan teknologi serupa digunakan di situs kami untuk mempersonalisasi konten dan iklan. Anda dapat menemukan detail lebih lanjut dan mengubah pengaturan pribadi Anda di bawah ini. Dengan mengklik Oke, atau dengan mengklik konten apa pun di situs kami, Anda menyetujui penggunaan cookie ini dan teknologi serupa.</p>

    <div class="mt-10 d-flex flex-wrap align-items-center">
        <button type="button" class="js-accept-all-cookies btn btn-primary btn-sm flex-grow-1 mr-0 mr-md-5">Terima semua cookie</button>
        <button type="button" class="js-cookie-customize-settings btn btn-light btn-sm flex-grow-1 mt-10 mt-md-0">Sesuaikan pengaturan</button>
    </div>
</div>

<div id="cookieSecurityModal" class="d-none">
    <h3 class="section-title after-line font-20 text-dark-blue mb-10">GDPR</h3>

    <p class="mt-10 cookie-security-modal-description">{!! $cookieSecuritySettings['cookie_settings_modal_message'] !!}</p>

    @if(!empty($cookieSecuritySettings['cookie_settings_modal_items']) and count($cookieSecuritySettings['cookie_settings_modal_items']))
        <form class="js-cookie-form-customize-inputs mt-25">

            @foreach($cookieSecuritySettings['cookie_settings_modal_items'] as $cookieModalItemKey => $cookieModalItem)
                @php
                    $isRequiredModalItem = (!empty($cookieModalItem['required']) and $cookieModalItem['required']);
                @endphp

                <div class="cookie-settings-modal-items-card mb-15">
                    <div class="form-group d-flex align-items-center mb-0">
                        <div class="custom-control custom-checkbox {{ $isRequiredModalItem ? 'c-not-allowed' : '' }}">
                            <input type="checkbox" name="settings" value="{{ mb_strtolower(str_replace(' ','_',$cookieModalItem['title'])) }}" class="custom-control-input" {{ $isRequiredModalItem ? ' checked="checked" disabled="disabled" ' : '' }} id="cookieModalItem{{ $cookieModalItemKey }}_record">
                            <label class="custom-control-label" for="cookieModalItem{{ $cookieModalItemKey }}_record"></label>
                        </div>
                        <label class="cursor-pointer font-14 text-gray mb-0 {{ $isRequiredModalItem ? 'c-not-allowed' : '' }}" for="cookieModalItem{{ $cookieModalItemKey }}_record">{{ $cookieModalItem['title'] }}</label>

                        @if($isRequiredModalItem)
                            <input type="hidden" name="settings" value="{{ mb_strtolower(str_replace(' ','_',$cookieModalItem['title'])) }}">
                        @endif

                        @if(!empty($cookieModalItem['description']))
                            <button type="button" class="js-cookie-settings-modal-items-help btn-transparent ml-15">
                                <i data-feather="help-circle" width="20" height="20" class="text-gray"></i>
                            </button>
                        @endif
                    </div>

                    <ul class="cookie-settings-modal-items-card__description">
                        <li class="font-12 text-gray">{!! $cookieModalItem['description'] !!}</li>
                    </ul>
                </div>

            @endforeach

        </form>
    @endif

    <div class="d-flex flex-wrap align-items-center mt-20 pt-15 border-top">
        <button type="button" class="js-store-customize-cookies d-inline-flex d-md-none btn btn-primary btn-sm">Konfirmasi}</button>
        <button type="button" class="js-store-customize-cookies d-none d-md-inline-flex btn btn-primary btn-sm">Konfirmasikan pilihan saya</button>

        <button type="button" class="js-accept-all-cookies d-inline-flex d-md-none btn btn-outline-primary btn-sm mx-15">Terima semua</button>
        <button type="button" class="js-accept-all-cookies d-none d-md-inline-flex btn btn-outline-primary btn-sm mx-15">
            Terima semua cookie</button>

        <button type="button" class="btn-transparent close-swl ml-auto font-14 text-danger">Batalkan</button>
    </div>
</div>

<script>
    var oopsLang = '{{ ('Oops...') }}';
    var somethingWentWrongLang = '{{ ('Ada yang salah...') }}';
</script>
<script type="text/javascript" src="{{ asset('') }}assets/default/js/parts/cookie-security.min.js"></script>
