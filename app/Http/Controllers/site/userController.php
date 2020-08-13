<?php

namespace App\Http\Controllers\site;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pull_credit;
use App\Models\Service_work;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    //
    public function accountSetting(){
        return view('site.user.accountsetting');
    }
    public function updateAccountSetting(Request $request){
        $validate= Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
            'photo' => ['nullable', 'image'],
            'about'=>['max:1000'],
            'skills'=>['max:200']
            
        ]);

        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }
        $user=User::find(auth()->user()->id);
        $user->name=$request->name;
        
        if($request->password!=''){
        $user->password=Hash::make($request->password);
        }

        $photo=$request->photo;
        if(!empty($photo)){
            $photoname=time().'-'.$photo->getClientOriginalName();
            $photo->move(base_path().'/public/site/img/users/',$photoname);
            $user->photo=$photoname;
        }

        $user->about_you=$request->about;
        $user->skills=$request->skills;
        $user->save(); 
        return redirect()->back()->with('success',__('trans_word.updatedsuccess'));
    }


    public function profile($id){
        $user=User::find($id);
        return view('site.user.profile')->with('user',$user);
    }


    public function service($id){
        $user=User::find($id);
        return view('site.user.profileservice')->with('user',$user);
    }


    public function completeOrder($id){
        $user=User::find($id);
        return view('site.user.completeOrder')->with('user',$user);
    }


    // الاعمال السابقة
    public function businessExhibition($id){
        $user=User::find($id);
        return view('site.user.businessExhibition')->with('user',$user);
    }
    





    public function cancelemail(){
        $user=User::find(auth()->user()->id);
        $user->delete();
        return redirect('/');
    }




    //myservice
    public function myservice(){
        $service=Service_work::where('user_id',auth()->user()->id)->orderBy('created_at','DESC')->get();
        return view('site.user.myservice')->with('service',$service);
    }




    // credit user

    public function credit(){
        $user=User::find(auth()->user()->id);
        return view('site.user.credit')->with('user',$user);
    }


    public function pullCredit(Request $request){
        $request->validate([
            'email_paypal'=>'email|required',
            'amount'=>'required'
        ]);

        $user=User::find(auth()->user()->id);
        $credit=$user->credit;

        if($credit && $request->amount<=$credit->amount){
        // طرح المبلغ من جدول الرصيد
        $credit->update( array( 'amount'=>($credit->amount-$request->amount) ) );


        // insert in pull_credits table
        $pullCredit=new Pull_credit();
        $pullCredit->user_id=auth()->user()->id;
        $pullCredit->amount=$request->amount;
        $pullCredit->email_paypal=$request->email_paypal;
        $pullCredit->save();

        
        return redirect()->back()->with('success',__('trans_word.The amount will be transferred to your Paypal account within 5 days'));
        }else{
        return redirect()->back()->withErrors(__('trans_word.The amount you requested is greater than the available balance in your account. Only profits from selling services can be withdrawn.'));
        }

    }



}
