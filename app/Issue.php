<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected  $table = 'issues';

    public function answers()
    {
        return $this->hasMany('App\Answer', "fk_issue");
    }

    public function author()
    {
        return $this->belongsTo("App\User", "fk_user");
    }

    public function supplier()
    {
        return $this->belongsTo("App\User", "fk_supplier");
    }

    public function getCodeAttribute()
    {
        return sprintf('%06d', $this->id);
    }

}
