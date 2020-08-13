<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    //
    protected $fillable=['user_id','category_technical_id','message','title','attachment','status'];

    //category ticket
    public function categoryTechnical(){
        return $this->belongsTo('App\Models\CategoryTechnical','category_technical_id');
    }

    // user open ticket
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }


    //comments ticket
    public function comment(){
        return $this->hasMany('App\Models\Comment_ticket','ticket_id');
    }
}
