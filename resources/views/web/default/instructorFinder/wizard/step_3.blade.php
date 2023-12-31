
<div class="wizard-step-1">
    <h3 class="font-20 text-dark font-weight-bold">Tingkat bimbingan</h3>

    <span class="d-block mt-30 text-gray wizard-step-num">
        Langkah 3/3
    </span>

    <div class="form-group mt-30">
        <label class="input-label font-weight-500">Tingkat keterampilan apa yang ingin Anda pelajari?</label>

        <select name="level_of_training" class="form-control mt-20">
            <option value="beginner" {{ (request()->get('level_of_training') == 'beginner') ? 'selected' : '' }}>Pemula</option>
            <option value="middle" {{ (empty(request()->get('level_of_training')) or request()->get('level_of_training') == 'middle') ? 'selected' : '' }}>Menengah</option>
            <option value="expert" {{ (request()->get('level_of_training') == 'expert') ? 'selected' : '' }}>Ahli</option>
        </select>
    </div>

</div>
