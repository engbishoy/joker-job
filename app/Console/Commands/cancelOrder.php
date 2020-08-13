<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Credit;
use Illuminate\Console\Command;
use App\Notifications\cronJobExpireTime;
use Illuminate\Support\Facades\Notification;

class cancelOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:cancel';

    /**
     * The console command description.
     *
     * @var string
     */

     //الغاء الطلب فى حالة عدم القبول او الرفض من صاحب الخدمة وارجاع المال الى صاحب الطلب
    protected $description = 'Canceling the request in the event of non-acceptance or rejection from the service owner';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //عدم الموافقة او الالغاء من البائع على الطلب فى خلال 3 ايام يتم تحويل المال الى صاحب الطلب  

        $order=Order::where([
            ['sale_service_approve',0],
            ['expire_time_sale_approve',0]
            ])->whereDate('created_at','<=',Carbon::now()->subDays(3))->get();
        if(count($order)>0){

            foreach($order as $orders){
            
                $orders->update(array('expire_time_sale_approve'=>1,'status'=>3));

                $credit=Credit::where('user_id',$orders->user_id)->first();
                if($credit){
                    $credit->update(array('amount'=>$credit->amount+$orders->price));
                }else{
                    $newCredit=new Credit();
                    $newCredit->user_id=$orders->user_id;
                    $newCredit->amount=$orders->price;
                    $newCredit->currancy='USD';
                    $newCredit->save();
                }
                
                // notification to seller and buyer
                $buyeruser=User::find($orders->user_id);
                $selleruser=User::find($orders->service->user_id);

                Notification::send($selleruser ,new cronJobExpireTime($orders,'The request became canceled by the manager due to the lack of acceptance or rejection of the request within 3 days','seller'));
                Notification::send($buyeruser ,new cronJobExpireTime($orders,'The request became canceled by the manager due to the lack of acceptance or rejection by the service owner of your request, and the amount was transferred to your account on the site','buyer'));

            }

        }






        //عدم ارسال البائع المرفقات فى الوقت المحدد للخدمة سوف يتم الغاء الطلب واعادة الاموال الى صاحب الطلب
        $allorder=Order::where('sale_service_approve',1)->get();
        if(count($allorder)>0){

            foreach($allorder as $orders){
            
            if(count($orders->attachment)==0){
                $orderdateline=Order::whereDate('created_at','<=',Carbon::now()->subDays($orders->service->time_execute))->get();

                if(count($orderdateline)>0){

                $orders->update(array('expire_time_sale_attachment'=>1,'status'=>3));

                $credit=Credit::where('user_id',$orders->user_id)->first();
                if($credit){
                    $credit->update(array('amount'=>$credit->amount+$orders->price));
                }else{
                    $newCredit=new Credit();
                    $newCredit->user_id=$orders->user_id;
                    $newCredit->amount=$orders->price;
                    $newCredit->currancy='USD';
                    $newCredit->save();
                }
         
                
                // notification to seller and buyer
                $buyeruser=User::find($orders->user_id);
                $selleruser=User::find($orders->service->user_id);

                Notification::send($selleruser ,new cronJobExpireTime($orders,'The service has been canceled by the manager because the service attachments were not sent on time','seller'));
                Notification::send($buyeruser ,new cronJobExpireTime($orders,'The service was canceled by the manager because the service attachments were not delivered on time and the amount of the service was transferred to your account on the site','buyer'));

            
               }
            }

       
            }
    
        }


    }
}
