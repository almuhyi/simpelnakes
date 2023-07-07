
<div class="tab-pane mt-3 fade active show " id="general" role="tabpanel" aria-labelledby="general-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="/admin/settings/main" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="page" value="financial">
                <input type="hidden" name="name" value="<?php echo e(\App\Models\Setting::$registrationPackagesGeneralName); ?>">

                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0 d-flex align-items-center">
                        <input type="hidden" name="value[status]" value="0">
                        <input type="checkbox" name="value[status]" id="generalStatusSwitch" value="1" <?php echo e((!empty($generalSettings) and !empty($generalSettings['status']) and $generalSettings['status']) ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="generalStatusSwitch">SaaS Aktif</label>
                    </label>
                    <div class="text-muted text-small">Menu "Paket SaaS" akan ditampilkan di panel pengguna</div>
                </div>

                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0 d-flex align-items-center">
                        <input type="hidden" name="value[show_packages_during_registration]" value="0">
                        <input type="checkbox" name="value[show_packages_during_registration]" id="showPackagesDuringRegistrationSwitch" value="1" <?php echo e((!empty($generalSettings) and !empty($generalSettings['show_packages_during_registration']) and $generalSettings['show_packages_during_registration']) ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="showPackagesDuringRegistrationSwitch">Tampilkan paket SaaS dalam pendaftaran</label>
                    </label>
                    <div class="text-muted text-small">Pengguna akan dialihkan ke halaman pemilihan paket setelah mengirimkan formulir "Menjadi instruktur".</div>
                </div>

                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0 d-flex align-items-center">
                        <input type="hidden" name="value[force_user_to_select_a_package]" value="0">
                        <input type="checkbox" name="value[force_user_to_select_a_package]" id="forceUserSelectPackageSwitch" value="1" <?php echo e((!empty($generalSettings) and !empty($generalSettings['force_user_to_select_a_package']) and $generalSettings['force_user_to_select_a_package']) ? 'checked="checked"' : ''); ?> <?php echo e((empty($generalSettings) or empty($generalSettings['show_packages_during_registration']) or !$generalSettings['show_packages_during_registration']) ? 'disabled' : ''); ?> class="custom-switch-input"/>
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="forceUserSelectPackageSwitch">
                            Paksa pengguna untuk memilih paket</label>
                    </label>
                    <div class="text-muted text-small">Pengguna harus memilih paket untuk menyelesaikan proses "Menjadi instruktur".</div>
                </div>

                <div class="form-group custom-switches-stacked">
                    <label class="custom-switch pl-0 d-flex align-items-center">
                        <input type="hidden" name="value[enable_home_section]" value="0">
                        <input type="checkbox" name="value[enable_home_section]" id="enableHomeSectionSwitch" value="1" <?php echo e((!empty($generalSettings) and !empty($generalSettings['enable_home_section']) and $generalSettings['enable_home_section']) ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description mb-0 cursor-pointer" for="enableHomeSectionSwitch">Aktifkan bagian rumah</label>
                    </label>
                    <div class="text-muted text-small">Bagian "Menjadi instruktur" akan ditampilkan di halaman beranda</div>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/financial/registration_packages/settings/general.blade.php ENDPATH**/ ?>