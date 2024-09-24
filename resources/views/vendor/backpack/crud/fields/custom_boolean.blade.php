@include('crud::fields.inc.wrapper_start')

<div class="form-group col-md-12">
    <label>{{ $field['label'] }}</label>
    <div class="btn-group btn-options-container">
        @foreach($field['options'] as $option_value => $option_label)
            <button type="button" class="btn btn-option @if($field['value'] == $option_value) selected @else  @endif"  data-option-value="{{ $option_value }}"
                    onclick="handleOptionClick(this, '{{ $field['name'] }}')">
                {{ $option_label }}
            </button>
        @endforeach
    </div>
    <input type="hidden" id="{{ $field['name'] }}_input" name="{{ $field['name'] }}" value="{{ $field['value'] }}">
</div>

@push('crud_fields_styles')
    @basset('css/btn-option.css')
    <!-- @basset(base_path('path_to_file')) -->
@endpush

@push('crud_fields_scripts')
    @basset('js/btn-option.js')
    <!-- @basset(base_path('path_to_file')) -->
    @bassetBlock('js/btn-option.js')
    <script>
        function handleOptionClick(button, fieldName) {
            // Get the container for the current field
            var container = button.closest('.btn-options-container');

            // Remove 'selected' class from all buttons in this container
            var btns = container.querySelectorAll('.btn-option');
            btns.forEach(function(btn) {
                btn.classList.remove('selected');
            });

            // Add 'selected' class to the clicked button
            button.classList.add('selected');

            // Set the hidden input value
            var hiddenInput = document.getElementById(fieldName + '_input');
            hiddenInput.value = button.getAttribute('data-option-value');
        }
    </script>
    @endBassetBlock

@endpush
@include('crud::fields.inc.wrapper_end')
