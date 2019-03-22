<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Teacher extends Authenticatable
{
    
    use Notifiable;

    protected $guarded = [];
    public $table = 'teachers' ; 

    public function  materials()
    {
        return $this->belongsToMany('App\Material');
    }
    
}
