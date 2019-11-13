<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envoi extends Model
{

    public function service() {
        return $this->belongsTo('App\Service') ;
    }

    public function courrier() {
        return $this->belongsTo('App\Courrier') ;
    }
}
