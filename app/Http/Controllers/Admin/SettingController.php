<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
// VALIDATION
use App\Http\Requests\SettingRequest as StoreRequest;
use App\Http\Requests\SettingRequest as UpdateRequest;

class SettingController extends CrudController
{
    public function setup()
    {
        parent::setup();
        $this->crud->setModel("App\Models\Setting");
        $this->crud->setEntityNameStrings(trans('settings.setting_singular'), trans('settings.setting_plural'));
        $this->crud->setRoute(fadmin_url('setting'));
        $this->crud->addClause('where', 'active', 1);
        $this->crud->denyAccess(['create', 'delete']);
        $this->crud->setColumns([
            [
                'name'  => 'name',
                'label' => trans('settings.name'),
            ],
            [
                'name'  => 'value',
                'label' => trans('settings.value'),
            ],
            [
                'name'  => 'description',
                'label' => trans('settings.description'),
            ],
        ]);
        $this->crud->addField([
            'name'       => 'name',
            'label'      => trans('settings.name'),
            'type'       => 'text',
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);
    }
    /**
     * Display all rows in the database for this entity.
     * This overwrites the default CrudController behaviour:
     * - instead of showing all entries, only show the "active" ones.
     *
     * @return Response
     */
    public function index()
    {
        return parent::index();
    }
    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->crud->hasAccessOrFail('update');
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->crud->addField(json_decode($this->data['entry']->field, true)); // <---- this is where it's different
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields'] = $this->crud->getUpdateFields($id);
        $this->data['title'] = trans('crud.edit').' '.$this->crud->entity_name;
        $this->data['id'] = $id;
        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getEditView(), $this->data);
    }
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}
