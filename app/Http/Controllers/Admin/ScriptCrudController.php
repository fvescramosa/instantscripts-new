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
        CRUD::setFromDb(); // set columns from db columns.


        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
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
            'name' => 'medical_consultation',
            'label' => '',
            'type' => 'relationship',
            'entity' => 'medical_consultation',
            'label' => 'Medical Consultations',
//            'tab' => 'Medical Consultations',
            'subfields' => [
                ['name' => 'consultation_date', 'type' => 'date', 'label' => 'Consultation Date'],
                [
                    'name' => 'serious_health_problems',
                    'label' => 'Do you have any serious health problems, including any blood borne diseases or blood disorders?',
                    'type' => 'custom_boolean', // Your custom field
                    'options' => [
                        1 => 'Yes',
                        0 => 'No',
                    ],
                    'value' => $entry->serious_health_problems ?? 0, // set the default value
                ],
                [
                    'name' => 'epilepsy_seizures_fainting',
                    'label' => 'Do you suffer from epilepsy, seizures or fainting?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->epilepsy_seizures_fainting ?? 0,
                ],
                [
                    'name' => 'autoimmune_disease',
                    'label' => 'Do you have a history of autoimmune disease?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->autoimmune_disease ?? 0,
                ],
                [
                    'name' => 'surgery_history',
                    'label' => 'Have you had any surgery, including cosmetic surgery?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->surgery_history ?? 0,
                ],
                [
                    'name' => 'medications_supplements',
                    'label' => 'Are you currently taking any medications or health supplements (prescribed or otherwise)?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->medications_supplements ?? 0,
                ],
                [
                    'name' => 'myasthenia_gravis',
                    'label' => 'Have you been diagnosed with myasthenia gravis, Eaton-Lambert (myasthenic) syndrome, or any conditions that cause weakness in the muscles?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->myasthenia_gravis ?? 0,
                ],
                [
                    'name' => 'cold_sores',
                    'label' => 'Do you suffer from cold sores?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->cold_sores ?? 0,
                ],
                [
                    'name' => 'pregnant_breastfeeding',
                    'label' => 'Are you currently pregnant / breastfeeding or planning a pregnancy in the next 3 months including IVF?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->pregnant_breastfeeding ?? 0,
                ],
                [
                    'name' => 'allergic_anything',
                    'label' => 'Are you allergic to anything (including anaesthetics, adrenaline, medications)?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->allergic_anything ?? 0,
                ],
                [
                    'name' => 'sensitive_bees',
                    'label' => 'Do you have any sensitivities or reactions to bee/wasp stings?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->sensitive_bees ?? 0,
                ],
                [
                    'name' => 'numbing_injection',
                    'label' => 'Have you ever had a numbing injection at the dentist?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->numbing_injection ?? 0,
                ],
                [
                    'name' => 'keloid_scarring',
                    'label' => 'Do you have a history of abnormal scarring or keloid scarring?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->keloid_scarring ?? 0,
                ],
                [
                    'name' => 'intend_to_surgical_invasive',
                    'label' => 'Do you intend to have any surgical invasive dental procedures within the next 4 weeks or have you had any procedures within the last 4 weeks?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->intend_to_surgical_invasive ?? 0,
                ],
                [
                    'name' => 'implants',
                    'label' => 'Do you have any implants or metalwork?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->implants ?? 0,
                ],
                [
                    'name' => 'vaccination',
                    'label' => 'Have you received any vaccinations in the past 14 days, or do you intend on getting any vaccination in the next 14 days?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->vaccination ?? 0,
                ],
                [
                    'name' => 'tropical_treatment',
                    'label' => 'Are you currently being treated with isotretinoin capsules or topical treatment (brands include Roaccutane, Oratane, Rocta, Dermatane and Isotrex)?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->tropical_treatment ?? 0,
                ],
                [
                    'name' => 'anti_wrinkle',
                    'label' => 'Have you ever received Botulinum Toxin Type A or other anti-wrinkle treatments before?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->anti_wrinkle ?? 0,
                ],
                [
                    'name' => 'dermal_fillers',
                    'label' => 'Have you ever received dermal fillers before?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->dermal_fillers ?? 0,
                ],
                [
                    'name' => 'stimulatory_fillers',
                    'label' => 'Have you ever received a treatment with stimulatory fillers such as Sculptra or Radiesse?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->stimulatory_fillers ?? 0,
                ],
                [
                    'name' => 'injectable_procedure',
                    'label' => 'Have you ever had any complications with your previous cosmetic injectable procedures?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->injectable_procedure ?? 0,
                ],
                [
                    'name' => 'smoke',
                    'label' => 'Do you smoke?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->smoke ?? 0,
                ],
                [
                    'name' => 'travel',
                    'label' => 'Do you intend to travel internationally in the following 2 weeks?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->travel ?? 0,
                ],
                [
                    'name' => 'appearance',
                    'label' => 'Are you worried about the way you look, and do you think about your appearance a lot and wish you could think about it less?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->appearance ?? 0,
                ],
                [
                    'name' => 'affected_daily_life',
                    'label' => 'Has the way you feel about it affected your daily life activities such as school, work or other activities?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->affected_daily_life ?? 0,
                ],
                [
                    'name' => 'avoid_gatherings',
                    'label' => 'Are there things you avoid because of how you look, such as gatherings, going out etc?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->avoid_gatherings ?? 0,
                ],
                [
                    'name' => 'thinking_look',
                    'label' => 'Do you spend more than 2-3 hours a day thinking about how you look?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->thinking_look ?? 0,
                ],
                [
                    'name' => 'life_adversely',
                    'label' => 'If you could not have a cosmetic treatment today, would this affect your life adversely?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->life_adversely ?? 0,
                ],
                [
                    'name' => 'before_after',
                    'label' => 'Do you consent to have your before and after photos taken for the purpose of medical records?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->before_after ?? 0,
                ],
                [
                    'name' => 'fully_consent',
                    'label' => 'Have you been advised of the risks and fully consented for this treatment?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->fully_consent ?? 0,
                ],
                [
                    'name' => 'understand',
                    'label' => 'Do you understand everything that is written above or do you require assistance or language interpretation?',
                    'type' => 'custom_boolean',
                    'options' => [1 => 'Yes', 0 => 'No'],
                    'value' => $entry->understand ?? 0,
                ],
                ['name' => 'notes', 'type' => 'textarea', 'label' => 'Notes'],
            ],
            'ajax' => false,
        ]);
        CRUD::addField([
            'name' => 'treatment_detail',
//            'tab' => 'Treatment Details',
            'label' => 'Treatment Details',
//            'label' => '',
            'type' => 'relationship',

            'entity' => 'treatment_detail',
            'subfields' => [

                [
                    'name' => 'quantity',
                    'label' => 'Quantity',
                    'type' => 'text',
                ],

                [
                    'name' => 'location',
                    'label' => 'Location',
                    'type' => 'text',
                ],

                [
                    'name' => 'extra_notes',
                    'label' => 'Extra Notes',
                    'type' => 'textarea',
//                    'wrapper' => 'col-md-6'
                ],


                /*[
                    'name' => 'treatment_photos',
                    'label' => 'Treatment Photos',
                    'type' => 'upload',
                    'upload' => true,
                    'disk' => 'public', // or your desired disk
                    'hint' => 'Supported types: JPEG, PNG, PDF. Max file size 5MB.',
                ],*/

                [
                    'label'        => "Treatment Photos (Before)",
                    'name'         => "before_treatment_photos",
                    'filename'     => "image_filename", // set to null if not needed
                    'type'         => 'base64_image',
                    'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
                    'crop'         => false, // set to true to allow cropping, false to disable
                    'src'          => NULL, // null to read straight from DB, otherwise set to model accessor function
                ],

                [
                    'label'        => "Treatment Photos (After)",
                    'name'         => "after_treatment_photos",
                    'filename'     => "image_filename", // set to null if not needed
                    'type'         => 'base64_image',
                    'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
                    'crop'         => false, // set to true to allow cropping, false to disable
                    'src'          => NULL, // null to read straight from DB, otherwise set to model accessor function
                ],

                [
                    'name' => 'consent_to_photographs',
                    'label' => 'Patient Consent to Photographs',
                    'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'],
                    'hint' => 'I understand and consent to photographs being taken before and after this treatment.'
                ],

                [
                    'name' => 'consent_to_treatment',
                    'label' => 'Patient Consent to Treatment',
                    'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'],
                    'hint' => 'By signing the below, I am consenting to the treatment as explained by the practitioner and acknowledge that I will receive details of the treatment, consultation, consent, and all related conditions and guidance.'
                ],

                [
                    'name' => 'patient_signature',
                    'label' => 'Patient Declaration (Signature Required)',
                    'type' => 'upload',
                    'upload' => true,
                    'disk' => 'public', // or your desired disk
                    'hint' => 'Please upload your signature as an image file.',
                ]
            ],
            'ajax' => false,
        ]);

        /*CRUD::addField([
            'label'     => "Patient",
            'type'      => 'select2',
            'name'      => 'patient_id',

            'entity'    => 'patient',
            'model'     => "App\Models\Patient",
            'attribute' => 'full_name',
            'allows_null' => false,
            'default' => 1,
            'options'   => (function ($query) {
                if (request()->has('q')) {
                    $search = request()->input('q');
                    return $query->where('first_name', 'LIKE', "%$search%")
                        ->orWhere('last_name', 'LIKE', "%$search%")
                        ->orderBy('id', 'ASC')
                        ->get();
                }
                return $query->orderBy('id', 'ASC')->get();
            }),
            'ajax' => true,
            'inline_create' => true,
        ]);*/


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

                $script->medical_consultation()->create( array_merge( $medicalConsultation[0], ['patient_id' => request('patient_id')]));
            }

            if (request()->has('treatment_detail')) {
                $treatmentDetails = request('treatment_detail');
                $script->treatment_detail()->create( array_merge( $treatmentDetails[0], ['patient_id' => request('patient_id')]));
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
}
