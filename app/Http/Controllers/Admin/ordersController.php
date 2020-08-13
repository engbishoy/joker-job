<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Credit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service_work;

class ordersController extends Controller
{
    //

    
    public function __construct()
    {
        $this->middleware(['permission:controlOrder_read'])->only('index','show');
        $this->middleware(['permission:controlOrder_update'])->only('complete','cancel');
    }

    public function index(){
        $order=Order::orderBy('created_at','DESC')->get();
        return view('admin.order.index')->with('order',$order);
    }

    public function show($id){
        $order=Order::find($id);

        if(isset($order)){
            return view('admin.order.show')->with('order',$order);
        }else{
            return redirect()->back();
        }
        
    }


    // complete order from admin
    public function complete($id){
        $order=Order::find($id);
        $order->update(array('status'=>4));
        
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
        
        return redirect()->back()->with('success',__('trans_word.The order is complete'));
        
    }




      // cancel order from admin
      public function cancel($id){
        $order=Order::find($id);
        $order->update(array('status'=>3));
        
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
        
        return redirect()->back()->with('success',__('trans_word.The order is canceled'));
        
    }
    

    //block service 
    public function blockService($id){
        $service=Service_work::find($id);
        $service->update(array('approve'=>3));
        return redirect()->back()->with('success','The service has been successfully blocked');
    }


      //search order 
      public function search(Request $request){
          $order=Order::where('id',$request->search)->paginate(10);
          return view('admin.order.search')->with('order',$order);
      }


}
