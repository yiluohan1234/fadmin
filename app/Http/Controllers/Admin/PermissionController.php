<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
// VALIDATION
use App\Http\Requests\PermissionRequest as StoreRequest;
use App\Http\Requests\PermissionRequest as UpdateRequest;

class PermissionController extends CrudController
{
     public function setup()
    {
        $role_model = config('permission.models.role');
        $permission_model = config('permission.models.permission');
        $this->crud->setModel($permission_model);
        $this->crud->setEntityNameStrings(trans('permissionmanager.permission_singular'), trans('permissionmanager.permission_plural'));
        $this->crud->setRoute(config('fadmin.base.route_prefix').'/permission');
        $this->crud->addColumn([
            'name'  => 'name',
            'label' => trans('permissionmanager.name'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([ // n-n relationship (with pivot table)
            'label'     => trans('permissionmanager.roles_have_permission'),
            'type'      => 'select_multiple',
            'name'      => 'roles',
            'entity'    => 'roles',
            'attribute' => 'name',
            'model'     => $role_model,
            'pivot'     => true,
        ]);
        $this->crud->addField([
            'name'  => 'name',
            'label' => trans('permissionmanager.name'),
            'type'  => 'text',
        ]);
        $this->crud->addField([
            'label'     => trans('permissionmanager.roles'),
            'type'      => 'checklist',
            'name'      => 'roles',
            'entity'    => 'roles',
            'attribute' => 'name',
            'model'     => $role_model,
            'pivot'     => true,
        ]);
        if (!config('fadmin.permissionmanager.allow_permission_create')) {
            $this->crud->denyAccess('create');
        }
        if (!config('fadmin.permissionmanager.allow_permission_update')) {
            $this->crud->denyAccess('update');
        }
        if (!config('fadmin.permissionmanager.allow_permission_delete')) {
            $this->crud->denyAccess('delete');
        }
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
