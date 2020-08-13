<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    //
    protected $fillable=['title_en','title_ar','answer_en','answer_en','answer_ar'];

    public function getTitleAttribute(){
        $locale=App::getLocale();
        $cloumn='title_'.$locale;
        return $this->{$cloumn};

    }

    public function getAnswerAttribute(){
        $locale=App::getLocale();
        $cloumn='answer_'.$locale;
        return $this->{$cloumn};

    }

}
