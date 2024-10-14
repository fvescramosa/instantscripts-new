/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import VideoChat from "./components/VideoChat.vue";
import VideoChatNew from "./components/VideoChatNew.vue";
import VideoChatNewMix from "./components/VideoChatNewMix.vue";
app.component('example-component', ExampleComponent);
app.component('video-chat', VideoChat);
app.component('video-chat-new', VideoChatNew);
app.component('video-chat-mix', VideoChatNewMix);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
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

app.mount('#app');
