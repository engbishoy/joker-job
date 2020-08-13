<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service_work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\approve_service_from_admin;
use App\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;

class service_workController extends Controller
{
    //

    
    public function __construct()
    {
        $this->middleware(['permission:services_update'])->only('approve','unapprove','block');
        $this->middleware(['permission:services_read'])->only('index','search','show');
        $this->middleware(['permission:services_delete'])->only('delete');
    }


    public function index(){
        $service=Service_work::paginate(10);

        return view('admin.servicework.index')->with('service',$service);
    }


    public function show($id){
        $service=Service_work::find($id);
        if($service){
        return view('admin.servicework.show')->with('service',$service);
        }else{
            return Redirect()->back();
        }
    }

    public function delete($id){
        $service=Service_work::find($id);
        $service->delete();
        return response()->json(['message'=>__('trans_word.deletesuccess')], 200);
    }

    public function approve($id){
        $service=Service_work::find($id);
        $service->update(array('approve'=>1));

        $userid=User::find($service->user_id);
        Notification::send($userid,new approve_service_from_admin($service));

        return redirect()->back()->with('success',__('trans_word.approveservice'));
    }

    public function unapprove($id){
        $service=Service_work::find($id);
        $service->update(array('approve'=>2));
        
        $userid=User::find($service->user_id);
        Notification::send($userid,new approve_service_from_admin($service));

        return redirect()->back()->with('success',__('trans_word.unapproveservice'));
        
    }

    public function block($id){
        $service=Service_work::find($id);
        $service->update(array('approve'=>3));
        
        $userid=User::find($service->user_id);
        Notification::send($userid,new approve_service_from_admin($service));

        return redirect()->back()->with('success',__('trans_word.The service has been successfully blocked'));
        
    }

    public function search(Request $request){
        $service=Service_work::where('title','like','%'.$request->search.'%')->orwhere('description','like','%'.$request->search.'%')->orwhere('id',$request->search)->orwhere('tags','like','%'.$request->search.'%')->paginate(10);
        return view('admin.servicework.search')->with('service',$service);
    }
}
