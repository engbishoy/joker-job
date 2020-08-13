<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pull_credit extends Model
{
    //
    protected $fillable=['user_id','email_paypal','amount','pull_status'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
