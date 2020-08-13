<?php

namespace App\Http\Controllers\site;

use App\User;
use Illuminate\Http\Request;
use App\Models\Service_attachment;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\sendAttachment;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Notification;

class attachmentController extends Controller
{
    //
    public function store(Request $request){
       $request->validate([
            'description'=>'nullable',
            'file.*'=>'required|mimes:zip,rar,flv,mp4,mov,ogg,3gp,avi,wmv,png,jpg,jpeg,gif,bmp|max:100000',
        ]);


            // upload files
            $file=$request->file('file');
        
            if($file){

            foreach($file as $files){
            $filename=time().'-'.$files->getClientOriginalName();
            $files->move(base_path().'/public/site/files/attachment_service/',$filename);
            $multifiles[]=$filename;
            }
        $attachment=implode(',',$multifiles);

         $service_attachment=Service_attachment::create([
            'description'=>$request->description,
            'files'=>$attachment,
            'user_id'=>auth()->user()->id,
            'order_id'=>$request->order_id
           ]);

        
           // send notification
           $userid=User::find($service_attachment->order->user_id);

           Notification::send($userid,new sendAttachment($service_attachment));
           //end



           // ارجاع قيمة status=0 
           $order=Order::find($request->order_id);
           $order->update(array('status'=>0));


           return redirect()->back()->with('success',__('trans_word.The service has been successfully sent to the buyer'));
         
        }else{
            return redirect()->back()->withErrors(__('trans_word.Please upload the service attachments'));
        }
            

    }


    // download attachment
    public function downloadfile($file){
        $filename= public_path(). "/site/files/attachment_service/$file";   
        return Response::download($filename);
    }


}
