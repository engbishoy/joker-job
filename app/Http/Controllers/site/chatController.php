<?php

namespace App\Http\Controllers\site;

use App\Events\recievemessage;
use App\Events\seenMessage;
use App\Events\sendmessage;
use App\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\chatmessage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Foreach_;

class chatController extends Controller
{
    //


    public function index(){
        return view('site.chat.index');
    }



    public function userfriend($id){

        if(isset(auth()->user()->id) && auth()->user()->id==$id){
            return redirect()->back();
        }else{
        $userfriend=User::find($id);
        $chatmessage=Chat::where([
            ['from','=',auth()->user()->id],
            ['to','=',$id]
        ])->orWhere([
            ['to','=',auth()->user()->id],
            ['from','=',$id]
        ])->get();
        
        if(isset($chatmessage) && isset($userfriend)){
            return view('site.chat.userfriend')->with('userfriend',$userfriend)->with('chatmessage',$chatmessage);

        }else{
            return redirect()->back();
        }

        }

    }


    public function sendmessage(Request $request){
        $validate=Validator::make($request->all(),[
            'message'=>'nullable',
            'photos.*'=>'nullable|image|max:2000',
        ]);
        if($validate->fails()){
            return response()->json(['message'=>$validate->errors()], 400);
        }

        if($request->message!='' or $request->photos!=''){

        $photo=$request->photos;

        if($photo==''){
            $images='';
        }else{
            
        foreach($photo as $photos){
        $photoname=time().'-'.$photos->getClientOriginalName();
        $photos->move(base_path().'/public/site/img/chat/',$photoname);
        $multiphoto[]=$photoname;
        }
        $images=implode(',',$multiphoto);
    
        }

        $chat=Chat::create([
            'from'=>auth()->user()->id,
            'to'=>$request->touser,
            'message'=>$request->message,
            'photo'=>$images
        ]);


        // event sendmessage 
        if($chat->message!=''){
            $message=$chat->message;
        }else{
            $message='';   
        }

        if($chat->photo!=''){
            $multiphotos=explode(',',$chat->photo);
        }else{
            $multiphotos='';
        }

        event(new sendmessage($chat->id,$chat->from,$chat->to,$chat->fromuser->name,$message,$multiphotos,$chat->created_at->diffForHumans(),$chat->seen));

        //end event send message

        // event recieve message
        event(new recievemessage($chat->id,$chat->from,$chat->to,$chat->fromuser->name,$chat->fromuser->photo,$message,$multiphotos,$chat->created_at->diffForHumans()));
        //end event recieve message
        

        // notification message to user
        $userid=User::find($chat->to);

        Notification::send($userid,new chatmessage($chat,$multiphotos));

        //end
        }

    }

    public function seenMessage(Request $request){
        $chat=Chat::where([
            ['from',$request->touser],
            ['to',$request->fromuser]
        ])->get();

        foreach($chat as $chats){
        
        if($chats->seen==0){
            $chats->update(array('seen'=>1));
            event(new seenMessage($chats->from,$chats->to,$chats->seen));
        }

        }
    }




    


    // read message notification

    public function readNotificationMessage(Request $request){
        auth()->user()->unreadNotificationsMessage->where('fromuserid',$request->fromuser)->markAsRead();
    }


}
