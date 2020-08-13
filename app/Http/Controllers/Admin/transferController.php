<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pull_credit;
use Illuminate\Http\Request;


use PayPal\Api\Amount;

use PayPal\Api\Payee;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;


class transferController extends Controller
{

    
    public function __construct()
    {
        $this->middleware(['permission:moneyTransfer_update'])->only('transferPay');
        $this->middleware(['permission:moneyTransfer_read'])->only('transferRequired','transferCompleted','search');
    }


    // required transer
    public function transferRequired(){
        $pullcredit=Pull_credit::where('pull_status',0)->paginate(10);
        return view('admin.transfer.transferRequired')->with('pullcredit',$pullcredit);
    }

    // required transer
    public function transferCompleted(){
        $pullcredit=Pull_credit::where('pull_status',1)->paginate(10);
        return view('admin.transfer.transferCompleted')->with('pullcredit',$pullcredit);
    }


    public function transferPay(Request $request){

    //paypal 

    // context

    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            config('payment.accounts.client_id'),     // ClientID
            config('payment.accounts.secret_client'),     // Secret client
        )
    );
    $apiContext->setConfig(config('payment.setting'));


        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $amount = new Amount();
        $amount->setCurrency("USD")
        ->setTotal($request->amount);

        $payee = new Payee();
        $payee->setEmail($request->email_paypal);
        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription("Payment Joker job")
            ->setPayee($payee)
            ->setInvoiceNumber(uniqid());


        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('transfer.success'))
        ->setCancelUrl(route('transfer.cancel'));


        $payment = new Payment();
        $payment->setIntent("order")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));



        try {
            $payment->create($apiContext);

        } catch (Exception $ex) {
            exit(1);
        }
 
        session(['amount'=>$request->amount]);
        session(['pull_id'=>$request->pull_id]);

        $approvalUrl = $payment->getApprovalLink();
        
        return redirect($approvalUrl);
    }




    public function transferPaySuccess(Request $request){

        if(isset($request->paymentId) && $request->paymentId!='' && isset($request->token) && $request->token!='' && isset($request->PayerID) && $request->PayerID!=''){
            
            // context

            $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    config('payment.accounts.client_id'),     // ClientID
                    config('payment.accounts.secret_client'),     // Secret client
                )
            );

            $apiContext->setConfig(config('payment.setting'));


            $paymentId = $request->paymentId;
            $payment = Payment::get($paymentId, $apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($request->PayerID);

            $transaction = new Transaction();
            $amount = new Amount();

            $amountMoney=session('amount');
            session()->forget('amount');

            $pull_id=session('pull_id');
            session()->forget('pull_id');

            $amount->setCurrency('USD');
            $amount->setTotal($amountMoney);
            $transaction->setAmount($amount);

            $execution->addTransaction($transaction);




            try {
                
                        $result = $payment->execute($execution, $apiContext);        
                        try {
                            $payment = Payment::get($paymentId, $apiContext);

                        } catch (Exception $ex) {

                        exit(1);
                        }
                    } catch (Exception $ex) {
                        exit(1);
                    }
                   
                    
              if($payment){
                  $pull_credit=Pull_credit::find($pull_id);
                  $pull_credit->pull_status=1;  //يعنى يبقى العملية متكاملة 
                  $pull_credit->save();
                  return redirect()->route('transfer.required')->with('success',__('trans_word.The amount has been successfully transferred to the user via Paypal'));
              }

                }


    }


    public function transferPayCancel(){
        return 'cancel payment';
    }



    public function search(Request $request){
        $pullcredit=Pull_credit::where('email_paypal',$request->search)->where('pull_status',0)->paginate(10);
        return view('admin.transfer.search')->with('pullcredit',$pullcredit);
    }

}
