<?php
    if (!empty($itemValue) and !is_array($itemValue)) {
        $itemValue = json_decode($itemValue, true);
    }
    $buttonColors = ['primary','secondary','warning','danger'];
?>

<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/vendors/summernote/summernote-bs4.min.css">
<?php $__env->stopPush(); ?>

<div class="mt-3" id="mobile_app">

    <form action="/admin/settings/mobile_app" method="post">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" name="page" value="personalization">
        <input type="hidden" name="mobile_app" value="mobile_app">

        <div class="row">
            <div class="col-12 col-md-6">

                <?php if(!empty(getGeneralSettings('content_translate'))): ?>
                    <div class="form-group">
                        <label class="input-label"><?php echo e(trans('auth.language')); ?></label>
                        <select name="locale" class="form-control js-edit-content-locale">
                            <?php $__currentLoopData = $userLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lang); ?>" <?php if(mb_strtolower(request()->get('locale', (!empty($itemValue) and !empty($itemValue['locale'])) ? $itemValue['locale'] : app()->getLocale())) == mb_strtolower($lang)): ?> selected <?php endif; ?>><?php echo e($language); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['locale'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                <?php else: ?>
                    <input type="hidden" name="locale" value="<?php echo e(getDefaultLocale()); ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label class="input-label mb-0"><?php echo e(trans('admin/main.image')); ?></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="input-group-text admin-file-manager" data-input="mobile_app_hero_image" data-preview="holder">
                                <i class="fa fa-upload"></i>
                            </button>
                        </div>
                        <input type="text" name="value[mobile_app_hero_image]" required id="mobile_app_hero_image" value="<?php echo e((!empty($itemValue) and !empty($itemValue['mobile_app_hero_image'])) ? $itemValue['mobile_app_hero_image'] : ''); ?>" class="form-control" placeholder="<?php echo e(trans('update.mobile_app_hero_image_placeholder')); ?>"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group ">
                    <label class="control-label"><?php echo e(trans('admin/main.description')); ?></label>
                    <textarea name="value[mobile_app_description]" required class="summernote form-control text-left"><?php echo e((!empty($itemValue) and !empty($itemValue['mobile_app_description'])) ? $itemValue['mobile_app_description'] : ''); ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">

                <div id="mobile_app_buttons" class="ml-0">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <strong class="d-block"><?php echo e(trans('update.buttons')); ?></strong>

                        <button type="button" data-parent="mobile_app_buttons" data-main-row="mobileAppMainRow" class="btn btn-success add-btn"><i class="fa fa-plus"></i> <?php echo e(trans('admin/main.add')); ?></button>
                    </div>


                    <?php if(!empty($itemValue) and !empty($itemValue['mobile_app_buttons'])): ?>
                        <?php $__currentLoopData = $itemValue['mobile_app_buttons']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mobileAppButtonsKey => $mobileAppButtonsValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group p-2 border rounded-lg">
                           <label class="input-label mb-0"><?php echo e(trans('update.button_label')); ?></label>
                                <div class="input-group">
                                    <input type="text" required name="value[mobile_app_buttons][<?php echo e($mobileAppButtonsKey); ?>][title]"
                                           class="form-control w-auto flex-grow-1"
                                           placeholder="<?php echo e(trans('admin/main.choose_title')); ?>"
                                           value="<?php echo e($mobileAppButtonsValue['title'] ?? ''); ?>"
                                    />

                                    <div class="input-group-append">
                                        <button type="button" class="btn remove-btn btn-danger"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>

                                <div class="form-group mb-0 mt-1">
                                    <label class="input-label mb-0"><?php echo e(trans('admin/main.link')); ?></label>
                                    <input type="text" required name="value[mobile_app_buttons][<?php echo e($mobileAppButtonsKey); ?>][link]"
                                           class="form-control w-100 flex-grow-1"
                                           placeholder="<?php echo e(trans('admin/main.link')); ?>"
                                           value="<?php echo e($mobileAppButtonsValue['link'] ?? ''); ?>"
                                    />
                                </div>

                                <div class="form-group mb-0 mt-1">
                                    <label class="input-label mb-0"><?php echo e(trans('admin/main.icon')); ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="input-group-text admin-file-manager" data-input="mobile_app_button_icon_<?php echo e($mobileAppButtonsKey); ?>" data-preview="holder">
                                                <i class="fa fa-upload"></i>
                                            </button>
                                        </div>
                                        <input type="text" required
                                               name="value[mobile_app_buttons][<?php echo e($mobileAppButtonsKey); ?>][icon]"
                                               id="mobile_app_button_icon_<?php echo e($mobileAppButtonsKey); ?>"
                                               class="form-control" placeholder="<?php echo e(trans('update.mobile_app_button_icon_placeholder')); ?>"
                                               value="<?php echo e($mobileAppButtonsValue['icon'] ?? ''); ?>"
                                        />
                                    </div>
                                </div>

                                <div class="form-group mb-0 mt-1">
                                    <label class="input-label mb-0"><?php echo e(trans('update.color')); ?></label>
                                    <select class="form-control" required name="value[mobile_app_buttons][<?php echo e($mobileAppButtonsKey); ?>][color]">
                                        <?php $__currentLoopData = $buttonColors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buttonColor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($buttonColor); ?>" <?php echo e((!empty($mobileAppButtonsValue['color']) and $mobileAppButtonsValue['color'] == $buttonColor) ? 'selected' : ''); ?>><?php echo e($buttonColor); ?></option>
                                            <option value="outline-<?php echo e($buttonColor); ?>" <?php echo e((!empty($mobileAppButtonsValue['color']) and $mobileAppButtonsValue['color'] == "outline-$buttonColor") ? 'selected' : ''); ?>>outline-<?php echo e($buttonColor); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary"><?php echo e(trans('admin/main.save_change')); ?></button>
    </form>

</div>

<div id="mobileAppMainRow" class="form-group p-2 border rounded-lg d-none">
                 <label class="input-label mb-0"><?php echo e(trans('update.button_label')); ?></label>
  <div class="input-group">
        <input type="text" name="value[mobile_app_buttons][record][title]" required
               class="form-control w-auto flex-grow-1"
               placeholder="<?php echo e(trans('admin/main.choose_title')); ?>"/>

        <div class="input-group-append">
            <button type="button" class="btn remove-btn btn-danger"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <div class="form-group mb-0 mt-1">
        <label class="input-label mb-0"><?php echo e(trans('admin/main.link')); ?></label>
        <input type="text" name="value[mobile_app_buttons][record][link]" required
               class="form-control w-100 flex-grow-1"
               placeholder="<?php echo e(trans('admin/main.link')); ?>"/>
    </div>

    <div class="form-group mb-0 mt-1">
        <label class="input-label mb-0"><?php echo e(trans('admin/main.icon')); ?></label>
        <div class="input-group">
            <div class="input-group-prepend">
                <button type="button" class="input-group-text admin-file-manager" data-input="mobile_app_button_icon_record" data-preview="holder">
                    <i class="fa fa-upload"></i>
                </button>
            </div>
            <input type="text" name="value[mobile_app_buttons][record][icon]" required id="mobile_app_button_icon_record" class="form-control" placeholder="<?php echo e(trans('update.mobile_app_button_icon_placeholder')); ?>"/>
        </div>
    </div>

    <div class="form-group mb-0 mt-1">
        <label class="input-label mb-0"><?php echo e(trans('update.color')); ?></label>
        <select class="form-control" name="value[mobile_app_buttons][record][color]" required>
            <?php $__currentLoopData = $buttonColors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buttonColor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($buttonColor); ?>"><?php echo e($buttonColor); ?></option>
                <option value="outline-<?php echo e($buttonColor); ?>">outline-<?php echo e($buttonColor); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="/assets/default/js/admin/settings/cookie_settings.min.js"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/settings/personalization/mobile_app.blade.php ENDPATH**/ ?>