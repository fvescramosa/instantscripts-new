<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NurseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NurseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NurseCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Nurse::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/nurse');
        CRUD::setEntityNameStrings('nurse', 'nurses');
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
        CRUD::setValidation(NurseRequest::class);

        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'value' => old('area') ?? $entry->area ?? nulL,
        ]);

        CRUD::addField([
            'name' => 'aphpra_registration_number',
            'label' => 'APRA Registration number',
            'type' => 'text',
            'value' => old('aphpra_registration_number') ?? $entry->aphpra_registration_number ?? nulL,
        ]);

        CRUD::addfield([
            'label'        => "Certificate",
            'name'         => "certificate",
            'filename'     => "image_filename", // set to null if not needed
            'type'         => 'base64_image',
            'aspect_ratio' => 1, // set to 0 to allow any aspect ratio
            'crop'         => false, // set to true to allow cropping, false to disable
            'src'          => NULL, // null to read straight from DB, otherwise set to model accessor function
            'attribute' => [
                'class' => 'col-sm-4'
            ]
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
