<section>
    <h3 class="section-title after-line mt-35">Tentang</h3>

    <div class="row mt-20">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label class="input-label">
                    Biografi</label>
                <textarea name="about" rows="9" class="form-control @error('about')  is-invalid @enderror">{!! (!empty($user) and empty($new_user)) ? $user->about : old('about')  !!}</textarea>
                @error('about')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="input-label">Judul pekerjaan</label>
                <textarea name="bio" rows="3" class="form-control @error('bio') is-invalid @enderror">{{ $user->bio }}</textarea>
                @error('bio')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <div class="mt-15">
                     <p class="font-12 text-gray">- "Jabatan" akan ditampilkan di bagian bawah nama Anda pada kartu profil.</p>
                     <p class="font-12 text-gray">
                        - Singkat (2 atau 3 kata) Misalnya "Desainer produk, Perawat".</p>
                </div>

            </div>
        </div>
    </div>
</section>
