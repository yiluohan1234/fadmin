<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ModelRequest as StoreRequest;
use App\Http\Requests\ModelRequest as UpdateRequest;

class ModelController extends CrudController
{
    public function __construct()
    {
        parent::__construct();
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Modeler");
        $this->crud->setRoute(config('fadmin.base.route_prefix', 'admin').'/model');
        $this->crud->setEntityNameStrings(trans('models.model'), trans('models.models'));
        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */
        // ------ CRUD COLUMNS
        $this->crud->addColumn([
                                'name' => 'name',
                                'label' => trans('models.name'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'slug',
                                'label' => trans('models.Slug'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'value',
                                'label' => trans('models.value'),
                            ]);
        // ------ CRUD FIELDS
        $this->crud->addField([
                                'name' => 'name',
                                'label' => trans('models.name'),
                            ]);
        $this->crud->addField([
                                'name' => 'slug',
                                'label' => trans('models.Slug (URL)'),
                                'type' => 'text',
                                'hint' => trans('models.Will be automatically generated from your name, if left empty.'),
                                // 'disabled' => 'disabled'
                            ]);
        $this->crud->addField([
                                'name' => 'value',
                                'label' => trans('models.value'),
                            ]);
    }
    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}
