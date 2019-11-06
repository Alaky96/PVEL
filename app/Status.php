<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'code';
}
