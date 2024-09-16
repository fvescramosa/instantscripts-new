{{-- before_after_field field --}}
<div class="form-group col-md-12">
    <div class="form-group">

        <label>{{ $field['label'] }}</label>
        <div class="before-after-container">
            <img src="{{ $field['before_image'] }}" alt="Before Image" class="before-image">
            <img src="{{  $field['after_image'] }}" alt="After Image" class="after-image">
        </div>
    </div>
</div>


@push('crud_fields_styles')
    @basset('css/before-after-image-viewer/styles.css')

@endpush

@push('crud_fields_scripts')
    @basset('js/before-after-image-viewer/beforeafter.jquery-1.0.0.js')
    <!-- @basset(base_path('path_to_file')) -->
    @bassetBlock('js/before-after-image-viewer/beforeafter.jquery-1.0.0.js')
    <script>
        $(document).ready(function() {
            $('.before-after-container').beforeAfter();
        });
    </script>


@endpush
