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

        return response()->json($query->get());
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
            'attribute' => 'last_name',
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
                ['name' => 'serious_health_problems', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you have any serious health problems, including any blood borne diseases or blood disorders?'],
                ['name' => 'epilepsy_seizures_fainting', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you suffer from epilepsy, seizures or fainting?'],
                ['name' => 'autoimmune_disease', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you have a history of autoimmune disease?'],
                ['name' => 'surgery_history', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Have you had any surgery, including cosmetic surgery?'],
                ['name' => 'medications_supplements', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Are you currently taking any medications or health supplements (prescribed or otherwise)?'],
                ['name' => 'myasthenia_gravis', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Have you been diagnosed with myasthenia gravis, Eaton-Lambert (myasthenic) syndrome, or any conditions that cause weakness in the muscles?'],
                ['name' => 'cold_sores', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you suffer from cold sores?'],
                ['name' => 'pregnant_breastfeeding', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Are you currently pregnant / breastfeeding or planning a pregnancy in the next 3 months including IVF?'],
                ['name' => 'allergic_anything', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Are you allergic to anything (including anaesthetics, adrenaline, medications)?'],
                ['name' => 'sensitive_bees', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you have any sensitivities or reactions to bee/wasp stings?'],
                ['name' => 'numbing_injection', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Have you ever had a numbing injection at the dentist?'],
                ['name' => 'keloid_scarring', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you have a history of abnormal scarring or keloid scarring?'],
                ['name' => 'intend_to_surgical_invasive', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you intend to have any surgical invasive dental procedures within the next 4 weeks or have you had any procedures within the last 4 weeks?'],
                ['name' => 'implants', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you have any implants or metalwork?'],
                ['name' => 'vaccination', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Have you received any vaccinations in the past 14 days, or do you intend on getting any vaccination in the next 14 days?'],
                ['name' => 'tropical_treatment', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Are you currently being treated with isotretinoin capsules or topical treatment (brands include Roaccutane, Oratane, Rocta, Dermatane and Isotrex)?'],
                ['name' => 'anti_wrinkle', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Have you ever received Botulinum Toxin Type A or other anti-wrinkle treatments before?'],
                ['name' => 'dermal_fillers', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Have you ever received dermal fillers before?'],
                ['name' => 'stimulatory_fillers', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Have you ever received a treatment with stimulatory fillers such as Sculptra or Radiesse?'],
                ['name' => 'injectable_procedure', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Have you ever had any complications with your previous cosmetic injectable procedures?'],
                ['name' => 'smoke', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you smoke?'],
                ['name' => 'travel', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you intend to travel internationally in the following 2 weeks?'],
                ['name' => 'appearance', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Are you worried about the way you look, and do you think about your appearance a lot and wish you could think about it less?'],
                ['name' => 'affected_daily_life', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Has the way you feel about it affected your daily life activities such as school, work or other activities?'],
                ['name' => 'avoid_gatherings', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Are there things you avoid because of how you look, such as gatherings, going out etc?'],
                ['name' => 'thinking_look', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you spend more than 2-3 hours a day thinking about how you look?'],
                ['name' => 'life_adversely', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'If you could not have a cosmetic treatment today, would this affect your life adversely?'],
                ['name' => 'before_after', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you consent to have your before and after photos taken for the purpose of medical records?'],
                ['name' => 'fully_consent', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Have you been advised of the risks and fully consented for this treatment?'],
                ['name' => 'understand', 'type' => 'radio',  'options' => [0 => 'No', 1 => 'Yes'], 'label' => 'Do you understand everything that is written above or do you require assistance or language interpretation?'],
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


                [
                    'name' => 'treatment_photos',
                    'label' => 'Treatment Photos',
                    'type' => 'upload',
                    'upload' => true,
                    'disk' => 'public', // or your desired disk
                    'hint' => 'Supported types: JPEG, PNG, PDF. Max file size 5MB.',
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
