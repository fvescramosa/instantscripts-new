{{-- category_tile_field field --}}


<div class="form-group col-md-12 ">
    <label>{{ $field['label'] }}</label>
    <div class="row">
        @foreach($field['options'] as $option)
            <div class="col-md-4 medicine-category">
                <div class="card card-body mb-3 category-option" data-value="{{ $option->id }}">
                    <h2>{{ $option->category }}</h2>
                    <p>{{ $option->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <input type="hidden" name="{{ $field['name'] }}" value="{{ old($field['name'], $field['value'] ?? '') }}">
</div>


@push('crud_fields_styles')

    <style>
        .medicine-category .card{
            min-height: 150px;
        }

        .medicine-category .card{
            background: #FFF;
            transition: all ease-in .3s;

            &.selected{
                background: #95785e;
                color: #fff;
                h2{ color: #fff; }
            }


        }

        .medicine-category h2{
            color: #95785e;
            font-size: 28px;
            line-height: 1.75em;
        }

        .medicine-category p{
            letter-spacing:  .7px;
        }

    </style>

@endpush

@push('crud_fields_scripts')
    <script>

        $(document).ready(function() {
            $('.category-option').on('click', function() {
                $('.category-option').removeClass('selected');
                $(this).addClass('selected');
                $('input[name="{{ $field['name'] }}"]').val($(this).data('value'));

            });
        });
    </script>
@endpush


