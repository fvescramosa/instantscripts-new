(function ($) {

    var app = {

        init: function (){
            console.log('js loaded');
            $('.before-after-container').beforeAfter();
        }
    }


    jQuery(document).ready(function () {
        app.init()
    });

    jQuery(window).on('load', function () {


    })



})(jQuery);
