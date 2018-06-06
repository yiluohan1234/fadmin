<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TimelineRequest as StoreRequest;
use App\Http\Requests\TimelineRequest as UpdateRequest;

class TimelineController extends CrudController
{
    public function __construct()
    {
        parent::__construct();
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\Models\Timeline");
        $this->crud->setRoute(config('fadmin.base.route_prefix', 'admin').'/timeline');
        $this->crud->setEntityNameStrings(trans('timeline.setting_singular'), trans('timeline.setting_plural'));
        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */
        // ------ CRUD COLUMNS
        $this->crud->addColumn([
                                'name' => 'date',
                                'label' => trans('timeline.Date'),
                                'type' => 'date',
                            ]);
        $this->crud->addColumn([
                                'name' => 'title',
                                'label' => trans('timeline.Title'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'action',
                                'label' => trans('timeline.Action'),
                            ]);
        $this->crud->addColumn([
                                'name' => 'color',
                                'label' => trans('timeline.Color'),
                            ]);
        // ------ CRUD FIELDS
        $this->crud->addField([    // TEXT
                                'name' => 'title',
                                'label' => trans('timeline.Title'),
                                'type' => 'text',
                                'placeholder' => 'Your title here',
                            ]);
        $this->crud->addField([    // TEXT
                                'name' => 'date',
                                'label' => trans('timeline.Date'),
                                'type' => 'date',
                                'value' => date('Y-m-d'),
                            ], 'create');
        $this->crud->addField([    // TEXT
                                'name' => 'date',
                                'label' => trans('timeline.Date'),
                                'type' => 'date',
                            ], 'update');
        $this->crud->addField([    // WYSIWYG
                                'name' => 'content',
                                'label' => trans('timeline.Content'),
                                'type' => 'ckeditor',
                                'placeholder' => trans('blog.Your textarea text here'),
                            ]);
        $this->crud->addField([    // SELECT
                                'label' => trans('timeline.Action'),
                                'type' => 'enum',
                                'name' => 'action',
                            ]);
        $this->crud->addField([    // ENUM
                                'name' => 'color',
                                'label' => trans('timeline.Color'),
                                'type' => 'enum',
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
