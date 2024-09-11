(function ($) {

    var app = {
        initBtnOption: function ($btnOptions){
            $btnOptions.on('click', '.btn-option', function () {
                console.log('fuck');
                var $this = $(this);
                var fieldName = $this.closest('.form-group').find('input[type="hidden"]').attr('id').replace('_input', '');

                // Set the hidden input value
                $('#' + fieldName + '_input').val($this.data('option-value'));

                // Remove 'selected' class from all buttons in the group
                $this.closest('.btn-options-container').find('.btn-option').removeClass('selected');

                // Add 'selected' class to the clicked button
                $this.addClass('selected');
            });
        },
        init: function (){
            console.log('js loaded')
        }
    }


    jQuery(document).ready(function () {
        app.init()
        app.initBtnOption(jQuery('.btn-options-container'));
    });

    jQuery(window).on('load', function () {


    })



})(jQuery);
