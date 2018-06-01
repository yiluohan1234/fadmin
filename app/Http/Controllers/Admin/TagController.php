<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TagRequest as StoreRequest;
use App\Http\Requests\TagRequest as UpdateRequest;

class TagController extends CrudController
{
    public function __construct()
    {
        parent::__construct();
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Tag");
        $this->crud->setRoute(config('fadmin.base.route_prefix', 'admin').'/tag');
        $this->crud->setEntityNameStrings(trans('blogs.tag'), trans('blogs.tags'));
        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */
        // ------ CRUD COLUMNS
        $this->crud->addColumn([
                                'name' => 'name',
                                'label' => trans('blogs.Name'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'slug',
                                'label' => trans('blogs.Slug'),
                            ]);
        // ------ CRUD FIELDS
        $this->crud->addField([
                                'name' => 'name',
                                'label' => trans('blogs.Name'),
                            ]);
        $this->crud->addField([
                                'name' => 'slug',
                                'label' => trans('blogs.Slug (URL)'),
                                'type' => 'text',
                                'hint' => trans('blogs.Will be automatically generated from your name, if left empty.'),
                                // 'disabled' => 'disabled'
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
