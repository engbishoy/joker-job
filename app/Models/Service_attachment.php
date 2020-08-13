<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service_attachment extends Model
{
    //

    protected $fillable=['description','files','user_id','order_id'];


    public function order(){
        return $this->belongsTo('App\Models\Order','order_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
