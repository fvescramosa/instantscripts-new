<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ScriptRequest;
use App\Models\Patient;
use App\Models\Script;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Prologue\Alerts\Facades\Alert;

/**
 * Class ScriptCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ScriptCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Script::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/script');
        CRUD::setEntityNameStrings('script', 'scripts');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
//        CRUD::setFromDb(); // set columns from db columns.

        $this->crud->addColumn([
            'name' => 'patient.full_name',
            'type' => 'text',
            'attribute' => 'full_name',
            'label' => 'Full Name',

        ]);

        $this->crud->addColumn([
            'name' => 'medical_consultation.consultation_date',
            'type' => 'date',
            'label' => 'Consultation Date',
        ]);
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }


    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ScriptRequest::class);

        /*CRUD::addField([
            'type' => "relationship",
            'name' => 'patient_id', // the method on your model that defines the relationship
            'ajax' => true,
            'attribute' => 'text',
            'inline_create' => true, // assumes the URL will be "/admin/category/inline/create"
        ]);*/

        CRUD::addField([
            'name' => 'patient_id',
            'type' => 'relationship',
            'entity' => 'patient',
            'model' => 'App\Models\Patient',
            'attribute' => 'text',
            'ajax' => true,
            'inline_create' => true
        ]);

        CRUD::addField([
            'name' => 'medicine_category_id',
            'type' => 'relationship',
            'entity' => 'medicine_category',
            'model' => 'App\Models\MedicineCategory',
            'attribute' => 'category',
            'ajax' => true,
            'inline_create' => true
        ]);

        CRUD::addField([
            'name' => 'medical_consultation[consultation_date]', 'type' => 'date', 'label' => 'Consultation Date',
            'entity' => 'medical_consultation',
            'model' => 'App\Models\MedicalConsultation',
            'value' => $entry->medical_consultation['consultation_date'] ?? date('m/d/y'),
        ]);


        $fields = [
            ['name' => 'serious_health_problems', 'label' => 'Do you have any serious health problems, including any blood borne diseases or blood disorders?'],
            ['name' => 'epilepsy_seizures_fainting', 'label' => 'Do you suffer from epilepsy, seizures or fainting?'],
            ['name' => 'autoimmune_disease', 'label' => 'Do you have a history of autoimmune disease?'],
            ['name' => 'surgery_history', 'label' => 'Have you had any surgery, including cosmetic surgery?'],
            ['name' => 'medications_supplements', 'label' => 'Are you currently taking any medications or health supplements (prescribed or otherwise)?'],
            ['name' => 'myasthenia_gravis', 'label' => 'Have you been diagnosed with myasthenia gravis, Eaton-Lambert (myasthenic) syndrome, or any conditions that cause weakness in the muscles?'],
            ['name' => 'cold_sores', 'label' => 'Do you suffer from cold sores?'],
            ['name' => 'pregnant_breastfeeding', 'label' => 'Are you currently pregnant / breastfeeding or planning a pregnancy in the next 3 months including IVF?'],
            ['name' => 'allergic_anything', 'label' => 'Are you allergic to anything (including anaesthetics, adrenaline, medications)?'],
            ['name' => 'sensitive_bees', 'label' => 'Do you have any sensitivities or reactions to bee/wasp stings?'],
            ['name' => 'numbing_injection', 'label' => 'Have you ever had a numbing injection at the dentist?'],
            ['name' => 'keloid_scarring', 'label' => 'Do you have a history of abnormal scarring or keloid scarring?'],
            ['name' => 'intend_to_surgical_invasive', 'label' => 'Do you intend to have any surgical invasive dental procedures within the next 4 weeks or have you had any procedures within the last 4 weeks?'],
            ['name' => 'implants', 'label' => 'Do you have any implants or metalwork?'],
            ['name' => 'vaccination', 'label' => 'Have you received any vaccinations in the past 14 days, or do you intend on getting any vaccination in the next 14 days?'],
            ['name' => 'tropical_treatment', 'label' => 'Are you currently being treated with isotretinoin capsules or topical treatment (brands include Roaccutane, Oratane, Rocta, Dermatane and Isotrex)?'],
            ['name' => 'anti_wrinkle', 'label' => 'Have you ever received Botulinum Toxin Type A or other anti-wrinkle treatments before?'],
            ['name' => 'dermal_fillers', 'label' => 'Have you ever received dermal fillers before?'],
            ['name' => 'stimulatory_fillers', 'label' => 'Have you ever received a treatment with stimulatory fillers such as Sculptra or Radiesse?'],
            ['name' => 'injectable_procedure', 'label' => 'Have you ever had any complications with your previous cosmetic injectable procedures?'],
            ['name' => 'smoke', 'label' => 'Do you smoke?'],
            ['name' => 'travel', 'label' => 'Do you intend to travel internationally in the following 2 weeks?'],
            ['name' => 'appearance', 'label' => 'Are you worried about the way you look, and do you think about your appearance a lot and wish you could think about it less?'],
            ['name' => 'affected_daily_life', 'label' => 'Has the way you feel about it affected your daily life activities such as school, work or other activities?'],
            ['name' => 'avoid_gatherings', 'label' => 'Are there things you avoid because of how you look, such as gatherings, going out etc?'],
            ['name' => 'thinking_look', 'label' => 'Do you spend more than 2-3 hours a day thinking about how you look?'],
            ['name' => 'life_adversely', 'label' => 'If you could not have a cosmetic treatment today, would this affect your life adversely?'],
            ['name' => 'before_after', 'label' => 'Do you consent to have your before and after photos taken for the purpose of medical records?'],
            ['name' => 'fully_consent', 'label' => 'Have you been advised of the risks and fully consented for this treatment?'],
            ['name' => 'understand', 'label' => 'Do you understand everything that is written above or do you require assistance or language interpretation?'],
        ];

        foreach ($fields as $field) {
            CRUD::addField([
                'name' => 'medical_consultation['.$field['name'].']',
                'label' => $field['label'],
                'entity' => 'medical_consultation',
                'model' => 'App\Models\MedicalConsultation',
                'type' => 'custom_boolean',
                'options' => [1 => 'Yes', 0 => 'No'],
                'value' => $entry->$field['name'] ?? 0,
            ]);
        }


        CRUD::addField([ 'name' => 'medical_consultation[notes]', 'type' => 'textarea', 'label' => 'Notes']);


        CRUD::addfield([
            'name' => 'treatment_detail[quantity]',
            'entity' => 'treatment_detail',
            'model' => 'App\Models\TreatmentDetail',
            'label' => 'Quantity',
            'type' => 'text',
        ]);

        CRUD::addfield([
            'name' => 'treatment_detail[location]',
            'entity' => 'treatment_detail',
            'model' => 'App\Models\TreatmentDetail',
            'label' => 'Location',
            'type' => 'text',
        ]);

        CRUD::addfield([
            'name' => 'treatment_detail[extra_notes]',
            'entity' => 'treatment_detail',
            'model' => 'App\Models\TreatmentDetail',
            'label' => 'Extra Notes',
            'type' => 'textarea',
        ]);

        CRUD::addfield([
            'label'        => "Treatment Photos (Before)",
            'name'         => "treatment_detail[before_treatment_photos]",
            'entity' => 'treatment_detail',
            'model' => 'App\Models\TreatmentDetail',
            'filename'     => "image_filename", // set to null if not needed
            'type'         => 'base64_image',
            'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
            'crop'         => false, // set to true to allow cropping, false to disable
            'src'          => NULL, // null to read straight from DB, otherwise set to model accessor function
        ]);

        CRUD::addfield([
            'label'        => "Treatment Photos (After)",
            'name'         => "treatment_detail[after_treatment_photos]",
            'entity' => 'treatment_detail',
            'model' => 'App\Models\TreatmentDetail',
            'filename'     => "image_filename", // set to null if not needed
            'type'         => 'base64_image',
            'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
            'crop'         => false, // set to true to allow cropping, false to disable
            'src'          => NULL, // null to read straight from DB, otherwise set to model accessor function
        ]);

        CRUD::addfield([
            'name' => 'treatment_detail[consent_to_photographs]',
            'label' => 'Patient Consent to Photographs',
            'entity' => 'treatment_detail',
            'model' => 'App\Models\TreatmentDetail',
            'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'],
            'hint' => 'I understand and consent to photographs being taken before and after this treatment.'
        ]);

        CRUD::addfield([
            'name' => 'treatment_detail[consent_to_treatment]',
            'label' => 'Patient Consent to Treatment',
            'entity' => 'treatment_detail',
            'model' => 'App\Models\TreatmentDetail',
            'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'],
            'hint' => 'By signing the below, I am consenting to the treatment as explained by the practitioner and acknowledge that I will receive details of the treatment, consultation, consent, and all related conditions and guidance.'
        ]);

        CRUD::addfield([
            'name' => 'treatment_detail[patient_signature]',
            'label' => 'Patient Declaration (Signature Required)',
            'entity' => 'treatment_detail',
            'model' => 'App\Models\TreatmentDetail',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public', // or your desired disk
            'hint' => 'Please upload your signature as an image file.',
        ]);

        CRUD::addField([
            'name' => 'treatment_detail[medicare_card_details_id]',
            'type' => 'relationship',
            'entity' => 'patient.medicare_card_details',
            'model' => 'App\Models\Patient',
            'attribute' => 'text',
            'ajax' => true,
            'inline_create' => true
        ]);

        CRUD::setFromDb(); // set fields from db columns.


    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        // MAYBE: do stuff before the autosetup

        // automatically add the columns
//        $this->autoSetupShowOperation();


        /*CRUD::addColumn([
            'name' => 'medical_consultations',
            'label' => 'Medical Consultation',
            'type' => 'relationship',
            'entity' => 'medical_consultations',
            'attribute' => 'id', // or another attribute you want to display
            'tab' => 'Medical Consultations',
            'columns' => [
                [
                    'name' => 'consultation_date',
                    'type' => 'date',
                    'label' => 'Consultation Date',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'serious_health_problems',
                    'type' => 'boolean',
                    'label' => 'Do you have any serious health problems, including any blood borne diseases or blood disorders?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'epilepsy_seizures_fainting',
                    'type' => 'boolean',
                    'label' => 'Do you suffer from epilepsy, seizures or fainting?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'autoimmune_disease',
                    'type' => 'boolean',
                    'label' => 'Do you have a history of autoimmune disease?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'surgery_history',
                    'type' => 'boolean',
                    'label' => 'Have you had any surgery, including cosmetic surgery?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'medications_supplements',
                    'type' => 'boolean',
                    'label' => 'Are you currently taking any medications or health supplements (prescribed or otherwise)?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'myasthenia_gravis',
                    'type' => 'boolean',
                    'label' => 'Have you been diagnosed with myasthenia gravis, Eaton-Lambert (myasthenic) syndrome, or any conditions that cause weakness in the muscles?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'cold_sores',
                    'type' => 'boolean',
                    'label' => 'Do you suffer from cold sores?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'pregnant_breastfeeding',
                    'type' => 'boolean',
                    'label' => 'Are you currently pregnant / breastfeeding or planning a pregnancy in the next 3 months including IVF?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'allergic_anything',
                    'type' => 'boolean',
                    'label' => 'Are you allergic to anything (including anaesthetics, adrenaline, medications)?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'sensitive_bees',
                    'type' => 'boolean',
                    'label' => 'Do you have any sensitivities or reactions to bee/wasp stings?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'numbing_injection',
                    'type' => 'boolean',
                    'label' => 'Have you ever had a numbing injection at the dentist?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'keloid_scarring',
                    'type' => 'boolean',
                    'label' => 'Do you have a history of abnormal scarring or keloid scarring?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'intend_to_surgical_invasive',
                    'type' => 'boolean',
                    'label' => 'Do you intend to have any surgical invasive dental procedures within the next 4 weeks or have you had any procedures within the last 4 weeks?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'implants',
                    'type' => 'boolean',
                    'label' => 'Do you have any implants or metalwork?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'vaccination',
                    'type' => 'boolean',
                    'label' => 'Have you received any vaccinations in the past 14 days, or do you intend on getting any vaccination in the next 14 days?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'tropical_treatment',
                    'type' => 'boolean',
                    'label' => 'Are you currently being treated with isotretinoin capsules or topical treatment (brands include Roaccutane, Oratane, Rocta, Dermatane and Isotrex)?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'anti_wrinkle',
                    'type' => 'boolean',
                    'label' => 'Have you ever received Botulinum Toxin Type A or other anti-wrinkle treatments before?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'dermal_fillers',
                    'type' => 'boolean',
                    'label' => 'Have you ever received dermal fillers before?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'stimulatory_fillers',
                    'type' => 'boolean',
                    'label' => 'Have you ever received a treatment with stimulatory fillers such as Sculptra or Radiesse?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'injectable_procedure',
                    'type' => 'boolean',
                    'label' => 'Have you ever had any complications with your previous cosmetic injectable procedures?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'smoke',
                    'type' => 'boolean',
                    'label' => 'Do you smoke?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'travel',
                    'type' => 'boolean',
                    'label' => 'Do you intend to travel internationally in the following 2 weeks?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'appearance',
                    'type' => 'boolean',
                    'label' => 'Are you worried about the way you look, and do you think about your appearance a lot and wish you could think about it less?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'affected_daily_life',
                    'type' => 'boolean',
                    'label' => 'Has the way you feel about it affected your daily life activities such as school, work or other activities?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'avoid_gatherings',
                    'type' => 'boolean',
                    'label' => 'Are there things you avoid because of how you look, such as gatherings, going out etc?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'thinking_look',
                    'type' => 'boolean',
                    'label' => 'Do you spend more than 2-3 hours a day thinking about how you look?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'life_adversely',
                    'type' => 'boolean',
                    'label' => 'If you could not have a cosmetic treatment today, would this affect your life adversely?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'before_after',
                    'type' => 'boolean',
                    'label' => 'Do you consent to have your before and after photos taken for the purpose of medical records?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'fully_consent',
                    'type' => 'boolean',
                    'label' => 'Have you been advised of the risks and fully consented for this treatment?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'understand',
                    'type' => 'boolean',
                    'label' => 'Do you understand everything that is written above or do you require assistance or language interpretation?',
                    'tab' => 'Medical Consultation',
                ],
                [
                    'name' => 'notes',
                    'type' => 'textarea',
                    'label' => 'Notes',
                    'tab' => 'Medical Consultation',
                ],
            ]
        ]);*/


        $this->crud->addColumn([
            'name' => 'patient.full_name',
            'type' => 'text',
            'attribute' => 'full_name',
            'label' => 'Full Name',

        ]);
        $this->crud->addColumn([
            'name' => 'patient.date_of_birth',
            'type' => 'text',
            'attribute' => 'date_of_birth',
            'label' => 'Date of Birth',
            'value' => function ($entry) {

                return $entry->patient && $entry->patient->date_of_birth ? date( 'M d,Y', strtotime($entry->patient->date_of_birth)) : '';
            },
        ]);

        $fields = [
            ['name' => 'consultation_date', 'label' => 'Consultation Date'],
            ['name' => 'serious_health_problems', 'label' => 'Do you have any serious health problems, including any blood borne diseases or blood disorders?'],
            ['name' => 'epilepsy_seizures_fainting', 'label' => 'Do you suffer from epilepsy, seizures or fainting?'],
            ['name' => 'autoimmune_disease', 'label' => 'Do you have a history of autoimmune disease?'],
            ['name' => 'surgery_history', 'label' => 'Have you had any surgery, including cosmetic surgery?'],
            ['name' => 'medications_supplements', 'label' => 'Are you currently taking any medications or health supplements (prescribed or otherwise)?'],
            ['name' => 'myasthenia_gravis', 'label' => 'Have you been diagnosed with myasthenia gravis, Eaton-Lambert (myasthenic) syndrome, or any conditions that cause weakness in the muscles?'],
            ['name' => 'cold_sores', 'label' => 'Do you suffer from cold sores?'],
            ['name' => 'pregnant_breastfeeding', 'label' => 'Are you currently pregnant / breastfeeding or planning a pregnancy in the next 3 months including IVF?'],
            ['name' => 'allergic_anything', 'label' => 'Are you allergic to anything (including anaesthetics, adrenaline, medications)?'],
            ['name' => 'sensitive_bees', 'label' => 'Do you have any sensitivities or reactions to bee/wasp stings?'],
            ['name' => 'numbing_injection', 'label' => 'Have you ever had a numbing injection at the dentist?'],
            ['name' => 'keloid_scarring', 'label' => 'Do you have a history of abnormal scarring or keloid scarring?'],
            ['name' => 'intend_to_surgical_invasive', 'label' => 'Do you intend to have any surgical invasive dental procedures within the next 4 weeks or have you had any procedures within the last 4 weeks?'],
            ['name' => 'implants', 'label' => 'Do you have any implants or metalwork?'],
            ['name' => 'vaccination', 'label' => 'Have you received any vaccinations in the past 14 days, or do you intend on getting any vaccination in the next 14 days?'],
            ['name' => 'tropical_treatment', 'label' => 'Are you currently being treated with isotretinoin capsules or topical treatment (brands include Roaccutane, Oratane, Rocta, Dermatane and Isotrex)?'],
            ['name' => 'anti_wrinkle', 'label' => 'Have you ever received Botulinum Toxin Type A or other anti-wrinkle treatments before?'],
            ['name' => 'dermal_fillers', 'label' => 'Have you ever received dermal fillers before?'],
            ['name' => 'stimulatory_fillers', 'label' => 'Have you ever received a treatment with stimulatory fillers such as Sculptra or Radiesse?'],
            ['name' => 'injectable_procedure', 'label' => 'Have you ever had any complications with your previous cosmetic injectable procedures?'],
            ['name' => 'smoke', 'label' => 'Do you smoke?'],
            ['name' => 'travel', 'label' => 'Do you intend to travel internationally in the following 2 weeks?'],
            ['name' => 'appearance', 'label' => 'Are you worried about the way you look, and do you think about your appearance a lot and wish you could think about it less?'],
            ['name' => 'affected_daily_life', 'label' => 'Has the way you feel about it affected your daily life activities such as school, work or other activities?'],
            ['name' => 'avoid_gatherings', 'label' => 'Are there things you avoid because of how you look, such as gatherings, going out etc?'],
            ['name' => 'thinking_look', 'label' => 'Do you spend more than 2-3 hours a day thinking about how you look?'],
            ['name' => 'life_adversely', 'label' => 'If you could not have a cosmetic treatment today, would this affect your life adversely?'],
            ['name' => 'before_after', 'label' => 'Do you consent to have your before and after photos taken for the purpose of medical records?'],
            ['name' => 'fully_consent', 'label' => 'Have you been advised of the risks and fully consented for this treatment?'],
            ['name' => 'understand', 'label' => 'Do you understand everything that is written above or do you require assistance or language interpretation?'],
            ['name' => 'notes', 'label' => 'Notes'],
        ];
    $this->crud->addField([
                'name' => 'medical_consultation_tab',
                'type' => 'hidden',
                'tab' => 'Medical Consultation', // This creates the tab
            ]);
        foreach ($fields as $field){
            $this->crud->addColumn([
                'name' => 'medical_consultation.'.$field['name'],
                'type' => 'text',
                 'tab' => 'Medical Consultation',
                'label' => $field['label'],
                'value' => function ($entry) use ($field) {
                    $q = $field['name'];

                    return $entry->medical_consultation && $entry->medical_consultation->$q ? 'Yes' : 'No';
                },
            ]);

        }

        $this->crud->addField([
            'name' => 'treatment_detail_tab',
            'type' => 'hidden',
            'tab' => 'Treatment Details', // This creates the tab
        ]);

        $treament_fields = [
            ['name' => 'quantity', 'label' => 'Quantity'],
            ['name' => 'location', 'label' => 'Location'],
            ['name' => 'extra_notes', 'label' => 'Extra Notes'],
//            ['name' => 'before_treatment_photos', 'label' => 'Treatment Photos (Before)'],
//            ['name' => 'after_treatment_photos', 'label' => 'Treatment Photos (After)'],
            ['name' => 'consent_to_photographs', 'label' => 'Patient Consent to Photographs']
        ];


        $this->crud->addColumn([
            'name'  => 'treatment_detail.before_treatment_photos',
            'type'  => 'image',
            'tab' => 'Treatment Details',
            'label' => 'Treatment Photos (Before)',
            'prefix' => 'storage/', // If you are using 'public' disk
        ]);
        $this->crud->addColumn([
            'name'  => 'treatment_detail.after_treatment_photos',
            'type'  => 'image',
            'tab' => 'Treatment Details',
            'label' => 'Treatment Photos (After)',
            'prefix' => 'storage/', // If you are using 'public' disk
        ]);
        foreach ($treament_fields as $treament_field){
            $this->crud->addColumn([
                'name' => 'treatment_detail.'.$treament_field['name'],
                'type' => 'text',
                'tab' => 'Treatment Details',
                'label' => $treament_field['label'],
                'value' => function ($entry) use ($treament_field) {
                    $q = $treament_field['name'];
                    return $entry->treatment_detail->$q;
                },
            ]);

        }

    }


    public function store()
    {

        $this->crud->validateRequest();


        DB::beginTransaction();

        try {

            $script = Script::create(request()->only([
                'patient_id'
            ]));


            if (request()->has('medical_consultation')) {


                $medicalConsultation = request('medical_consultation');

                $script->medical_consultation()->create( array_merge( $medicalConsultation, ['patient_id' => request('patient_id')]));
            }

            if (request()->has('treatment_detail')) {
                $treatmentDetails = request('treatment_detail');
                $script->treatment_detail()->create( array_merge( $treatmentDetails, ['patient_id' => request('patient_id')]));
            }

            DB::commit();

            // Redirect or return a response
            Alert::success('Patient, Medical Consultation, and Treatment Details saved successfully!')->flash();

            return redirect()->to($this->crud->route);

        }catch (Exception $exception){
            DB::rollBack();

            // Handle the exception (log it or display a user-friendly message)
            return back()->withErrors('An error occurred: ' . $exception->getMessage());
        }
    }


    public function fetchPatient()
    {
        $query = \App\Models\Patient::query();

        if (request()->has('q')) {
            $search = request()->input('q');
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%$search%")
                    ->orWhere('last_name', 'LIKE', "%$search%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$search%"]);
            });
        }

        $patients = $query->get();

        $results = $patients->map(function ($patient) {
            return [
                'id' => $patient->id,
                'text' => $patient->first_name . ' ' . $patient->last_name
            ];
        });

        return response()->json($results);
    }

    public function fetchCategory()
    {
        $query = \App\Models\MedicineCategory::query();

        if (request()->has('q')) {
            $search = request()->input('q');
            $query->where(function ($query) use ($search) {
                $query->where('category', 'LIKE', "%$search%");
            });
        }

        $categories = $query->get();

        $results = $categories->map(function ($patient) {
            return [
                'id' => $patient->id,
                'category' => $patient->category
            ];
        });

        return response()->json($results);
    }
}
