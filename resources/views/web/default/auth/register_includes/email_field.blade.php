<div class="form-group">
    <label class="input-label" for="email">Email {{ !empty($optional) ? "(". ('Opsional') .")" : '' }}:</label>
    <input name="email" type="text" class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email') }}" id="email" aria-describedby="emailHelp">

    @error('email')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
