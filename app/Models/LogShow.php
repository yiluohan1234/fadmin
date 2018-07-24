<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Orgs\Crud\CrudTrait;
class LogShow extends Model
{
    use CrudTrait;
    protected $table = 'logs';
}
