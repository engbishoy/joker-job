<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class CategoryTechnical extends Model
{
    //
   protected $fillable=['name_en','name_ar'];


   public function ticket(){
    return $this->hasMany('App\Models\ticket','category_technical_id');
   }

   public function getNameAttribute(){
    $locale=App::getLocale();
    $cloumn='name_'.$locale;
    return $this->{$cloumn};
   }


}
