<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MedicareCardDetailsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

/**
 * Class MedicareCardDetailsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MedicareCardDetailsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\MedicareCardDetails::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/medicare-card-details');
        CRUD::setEntityNameStrings('medicare card details', 'medicare card details');
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
        CRUD::setValidation(MedicareCardDetailsRequest::class);
        CRUD::addField([
            'name' => 'patient_id',
            'type' => 'relationship',
            'entity' => 'patient',
            'model' => 'App\Models\Patient',
            'attribute' => 'text',
            'ajax' => true,
//            'inline_create' => true
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

}
