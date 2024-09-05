<?php
    $loadedAssets = json_decode($parentLoadedAssets ?? '[]', true);

    //mark parent crud assets as loaded.
    foreach($loadedAssets as $asset) {
        Basset::markAsLoaded($asset);
    }
?>

<div class="modal modal-blur fade" id="inline-create-dialog" tabindex="0" data-backdrop="static" data-bs-backdrop="static" role="dialog" aria-labelledby="<?php echo e($entity); ?>-inline-create-dialog-label" aria-hidden="true">
    <div class="<?php echo e($modalClass); ?>" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?php echo e($entity); ?>-inline-create-dialog-label">
                    <?php echo $crud->getSubheading() ?? trans('backpack::crud.add').' '.$crud->entity_name; ?>

                </h5>
                <button type="button" class="btn-close close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <form method="post"
                      id="<?php echo e($entity); ?>-inline-create-form"
                      action="#"
                      onsubmit="return false"
                      <?php if($crud->hasUploadFields('create')): ?>
                      enctype="multipart/form-data"
                        <?php endif; ?>
                >
                    <?php echo csrf_field(); ?>


                    <?php echo $__env->make($crud->getFirstFieldView('relationship.inc.form_content'), [ 'fields' => $fields, 'action' => $action], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelButton"><?php echo e(trans('backpack::crud.cancel')); ?></button>
                <button type="button" class="btn btn-primary" id="saveButton"><?php echo e(trans('backpack::crud.save')); ?></button>
            </div>
        </div>
    </div>
</div>



<?php echo $__env->yieldPushContent('crud_fields_scripts'); ?>
<script>
    // Focus on first focusable field when modal is shown
    $('#inline-create-dialog').on('shown.bs.modal', function () {
        $(this).find('form').find('input, select, textarea, button').not('[readonly]').not('[disabled]').filter(':visible:first').focus();
    });
</script>

<?php echo $__env->yieldPushContent('crud_fields_styles'); ?>

<?php echo $__env->yieldPushContent('after_scripts'); ?>

<?php echo $__env->yieldPushContent('after_styles'); ?><?php /**PATH C:\laragon\www\instantscripts-new\vendor\backpack\pro/resources/views/fields/relationship/inc/inline_create_modal.blade.php ENDPATH**/ ?>