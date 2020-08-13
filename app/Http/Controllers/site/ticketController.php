<?php

namespace App\Http\Controllers\site;

use App\Models\ticket;
use Illuminate\Http\Request;
use App\Models\Comment_ticket;
use App\Models\CategoryTechnical;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\commentTicket;
use App\Notifications\openTicket;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Notification;

class ticketController extends Controller
{
    //

    public function all(){
        $ticket=ticket::where('user_id',auth()->user()->id)->orderBy('updated_at','DESC')->get();

        return view('site.tickets.all')->with('ticket',$ticket);
    }


    public function show($id){
        $ticket=ticket::find($id);

        if($ticket){
        return view('site.tickets.show')->with('ticket',$ticket);
        }else{
            return redirect()->back();
        }
    }


    // download attachment ticket
    public function downloadAttach($attach){
        
        $filename= public_path(). "/site/tickets/$attach";   
        return Response::download($filename);

    }



    public function create(){
        $categoryTechnical=CategoryTechnical::all();
        return view('site.tickets.create')->with('categoryTechnical',$categoryTechnical);
    }

    // store ticket
    public function store(Request $request){
        $request->validate([
            'title'=>'max:200|required',
            'message'=>'required',
            'attachment.*'=>'nullable|mimes:zip,rar,jpg,jpeg,bmp,png,gif,svg,pdf|max:10000',
        ]);

        $ticket=new ticket();
        $ticket->title=$request->title;
        $ticket->category_technical_id=$request->category;
        $ticket->user_id=auth()->user()->id;
        $ticket->message=$request->message;

        if($request->file('attachment')){
            $file=$request->file('attachment');

            foreach($file as $files){
                $filename=time().'-'.$files->getClientOriginalName();
                $files->move(base_path().'/public/site/tickets/',$filename);

                $multiattachment[]=$filename;
            }
            $attachment=implode(',',$multiattachment);

            $ticket->attachment=$attachment;
        }

        $ticket->save();

        $admin=Admin::find(1);
        Notification::send($admin ,new openTicket($ticket));
        return redirect()->route('ticket.all')->with('success',__('trans_word.The ticket has been successfully opened, and technical support will be replied in the shortest time'));

    }



    //store comment ticket
    public function storeComment(Request $request){
        $request->validate([
            'message'=>'required',
            'attachment.*'=>'nullable|mimes:zip,rar,jpg,jpeg,bmp,png,gif,svg,pdf|max:10000',
        ]);

        $commentTicket=new Comment_ticket();
        $commentTicket->message=$request->message;
        $commentTicket->user_id=auth()->user()->id;
        $commentTicket->admin_id=1;
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

        $commentTicket->save();


        $admin=Admin::find($commentTicket->admin_id);
        Notification::send($admin,new commentTicket($commentTicket));

        return redirect()->back()->with('success',__('trans_word.Your comment has been added to the ticket. A customer service representative will respond to you within minutes'));

    }

}
