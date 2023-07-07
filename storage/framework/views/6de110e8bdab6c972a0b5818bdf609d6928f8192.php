<button class="<?php if(empty($hideDefaultClass) or !$hideDefaultClass): ?> btn-transparent text-primary <?php endif; ?> <?php echo e($btnClass ?? ''); ?>"
        data-confirm="<?php echo e(('Apa kamu yakin? | Apakah Anda ingin melanjutkan?')); ?>"
        data-confirm-href="<?php echo e($url); ?>"
        data-confirm-text-yes="<?php echo e(('Ya')); ?>"
        data-confirm-text-cancel="<?php echo e(('Batal')); ?>"
        <?php if(empty($btnText)): ?>
        data-toggle="tooltip" data-placement="top" title="<?php echo e(!empty($tooltip) ? $tooltip : ('Hapus')); ?>"
    <?php endif; ?>
>
    <?php if(!empty($btnText)): ?>
        <?php echo $btnText; ?>

    <?php else: ?>
        <i class="fa <?php echo e(!empty($btnIcon) ? $btnIcon : 'fa-times'); ?>" aria-hidden="true"></i>
    <?php endif; ?>
</button>
<?php /**PATH C:\laragon\www\simpelnakes\resources\views/admin/includes/delete_button.blade.php ENDPATH**/ ?>