<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AreaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class AreaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class AreaCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Area::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/area');
        CRUD::setEntityNameStrings('area', 'areas');
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
        CRUD::setValidation(AreaRequest::class);

        $rules = [
            'product_id' => 'required',
            'area' => 'required',
        ];

        $messages = [
            'product_id' => 'Product is required',
            'area' => 'Area is required',
        ];
        $this->crud->setValidation(

            $rules, $messages
        );


        CRUD::addField([
            'name' => 'product_id',
            'type' => 'relationship',
            'entity' => 'product',
            'model' => 'App\Models\Product',
            'attribute' => 'text',
            'ajax' => true,
            'value' => old('product_id') ?? $entry->product_id ?? nulL,
        ]);

        CRUD::addField([
            'name' => 'area',
            'type' => 'text',
            'value' => old('area') ?? $entry->area ?? nulL,
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

    public function fetchProduct()
    {
        $query = \App\Models\Product::query();


        if (request()->has('q')) {
            $search = request()->input('q');
            $query->where(function ($query) use ($search) {
                $query->where('product', 'LIKE', "%$search%");
            });
        }

        $products = $query->get();


        $results = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'text' => $product->product
            ];
        });

        return response()->json($results);
    }
}
