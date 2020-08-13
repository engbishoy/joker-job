<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //

    protected $fillable=['name_en','name_ar','description_en','description_ar','category_id'];

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function servicework(){
        return $this->hasMany('App\Models\Service_work','section_id');
    }


    public function getNameAttribute(){
        $locale=App::getLocale();
        $cloumn='name_'.$locale;
        return $this->{$cloumn};

    }
}
