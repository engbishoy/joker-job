<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\question;
use App\Models\Setting;
use Illuminate\Http\Request;

class settingController extends Controller
{
    //

    public function aboutus(){
        $setting=Setting::first();
        $about=$setting->about;
        return view('site.setting.aboutus')->with('about',$about);
    }   
    
    public function usagePolicy(){
        $setting=Setting::first();
        $usagePolicy=$setting->policyUsage;
        return view('site.setting.usagePolicy')->with('usagePolicy',$usagePolicy);
    }

    public function conditions(){
        $setting=Setting::first();
        $conditions=$setting->conditions;
        return view('site.setting.conditions')->with('conditions',$conditions);
    }
    

    public function questions(){
        $questions=question::all();
        return view('site.setting.questions')->with('questions',$questions);
    }
    

}
