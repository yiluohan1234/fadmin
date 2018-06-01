<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CategoryRequest as StoreRequest;
use App\Http\Requests\CategoryRequest as UpdateRequest;

class CategoryController extends CrudController
{
    public function __construct()
    {
        parent::__construct();
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Category");
        $this->crud->setRoute(config('fadmin.base.route_prefix', 'admin').'/category');
        $this->crud->setEntityNameStrings(trans('blogs.category'), trans('blogs.categories'));
        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */
        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('name', 2);
        // ------ CRUD COLUMNS
        $this->crud->addColumn([
                                'name' => 'name',
                                'label' => trans('blogs.Name'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'slug',
                                'label' => trans('blogs.Slug'),
                            ]);
        $this->crud->addColumn([
                                'label' => trans('blogs.Parent'),
                                'type' => 'select',
                                'name' => 'parent_id',
                                'entity' => 'parent',
                                'attribute' => 'name',
                                'model' => "App\Models\Category",
                            ]);
        // ------ CRUD FIELDS
        $this->crud->addField([
                                'name' => 'name',
                                'label' => trans('blogs.Name'),
                            ]);
        $this->crud->addField([
                                'name' => 'slug',
                                'label' => 'Slug (URL)',
                                'type' => 'text',
                                'hint' => trans('blogs.Will be automatically generated from your name, if left empty.'),
                                // 'disabled' => 'disabled'
                            ]);
        $this->crud->addField([
                                'label' => trans('blogs.Parent'),
                                'type' => 'select',
                                'name' => 'parent_id',
                                'entity' => 'parent',
                                'attribute' => 'name',
                                'model' => "App\Models\Category",
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
