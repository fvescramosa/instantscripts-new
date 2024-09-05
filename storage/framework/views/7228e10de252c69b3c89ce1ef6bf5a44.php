

<?php
    $field['type'] = 'repeatable';
    //each row represent a related entry in a database table. We should not "auto-add" one relationship if it's not the user intention.
    $field['init_rows'] = $field['init_rows'] ?? 0;
    $field['subfields'] = $field['subfields'] ?? [];
    $field['reorder'] = $field['reorder'] ?? false;

    $pivotSelectorField = $field['pivotSelect'] ?? [];

    // this needs to be checked here because they depend on a blade variable `$inlineCreate` that prevents the modal over modal scenario
    $inline_create = !isset($inlineCreate) && isset($pivotSelectorField['inline_create']) ? $pivotSelectorField['inline_create'] : false;
    $pivotSelectorField['ajax'] = $inline_create !== false ? true : ($pivotSelectorField['ajax'] ?? false);
    $pivotSelectorField['data_source'] = $pivotSelectorField['data_source'] ?? ($pivotSelectorField['ajax'] ? url($crud->route.'/fetch/'.Str::kebab($field['entity'])) : 'false');

    $field['subfields'] = array_map(function($subfield) use ($pivotSelectorField) {
        if(isset($subfield['is_pivot_select'])) {
            $subfield = array_merge($subfield, $pivotSelectorField);
        }
        return $subfield;
    },$field['subfields']);
?>

<?php echo $__env->make($crud->getFirstFieldView($field['type']), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\instantscripts-new\vendor\backpack\pro/resources/views/fields/relationship/entries.blade.php ENDPATH**/ ?>