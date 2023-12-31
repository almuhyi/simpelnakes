
<div class="tab-pane mt-3 fade" id="organizations" role="tabpanel" aria-labelledby="organizations-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="{{ url('/admin/settings/main') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="page" value="financial">
                <input type="hidden" name="name" value="{{ \App\Models\Setting::$registrationPackagesOrganizationsName }}">

                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0 d-flex align-items-center">
                        <input type="hidden" name="value[status]" value="0">
                        <input type="checkbox" name="value[status]" id="organizationsStatusSwitch" value="1" {{ (!empty($organizationsSettings) and !empty($organizationsSettings['status']) and $organizationsSettings['status']) ? 'checked="checked"' : '' }} class="custom-switch-input"/>
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="organizationsStatusSwitch">Aktifkan SaaS untuk organisasi</label>
                    </label>
                    <div class="text-muted text-small mt-1">Dengan mengaktifkan opsi ini, sistem akan membatasi beberapa fitur untuk organisasi sesuai dengan nilai default dan mereka perlu memutakhirkan akun mereka menggunakan paket.</div>
                </div>
                <h2 class="section-title">Nilai default organisasi</h2>
                @foreach(['instructors_count','students_count','courses_capacity','courses_count','meeting_count','product_count'] as $str)
                    <div class="form-group">
                        <label>{{ $str }}</label>
                        <input type="text" class="form-control" name="value[{{ $str }}]" value="{{ (!empty($organizationsSettings) and !empty($organizationsSettings[$str])) ? $organizationsSettings[$str] : '' }}">
                    </div>
                @endforeach

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
