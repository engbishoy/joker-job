<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    //
    protected $fillable=['user_id','service_work_id','comment','evaluation'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function service(){
        return $this->belongsTo('App\Models\Service_work','service_id');
    }
}
