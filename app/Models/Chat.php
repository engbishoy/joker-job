<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    protected $fillable=['from','to','message','photo','seen'];

    public function fromuser(){
        return $this->belongsTo('App\User','from');
    }

    public function touser(){
        return $this->belongsTo('App\User','to');
    }
}
