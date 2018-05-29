<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Orgs\Crud\CrudTrait;
use Spatie\Permission\Models\Permission as OriginalPermission;

class Permission extends OriginalPermission
{
    use CrudTrait;
    protected $fillable = ['name', 'updated_at', 'created_at'];
}
