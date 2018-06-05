<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Orgs\Crud\CrudTrait;


class Link extends Model
{
    use CrudTrait;
    protected $table = 'links';
    protected $fillable = ['name', 'value'];
}
