<?php

namespace App\Http\Controllers\site;

use App\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Models\Evaluation;
use App\Notifications\statusOrderService;
use Illuminate\Support\Facades\Notification;

class ordersController extends Controller
{
    //
    public function index(){
        $order=Order::where('user_id',auth()->user()->id)->orderBy('created_at','DESC')->get();
        return view('site.orders.index')->with('order',$order);
    }

    public function completed(){
        $order=Order::where('user_id',auth()->user()->id)->where('status',1)->orWhere('status',4)->orderBy('created_at','DESC')->get();
        return view('site.orders.complete')->with('order',$order);
    }

    public function canceled(){
        // canceled from admin
        $order=Order::where('user_id',auth()->user()->id)->where('status',3)->orWhere('sale_service_approve',2)->orderBy('created_at','DESC')->get();
        return view('site.orders.cancel')->with('order',$order);
    }



    public function show($id){
        $order=Order::find($id);
        if(isset($order) && $order->user_id==auth()->user()->id){
            return view('site.orders.show')->with('order',$order);
        }else{
            return redirect()->back();
        }
    }



    public function approve(Request $request ,$id){
        $request->validate([
            'comment'=>'string|max:255|required',
            'evaluation'=>'required',
        ]);

        //update status order
        $order=Order::find($id);
        $order->update(array('status'=>1));

        // evaluation service
        $evaluation=new Evaluation();
        $evaluation->user_id=$order->user_id;
        $evaluation->service_work_id=$order->service_work_id;
        $evaluation->comment=$request->comment;
        $evaluation->evaluation=$request->evaluation;
        $evaluation->save();

        //notification
        $user=User::find($order->service->user_id);
        Notification::send($user, new statusOrderService($order));


        // send money to user in credits table
        $credit=Credit::where('user_id',$order->service->user_id)->first();
        if($credit){
            $credit->update(array('amount'=>$credit->amount+$order->price));
        }else{
            $credituser=new Credit();
            $credituser->user_id=$order->service->user_id;
            $credituser->amount=$order->price;
            $credituser->currancy='USD';
            $credituser->save();
        }
        
        return redirect()->back()->with('success',__('trans_word.The service is approved'));
    }

    public function refusal($id){
        $order=Order::find($id);
        $order->update(array('status'=>2));

        $user=User::find($order->service->user_id);
        Notification::send($user,new statusOrderService($order));
        
        return redirect()->back()->withErrors(__('trans_word.The service was rejected'));
    }

    public function readNotificationOrderservice(){
        auth()->user()->unreadnotificationsOrderService->markAsRead();
    }
}
