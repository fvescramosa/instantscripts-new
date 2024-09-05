<?php

    //in case entity is superNews we want the url friendly super-news
    $entityWithoutAttribute = $crud->getOnlyRelationEntity($field);
    $routeEntity = Str::kebab(str_replace('_', '-', $entityWithoutAttribute));

    $connected_entity = new $field['model'];
    $connected_entity_key_name = $connected_entity->getKeyName();

    // we need to re-ensure field type here because relationship is a `switchboard` and not actually
    // a crud field like this one.
    $field['type'] = 'fetch';

    // this field can be used as a pivot selector for n-n relationships
    $field['is_pivot_select'] = $field['is_pivot_select'] ?? false;
    $field['allow_duplicate_pivots'] = $field['allow_duplicate_pivots'] ?? false;

    $field['multiple'] = $field['multiple'] ?? $crud->guessIfFieldHasMultipleFromRelationType($field['relation_type']);
    $field['data_source'] = $field['data_source'] ?? url($crud->route.'/fetch/'.$routeEntity);
    $field['attribute'] = $field['attribute'] ?? $connected_entity->identifiableAttribute();
    $field['placeholder'] = $field['placeholder'] ?? ($field['multiple'] ? trans('backpack::crud.select_entries') : trans('backpack::crud.select_entry'));
    $field['include_all_form_fields'] = $field['include_all_form_fields'] ?? true;
    $field['closeOnSelect'] ??= !$field['multiple'];

    // Note: isColumnNullable returns true if column is nullable in database, also true if column does not exist.
    $field['allows_null'] = $field['allows_null'] ?? $crud->model::isColumnNullable($field['name']);

    // this is the time we wait before send the query to the search endpoint, after the user as stopped typing.
    $field['delay'] = $field['delay'] ?? 500;

    // make sure the $field['value'] takes the proper value
    // and format it to JSON, so that select2 can parse it
    $current_value = old_empty_or_null($field['name'], []) ??  $field['value'] ?? $field['default'] ?? [];
    if (!empty($current_value) || is_int($current_value)) {
        switch (gettype($current_value)) {
            case 'array':
                $current_value = $connected_entity
                                    ->whereIn($connected_entity_key_name, $current_value)
                                    ->get()
                                    ->pluck($field['attribute'], $connected_entity_key_name);
                break;

            case 'object':
            if (is_subclass_of(get_class($current_value), 'Illuminate\Database\Eloquent\Model') ) {
                    $current_value = [$current_value->{$connected_entity_key_name} => $current_value->{$field['attribute']}];
                }else{
                    if(! $current_value->isEmpty())  {
                    $current_value = $current_value
                                    ->pluck($field['attribute'], $connected_entity_key_name)
                                    ->toArray();
                    }
                }
                break;

            default:
                $current_value = $connected_entity
                                ->where($connected_entity_key_name, $current_value)
                                ->get()
                                ->pluck($field['attribute'], $connected_entity_key_name);
                break;
        }
    }
?>

<?php echo $__env->make('crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <label><?php echo $field['label']; ?></label>
    
    <?php if($field['multiple']): ?><input type="hidden" name="<?php echo e($field['name']); ?>" value="" <?php if(in_array('disabled', $field['attributes'] ?? [])): ?> disabled <?php endif; ?> /><?php endif; ?>
    <select
        style="width:100%"
        name="<?php echo e($field['name'].($field['multiple']?'[]':'')); ?>"
        data-init-function="bpFieldInitFetchElement"
        data-field-is-inline="<?php echo e(var_export($inlineCreate ?? false)); ?>"
        data-column-nullable="<?php echo e(var_export($field['allows_null'])); ?>"
        data-dependencies="<?php echo e(isset($field['dependencies'])?json_encode(Arr::wrap($field['dependencies'])): json_encode([])); ?>"
        data-model-local-key="<?php echo e($crud->model->getKeyName()); ?>"
        data-placeholder="<?php echo e($field['placeholder']); ?>"
        data-minimum-input-length="<?php echo e(isset($field['minimum_input_length']) ? $field['minimum_input_length'] : 2); ?>"
        data-method="<?php echo e($field['method'] ?? 'POST'); ?>"
        data-data-source="<?php echo e($field['data_source']); ?>"
        data-field-attribute="<?php echo e($field['attribute']); ?>"
        data-connected-entity-key-name="<?php echo e($connected_entity_key_name); ?>"
        data-include-all-form-fields="<?php echo e(var_export($field['include_all_form_fields'])); ?>"
        data-app-current-lang="<?php echo e(app()->getLocale()); ?>"
        data-ajax-delay="<?php echo e($field['delay']); ?>"
        data-language="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
        data-is-pivot-select="<?php echo e(var_export($field['is_pivot_select'])); ?>"
        data-allow-duplicate-pivots="<?php echo e(var_export($field['allow_duplicate_pivots'])); ?>"
        data-close-on-select="<?php echo e(var_export($field['closeOnSelect'])); ?>"
        bp-field-main-input
        <?php echo $__env->make('crud::fields.inc.attributes', ['default_class' =>  'form-control'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if($field['multiple']): ?>
        multiple
        <?php endif; ?>
        >

        <?php if($field['allows_null'] && !$field['multiple']): ?>
            <option value="">-</option>
        <?php endif; ?>

        <?php if(!empty($current_value)): ?>
            <?php $__currentLoopData = $current_value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>" selected>
                    <?php echo e($item); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
<?php echo $__env->make('crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>







<?php $__env->startPush('crud_fields_styles'); ?>
    <?php Basset::basset('https://unpkg.com/select2@4.0.13/dist/css/select2.min.css'); ?>
    <?php Basset::basset('https://unpkg.com/select2-bootstrap-theme@0.1.0-beta.10/dist/select2-bootstrap.min.css'); ?>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('crud_fields_scripts'); ?>
    
    <?php Basset::basset('https://unpkg.com/select2@4.0.13/dist/js/select2.full.min.js'); ?>
    <?php if(app()->getLocale() !== 'en'): ?>
        <?php Basset::basset('https://unpkg.com/select2@4.0.13/dist/js/i18n/' . str_replace('_', '-', app()->getLocale()) . '.js'); ?>
    <?php endif; ?>

<?php $bassetBlock = 'backpack/pro/fields/relationship-fetch-field-'.app()->getLocale().'.js'; ob_start(); ?>
<script>
    // if nullable, make sure the Clear button uses the translated string
    document.styleSheets[0].addRule('.select2-selection__clear::after','content:  "<?php echo e(trans('backpack::crud.clear')); ?>";');
    /**
     * Initialize Select2 on an element that wants the "Fetch" functionality.
     * This method gets called automatically by Backpack:
     * - after the Create/Update page loads
     * - after a Fetch is inserted with JS somewhere (ex: in a modal)
     *
     * @param  node element The jQuery-wrapped "select" element.
     * @return void
     */
    function bpFieldInitFetchElement(element) {
        var form = element.closest('form');
        var $placeholder = element.attr('data-placeholder');
        var $minimumInputLength = element.attr('data-minimum-input-length');
        var $dataSource = element.attr('data-data-source');
        var $modelKey = element.attr('data-model-local-key');
        var $method = element.attr('data-method');
        var $fieldAttribute = element.attr('data-field-attribute');
        var $connectedEntityKeyName = element.attr('data-connected-entity-key-name');
        var $includeAllFormFields = element.attr('data-include-all-form-fields') == 'false' ? false : true;
        var $dependencies = JSON.parse(element.attr('data-dependencies'));
        var $allows_null = element.attr('data-column-nullable') == 'true' ? true : false;
        var $multiple = element.prop('multiple');
        var $ajaxDelay = element.attr('data-ajax-delay');
        var $isFieldInline = element.data('field-is-inline');
        var $isPivotSelect = element.data('is-pivot-select');
        var $allowDuplicatePivots = element.data('allow-duplicate-pivots');
        var $fieldCleanName = element.attr('data-repeatable-input-name') ?? element.attr('name');
        var $closeOnSelect = element.attr('data-close-on-select');

        var $select2Settings = {
                theme: 'bootstrap',
                multiple: $multiple,
                placeholder: $placeholder,
                minimumInputLength: $minimumInputLength,
                allowClear: $allows_null,
                dropdownParent: $isFieldInline ? $('#inline-create-dialog .modal-content') : $(document.body),
                closeOnSelect: $closeOnSelect,
                ajax: {
                    url: $dataSource,
                    type: $method,
                    dataType: 'json',
                    delay: $ajaxDelay,
                    data: function (params) {
                        if ($includeAllFormFields) {
                            return {
                                q: params.term, // search term
                                page: params.page, // pagination
                                form: form.serializeArray(), // all other form inputs
                                triggeredBy:
                                {
                                    'rowNumber': element.attr('data-row-number') !== 'undefined' ? element.attr('data-row-number')-1 : false, 
                                    'fieldName': $fieldCleanName
                                }
                            };
                        } else {
                            return {
                                q: params.term, // search term
                                page: params.page, // pagination
                            };
                        }
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        // if field is a pivot select, we are gonna get other pivot values,so we can disable them from selection.
                        if ($isPivotSelect && !$allowDuplicatePivots) {
                            let containerName = element.data('repeatable-input-name');

                            if(containerName.indexOf('[') > -1) {
                                containerName = containerName.substring(0, containerName.indexOf('['));
                            }

                            let pivotsContainer = element.closest('div[data-repeatable-holder='+containerName+']');
                            var selectedValues = [];

                            pivotsContainer.children().each(function(i,container) {
                                $(container).find('select').each(function(i, el) {
                                    if(typeof $(el).attr('data-is-pivot-select') !== 'undefined' && $(el).attr('data-is-pivot-select') != "false" && $(el).val()) {
                                        selectedValues.push($(el).val());
                                    }
                                });
                            });
                        }

                        //if we have data.data here it means we returned a paginated instance from controller.
                        //otherwise we returned one or more entries unpaginated.
                        let paginate = false;

                        if (data.data) {
                            paginate = data.next_page_url !== null;
                            data = data.data;
                        }

                        return {
                            results: $.map(data, function (item) {
                                var $itemText = processItemText(item, $fieldAttribute);
                                let disabled = false;

                                if (selectedValues && selectedValues.some(e => e == item[$connectedEntityKeyName]) && ! $allowDuplicatePivots) {
                                    disabled = true;
                                }

                                return {
                                    text: $itemText,
                                    id: item[$connectedEntityKeyName],
                                    disabled: disabled
                                }
                            }),
                            pagination: {
                                    more: paginate
                            }
                        };
                    },
                    cache: true
                },
            };
        if (!$(element).hasClass("select2-hidden-accessible"))
        {
            $(element).select2($select2Settings);

            // if any dependencies have been declared
            // when one of those dependencies changes value
            // reset the select2 value
            for (var i=0; i < $dependencies.length; i++) {
                var $dependency = $dependencies[i];
                //if element does not have a custom-selector attribute we use the name attribute
                if (typeof element.attr('data-custom-selector') == 'undefined') {
                    form.find('[name="'+$dependency+'"], [name="'+$dependency+'[]"]').change(function(el) {
                            $(element.find('option:not([value=""])')).remove();
                            element.val(null).trigger("change");
                    });
                } else {
                    // we get the row number and custom selector from where element is called
                    let rowNumber = element.attr('data-row-number');
                    let selector = element.attr('data-custom-selector');

                    // replace in the custom selector string the corresponding row and dependency name to match
                    selector = selector
                        .replaceAll('%DEPENDENCY%', $dependency)
                        .replaceAll('%ROW%', rowNumber);

                    $(selector).change(function (el) {
                        $(element.find('option:not([value=""])')).remove();
                        element.val(null).trigger("change");
                    });
                }
            }
        }

        $(element).on('CrudField:disable', function(e) {
            if($multiple) {
                let hiddenInput = element.siblings('input[type="hidden"]');
                if(hiddenInput.length) {
                    hiddenInput.prop('disabled',true);
                }
            }
            return true;
        });

        $(element).on('CrudField:enable', function(e) {
            if($multiple) {
                let hiddenInput = element.siblings('input[type="hidden"]');
                if(hiddenInput.length) {
                    hiddenInput.prop('disabled',false);
                }
            }
            return true;
        });
    }

    if (typeof processItemText !== 'function') {
        function processItemText(item, $fieldAttribute) {
            var $appLang = '<?php echo e(app()->getLocale()); ?>';
            var $appLangFallback = '<?php echo e(Lang::getFallback()); ?>';
            var $emptyTranslation = '<?php echo e(trans("backpack::crud.empty_translations")); ?>';
            var $itemField = item[$fieldAttribute];

            // try to retreive the item in app language; then fallback language; then first entry; if nothing found empty translation string
            return typeof $itemField === 'object' && $itemField !== null
                ? $itemField[$appLang] ? $itemField[$appLang] : $itemField[$appLangFallback] ? $itemField[$appLangFallback] : Object.values($itemField)[0] ? Object.values($itemField)[0] : $emptyTranslation
                : $itemField;
        }
    }
</script>
<?php Basset::bassetBlock($bassetBlock, ob_get_clean()); ?>
<?php $__env->stopPush(); ?>


<?php /**PATH C:\laragon\www\instantscripts-new\vendor\backpack\pro/resources/views/fields/relationship/fetch.blade.php ENDPATH**/ ?>