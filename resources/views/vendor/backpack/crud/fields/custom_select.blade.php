{{-- custom_select --}}
@php
    // Custom options array (you can define this manually)
    $field['options'] = $field['options'] ?? [
        'Lips',
        'Nose',
        'Ears'
    ];

    // Set default values
    $field['multiple'] = true;
    $field['allows_null'] = $field['allows_null'] ?? false;
    $field['placeholder'] = $field['placeholder'] ?? trans('backpack::crud.select_entries');
    $field['closeOnSelect'] ??= false;

    // Prepare the value to be used in select2
    $field['value'] = old_empty_or_null($field['name']) ?? $field['value'] ?? $field['default'] ?? '';

    // If the value is a string, split it by commas into an array
    if (is_string($field['value'])) {
        $field['value'] = explode(',', $field['value']);
    }
@endphp

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    {{-- Hidden input to store the value as a comma-separated string --}}
    <input type="hidden" name="{{ $field['name'] }}" value="{{ implode(',', $field['value']) }}" bp-field-main-input />

    <select
        data-name="{{ $field['name'] }}[]"
        style="width: 100%"
        data-init-function="bpFieldInitCustomSelectMultipleElement"
        data-allows-null="{{ var_export($field['allows_null']) }}"
        data-placeholder="{{ $field['placeholder'] }}"
        data-close-on-select="{{ var_export($field['closeOnSelect']) }}"
        class="form-control select2_multiple"
        multiple>

        @foreach ($field['options'] as $option)
            <option value="{{ $option }}"
                @if (in_array($option, $field['value'])) selected @endif>
                {{ $option }}
            </option>
        @endforeach
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
@push('crud_fields_styles')
    @basset('https://unpkg.com/select2@4.0.13/dist/css/select2.min.css')
    @basset('https://unpkg.com/select2-bootstrap-theme@0.1.0-beta.10/dist/select2-bootstrap.min.css')
@endpush

@push('crud_fields_scripts')
    @basset('https://unpkg.com/select2@4.0.13/dist/js/select2.full.min.js')

    <script>
        function bpFieldInitCustomSelectMultipleElement(element) {
            if (!element.hasClass("select2-hidden-accessible")) {
                let $allowClear = element.data('allows-null');
                let $multiple = element.attr('multiple') ?? false;
                let $placeholder = element.attr('placeholder');
                let $closeOnSelect = element.data('close-on-select');

                element.select2({
                    theme: "bootstrap",
                    allowClear: $allowClear,
                    multiple: $multiple,
                    placeholder: $placeholder,
                    closeOnSelect: $closeOnSelect,
                });

                // Update the hidden input field with selected values, combined by commas
                element.on('change', function() {
                    var selectedValues = element.val();
                    var combinedValues = selectedValues ? selectedValues.join(',') : '';
                    element.siblings('input[type="hidden"]').val(combinedValues);
                });
            }
        }
    </script>
@endpush
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
