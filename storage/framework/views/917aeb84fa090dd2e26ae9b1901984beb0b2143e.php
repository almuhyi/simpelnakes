<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/vendors/leaflet/leaflet.css">
<?php $__env->stopPush(); ?>

<div class="tab-pane mt-3 fade" id="meetingSettings" role="tabpanel" aria-labelledby="meetingSettings-tab">
    <div class="row">
        <div class="col-12">
            <form action="/admin/users/<?php echo e($user->id); ?>/meetingSettings" method="Post">
                <?php echo e(csrf_field()); ?>


                <div class="row mt-20">
                    <div class="col-12 col-lg-12">

                        <div class="form-group mb-30 mt-30">
                            <label class="input-label">Jenis kelamin:</label>

                            <div class="d-flex align-items-center">
                                <div class="custom-control mr-2 custom-radio">
                                    <input type="radio" name="gender" value="man" <?php echo e((!empty($user->gender) and $user->gender == 'man') ? 'checked="checked"' : ''); ?> id="man" class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="man">Pria</label>
                                </div>

                                <div class="custom-control mr-2 custom-radio ml-15">
                                    <input type="radio" name="gender" value="woman" id="woman" <?php echo e((!empty($user->gender) and $user->gender == 'woman') ? 'checked="checked"' : ''); ?> class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="woman">Wanita</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-30 col-lg-6">
                            <label class="input-label">Umur:</label>
                            <input type="number" name="age" value="<?php echo e(!empty($user->age) ? $user->age : ''); ?>" class="form-control">
                        </div>

                        <?php if(!$user->isUser()): ?>
                        <div class="form-group mb-30">
                            <label class="input-label">Jenis pertemuan:</label>

                            <div class="d-flex align-items-center">
                                <div class="custom-control mr-2 custom-radio">
                                    <input type="radio" name="meeting_type" value="in_person" id="in_person" <?php echo e((!empty($user->meeting_type) and $user->meeting_type == 'in_person') ? 'checked="checked"' : ''); ?> class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="in_person">pertemuan Tatap muka</label>
                                </div>

                                <div class="custom-control mr-2 custom-radio ml-10">
                                    <input type="radio" name="meeting_type" value="online" id="online" <?php echo e((!empty($user->meeting_type) and $user->meeting_type == 'online') ? 'checked="checked"' : ''); ?> class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="online">Pertemuan daring</label>
                                </div>

                                <div class="custom-control mr-2 custom-radio ml-10">
                                    <input type="radio" name="meeting_type" value="all" id="all" <?php echo e((!empty($user->meeting_type) and $user->meeting_type == 'all') ? 'checked="checked"' : ''); ?> class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="all">Semua</label>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(!$user->isUser()): ?>
                        <div class="form-group mb-30">
                            <label class="input-label">Tingkat pelatihan:</label>

                            <div class="d-flex align-items-center">
                                <div class="custom-control mr-2 custom-checkbox">
                                    <input type="checkbox" name="level_of_training[]" value="beginner" id="beginner" <?php echo e((!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('beginner',$user->level_of_training)) ? 'checked="checked"' : ''); ?> class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="beginner">Pemula</label>
                                </div>

                                <div class="custom-control mr-2 custom-checkbox ml-10">
                                    <input type="checkbox" name="level_of_training[]" value="middle" id="middle" <?php echo e((!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('middle',$user->level_of_training)) ? 'checked="checked"' : ''); ?> class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="middle">Menengah</label>
                                </div>

                                <div class="custom-control mr-2 custom-checkbox ml-10">
                                    <input type="checkbox" name="level_of_training[]" value="expert" id="expert" <?php echo e((!empty($user->level_of_training) and is_array($user->level_of_training) and in_array('expert',$user->level_of_training)) ? 'checked="checked"' : ''); ?> class="custom-control-input">
                                    <label class="custom-control-label cursor-pointer" for="expert">Sulit/expert</label>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <h2 class="section-title after-line">
                    Wilayah</h2>

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
                            <label class="input-label">Wilayah:</label>

                            <select name="district_id" class="form-control " <?php echo e(empty($districts) ? 'disabled' : ''); ?>>
                                <option value="">Pilih wilayah</option>

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

                    
                </div>

                <div class=" mt-4">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/vendors/leaflet/leaflet.min.js"></script>

    <script>
        var selectProvinceLang = '<?php echo e(('Pilih provinsi')); ?>';
        var selectCityLang = '<?php echo e(('Pilih kota')); ?>';
        var selectDistrictLang = '<?php echo e(('Pilih wilayah')); ?>';
    </script>

    <script src="/assets/default/js/panel/user_settings_tab.min.js"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/users/editTabs/meeting_settings.blade.php ENDPATH**/ ?>