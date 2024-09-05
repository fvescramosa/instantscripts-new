<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MedicalConsultationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MedicalConsultationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MedicalConsultationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\MedicalConsultation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/medical-consultation');
        CRUD::setEntityNameStrings('medical consultation', 'medical consultations');
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
        CRUD::setValidation(MedicalConsultationRequest::class);

        $this->crud->addField([
            'name' => 'consultation_date',
            'label' => 'Consultation Date',
            'type' => 'date_picker',
        ]);

        $this->crud->addField([
            'name' => 'serious_health_problems',
            'label' => 'Do you have any serious health problems, including any blood borne diseases or blood disorders?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'epilepsy_seizures_fainting',
            'label' => 'Do you suffer from epilepsy, seizures or fainting?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'autoimmune_disease',
            'label' => 'Do you have a history of autoimmune disease?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'surgery_history',
            'label' => 'Have you had any surgery, including cosmetic surgery?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'medications_supplements',
            'label' => 'Are you currently taking any medications or health supplements (prescribed or otherwise)?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'myasthenia_gravis',
            'label' => 'Have you been diagnosed with myasthenia gravis, Eaton-Lambert (myasthenic) syndrome, or any conditions that cause weakness in the muscles?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'cold_sores',
            'label' => 'Do you suffer from cold sores?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'pregnant_breastfeeding',
            'label' => 'Are you currently pregnant / breastfeeding or planning a pregnancy in the next 3 months including IVF?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'allergic_anything',
            'label' => 'Are you allergic to anything (including anaesthetics, adrenaline, medications)?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'sensitive_bees',
            'label' => 'Do you have any sensitivities or reactions to bee/wasp stings?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'numbing_injection',
            'label' => 'Have you ever had a numbing injection at the dentist?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'keloid_scarring',
            'label' => 'Do you have a history of abnormal scarring or keloid scarring?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'intend_to_surgical_invasive',
            'label' => 'Do you intend to have any surgical invasive dental procedures within the next 4 weeks or have you had any procedures within the last 4 weeks?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'implants',
            'label' => 'Do you have any implants or metalwork?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'vaccination',
            'label' => 'Have you received any vaccinations in the past 14 days, or do you intend on getting any vaccination in the next 14 days?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'tropical_treatment',
            'label' => 'Are you currently being treated with isotretinoin capsules or topical treatment (brands include Roaccutane, Oratane, Rocta, Dermatane and Isotrex)?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'anti_wrinkle',
            'label' => 'Have you ever received Botulinum Toxin Type A or other anti-wrinkle treatments before?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'dermal_fillers',
            'label' => 'Have you ever received dermal fillers before?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'stimulatory_fillers',
            'label' => 'Have you ever received a treatment with stimulatory fillers such as Sculptra or Radiesse?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'injectable_procedure',
            'label' => 'Have you ever had any complications with your previous cosmetic injectable procedures?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'smoke',
            'label' => 'Do you smoke?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'travel',
            'label' => 'Do you intend to travel internationally in the following 2 weeks?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'appearance',
            'label' => 'Are you worried about the way you look, and do you think about your appearance a lot and wish you could think about it less? Yes',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'affected_daily_life',
            'label' => 'Has the way you feel about it affected your daily life activities such as school, work or other activities?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'avoid_gatherings',
            'label' => 'Are there things you avoid because of how you look, such as gatherings, going out etc?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'thinking_look',
            'label' => 'Do you spend more than 2-3 hours a day thinking about how you look?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'life_adversely',
            'label' => 'If you could not have a cosmetic treatment today, would this affect your life adversely?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'before_after',
            'label' => 'Do you consent to have your before and after photos taken for the purpose of medical records?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'fully_consent',
            'label' => 'Have you been advised of the risks and fully consented for this treatment?',
            'type' => 'boolean',
        ]);

        $this->crud->addField([
            'name' => 'understand',
            'label' => 'Do you understand everything that is written above or do you require assistance or language interpretation?',
            'type' => 'boolean',
        ]);

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
}
