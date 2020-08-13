<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class settingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $setting=Setting::first();
        return view('admin.settings.index')->with('setting',$setting);
    }

    
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'policyUsage_en'=>'required|string',
            'policyUsage_ar'=>'required|string',
            'about_en'=>'required|string',
            'about_ar'=>'required|string',
            'conditions_en'=>'required|string',
            'conditions_ar'=>'required|string',
        ]);
        $setting=Setting::find($id);
        $setting->policyUsage_en=$request->policyUsage_en;
        $setting->policyUsage_ar=$request->policyUsage_ar;

        $setting->conditions_en=$request->conditions_en;
        $setting->conditions_ar=$request->conditions_ar;

        
        $setting->about_en=$request->about_en;
        $setting->about_ar=$request->about_ar;
        $setting->save();
        return redirect()->back()->with('success',__('trans_word.updatedsuccess'));

    }

}
