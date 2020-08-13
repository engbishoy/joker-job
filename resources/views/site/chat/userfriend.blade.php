@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="chat-layout" style="margin-top: 40px">
<div class="container bootstrap snippet">

    <div class="row">
		<div class="col-sm-4 col-xs-12" style="background:linear-gradient(40deg,#104c91,#1565c0c7)!important">
    
            
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
    	<div class="col-sm-8 col-xs-12">
            <div class="panel panel-default" style="border-radius: 0px">
                <div class="panel-heading" style="border-radius: 0px;color:white;background: linear-gradient(40deg,#104c91,#1565c0c7)!important; padding: 10px 15px">
                 
                <a class="back-chat" href="{{route('chat.index')}}">
                    <i class="fa fa-arrow-left" style="color: white; @if ( Config::get('app.locale') == 'en') margin-right:11px; @else margin-left:11px @endif"></i>
                </a>

              <a href="{{route('user.profile',['id'=>$userfriend->id])}}" style="color: white">
                <img style="width: 41px;height:35px;border-radius: 100%;" src="{{asset('site/img/users/'.$userfriend->photo)}}">
                <span style="font-size: 15px">{{$userfriend->name}}</span>
                </a>
                <div class="status-active @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif">
                <div class="online-right-{{$userfriend->id}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #00ff1f;
                  width: 10px;
                  height: 10px;
                  display: inline-block;
                  border-radius: 100%;
                  font-weight: bold;
                  "></span> Online</div>

                <div class="offline-right-{{$userfriend->id}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #adadad;
                  width: 10px;
                  height: 10px;
                  display: inline-block;
                  border-radius: 100%;
                  font-weight: bold;
                  "></span> Offline</div>
                </div>

                </div>
                <div class="panel-body chat-message" id={{$userfriend->id}}>
                <ul class="chat">

                  @foreach ($chatmessage as $messages)
                      
                  @if ($messages->from==auth()->user()->id)
                  <li class="left clearfix message-content my-message" style="position: relative">
                    <div class="chat-body clearfix">
                      <div class="header">
                      <strong class="primary-font" style="color: white ;font-size: 14px">{{$messages->fromuser->name}}</strong>
                        <small class="@if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif text-muted" style="color: white"><i class="fa fa-clock"></i> {{$messages->created_at->diffForHumans()}}</small>
                      </div>
                      <p style="font-size: 15px;">
                        {{$messages->message}}
                      </p>
                      @if($messages->photo!='')
                      
                      <?php
                      $explode=explode(',',$messages->photo);
                      ?>
                      @foreach ($explode as $photos)

                      <!-- model photo to popup  -->
                    <img id="{{strstr($photos,'.',true)}}" class="modal img-responsive" src='{{asset('site/img/chat/'.$photos)}}'> 

                    @if(count($explode)>2)
                    <div class="col-md-4 col-sm-12 col-xs-6" style="margin-bottom: 10px">
                    <a href="#{{strstr($photos,'.',true)}}" rel="modal:open"> <img style="margin-bottom: 10px;width:100%;height: 82px;" class="img-responsive img-thumbnail" src='{{asset('site/img/chat/'.$photos)}}'> </a>                     
                    </div>
                    @else  
                    <a href="#{{strstr($photos,'.',true)}}" rel="modal:open"> <img class="img-responsive img-thumbnail" style="width: 100%;height: 187px;"  src='{{asset('site/img/chat/'.$photos)}}'> </a>                     
                    @endif
                      @endforeach


                    @endif


                      <!-- seen message -->
                      <div class="seen @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif" style="margin-top: 10px">
                        <span>{{$messages->updated_at->format('d-M h:i A')}}</span>
                        <i class="fa fa-check" @if($messages->seen==1) style="color: #35e6ff;" @else style="color: #a1a1a1;" @endif></i>
                        <i class="fa fa-check" @if($messages->seen==1) style="color: #35e6ff;"  @else style="color: #a1a1a1;" @endif></i>
                        </div>
                    </div>


                  </li>     
                  @elseif($messages->from==$userfriend->id)
                 
                    <li class="right user-friend clearfix message-content">
                    	<span class="chat-img @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif">
                    		<img class="img-user" src="{{asset('site/img/users/'.$messages->fromuser->photo)}}" alt="User Avatar">
                    	</span>
                    	<div class="chat-body @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif clearfix">
                    		<div class="header">
                          <strong class="primary-font" style="font-size: 14px">{{$messages->fromuser->name}}</strong>
                          <small class="@if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif text-muted"><i class="fa fa-clock"></i>  {{$messages->created_at->diffForHumans()}}</small>
                        </div>
                        
                          @if($messages->photo!='')
                          
                          <?php
                          $explode=explode(',',$messages->photo);
                          ?>
                          @foreach ($explode as $photos)
                          <!-- model photo to popup  -->
                        <img id="{{strstr($photos,'.',true)}}" class="modal img-responsive" src='{{asset('site/img/chat/'.$photos)}}'> 
                        @if(count($explode)>2)
                        <div class="col-md-4 col-sm-12 col-xs-6">
                          <a href="#{{strstr($photos,'.',true)}}" rel="modal:open"> <img style="margin-bottom: 10px;width:100%;height: 82px;" class="img-responsive img-thumbnail" src='{{asset('site/img/chat/'.$photos)}}'> </a>                     
                        </div>
                        @else  
                        <a href="#{{strstr($photos,'.',true)}}" rel="modal:open"> <img class="img-responsive img-thumbnail" style="width: 100%;height: 187px;"  src='{{asset('site/img/chat/'.$photos)}}'> </a>                     
                        @endif
                        
                         @endforeach

                          
                          @endif

                        <p style="font-size: 15px;">
                            {{$messages->message}}
                        </p>


                        <!-- icon caret left -->
                        @if ( Config::get('app.locale') == 'en')

                        <span class="fa fa-caret-right" style="font-size: 29px;
                        position: absolute;
                        top: 3px;
                        right: -12px;
                        color: #edededb0;"></span>
                        @else
                        <span class="fa fa-caret-left" style="font-size: 29px;
                        position: absolute;
                        top: 3px;
                        left: -12px;
                        color: #edededb0;"></span>
                        @endif

                        
                      </div>

                    </li>
                   
                  @endif
                        

                  @endforeach

                </ul>
            </div>
        </div>


        <form method="POST" class="send-message" enctype="multipart/form-data">
          @csrf
          @method('POST')

        <input type="hidden" class="touser" value="{{$userfriend->id}}" name="touser">
            <div class="chat-box" style="position: relative">
            	<div class="form-group">
            		<input style="border: none;box-shadow: -2px 0px 6px #00000026;" name="message" class="form-control border input-message " placeholder="{{__('trans_word.Type your message here')}}">
            	</div>
                <input type="file" name="photos[]" class="upload-img-chat" multiple>
               <span class="upload-img-icon"> <i class="fa fa-images fa-2x"></i> </span>
                  <button class="btn btn-primary submit-msg " type="submit"><i class="fa fa-paper-plane"></i></button>
            </div>          
        </form>
  
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


@media(max-width:767px){
  .friends{
    display: none;
  }
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
.chat li.right .chat-body {
  margin-right: 10px;
  background-color: #fff;
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
  .chat li.right .chat-body {
  margin-left: 10px;
  background-color: #fff;
}
  </style>

@endif


@section('jscode')
<script>

$(document).on('submit','.send-message',function(e){ 
    e.preventDefault();
    $.ajax({
      method:"POST",
      url:"{{route('sendmessage')}}",
      data:new FormData(this),
      dataType:"json",
      processData:false,
      contentType:false,    
      cache:true,
      error:function(data){
        var response=$.parseJSON(data.responseText);
        $.each(response.message,function(key,value){
          $('body').append(`<div class="error-photo wow bounceInRight data-wow-duration='3s'" data-wow-delay="0s">${value[0]}</div>`);
        $('.error-photo').delay(4000).fadeOut(1000);       
        });
        $(window).scrollTop(0);
      }
    });
    $('input:text').val('');
    $('input:file').val('');

});


// events

$('.chat-message').animate({scrollTop:$('.chat-message').prop('scrollHeight')});

// event send message
  window.Echo.private('send.'+localStorage.getItem('uid'))
    .listen('sendmessage', (e) => {

      if($('.chat-message').attr('id')==`${e.to_id}`){

      $('.chat-message').animate({scrollTop:$('.chat-message').prop('scrollHeight')});

      $('.chat').append(`<li class="left clearfix message-content my-message" style="position:relative">
                    <div class="chat-body clearfix event-msg-${e.id}">
                      <div class="header">
                      <strong class="primary-font" style="color: white ;font-size: 14px">${e.username}</strong>
                      <small class="@if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif text-muted" style="color: white"><i class="fa fa-clock"></i>${e.created_at}</small>
                      </div>
                      <p style="font-size: 15px;">
                        ${e.message}
                      </p> 
                    </div>
                    
                      <div class="seen @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif" style="position: absolute;
                      bottom: 11px;
                      @if ( Config::get('app.locale') == 'en') left: 289px; @else right:289px; @endif">
                      <i class="fa fa-check" style="color: #a1a1a1;" ></i>
                      <i class="fa fa-check" style="color: #a1a1a1;" ></i>
                      </div>

                  </li>`);


    if(e.photos!=''){
     if(e.photos.length>2){
 
      $.each(e.photos,function(key,value){
          $(`.left .event-msg-${e.id}`).append(`
          <div class="col-md-4 col-sm-12 col-xs-6" style="margin-bottom: 10px">

                        <img id="${value.split(".")[0]}" class="modal img-responsive" src='{{asset('site/img/chat/${value}')}}'> 
        
                        <a href="#${value.split(".")[0]}" rel="modal:open"> <img style="margin-bottom: 10px; width:100%;height:82px;" class="img-responsive" src='{{asset('site/img/chat/${value}')}}'> </a>                     
          </div>              
          `);
        });

    }else{
      $.each(e.photos,function(key,value){
        $(`.left .event-msg-${e.id}`).append(`
          
                        <img id="${value.split(".")[0]}" class="modal img-responsive" src='{{asset('site/img/chat/${value}')}}'> 
        
                        <a href="#${value.split(".")[0]}" rel="modal:open"> <img class="img-responsive" style="width: 100%;height: 187px;" src='{{asset('site/img/chat/${value}')}}'> </a>                     

          `);
        });
      }

    }    

  }

    });


    // event recieve message

    
  window.Echo.private('recieve.'+localStorage.getItem('uid'))
    .listen('recievemessage', (e) => {

      if($('.chat-message').attr('id')==`${e.from_id}`){

      $('.chat-message').animate({scrollTop:$('.chat-message').prop('scrollHeight')});

      $('.chat').append(`<li class="right user-friend clearfix message-content">
                    	<span class="chat-img @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif">
                    		<img class="img-user" src="{{asset('site/img/users/${e.photouser}')}}" alt="User Avatar">
                    	</span>
                    <div class="chat-body @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif clearfix"  @if ( Config::get('app.locale') == 'ar') style="margin-left: 20px" @endif clearfix event-msg-${e.id}">
                      <div class="header">
                      <strong class="primary-font" style="font-size: 14px">${e.username}</strong>
                      <small class="@if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif text-muted"><i class="fa fa-clock"></i> ${e.created_at}</small>

                      </div>
                      <p style="font-size: 15px;">
                        ${e.message}
                      </p> 
                    </div>
                  </li>`);


    if(e.photos!=''){
     if(e.photos.length>2){
 
      $.each(e.photos,function(key,value){
          $(`.right .event-msg-${e.id}`).append(`
          <div class="col-md-4 col-sm-12 col-xs-6" style="margin-bottom: 10px">

                        <img id="${value.split(".")[0]}" class="modal img-responsive" src='{{asset('site/img/chat/${value}')}}'> 
        
                        <a href="#${value.split(".")[0]}" rel="modal:open"> <img style="margin-bottom: 10px;width:100%;height:82px;" class="img-responsive" src='{{asset('site/img/chat/${value}')}}'> </a>                     
          </div>              
          `);
        });

    }else{
      $.each(e.photos,function(key,value){
        $(`.right .event-msg-${e.id}`).append(`
          
                        <img id="${value.split(".")[0]}" class="modal img-responsive" src='{{asset('site/img/chat/${value}')}}'> 
        
                        <a href="#${value.split(".")[0]}" rel="modal:open"> <img class="img-responsive" style="width:100%;height:187px" src='{{asset('site/img/chat/${value}')}}'> </a>                     

          `);
        });
      }

    }    

  }

    });


    //seen message

    window.Echo.private('seen.'+localStorage.getItem('uid'))
    .listen('seenMessage', (e) => {
      console.log(e);
      if($('.chat-message').attr('id')==`${e.toid}`){
        $('.seen .fa-check').css('color','#35e6ff');
      }
    });




    //end

$(document).on('focus','.input-message',function(){
  var fromuser="{{auth()->user()->id}}";
  var touser=$('.touser').val();

  $.ajax({
    method:'GET',
    url:"{{route('message.seen')}}",
    data:{
      "_token": "{{ csrf_token() }}",
      fromuser:fromuser,
      touser:touser,
    },

  });
});

</script>
@endsection



@include('layouts.site.footer')


@endsection