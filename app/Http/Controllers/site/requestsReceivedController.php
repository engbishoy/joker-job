<?php

namespace App\Http\Controllers\site;

use App\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Credit;
use App\Notifications\statusSaleService;
use Illuminate\Support\Facades\Notification;

class requestsReceivedController extends Controller
{
    //
    public function index(){
        $user=User::find(auth()->user()->id);
        return view('site.requests_received.index')->with('user',$user);
    }

    public function completed(){
        $user=User::find(auth()->user()->id);
        return view('site.requests_received.completed')->with('user',$user);
    }

    public function Refusal(){
        $user=User::find(auth()->user()->id);
        return view('site.requests_received.Refusal')->with('user',$user);
    }

    public function canceled(){
        $user=User::find(auth()->user()->id);
        return view('site.requests_received.canceled')->with('user',$user);
    }


    public function show($id){
        $order=Order::find($id);
        if(isset($order) && $order->service->user_id==auth()->user()->id){
        return view('site.requests_received.show')->with('order',$order);
        }else{
            return redirect()->back();
        }


    }

    // approve sale service
    public function approve($id){
        $order=Order::find($id);
        $order->update(array('sale_service_approve'=>1));
        
        // notification confirm from sale service
        $userid=$order->user_id;
        $user=User::find($userid);

        Notification::send($user, new statusSaleService($order));
        return redirect()->back()->with('success',__('trans_word.The request was successfully approved'));
    }

    // cancel sale service
    public function cancel($id){
        $order=Order::find($id);
        $order->update(array('sale_service_approve'=>2));

      // تحويل مبلغ الطلب الى المشترى 
      // send money to user in credits table
      $credit=Credit::where('user_id',$order->user_id)->first();
      if($credit){
          $credit->update(array('amount'=>$credit->amount+$order->price));
      }else{
          $credituser=new Credit();
          $credituser->user_id=$order->user_id;
          $credituser->amount=$order->price;
          $credituser->currancy='USD';
          $credituser->save();
      }
      
      

        // notification cancel from sale service
        $userid=$order->user_id;
        $user=User::find($userid);
        Notification::send($user, new statusSaleService($order));

        return redirect()->back()->with('success',__('trans_word.The request was successfully Canceled'));
    }

}
