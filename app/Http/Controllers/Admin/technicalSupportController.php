<?php

namespace App\Http\Controllers\Admin;

use App\Models\ticket;
use Illuminate\Http\Request;
use App\Models\Comment_ticket;
use App\Models\CategoryTechnical;
use App\Http\Controllers\Controller;
use App\Notifications\commentTicket;
use App\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class technicalSupportController extends Controller
{
    //

    public function createCategory(){
        return view('admin.categoryTechnical.create');
    }

    
    public function storeCategory(Request $request){
        $validate=Validator::make($request->all(),[
            'name_en'=>'required|max:40|string|unique:category_technicals',
            'name_ar'=>'required|max:40|string|unique:category_technicals'
            ]);
            if($validate->fails()){
                return response()->json(['message'=>$validate->errors()],401);
            }
           CategoryTechnical::create([
                'name_en'=>$request->name_en,
                'name_ar'=>$request->name_ar
            ]);
            return response()->json(['message'=>__('trans_word.The Category was added successfully')],200);
    
    }


    // tickets category 
    public function tickets($id){
        $tickets=ticket::where('category_technical_id',$id)->orderBy('updated_at','DESC')->get();
        return view('admin.categoryTechnical.tickets')->with('tickets',$tickets);
    }


    // show ticket 
    public function showTicket($id){
        $ticket=ticket::find($id);
        return view('admin.categoryTechnical.showTicket')->with('ticket',$ticket);
    }


      // download attachment ticket
      public function downloadAttach($attach){
        $filename= public_path(). "/site/tickets/$attach";   
        return Response::download($filename);

    }

    
    //store comment ticket
    public function storeComment(Request $request){
        $request->validate([
            'message'=>'required',
            'attachment.*'=>'nullable|mimes:zip,rar,jpg,jpeg,bmp,png,gif,svg,pdf|max:10000',
        ]);

        $commentTicket=new Comment_ticket();
        $commentTicket->message=$request->message;
        $commentTicket->admin_id=auth()->user()->id;
        $commentTicket->user_id=$request->user_id;
        $commentTicket->ticket_id=$request->ticket_id;

        if($request->file('attachment')){
            $file=$request->file('attachment');

            foreach($file as $files){
                $filename=time().'-'.$files->getClientOriginalName();
                $files->move(base_path().'/public/site/tickets/',$filename);

                $multiattachment[]=$filename;
            }
            $attachment=implode(',',$multiattachment);

            $commentTicket->attachment=$attachment;
        }


        $commentTicket->is_admin=1;

        $commentTicket->save();

        $user=User::find($commentTicket->user_id);
        Notification::send($user,new commentTicket($commentTicket));
        return redirect()->back()->with('success',__('trans_word.Your comment has been added to the ticket.'));

    }


    // seen notification

    public function seenNotification(){
        auth()->user()->unreadnotificationsAdmin->markAsRead();
    }

}
