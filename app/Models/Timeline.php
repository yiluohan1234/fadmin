<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Orgs\Crud\CrudTrait;

class Timeline extends Model
{
    use CrudTrait;
    protected $fillable = ['title', 'content', 'color', 'action', 'date'];
}
