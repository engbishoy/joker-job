<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable=['name_en','name_ar'];
    
    public function section(){
        return $this->hasMany('App\Models\Section','category_id');
    }

    public function service(){
        return $this->hasManyThrough('App\Models\Service_work','App\Models\Section','category_id','section_id')->where('approve',1)->orderBy('created_at','DESC')->take(4);
    }

    public function businessExhibitions(){
        return $this->hasMany('App\Models\businessExhibitions','category_id');
    }


    public function getNameAttribute(){
        $locale=App::getLocale();
        $cloumn='name_'.$locale;
        return $this->{$cloumn};

    }
}
