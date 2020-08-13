@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')


<div class="all-ticket" style="padding-top: 40px;padding-bottom: 40px">
    <div class="container">
    <h4 style="font-weight: 700">{{__('trans_word.Title ticket')}} : {{Str::title($ticket->title)}}</h4>
    <hr>
    <br>

    <div class="col-sm-8 col-xs-12">

    @include('layouts.message')

    <div class="row">

     <div class="col-md-2 col-xs-3">
     <img src="{{asset('site/img/users/'.$ticket->user->photo)}}" class="img-responsive" style="width: 50px;border-radius: 100%">
     </div>
     <div class="col-md-10 col-xs-9">   
    
    <div class="panel panel-default">
    <div class="panel-body" style="position: relative;overflow-wrap: break-word">
        <div class="col-md-9 col-xs-8">

    <p style="color: rgb(78, 78, 78)"> {!! $ticket->message !!} </p>
    <br>

    @if($ticket->attachment!='')
    <?php
        $explode=explode(',',$ticket->attachment);
    ?>
    @foreach ($explode as $attachment)
    <a style="margin-bottom: 10px" href="{{route('ticket.attachment.download',['attach'=>$attachment])}}" class="btn btn-default">{{$attachment}}</a>
    <br>
    @endforeach
    @endif

        </div>

        <div class="col-md-3 col-xs-4">
    <p style="position: absolute;
    top: 12px;
    @if ( Config::get('app.locale') == 'en') right: 6px; @else left:6px; @endif
    color: #898989;">{{$ticket->created_at->format('d M Y  h:m A')}}</p>
    
        </div>

    </div>
    </div>

     </div>

    @foreach ($ticket->comment as $comment)
    
    <div class="col-md-2 col-xs-3">
        
        @if($comment->is_admin==1)
        <img src="{{asset('admin/dist/img/admins/'.$comment->admin->photo)}}" class="img-responsive" style="width: 50px;border-radius: 100%">
        @endif
        @if($comment->is_admin==0)
        <img src="{{asset('site/img/users/'.$comment->user->photo)}}" class="img-responsive" style="width: 50px;border-radius: 100%">
        @endif
        
    </div>
        <div class="col-md-10 col-xs-9">      
    
            <div class="panel panel-default" @if($comment->is_admin==1) style="background: #f1f1f1;" @endif>
                <div class="panel-body" style="position: relative;overflow-wrap: break-word">

            <div class="col-md-9 col-xs-8">

        <p> {!! $comment->message !!} </p>
        <br>
    
        @if($comment->attachment!='')
        <?php
            $explode=explode(',',$comment->attachment);
        ?>
        @foreach ($explode as $attachment)
        <a style="margin-bottom: 10px" href="{{route('ticket.attachment.download',['attach'=>$attachment])}}" class="btn btn-default">{{$attachment}}</a>
        <br>
        @endforeach
        @endif

        @if($comment->is_admin==1)
        <p>{{__('trans_word.Need more help? We are always here to serve you; Feel free to contact us if you have any questions.Good luckCustomer service and technical support for Joker Job')}}</p>
        @endif

            </div>

            <div class="col-md-3 col-xs-4">

        <p style="position: absolute;
        top: 8px;
        @if ( Config::get('app.locale') == 'en') right: 6px; @else left:6px; @endif
        color: #898989;">{{$comment->created_at->format('d M Y  h:m A')}}</p>
            </div>

        </div>
        </div>
    </div>

    @endforeach

   </div>

    <br>

    <p style="color: rgb(66, 66, 66)">{{__('trans_word.Add replay to the ticket')}}</p>

    <form action="{{route('ticket.comment.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <textarea name="message" id="description" class="form-control" style="height: 150px; box-shadow: 0px 0px 6px -2px rgb(39, 39, 39);"></textarea>
        <br>
        <div class="form-group" style="position: relative;">
            <div class="icon">
            <i class="fa fa-paperclip"></i> <span style="color: rgb(95, 95, 95);">{{__('trans_word.Add attachment')}}</span>
            </div>
            <input type="file" name="attachment[]" multiple>
        </div>
    <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
    <button type="submit" class="btn btn-primary">{{__('trans_word.Add replay')}}</button>
    </form>

    </div>

    <div class="col-sm-4 col-xs-12">

       
    <div class="panel panel-default">
        <div class="panel-body">
            <h4 style="font-weight: 700">{{__('trans_word.Ticket ID')}} #{{$ticket->id}}</h4>
<hr>
            <div class="row">
            
            <div class="col-lg-4 col-md-6 col-sm-7 col-xs-3"><h5 style="font-weight: bold;color: rgb(124, 124, 124)"> {{__('trans_word.Category')}} </h5></div>
            <div class="col-lg-8 col-md-6 col-sm-5 col-xs-9"><h5 style="font-weight: bold;color: rgb(124, 124, 124)"> : {{$ticket->categoryTechnical->name}} </h5></div>

            <br>            
            <br>
            
            <div class="col-lg-4 col-md-6 col-sm-7 col-xs-3"><h5 style="font-weight: bold;color: rgb(124, 124, 124)"> {{__('trans_word.Created at')}}</h5></div>
            <div class="col-lg-8 col-md-6 col-sm-5 col-xs-9"><h5 style="font-weight: bold;color: rgb(124, 124, 124)"> : {{$ticket->created_at->format('d M Y')}} </h5></div>
           </div>
            
        </div>
    </div>
    
    </div>

    </div>
</div>


@include('layouts.site.footer')

@endsection

