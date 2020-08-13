@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="chat-layout" style="margin: 40px 0">
<div class="container bootstrap snippet">

    <div class="row">
		<div class="col-sm-offset-0 col-sm-4 col-xs-offset-1 col-xs-10" style="background:linear-gradient(40deg,#104c91,#1565c0c7)!important">
    
            
            <!-- =============================================================== -->
            <!-- member list -->
            
            <div class="friends">
        
            <h3 style="color: beige;
            border-bottom: 1px solid #d1d1d1;
            padding-bottom: 17px;">{{__('trans_word.Conversations')}}</h3>

              <div class="all-Conversations" style="margin-top: 30px">
              @if(count(auth()->user()->notificationsMessage)>0)

              @foreach (auth()->user()->notificationsMessage as $notification)

            <li class="notification-message-from-{{$notification->data['fromuserid']}} read-message" data-fromuserid="{{$notification->fromuserid}}" data-notifiId="{{$notification->id}}" style="list-style-type: none">
              <a href="{{route('chat',['id'=>$notification->data['fromuserid']])}}" style="text-decoration: none;">
                <img src='{{asset('site/img/users/'.$notification->data['fromuserphoto'])}}' class="img-rseponsive" style="width: 45px;
                float: left;
                height: 45px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
              <div class="msg-users" style="@if ( Config::get('app.locale') == 'en') padding-left: 56px; @else padding-right:56px; @endif  position: relative;">
                
                <span style="color: white">{{$notification->data['fromusername']}} </span>
            
                <div class="status-active @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif" >
                  <div class="online-right-{{$notification->data['fromuserid']}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #00ff1f;
                    width: 10px;
                    height: 10px;
                    display: inline-block;
                    border-radius: 100%;
                    font-weight: bold;
                    "></span></div>
  
                  <div class="offline-right-{{$notification->data['fromuserid']}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #adadad;
                    width: 10px;
                    height: 10px;
                    display: inline-block;
                    border-radius: 100%;
                    font-weight: bold;
                    "></span></div>
                  </div>


                  <span class="count-unreaduser-message @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif" style="background-color: #2E7D32;
                  border-radius: 100%;
                  padding: 4px 7px;
                  color: white;
                  margin-top: 6px;
                  @if ( Config::get('app.locale') == 'en') margin-right: 9px @else margin-left: 9px @endif">{{auth()->user()->unreadnotificationsMessage->where('fromuserid',$notification->data['fromuserid'])->count()}}</span>
                   


                  
                @if(auth()->user()->unreadnotificationsMessage->where('fromuserid',$notification->data['fromuserid'])->count()==0)
                <style>
                  .count-unreaduser-message{
                    display: none;
                  }
                </style>
                @endif
                  

                <p class="last-message" style="margin-top: 2px;font-size: 13px;color: rgb(206 206 206);">{{Str::limit($notification->data['message'],20)}}</p>

              </div>  

              </a>
                </li>
                @endforeach
               
                @else
              <h3 style="color: rgb(219, 219, 219);padding-top:30px;padding-bottom:30px;text-align: center ">{{__('trans_word.There are no talks yet')}}</h3>
                @endif
       
              </div>
            </div>
		</div>
        
        <!--=========================================================-->
        <!-- selected chat -->
    	<div class="col-sm-offset-0 col-sm-8 col-xs-offset-1 col-xs-10">
        <img src="{{asset('site/img/group-of-friends-png-hd-friends-png-file-940.png')}}" class="img-responsive wow @if ( Config::get('app.locale') == 'en') bounceInRight  @else bounceInLeft @endif" data-wow-duration="2s" style="width: 100%;
        height: 592px;" >    
        </div>   
        
        
	</div>
</div>


</div>

<style>

body {
  padding-top: 0;
  font-size: 12px;
  color: #777;
  background: #f9f9f9;
  font-family: 'Open Sans',sans-serif;
}

.bg-white {
  background-color: #1f5479;
}

small, .small {
  font-size: 85%;
}


.all-Conversations{
  height: 503px;
  overflow: overlay;

}
.chat-message{
  height: 500px;
  overflow-y: scroll;

}

.chat {
    list-style: none;
    margin: 0;
}


.chat-body{
    width: 50%
}
.chat li .img-user {
  width: 45px;
  height: 45px;
  border-radius: 50em;
  -moz-border-radius: 50em;
  -webkit-border-radius: 50em;
}

img {
  max-width: 100%;
}

.chat-body {
  padding-bottom: 20px;
  overflow-wrap: break-word;
}

.chat li.left .chat-body {
  background: linear-gradient(40deg,#104c91,#1565c0c7)!important;
  
  color: white;
  }

.chat li .chat-body {
  position: relative;
  font-size: 11px;
  padding: 10px;
  border: 1px solid #f1f5fc;
  box-shadow: 0 1px 1px rgba(0,0,0,.05);
  -moz-box-shadow: 0 1px 1px rgba(0,0,0,.05);
  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05); 
}

.chat li .chat-body .header {
  padding-bottom: 5px;
  border-bottom: 1px solid #f1f5fc;
  margin-bottom: 9px
}

.chat li .chat-body p {
  margin: 0;
}



.chat li {
  margin: 15px 0;
}

.chat li.right .chat-body {
  margin-right: 20px;
  background-color: #fff;
}

.chat-box {
    margin-top: -20px;
}

.chat-box .submit-msg{
  position: absolute;
  top: 0;
}

.primary-font {
  color: #3c8dbc;
}

a:hover, a:active, a:focus {
  text-decoration: none;
  outline: 0;
}


.upload-img-chat{
    position: absolute;
    top: 8px;
    width: 30px;
    height: 20px;
    opacity: 0;
    z-index: 999;
    cursor: pointer;
}
.upload-img-icon{
position: absolute;
    top: 5px;
    color: #1e9810;

}


</style>

@if ( Config::get('app.locale') == 'en')
<style>
.upload-img-chat{
 right:55px;
}
.upload-img-icon{
    right: 56px;
}
.chat-box .submit-msg{
right: 0;
}

</style>
@else

<style>
  .upload-img-chat{
   left:55px;
  }
  .upload-img-icon{
      left: 56px;
  }
  .chat-box .submit-msg{
  left: 0;
  }
  </style>

@endif

@include('layouts.site.footer')

@endsection