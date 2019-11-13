<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Piecejointe extends Model
{

    use SoftDeletes ;
    protected $dates = ['deleted_at'];
    public function courrier() {
        return $this->belongsTo('App\Courrier') ;
    }
}
