
<?php
    $current_value = old_empty_or_null($field['name'], '') ??  $field['value'] ?? $field['default'] ?? '';

    //if it's part of a relationship here we have the full related model, we want the key.
    if (is_object($current_value) && is_subclass_of(get_class($current_value), 'Illuminate\Database\Eloquent\Model') ) {
        $current_value = $current_value->getKey();
    }
    if (!isset($field['options'])) {
        $options = $field['model']::all();
    } else {
        $options = call_user_func($field['options'], $field['model']::query());
    }
    $field['allows_null'] = $field['allows_null'] ?? $crud->model::isColumnNullable($field['name']);
    $field['placeholder'] = $field['placeholder'] ?? trans('backpack::crud.select_entry');
?>

<?php echo $__env->make('crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::fields.inc.translatable_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <select
        name="<?php echo e($field['name']); ?>"
        style="width: 100%"
        data-field-is-inline="<?php echo e(var_export($inlineCreate ?? false)); ?>"
        data-init-function="bpFieldInitSelect2Element"
        data-language="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
        data-field-placeholder="<?php echo e($field['placeholder']); ?>"
        data-field-allow-clear="<?php echo e(var_export($field['allows_null'])); ?>"
        <?php echo $__env->make('crud::fields.inc.attributes', ['default_class' =>  'form-control select2_field'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        >

        <?php if($field['allows_null']): ?>
            <option value="">-</option>
        <?php endif; ?>

        <?php if(count($options)): ?>
            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($current_value == $option->getKey()): ?>
                    <option value="<?php echo e($option->getKey()); ?>" selected><?php echo e($option->{$field['attribute']}); ?></option>
                <?php else: ?>
                    <option value="<?php echo e($option->getKey()); ?>"><?php echo e($option->{$field['attribute']}); ?></option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
<?php echo $__env->make('crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




<?php if($crud->fieldTypeNotLoaded($field)): ?>
    <?php
        $crud->markFieldTypeAsLoaded($field);
    ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
        
        <?php Basset::basset('https://unpkg.com/select2@4.0.13/dist/css/select2.min.css'); ?>
        <?php Basset::basset('https://unpkg.com/select2-bootstrap-theme@0.1.0-beta.10/dist/select2-bootstrap.min.css'); ?>
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
        
        <?php Basset::basset('https://unpkg.com/select2@4.0.13/dist/js/select2.full.min.js'); ?>
        <?php if(app()->getLocale() !== 'en'): ?>
            <?php Basset::basset('https://unpkg.com/select2@4.0.13/dist/js/i18n/' . str_replace('_', '-', app()->getLocale()) . '.js'); ?>
        <?php endif; ?>
        <?php $bassetBlock = 'backpack/pro/fields/select2-field.js'; ob_start(); ?>
        <script>
            function bpFieldInitSelect2Element(element) {
                // element will be a jQuery wrapped DOM node
                if (!element.hasClass("select2-hidden-accessible"))
                {
                    let isFieldInline = element.data('field-is-inline');
                    let placeholder = element.data('field-placeholder');
                    let allowClear = element.data('field-allow-clear');

                    element.select2({
                        theme: "bootstrap",
                        placeholder: placeholder,
                        allowClear: allowClear,
                        dropdownParent: isFieldInline ? $('#inline-create-dialog .modal-content') : $(document.body)
                    });
                }
            }
        </script>
        <?php Basset::bassetBlock($bassetBlock, ob_get_clean()); ?>
    <?php $__env->stopPush(); ?>

<?php endif; ?>


<?php /**PATH C:\laragon\www\instantscripts-new\vendor\backpack\pro/resources/views/fields/select2.blade.php ENDPATH**/ ?>