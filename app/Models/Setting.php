<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable=['policyUsage_en','policyUsage_ar','conditions_en','conditions_ar','about_en','about_ar'];

    public function getPolicyUsageAttribute(){
        $locale=App::getLocale();
        $cloumn='policyUsage_'.$locale;
        return $this->{$cloumn};

    }


    public function getConditionsAttribute(){
        $locale=App::getLocale();
        $cloumn='conditions_'.$locale;
        return $this->{$cloumn};

    }


    public function getAboutAttribute(){
        $locale=App::getLocale();
        $cloumn='about_'.$locale;
        return $this->{$cloumn};

    }


   
}
