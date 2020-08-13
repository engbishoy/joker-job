<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class adminLoginController extends Controller
{
    //

    public function __construct(){
         $this->middleware('guest:admin')->except('logout');
    }


    public function showlogin(){
        return view('admin.login');
    }

    public function login(Request $request){
        $validator=Validator::make($request->all(),[
            'identify'=>'string|required',
            'password'=>'min:8|required',
        ]);

        $identify=$request->identify;
        $type=filter_var($identify,FILTER_VALIDATE_EMAIL) ? 'email':'phone';
        request()->merge([$type=>$identify]);

        if(Auth::guard('admin')->attempt([$type => $identify, 'password' => $request->password])){
            return redirect()->intended('/dashboard');
        }else{
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }

}
