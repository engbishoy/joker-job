<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Credit;
use Illuminate\Console\Command;
use App\Notifications\cronJobExpireTime;
use Illuminate\Support\Facades\Notification;

class completeOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:complete';

    /**
     * The console command description.
     *
     * @var string
    */

        //اكمال الطلب فى حالة عدم قبول او الرفض من المشترى على مرفقات الخدمة فى خلال 3 ايام
        protected $description = 'Completion of the request in the event that the buyer does not accept or reject the service attachments within 3 days';

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
        //اكمال الطلب فى حالة عدم القبول او الرفض على اخر مرفق خدمة فى خلال 3 ايام من ارسال المرفقات
        $order=Order::where('sale_service_approve',1)->where('status',0)->whereHas('getLastAttachment')->get();

        if(count($order)>0){

            foreach($order as $orders){

                if($orders->getLastAttachment->created_at <= Carbon::now()->subDays(3)){
                    $orders->update(array('expire_time_buyer_approve'=>1,'status'=>4));

                    $credit=Credit::where('user_id',$orders->service->user_id)->first();
                    if($credit){
                        $credit->update(array('amount'=>$credit->amount+$orders->price));
                    }else{
                        $newCredit=new Credit();
                        $newCredit->user_id=$orders->service->user_id;
                        $newCredit->amount=$orders->price;
                        $newCredit->currancy='USD';
                        $newCredit->save();
                    }


                    
                // notification to seller and buyer
                $buyeruser=User::find($orders->user_id);
                $selleruser=User::find($orders->service->user_id);

                Notification::send($selleruser ,new cronJobExpireTime($orders,'The request was completed by the manager','seller'));
                Notification::send($buyeruser ,new cronJobExpireTime($orders,'The request was completed because you did not respond to the acceptance or rejection of the latest attachment service','buyer'));


                }
        
            }

        }

    }
}
