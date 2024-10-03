<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PatientRequest;
use App\Models\MedicalConsultation;
use App\Models\Script;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
/**
 * Class PatientCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PatientCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Patient::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/patient');
        CRUD::setEntityNameStrings('patient', 'patients');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

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
        CRUD::setValidation(PatientRequest::class);

        CRUD::setFromDb(); // set fields from db columns.



        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
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
        $this->autoSetupShowOperation();


        $patientId = $this->crud->getCurrentEntryId(); // Get the current patient's ID
        $patient = \App\Models\Patient::with('medical_consultations')->find($patientId); // Eager load the related consultations



        foreach ($patient->medical_consultations as $medical_consultation){
            $this->crud->addField([
                'name' => 'medical_consultation_tab_'.$medical_consultation->id,
                'type' => 'hidden',
                'tab' => date('M, d, Y', strtotime($medical_consultation->consultation_date)),
            ]);

            $details = MedicalConsultation::with('script', 'script.treatment_detail')->find($medical_consultation->id);


            $treament_fields = [
                ['name' => 'quantity', 'label' => 'Quantity'],
                ['name' => 'location', 'label' => 'Location'],
                ['name' => 'extra_notes', 'label' => 'Extra Notes'],
                ['name' => 'top_treatment_photos', 'label' => 'Treatment Photos (Top)'],
                ['name' => 'bottom_treatment_photos', 'label' => 'Treatment Photos (Bottom)'],
                ['name' => 'left_treatment_photos', 'label' => 'Treatment Photos (Left)'],
                ['name' => 'right_treatment_photos', 'label' => 'Treatment Photos (Right)'],
                ['name' => 'consent_to_photographs', 'label' => 'Patient Consent to Photographs']
            ];

            $treatment_detail = $details->script->treatment_detail;


            foreach ($treament_fields as $treatment_field){

                if($treatment_field['name'] == 'top_treatment_photos' || $treatment_field['name'] == 'bottom_treatment_photos' || $treatment_field['name'] == 'left_treatment_photos' || $treatment_field['name'] == 'right_treatment_photos'  ){
                    $this->crud->addColumn([
                        'name' => 'medical_consultation_' . $medical_consultation->id . '_' .$treatment_field['name'],
                        'type'  => 'image',
                        'tab' => $medical_consultation->consultation_date,
                        'label' => $treatment_field['label'],
                        'value' => function ($entry) use ($treatment_field, $treatment_detail) {
                            $q = $treatment_field['name'];
                            return $treatment_detail->$q ?? '';
                        },
                    ]);
                }

                $this->crud->addColumn([
                    'name' => 'medical_consultation_' . $medical_consultation->id . '_' .$treatment_field['name'],
                    'type' => 'text',
                    'tab' => $medical_consultation->consultation_date,
                    'label' => $treatment_field['label'],
                    'value' => function ($entry) use ($treatment_field, $treatment_detail) {
                        $q = $treatment_field['name'];
                        return $treatment_detail->$q ?? '';
                    },
                ]);

            }

            /*$fields = [

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


            foreach ($fields as $field){
                $this->crud->addColumn([
                    'name' => 'medical_consultation_' . $medical_consultation->id . '_' .$field['name'],
                    'type' => 'text',
                    'tab' => $medical_consultation->consultation_date,
                    'label' => $field['label'],
                    'value' => function ($entry) use ($field, $details) {
                        $q = $field['name'];
                        return $details->$q ? 'Yes' : 'No';
                    },
                ]);

            }*/


        }
    }
}
