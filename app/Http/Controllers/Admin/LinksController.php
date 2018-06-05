<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\LinkRequest as StoreRequest;
use App\Http\Requests\LinkRequest as UpdateRequest;

class LinksController extends CrudController
{
    public function __construct()
    {
        parent::__construct();
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Link");
        $this->crud->setRoute(config('fadmin.base.route_prefix', 'admin').'/link');
        $this->crud->setEntityNameStrings(trans('settings.link'), trans('settings.links'));
        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */
        // ------ CRUD COLUMNS
        $this->crud->addColumn([
                                'name' => 'name',
                                'label' => trans('settings.name'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'value',
                                'label' => trans('settings.value'),
                            ]);
        // ------ CRUD FIELDS
        $this->crud->addField([
                                'name' => 'name',
                                'label' => trans('settings.name'),
                            ]);
        $this->crud->addField([
                                'name' => 'value',
                                'label' => trans('settings.value'),
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
