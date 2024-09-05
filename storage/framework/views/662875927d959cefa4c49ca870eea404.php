
<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $fieldView = $crud->getFirstFieldView($field['type'], $field['view_namespace'] ?? false);
    ?>

    <?php echo $__env->make($fieldView, ['field' => $field, 'inlineCreate' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH C:\laragon\www\instantscripts-new\vendor\backpack\pro/resources/views/fields/relationship/inc/show_fields.blade.php ENDPATH**/ ?>