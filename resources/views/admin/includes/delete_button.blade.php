<button class="@if(empty($hideDefaultClass) or !$hideDefaultClass) btn-transparent text-primary @endif {{ $btnClass ?? '' }}"
        data-confirm="{{ ('Apa kamu yakin? | Apakah Anda ingin melanjutkan?') }}"
        data-confirm-href="{{ $url }}"
        data-confirm-text-yes="{{ ('Ya') }}"
        data-confirm-text-cancel="{{ ('Batal') }}"
        @if(empty($btnText))
        data-toggle="tooltip" data-placement="top" title="{{ !empty($tooltip) ? $tooltip : ('Hapus') }}"
    @endif
>
    @if(!empty($btnText))
        {!! $btnText !!}
    @else
        <i class="fa {{ !empty($btnIcon) ? $btnIcon : 'fa-times' }}" aria-hidden="true"></i>
    @endif
</button>
