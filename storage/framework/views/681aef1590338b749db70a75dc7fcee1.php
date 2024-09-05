

<?php
    $field['type'] = 'repeatable';
    //each row represent a related entry in a database table. We should not "auto-add" one relationship if it's not the user intention.
    $field['init_rows'] = $field['init_rows'] ?? 0;
    $field['max_rows'] = 1;
    $field['init_rows'] = $field['init_rows'] > $field['max_rows'] ? $field['max_rows'] : $field['init_rows'];
    $field['reorder'] = $field['reorder'] ?? false;
?>

<?php echo $__env->make($crud->getFirstFieldView($field['type']), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\instantscripts-new\vendor\backpack\pro/resources/views/fields/relationship/entry.blade.php ENDPATH**/ ?>