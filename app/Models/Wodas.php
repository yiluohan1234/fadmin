<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Orgs\Crud\CrudTrait;

class Wodas extends Model
{
    use CrudTrait;
    protected $table = 'wodas';
    protected $fillable = ['name', 'value', 'description'];
}
