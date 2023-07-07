<div id="stream-player" class="player stream-player flex-grow-1 position-relative">
    @if($notStarted)
        <div id="notStartedAlert" class="no-result default-no-result d-flex align-items-center justify-content-center flex-column w-100 h-100">
            <div class="no-result-logo">
                <img src="{{ asset('') }}assets/default/img/no-results/support.png" alt="">
            </div>
            <div class="d-flex align-items-center flex-column mt-30 text-center">
                <h2 class="text-dark-blue">Live ini belum dimulai!</h2>
                <p class="mt-5 text-center text-gray font-weight-500">Anda dapat menunggu di halaman ini dan akan ditampilkan setelah sesi dimulai oleh instruktur.</p>
            </div>
        </div>
    @else
        <div class="agora-stream-loading">
            <img src="{{ asset('') }}assets/default/img/loading.gif" alt="">
            <p class="mt-10">Menghubungkan ke sesi langsung, harap tunggu...</p>
        </div>
    @endif
</div>

<!-- Single button -->
<div class="stream-footer py-20 px-15 px-lg-30 mt-15 d-flex align-items-center justify-content-around bg-white">

    @if($isHost)
        <button type="button" id="microphoneEffect" class="stream-bottom-actions btn-transparent d-flex flex-column align-items-center active">
            <span class="icon">
                <i data-feather="mic" width="24" height="24" class=""></i>
            </span>

            <span class="mt-1 text-gray font-14">Mikropon</span>
        </button>


        <button type="button" id="cameraEffect" class="stream-bottom-actions btn-transparent d-flex flex-column align-items-center active">
            <span class="icon">
                <i data-feather="video" width="24" height="24" class=""></i>
            </span>

            <span class="mt-1 text-gray font-14">Kamera</span>
        </button>
    @endif

    <div class="stream-bottom-actions d-flex flex-column align-items-center">
        <i data-feather="clock" width="24" height="24" class=""></i>
        <span id="streamTimer" class="mt-1 font-14 text-gray d-flex align-items-center justify-content-center">
            <span class="d-flex align-items-center justify-content-center text-dark time-item hours">00</span>:
            <span class="d-flex align-items-center justify-content-center text-dark time-item minutes">00</span>:
            <span class="d-flex align-items-center justify-content-center text-dark time-item seconds">00</span>
        </span>
    </div>

    @if($isHost)
        <button type="button" id="shareScreen" class="stream-bottom-actions btn-transparent d-flex flex-column align-items-center ">
            <i data-feather="airplay" width="24" height="24" class=""></i>
            <span class="mt-1 text-gray font-14">Bagikan layar</span>
        </button>

        <button type="button" class="stream-bottom-actions btn-transparent d-flex flex-column align-items-center text-danger" data-toggle="modal" data-target="#leaveModal">
            <i data-feather="x-square" width="24" height="24" class=" "></i>
            <span class="mt-1 font-14">Akhiri live</span>
        </button>

        <div class="modal fade" id="leaveModal" tabindex="-1" role="dialog" aria-labelledby="leaveModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="leaveModalLabel">Akhiri live</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <p class="">Anda yakin ingin mengakhiri sesi langsung?</p>

                        <div class="mt-30 text-center">
                            <button type="button" class="btn btn-danger btn-sm" id="leave" data-id="{{ $session->id }}">Ya</button>
                            <button type="button" class="btn ml-10 btn-gray btn-sm" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

@push('scripts_bottom')
    <script>
        var rtcToken = '{{ $rtcToken }}';
        var notStarted = false;
        @if($notStarted) notStarted = true @endif

    </script>
    <script src="{{ asset('') }}assets/default/js/parts/time-counter-down.min.js"></script>

    <script src="{{ asset('') }}assets/vendors/agora/AgoraRTC_N.js"></script>
    <script src="{{ asset('') }}assets/default/agora/stream.min.js"></script>
@endpush
