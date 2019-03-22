<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    
    protected $guarded = [];

    public $table = 'materials' ; 
    public function  teachers()
    {
        return $this->belongsToMany('App\Teacher');
    }

}
