<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\WodasRequest as StoreRequest;
use App\Http\Requests\WodasRequest as UpdateRequest;

class WodasController extends CrudController
{
    public function __construct()
    {
        parent::__construct();
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Wodas");
        $this->crud->setRoute(config('fadmin.base.route_prefix', 'admin').'/wodas');
        $this->crud->setEntityNameStrings(trans('wodas.wodas'), trans('wodas.wodass'));
        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */
        // ------ CRUD COLUMNS
        $this->crud->addColumn([
                                'name' => 'name',
                                'label' => trans('wodas.name'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'value',
                                'label' => trans('wodas.value'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'description',
                                'label' => trans('wodas.description'),
                            ]);
        // ------ CRUD FIELDS
        $this->crud->addField([
                                'name' => 'name',
                                'label' => trans('wodas.name'),
                            ]);
        $this->crud->addField([
                                'name' => 'value',
                                'label' => trans('wodas.value'),
                            ]);
        $this->crud->addField([
                                'name' => 'description',
                                'label' => trans('wodas.description'),
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
