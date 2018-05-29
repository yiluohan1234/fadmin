<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
// VALIDATION
use App\Http\Requests\RoleRequest as StoreRequest;
use App\Http\Requests\RoleRequest as UpdateRequest;

class RoleController extends CrudController
{
    public function setup()
    {
        $role_model = config('permission.models.role');
        $permission_model = config('permission.models.permission');
        $this->crud->setModel($role_model);
        $this->crud->setEntityNameStrings(trans('permissionmanager.role'), trans('permissionmanager.roles'));
        $this->crud->setRoute(config('fadmin.base.route_prefix').'/role');
        $this->crud->setColumns([
            [
                'name'  => 'name',
                'label' => trans('permissionmanager.name'),
                'type'  => 'text',
            ],
            [
                // n-n relationship (with pivot table)
                'label'     => ucfirst(trans('permissionmanager.permission_plural')),
                'type'      => 'select_multiple',
                'name'      => 'permissions', // the method that defines the relationship in your Model
                'entity'    => 'permissions', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => $permission_model, // foreign key model
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?
            ],
        ]);
        $this->crud->addField([
            'name'  => 'name',
            'label' => trans('permissionmanager.name'),
            'type'  => 'text',
        ]);
        $this->crud->addField([
            'label'     => ucfirst(trans('permissionmanager.permission_plural')),
            'type'      => 'checklist',
            'name'      => 'permissions',
            'entity'    => 'permissions',
            'attribute' => 'name',
            'model'     => $permission_model,
            'pivot'     => true,
        ]);
        if (config('fadmin.permissionmanager.allow_role_create') == false) {
            $this->crud->denyAccess('create');
        }
        if (config('fadmin.permissionmanager.allow_role_update') == false) {
            $this->crud->denyAccess('update');
        }
        if (config('fadmin.permissionmanager.allow_role_delete') == false) {
            $this->crud->denyAccess('delete');
        }
    }
    public function store(StoreRequest $request)
    {
        //otherwise, changes won't have effect
        \Cache::forget('spatie.permission.cache');
        return parent::storeCrud();
    }
    public function update(UpdateRequest $request)
    {
        //otherwise, changes won't have effect
        \Cache::forget('spatie.permission.cache');
        return parent::updateCrud();
    }
}
