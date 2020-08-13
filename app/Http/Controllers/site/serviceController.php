<?php

namespace App\Http\Controllers\site;

use App\User;
use PayPal\Api\Item;
use App\Models\Order;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
//paypal

use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use App\Models\Service_work;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

use Illuminate\Support\Facades\DB;
use App\Notifications\orderService;
use App\Http\Controllers\Controller;
use App\Http\Resources\sectionsByCategory;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Support\Facades\Notification;

class serviceController extends Controller
{
    //

    public function serviceSection($id){
        $section=Section::find($id);
        if($section){
        $service=Service_work::where('section_id',$id)->where('approve',1)->orderBy('created_at','desc')->paginate(9);
        $servicetime=Service_work::where('section_id',$id)->where('approve',1)->groupBy('time_execute')->get();
        return view('site.service.serviceSection')->with('service',$service)->with('section',$section)->with('servicetime',$servicetime);
        }else{
            return Redirect()->back();
        }

    }


     public function filterTime(Request $request){

        $filterTime=$request->filter_time;
        foreach($filterTime as $filter){
            $service=Service_work::where('time_execute',$filter)->where('section_id',$request->section_id)->where('approve',1)->get();
            $services[]=$service;
        }

        return view('site.service.resultFilterTime')->with('service',$services);
    }


    public function filterSort(Request $request){

        if($request->type_sort=='highprice'){
            $service=Service_work::where('section_id',$request->section_id)->where('approve',1)->orderBy('price','desc')->get();
        }
        if($request->type_sort=='lowprice'){
            $service=Service_work::where('section_id',$request->section_id)->where('approve',1)->orderBy('price','asc')->get();
        }
        if($request->type_sort=='toprate'){
            $service=Service_work::where('section_id',$request->section_id)->where('approve',1)->whereHas('topRate')->get();
        }
        if($request->type_sort=='latestadd'){
            $service=Service_work::where('section_id',$request->section_id)->where('approve',1)->orderBy('created_at','desc')->get();
        }
        if($request->type_sort=='oldadd'){
            $service=Service_work::where('section_id',$request->section_id)->where('approve',1)->orderBy('created_at','asc')->get();
        }

        return view('site.service.sortService')->with('service',$service);
    }

    public function create(){
        $category=Category::all(); 
        $section=Section::all();
        return view('site.service.create')->with('category',$category)->with('section',$section);
    }

    // section by category with ajax

    public function sectionsByCategory(Request $request){
        $category=Category::find($request->id);
        return response()->json(['sections'=>sectionsByCategory::collection($category->section)],200);
    }



    // store service 
    public function store(Request $request){
        $request->validate([
            'title'=>'max:200|required',
            'price'=>'numeric|required',
            'description'=>'required|max:1000',
            'category'=>'required',
            'section'=>'required',
            'photos.*'=>'required|image|max:2000',
            'tags'=>'required',
        ]);

        if($request->price>=5){
        $service=new Service_work();
        $service->title=$request->title;
        $service->price=$request->price;
        $service->description=$request->description;
        $service->tags=$request->tags;
        $service->category_id=$request->category;
        $service->section_id=$request->section;
        $service->user_id=auth()->user()->id;
        $service->time_execute=$request->time_execute;
        

        $photo=$request->photos;
        foreach($photo as $photos){
        $photoname=time().'-'.$photos->getClientOriginalName();
        $photos->move(base_path().'/public/site/img/servicework/',$photoname);
        $multiphoto[]=$photoname;
        }
        $images=implode(',',$multiphoto);
        
        $service->photos=$images;

        $service->save();

        return redirect()->back()->with('success',__('trans_word.The service has been successfully added, awaiting review and approval by the manager to view it'));

    }else{
        return redirect()->back()->withErrors(__('trans_word.The minimum price is $ 5.'));

    }


    
    }


    public function show($id){
        $service=Service_work::find($id);
        if(isset($service)){

        if(isset(auth()->user()->id)){
            if(auth()->user()->id!=$service->user_id){
            $view_service= DB::table('view_service')->where([
                ['user_id',auth()->user()->id],
                ['service_work_id',$id]
                ])->get();
            if($view_service->count()==0){
                DB::table('view_service')->insert([
                    ['user_id'=>auth()->user()->id ,'service_work_id'=>$id]
                ]);
            }

            }
        }
        return view('site.service.show')->with('service',$service);

        }else{
            return redirect()->back();
        }

    }



    public function showPay($id){
        $service=Service_work::find($id);

        if(isset($service) && $service->approve==1){

        if(isset(auth()->user()->id) && auth()->user()->id!=$service->user_id){
        return view('site.service.showPay')->with('service',$service);
        }else{
            return redirect()->back();
        }
    
        }

    }




    public function payService($id){
        $service=Service_work::find($id);

        $taxes=$service->price*5/100;
        $totalprice=$service->price+$taxes;


    //paypal 

    // context

    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            config('payment.accounts.client_id'),     // ClientID
            config('payment.accounts.secret_client')    // Secret client
        )
    );

    $apiContext->setConfig(config('payment.setting'));


        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
        $item1->setName($service->title)
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setSku($service->id) // Similar to `item_number` in Classic API
        ->setPrice($totalprice);


        $list[]=$item1;
        $itemList = new ItemList();
        $itemList->setItems($list);
        
        // taxes 
        $details = new Details();
        $details->setShipping(0)
        ->setTax(0)
        ->setSubtotal($totalprice);

        $amount = new Amount();
        $amount->setCurrency("USD")
        ->setTotal($totalprice)
        ->setDetails($details);


        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription("Joker job payment service")
        ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('pay.success'))
        ->setCancelUrl(route('pay.cancel'));


        $payment = new Payment();
        $payment->setIntent("order")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));


        $request = clone $payment;

        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            exit(1);
        }
 
        $approvalUrl = $payment->getApprovalLink();
        
  
        session(['totalprice'=>$totalprice]);
        session(['price'=>$service->price]);
        
        return redirect($approvalUrl);

    }


    public function success(Request $request){

        if(isset($request->paymentId) && $request->paymentId!='' && isset($request->token) && $request->token!='' && isset($request->PayerID) && $request->PayerID!=''){
            
            // context

            $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    config('payment.accounts.client_id'),     // ClientID
                    config('payment.accounts.secret_client')    // Secret client
                )
            );

            $apiContext->setConfig(config('payment.setting'));

            $paymentId = $request->paymentId;
            $payment = Payment::get($paymentId, $apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);

            $transaction = new Transaction();
            $amount = new Amount();
            $details = new Details();

            $totalprice=session('totalprice');
            session()->forget('totalprice');


            $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($totalprice);

            $amount->setCurrency('USD');
            $amount->setTotal($totalprice);
            $amount->setDetails($details);
            $transaction->setAmount($amount);

            $execution->addTransaction($transaction);




            try {
                        $result =$payment->execute($execution, $apiContext);       
                        
                        try {
                            $payment = Payment::get($paymentId,$apiContext);
                        } catch (Exception $ex) {
                        exit(1);
                        }
                } catch (Exception $ex) {
                    exit(1);
                    }
                                
                return $payment;
                    if($payment){

                                
                    $price=session('price');
                    session()->forget('price');

                    // insert to orders table
                    $order=new Order();
                    $order->user_id=auth()->user()->id;
                    $order->service_work_id=$payment->transactions[0]->item_list->items[0]->sku;  //service id
                    $order->payed_id=$payment->id;
                    $order->price=$price;
                    $order->taxes=$price*5/100;
                    $order->total_price=$payment->transactions[0]->amount->total;
                    $order->save();

                    // notification to sale service 
                    $saleservice=$order->service->user_id;
                    $user=User::find($saleservice);
                    
                    Notification::send($user,new orderService($order));

                    //end
                    
                    return redirect()->route('service.pay.show',['id'=>$payment->transactions[0]->item_list->items[0]->sku])->with('success',__('trans_word.Congratolations The amount was successfully paid').$payment->transactions[0]->amount->total . $payment->transactions[0]->amount->currency  . __('trans_word.The payment process number is').$payment->id);
                                    
                    }
   

                
                }

        }

    


    public function cancel(){
        return "cancel payment";
    }


    
    public function payMyCredit($id){
        $service=Service_work::find($id);
        if( auth()->user()->credit && auth()->user()->credit <= ($service->price+$service->price*5/100) ){
            
        // insert to orders table
        $order=new Order();
        $order->user_id=auth()->user()->id;
        $order->service_work_id=$service->id;  //service id
        $order->price=$service->price;
        $order->taxes=$service->price*5/100;
        $order->total_price=($service->price+$service->price*5/100);
        $order->save();

        // notification to sale service 
        $saleservice=$order->service->user_id;
        $user=User::find($saleservice);
        
        Notification::send($user,new orderService($order));

        return redirect()->back()->with('success',__('trans_word.Congratolations The amount was successfully paid') . $order->total_price );
        //end
        }else{
            return redirect()->back()->withErrors(__('trans_word.Sorry,you dont have amount service to buy the service'));
        }

    }



    // edit service
    public function edit($id){
        $service=Service_work::find($id);
        $category=Category::all();

        if(isset($service)){

        if($service->user_id==auth()->user()->id){
        return view('site.service.edit')->with('service',$service)->with('category',$category);
        }else{
            return redirect()->back();
        }

        }else{
            return redirect()->back();
        }
    
    }



    // update service
    public function update(Request $request,$id){
        $request->validate([
            'title'=>'max:200|required',
            'price'=>'numeric|required',
            'description'=>'required|max:1000',
            'category'=>'required',
            'section'=>'required',
            'photos.*'=>'image|max:2000',
            'tags'=>'required',
        ]);


        $service=Service_work::find($id);
        $service->title=$request->title;
        $service->price=$request->price;
        $service->description=$request->description;
        $service->tags=$request->tags;
        $service->category_id=$request->category;
        $service->section_id=$request->section;
        $service->user_id=auth()->user()->id;
        $service->time_execute=$request->time_execute;
        $service->approve=0;
        
        $photo=$request->photos;
        if($photo!=''){
        if(count($photo)<=4){
        foreach($photo as $photos){
        $photoname=time().'-'.$photos->getClientOriginalName();
        $photos->move(base_path().'/public/site/img/servicework/',$photoname);
        $multiphoto[]=$photoname;
        }
        $images=implode(',',$multiphoto);
        $service->photos=$images;
        }else{
            return redirect()->back()->withErrors(__('trans_word.Only 4 images are allowed'));
        }
        }

        $service->save();
        return redirect()->back()->with('success',__('trans_word.The service has been successfully updated and is awaiting manager approval to view it'));


    }



    public function search(Request $request){
        $service=Service_work::where('title','like','%'.$request->search.'%')->orwhere('description','like','%'.$request->search.'%')->orwhere('tags','like','%'.$request->search.'%')->paginate(10);
        return view('site.service.search')->with('service',$service);
    }

}
