<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class businessExhibition extends Model
{
    //

    protected $fillable=['title','description','photos','skills','link_work','category_id','section_id','user_id'];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }
}
