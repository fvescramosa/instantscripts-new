(function ($) {

    var app = {

        init: function (){
            console.log('js loaded');
            $('.before-after-container').beforeAfter();
        },
        initPatientID: function(){
            $('select[name="patient_id"]').on('change', function() {
                var patientId = $(this).val(); // Get the selected patient_id

                // Update the Medicare Card Details field's data source URL with the selected patient_id
                var medicareCardField = $('select[name="treatment_detail[medicare_card_details_id]"]');
                var newDataSource = medicareCardField.data('ajax--url').split('?')[0] + '?patient_id=' + patientId;

                // Set the new data source for the Medicare Card Details field
                medicareCardField.data('ajax--url', newDataSource);

                // Trigger change event to reload the field's options via AJAX
                medicareCardField.trigger('change.select2');
            });
        },
    }


    jQuery(document).ready(function () {
        app.init()
        // app.initPatientID()
    });

    jQuery(window).on('load', function () {


    })



})(jQuery);
