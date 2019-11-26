<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anwser extends Model
{
    protected $table = 'answers';

    public function author()
    {
        return $this->belongsTo("App\User", "fk_user");
    }
}
