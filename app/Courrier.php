<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courrier extends Model
{

    use SoftDeletes ;
    protected $dates = ['deleted_at'];


    public function piecejointes() {
        return $this->hasMany('App\Piecejointe') ;
    }

    public function envois() {
        return $this->hasMany('App\Envoi') ;
    }

    public function consultations() {
        return $this->hasMany('App\Consultation') ;
    }
}
