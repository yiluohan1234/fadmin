<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ArticleRequest as StoreRequest;
use App\Http\Requests\ArticleRequest as UpdateRequest;

class ArticleController extends CrudController
{
    public function __construct()
    {
        parent::__construct();
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Article");
        $this->crud->setRoute(config('fadmin.base.route_prefix', 'admin').'/article');
        $this->crud->setEntityNameStrings(trans('blogs.setting_singular'), trans('blogs.setting_plural'));
        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */
        // ------ CRUD COLUMNS
        $this->crud->addColumn([
                                'name' => 'date',
                                'label' => trans('blogs.Date'),
                                'type' => 'date',
                            ]);
        $this->crud->addColumn([
                                'name' => 'status',
                                'label' => trans('blogs.Status'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'title',
                                'label' => trans('blogs.Title'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'featured',
                                'label' => trans('blogs.Featured'),
                                'type' => 'check',
                            ]);
        $this->crud->addColumn([
                                'label' => trans('blogs.Category'),
                                'type' => 'select',
                                'name' => 'category_id',
                                'entity' => 'category',
                                'attribute' => 'name',
                                'model' => "App\Models\Category",
                            ]);
        $this->crud->addColumn([
                                'label' => trans('blogs.Model'),
                                'type' => 'select',
                                'name' => 'model_id',
                                'entity' => 'models',
                                'attribute' => 'name',
                                'model' => "App\Models\Modeler",
                            ]);
        // ------ CRUD FIELDS
        $this->crud->addField([    // TEXT
                                'name' => 'title',
                                'label' => trans('blogs.Title'),
                                'type' => 'text',
                                'placeholder' => 'Your title here',
                            ]);
        $this->crud->addField([
                                'name' => 'slug',
                                'label' => trans('blogs.Slug (URL)'),
                                'type' => 'text',
                                'hint' => trans('blogs.Will be automatically generated from your title, if left empty.'),
                                // 'disabled' => 'disabled'
                            ]);
        $this->crud->addField([    // TEXT
                                'name' => 'date',
                                'label' => trans('blogs.Date'),
                                'type' => 'date',
                                'value' => date('Y-m-d'),
                            ], 'create');
        $this->crud->addField([    // TEXT
                                'name' => 'date',
                                'label' => trans('blogs.Date'),
                                'type' => 'date',
                            ], 'update');
        $this->crud->addField([    // WYSIWYG
                                'name' => 'content',
                                'label' => trans('blogs.Content'),
                                'type' => 'ckeditor',
                                'placeholder' => trans('blog.Your textarea text here'),
                            ]);
        $this->crud->addField([    // Image
                                'name' => 'image',
                                'label' => trans('blogs.Image'),
                                'type' => 'browse',
                            ]);
        $this->crud->addField([    // SELECT
                                'label' => trans('blogs.Category'),
                                'type' => 'select2',
                                'name' => 'category_id',
                                'entity' => 'category',
                                'attribute' => 'name',
                                'model' => "App\Models\Category",
                            ]);
        $this->crud->addField([    // SELECT
                                'label' => trans('blogs.Model'),
                                'type' => 'select2',
                                'name' => 'model_id',
                                'entity' => 'models',
                                'attribute' => 'name',
                                'model' => "App\Models\Modeler",
                            ]);
        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
                                'label' => trans('blogs.Tags'),
                                'type' => 'select2_multiple',
                                'name' => 'tags', // the method that defines the relationship in your Model
                                'entity' => 'tags', // the method that defines the relationship in your Model
                                'attribute' => 'name', // foreign key attribute that is shown to user
                                'model' => "App\Models\Tag", // foreign key model
                                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                            ]);
        $this->crud->addField([    // ENUM
                                'name' => 'status',
                                'label' => trans('blogs.Status'),
                                'type' => 'enum',
                            ]);
        $this->crud->addField([    // CHECKBOX
                                'name' => 'featured',
                                'label' => trans('blogs.Featured item'),
                                'type' => 'checkbox',
                            ]);
        $this->crud->enableAjaxTable();
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
