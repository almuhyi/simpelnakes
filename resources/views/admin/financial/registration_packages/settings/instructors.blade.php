

<div class="tab-pane mt-3 fade " id="instructors" role="tabpanel" aria-labelledby="instructors-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="{{ url('/admin/settings/main') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="financial">
                <input type="hidden" name="name" value="{{ \App\Models\Setting::$registrationPackagesInstructorsName }}">

                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0 d-flex align-items-center">
                        <input type="hidden" name="value[status]" value="0">
                        <input type="checkbox" name="value[status]" id="instructorsStatusSwitch" value="1" {{ (!empty($instructorsSettings) and !empty($instructorsSettings['status']) and $instructorsSettings['status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="instructorsStatusSwitch">
                            Aktifkan SaaS untuk instruktur</label>
                    </label>
                    <div class="text-muted text-small">Dengan mengaktifkan opsi ini, sistem akan membatasi beberapa fitur untuk instruktur sesuai dengan nilai default dan mereka perlu mengupgrade akun mereka menggunakan paket.</div>
                </div>
                <h2 class="section-title">Nilai default instruktur</h2>
                @foreach(['courses_capacity','courses_count','meeting_count','product_count'] as $str)
                    <div class="form-group">
                        <label>{{ $str }}</label>
                        <input type="text" class="form-control" name="value[{{ $str }}]" value="{{ (!empty($instructorsSettings) and !empty($instructorsSettings[$str])) ? $instructorsSettings[$str] : '' }}">
                    </div>
                @endforeach

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
