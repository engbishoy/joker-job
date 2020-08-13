<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    //
    protected $fillable=['user_id','amount','currancy'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
