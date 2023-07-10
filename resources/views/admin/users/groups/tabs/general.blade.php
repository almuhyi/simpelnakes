<div class="tab-pane mt-3 fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6">
            <form action="{{ url('') }}/admin/users/groups/{{ !empty($group) ? $group->id.'/update' : 'store' }}" method="Post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name"
                           class="form-control  @error('name') is-invalid @enderror"
                           value="{{ !empty($group) ? $group->name : old('name') }}"/>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group ">
                    <label>
                        Tarif Komisi (Untuk Instruktur & Organisasi)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-percentage"></i>
                            </div>
                        </div>

                        <input type="number"
                               name="commission"
                               class="spinner-input form-control text-center @error('commission') is-invalid @enderror"
                               value="{{ !empty($group) ? $group->commission : old('commission') }}"
                               placeholder="Biarkan kosong untuk nilai default (Ditentukan di Pengaturan)" maxlength="3" min="0" max="100">

                        @error('commission')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="text-muted text-small mt-1">Nilai ini akan dianggap sebagai tarif komisi instruktur dan tarif default akan diabaikan.</div>
                </div>

                <div class="form-group ">
                    <label>
                        Tarif Diskon (Untuk Semua Pengguna)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-percentage"></i>
                            </div>
                        </div>
                        <input type="number"
                               name="discount"
                               class="form-control spinner-input text-center @error('discount') is-invalid @enderror"
                               value="{{ !empty($group) ? $group->discount : old('discount') }}"
                               placeholder="kosongkan untuk diskon 0%" maxlength="3" min="0" max="100">
                        @error('discount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="text-muted text-small mt-1">Pengguna akan mendapatkan tarif ini sebagai diskon tambahan untuk semua pembelian.</div>
                </div>


                <div class="form-group">
                    <label class="input-label d-block">Pengguna</label>
                    <select name="users[]" multiple="multiple" class="form-control search-user-select2"
                            data-search-option="for_user_group"
                            data-placeholder="Cari pengguna">

                        @if(!empty($userGroups) and $userGroups->count() > 0)
                            @foreach($userGroups as $userGroup)
                                <option value="{{ $userGroup->user_id }}" selected>{{ $userGroup->user->full_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0">
                        <input type="hidden" name="status" value="inactive">
                        <input type="checkbox" name="status" id="preloadingSwitch" value="active" {{ (!empty($group) and $group->status == 'active') ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="preloadingSwitch">Aktif</label>
                    </label>
                </div>

                <div class=" mt-4">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
