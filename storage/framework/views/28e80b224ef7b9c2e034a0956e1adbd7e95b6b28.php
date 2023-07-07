<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>assets/vendors/leaflet/leaflet.css">
<?php $__env->stopPush(); ?>

<section class="mt-30">
    <h2 class="section-title after-line">Pengaturan</h2>

    <div class="row mt-20">
        <div class="col-12 col-lg-4">

            <div class="form-group mb-30 mt-30">
                <label class="input-label">Jenis kelamin:</label>

                <div class="d-flex align-items-center">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="gender" value="man" <?php echo e((!empty($user->gender) and $user->gender == 'man') ? 'checked="checked"' : ''); ?> id="man" class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="man">Pria</label>
                    </div>

                    <div class="custom-control custom-radio ml-15">
                        <input type="radio" name="gender" value="woman" id="woman" <?php echo e((!empty($user->gender) and $user->gender == 'woman') ? 'checked="checked"' : ''); ?> class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="woman">Wanita</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-30">
                <label class="input-label">Umur:</label>
                <input type="number" name="age" value="<?php echo e(!empty($user->age) ? $user->age : ''); ?>" class="form-control">
            </div>

            <?php if(!$user->isUser()): ?>
            <div class="form-group mb-30">
                <label class="input-label">Jenis pertemuan:</label>

                <div class="d-flex align-items-center">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="meeting_type" value="in_person" id="in_person" <?php echo e((!empty($user->meeting_type) and $user->meeting_type == 'in_person') ? 'checked="checked"' : ''); ?> class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="in_person">pertemuan tatap muka</label>
                    </div>

                    <div class="custom-control custom-radio ml-10">
                        <input type="radio" name="meeting_type" value="online" id="online" <?php echo e((!empty($user->meeting_type) and $user->meeting_type == 'online') ? 'checked="checked"' : ''); ?> class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="online">pertemuan daring</label>
                    </div>

                    <div class="custom-control custom-radio ml-10">
                        <input type="radio" name="meeting_type" value="all" id="all" <?php echo e((!empty($user->meeting_type) and $user->meeting_type == 'all') ? 'checked="checked"' : ''); ?> class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="all">semua</label>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(!$user->isUser()): ?>
            <div class="form-group mb-30">
                <label class="input-label">
                    Tingkat pelatihan:</label>

                <div class="d-flex align-items-center">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="level_of_training[]" value="beginner" id="beginner" <?php echo e((!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('beginner',$user->level_of_training)) ? 'checked="checked"' : ''); ?> class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="beginner">Pemula</label>
                    </div>

                    <div class="custom-control custom-checkbox ml-10">
                        <input type="checkbox" name="level_of_training[]" value="middle" id="middle" <?php echo e((!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('middle',$user->level_of_training)) ? 'checked="checked"' : ''); ?> class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="middle">Menengah</label>
                    </div>

                    <div class="custom-control custom-checkbox ml-10">
                        <input type="checkbox" name="level_of_training[]" value="expert" id="expert" <?php echo e((!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('expert',$user->level_of_training)) ? 'checked="checked"' : ''); ?> class="custom-control-input">
                        <label class="custom-control-label font-14 cursor-pointer" for="expert">Sulit/expert</label>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <h2 class="section-title after-line">Wilayah</h2>

    <div class="row mt-30">
        <div class="col-12 col-lg-4">
            <div class="form-group ">
                <label class="input-label">Negara:</label>

                <select name="country_id" class="form-control " <?php echo e(empty($countries) ? 'disabled' : ''); ?>>
                    <option value="">Pilih negara</option>

                    <?php if(!empty($countries)): ?>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $country->geo_center = \Geo::get_geo_array($country->geo_center);
                            ?>

                            <option value="<?php echo e($country->id); ?>" data-center="<?php echo e(implode(',', $country->geo_center)); ?>" <?php echo e((($user->country_id == $country->id) or old('country_id') == $country->id) ? 'selected' : ''); ?>><?php echo e($country->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group mt-30">
                <label class="input-label">Provinsi:</label>

                <select name="province_id" class="form-control " <?php echo e(empty($provinces) ? 'disabled' : ''); ?>>
                    <option value="">Pilih provinsi</option>

                    <?php if(!empty($provinces)): ?>
                        <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $province->geo_center = \Geo::get_geo_array($province->geo_center);
                            ?>

                            <option value="<?php echo e($province->id); ?>" data-center="<?php echo e(implode(',', $province->geo_center)); ?>" <?php echo e((($user->province_id == $province->id) or old('province_id') == $province->id) ? 'selected' : ''); ?>><?php echo e($province->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group mt-30">
                <label class="input-label">Kota:</label>

                <select name="city_id" class="form-control " <?php echo e(empty($cities) ? 'disabled' : ''); ?>>
                    <option value="">Pilih kota</option>

                    <?php if(!empty($cities)): ?>
                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $city->geo_center = \Geo::get_geo_array($city->geo_center);
                            ?>

                            <option value="<?php echo e($city->id); ?>" data-center="<?php echo e(implode(',', $city->geo_center)); ?>" <?php echo e((($user->city_id == $city->id) or old('city_id') == $city->id) ? 'selected' : ''); ?>><?php echo e($city->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group mt-30">
                <label class="input-label">Daerah:</label>

                <select name="district_id" class="form-control " <?php echo e(empty($districts) ? 'disabled' : ''); ?>>
                    <option value="">Pilih daerah</option>

                    <?php if(!empty($districts)): ?>
                        <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $district->geo_center = \Geo::get_geo_array($district->geo_center);
                            ?>

                            <option value="<?php echo e($district->id); ?>" data-center="<?php echo e(implode(',', $district->geo_center)); ?>" <?php echo e((($user->district_id == $district->id) or old('district_id') == $district->id) ? 'selected' : ''); ?>><?php echo e($district->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group mb-30">
                <label class="input-label">Alamat:</label>
                <input type="text" name="address" value="<?php echo e(!empty($user->address) ? $user->address : ''); ?>" class="form-control">
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="form-group">
                <input type="hidden" id="LocationLatitude" name="latitude" value="<?php echo e((!empty($user->location)) ? $user->location[0] : ''); ?>">
                <input type="hidden" id="LocationLongitude" name="longitude" value="<?php echo e((!empty($user->location)) ? $user->location[1] : ''); ?>">

                <div id="mapContainer" class="d-none">
                    <label class="input-label">Pilih lokasi</label>
                    <span class="d-block font-12 text-gray">Pilih lokasi Anda di peta. Lokasi ini akan ditampilkan di halaman pencari.</span>

                    <div class="region-map mt-10" id="mapBox"
                         data-zoom="12"
                    >
                        <img src="<?php echo e(asset('')); ?>assets/default/img/location.png" class="marker">
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</section>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="<?php echo e(asset('')); ?>assets/vendors/leaflet/leaflet.min.js"></script>

    <script>
        var selectProvinceLang = '<?php echo e(('Pilih provinsi')); ?>';
        var selectCityLang = '<?php echo e(('Pilih kota')); ?>';
        var selectDistrictLang = '<?php echo e(('Pilih daerah')); ?>';
    </script>

    <script src="<?php echo e(asset('')); ?>assets/default/js/panel/user_settings_tab.min.js"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/web/default/panel/setting/setting_includes/settings.blade.php ENDPATH**/ ?>