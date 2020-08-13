<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Joker</title>
        @if ( Config::get('app.locale') == 'en')
    <link rel="stylesheet" href="{{asset('site/css/bootstrap.min.css')}}">
        @else
        <link rel="stylesheet" href="{{asset('site/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/bootstrap-rtl.min.css')}}">
        @endif

    <!-- wow.js -->
        <link rel="stylesheet" href="{{asset('admin/dist/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('site/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/style.css')}}">
    <!-- login tempalate links -->
    @yield('logintempaltelinks')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />



        <!-- file upload plugin   -->

        <link href="{{asset('site/css/font-fileuploader.css')}}" rel="stylesheet">

        <link href="{{asset('site/css/jquery.fileuploader.min.css')}}" media="all" rel="stylesheet">

        <!-- end plugin -->

        <link href="{{asset('site/css/bootstrap-tagsinput.css')}}" rel="stylesheet">


    </head>
    <body style="padding:0">

     
          @yield('content')
          

          @if(isset(auth()->user()->id))
          <script>
          localStorage.setItem('uid',{{auth()->user()->id}});
          </script>
          @endif          
          
          <script src="{{asset('js/app.js')}}"></script>

        <script src="{{asset('site/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('site/js/all.min.js')}}"></script>
        <script src="{{asset('site/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admin/dist/js/wow.min.js')}}"></script>
        <script> new WOW().init();</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
        <script src="{{asset('site/js/main.js')}}"></script>
        @yield('jscode')

        <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#description' ) )
        .catch( error => {
            console.log( error );
        } );
        
</script>
        
<script src="{{asset('site/js/bootstrap-tagsinput.min.js')}}"></script>

<script src="{{asset('site/js/jquery.fileuploader.min.js')}}"></script>

<script>
  $(document).ready(function(){
    $('.dropdown-submenu a.test').on("click", function(e){
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
  });
  </script>
        
<script>

        // notifications message to user

        window.Echo.private('App.User.'+localStorage.getItem('uid'))
   .notification((n) => {
       console.log(n);

       if(n.type=='App\\Notifications\\chatmessage'){
        $('.message-badge').show();
        $('.notification-real-time').show();

       if($('.notification-message-from-'+n.fromuserid).length>0){
        var countmessage=parseInt($('.notification-message-from-'+n.fromuserid +' .msg-users .count-unread-message span').text());
        $('.notification-message-from-'+n.fromuserid +' .msg-users .count-unread-message span').text(countmessage+1);

        var countusermessage=parseInt($('.notification-message-from-'+n.fromuserid +' .msg-users .count-unreaduser-message').text());
        $('.notification-message-from-'+n.fromuserid +' .msg-users .count-unreaduser-message').text(countusermessage+1);

        if(`${n.photos}`!=''){
        $('.notification-message-from-'+n.fromuserid +' .msg-users .last-message').html("<i class='fa fa-images' style='color: #28992e;'></i>"+ " "+"{{__('trans_word.send you photo')}}");
        }else{
          $('.notification-message-from-'+n.fromuserid +' .msg-users .last-message').text(n.message);
        }

        $('.notification-message-from-'+n.fromuserid +' .msg-users .date-message').text(n.created_at);
       }else{

        $('.recent-messages .notification-real-time').append(`
       <li class='notification-message-from-${n.fromuserid}'>
       <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/chat/${n.fromuserid}" style="text-decoration: none;">
       <img src="/site/img/users/${n.fromuserphoto}" class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
       <div class="msg-users" style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
       <span style="color: white">${n.fromusername} </span>
       <span class="count-unread-message" style="padding: 1px 5px;color: #ebebeb;">(<span>1</span>)</span>

       <p class="last-message" style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">{{__('trans_word.Send you message')}}</p>
       
       <span style="position: absolute;
       top: 2px;
       @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
       color: #e7e7e7;
       font-size: 12px;" class="date-message">${n.created_at}</span>

     </div>  

     </a>
       </li>
       <hr>

       `);

    }

    var test=parseInt( $('.message-badge').text());
    $('.message-badge').text(test+1);
    
       $('body').append(`
       <div class="notification-message wow bounceInLeft" data-wow-duration="1s" style="bottom: 33px;
        background: #067206;
        position: fixed;
        left: 30px;
        padding:12px;
        border-radius: 4px">
        <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/chat/${n.fromuserid}">
          <img src="/site/img/users/${n.fromuserphoto}" class="img-rseponsive" style="width: 45px;height:45px;border-radius: 100%;margin-right: 10px">
          <span style="font-weight: bold;color: white;font-size: 14px">${n.fromusername}</span>
          <p style="@if ( Config::get('app.locale') == 'en') padding-left: 59px; @else padding-right:59px;  @endif
          margin-top: -9px;
          color: #e3e3e3;"> <i class="fa fa-envelope"></i> {{__('trans_word.Send you message')}}</p>
        </a>
        </div>
       `);


       $('.notification-message').delay(5000).fadeOut(1000);


      }
      else if(n.type=='App\\Notifications\\orderService'){

        $('.notification-real-time').show();

        $('.recent-notification .notification-real-time').append(`
       <li>
       <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/requests_received/show/${n.order_id}" style="text-decoration: none;">
       <img src="/site/img/users/${n.userphoto}" class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
       <div class="msg-users" style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
       <span style="color: white">${n.username} </span>
       <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">{{__('trans_word.Send you a request for a service')}}</p>
       
       <span style="position: absolute;
       top: 2px;
       @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
       color: #e7e7e7;
       font-size: 12px;" class="date-message">${n.created_at}</span>

     </div>  

     </a>
       </li>
       <hr>

       `);

   $('.orders-badge').show();
        var test=parseInt( $('.orders-badge').text());
        $('.orders-badge').text(test+1);
        $('body').append(`
       <div class="notification-sale-service wow bounceInLeft" data-wow-duration="1s" style="bottom: 33px;
        background: #067206;
        position: fixed;
        left: 30px;
        padding:12px;
        border-radius: 4px">
        <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/requests_received/show/${n.order_id}">
          <img src="/site/img/users/${n.userphoto}" class="img-rseponsive" style="width: 45px;height:45px;border-radius: 100%;margin-right: 10px">
          <span style="font-weight: bold;color: white;font-size: 14px">${n.username}</span>
          <p style="@if ( Config::get('app.locale') == 'en') padding-left: 59px; @else padding-right:59px;  @endif
          margin-top: -9px;
          color: #e3e3e3;"> <i class="fa fa-bell"></i> {{__('trans_word.Send you a request for a service')}}</p>
        </a>
        </div>
       `);

       $('.notification-sale-service').delay(5000).fadeOut(1000);

      }else if(n.type=='App\\Notifications\\statusSaleService'){
        $('.notification-real-time').show();


        $('.recent-notification .notification-real-time').append(`
       <li>
       <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/myorders/show/${n.order_id}" style="text-decoration: none;">
       <img src="/site/img/users/${n.userphoto}" class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
       <div class="msg-users" style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
       <span style="color: white">${n.username} </span>
       <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">@if ( Config::get('app.locale') == 'en') ${n.message_en} @else ${n.message_ar} @endif</p>
       
       <span style="position: absolute;
       top: 2px;
       @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
       color: #e7e7e7;
       font-size: 12px;" class="date-message">${n.created_at}</span>

     </div>  

     </a>
       </li>
       <hr>

       `);

       $('.orders-badge').show();

        var test=parseInt( $('.orders-badge').text());
        $('.orders-badge').text(test+1);

        $('body').append(`
       <div class="notification-sale-service wow bounceInLeft" data-wow-duration="1s" style="bottom: 33px;
        background: #067206;
        position: fixed;
        left: 30px;
        padding:12px;
        border-radius: 4px">
        <a  href="/{{LaravelLocalization::getCurrentLocale()}}/home/myorders/show/${n.order_id}">
          <img src="/site/img/users/${n.userphoto}" class="img-rseponsive" style="width: 45px;height:45px;border-radius: 100%;margin-right: 10px">
          <span style="font-weight: bold;color: white;font-size: 14px">${n.username}</span>
          <p style="@if ( Config::get('app.locale') == 'en') padding-left: 59px; @else padding-right:59px;  @endif
          margin-top: -9px;
          color: #e3e3e3;"> <i class="fa fa-bell"></i> @if ( Config::get('app.locale') == 'en') ${n.message_en} @else ${n.message_ar} @endif</p>
        </a>
        </div>
       `);
       $('.notification-sale-service').delay(5000).fadeOut(1000);

      }
      
      else if(n.type=='App\\Notifications\\sendAttachment'){
        $('.notification-real-time').show();



        $('.recent-notification .notification-real-time').append(`
       <li>
       <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/myorders/show/${n.order_id}" style="text-decoration: none;">
       <img src="/site/img/users/${n.userphoto}" class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
       <div class="msg-users" style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
       <span style="color: white">${n.username} </span>
       <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">{{__('trans_word.Send you service attachments')}}</p>
       
       <span style="position: absolute;
       top: 2px;
       @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
       color: #e7e7e7;
       font-size: 12px;" class="date-message">${n.created_at}</span>

     </div>  

     </a>
       </li>
       <hr>
       `);

       $('.orders-badge').show();

        var test=parseInt( $('.orders-badge').text());
        $('.orders-badge').text(test+1);

        $('body').append(`
       <div class="notification-sale-service wow bounceInLeft" data-wow-duration="1s" style="bottom: 33px;
        background: #067206;
        position: fixed;
        left: 30px;
        padding:12px;
        border-radius: 4px">
        <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/myorders/show/${n.order_id}" style="text-decoration: none;">
          <img src="/site/img/users/${n.userphoto}" class="img-rseponsive" style="width: 45px;height:45px;border-radius: 100%;margin-right: 10px">
          <span style="font-weight: bold;color: white;font-size: 14px">${n.username}</span>
          <p style="@if ( Config::get('app.locale') == 'en') padding-left: 59px; @else padding-right:59px;  @endif
          margin-top: -9px;
          color: #e3e3e3;"> <i class="fa fa-bell"></i> {{__('trans_word.Send you service attachments')}}</p>
        </a>
        </div>
       `);
       $('.notification-sale-service').delay(5000).fadeOut(1000);

      }

      else if(n.type=='App\\Notifications\\statusOrderService'){
        $('.notification-real-time').show();

        $('.recent-notification .notification-real-time').append(`
       <li>
       <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/requests_received/show/${n.order_id}" style="text-decoration: none;">
       <img src="/site/img/users/${n.userphoto}" class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
       <div class="msg-users" style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
       <span style="color: white">${n.username} </span>
       <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">@if ( Config::get('app.locale') == 'en') ${n.message_en} @else ${n.message_ar} @endif </p>
       
       <span style="position: absolute;
       top: 2px;
       @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
       color: #e7e7e7;
       font-size: 12px;" class="date-message">${n.created_at}</span>

     </div>  

     </a>
       </li>
       <hr>
       `);

       $('.orders-badge').show();


        var test=parseInt( $('.orders-badge').text());
        $('.orders-badge').text(test+1);

        $('body').append(`
       <div class="notification-sale-service wow bounceInLeft" data-wow-duration="1s" style="bottom: 33px;
        background: #067206;
        position: fixed;
        left: 30px;
        padding:12px;
        border-radius: 4px;
        max-width: 340px;
        overflow-wrap: break-word;">
        <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/requests_received/show/${n.order_id}">
          <img src="/site/img/users/${n.userphoto}" class="img-rseponsive" style="width: 45px;height:45px;border-radius: 100%;margin-right: 10px">
          <span style="font-weight: bold;color: white;font-size: 14px">${n.username}</span>
          <p style="@if ( Config::get('app.locale') == 'en') padding-left: 59px; @else padding-right:59px;  @endif
          margin-top: -9px;
          color: #e3e3e3;"> <i class="fa fa-bell"></i> @if ( Config::get('app.locale') == 'en') ${n.message_en} @else ${n.message_ar} @endif </p>
        </a>
        </div>
       `);
       $('.notification-sale-service').delay(6000).fadeOut(1000);

      }
      
      // comment ticket from admin

      else if(n.type=='App\\Notifications\\commentTicket'){
        $('.notification-real-time').show();
        $('.orders-badge').show();


        $('.recent-notification .notification-real-time').append(`
       <li>
       <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/ticket/show/${n.ticket_id}" style="text-decoration: none;">
       <img src="/site/img/tech.jpg" class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
       <div class="msg-users" style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
       <span style="color: white">{{__('trans_word.Technical support')}} </span>
       <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">{{__('trans_word.Your ticket was answered by technical support.')}}</p>
       
       <span style="position: absolute;
       top: 2px;
       @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
       color: #e7e7e7;
       font-size: 12px;" class="date-message">${n.created_at}</span>

     </div>  

     </a>
       </li>
       <hr>
       `);


        var test=parseInt( $('.orders-badge').text());
        $('.orders-badge').text(test+1);

        $('body').append(`
       <div class="notification-comment-ticket wow bounceInLeft" data-wow-duration="1s" style="bottom: 33px;
        background: #067206;
        position: fixed;
        left: 30px;
        padding:12px;
        border-radius: 4px;
        max-width: 340px;
        overflow-wrap: break-word;">
        <a href="/{{LaravelLocalization::getCurrentLocale()}}/home/ticket/show/${n.ticket_id}">
          <img src="/site/img/tech.jpg" class="img-rseponsive" style="width: 45px;height:45px;border-radius: 100%;margin-right: 10px">
          <span style="font-weight: bold;color: white;font-size: 14px">{{__('trans_word.Technical support')}}</span>
          <p style="@if ( Config::get('app.locale') == 'en') padding-left: 59px; @else padding-right:59px;  @endif
          margin-top: -9px;
          color: #e3e3e3;"> <i class="fa fa-bell"></i> {{__('trans_word.Your ticket was answered by technical support.')}}</p>
        </a>
        </div>
       `);
       $('.notification-comment-ticket').delay(5000).fadeOut(1000);

      }

        


      // approve_service_from_admin

      
      else if(n.type=='App\\Notifications\\approve_service_from_admin'){
        $('.notification-real-time').show();
        $('.orders-badge').show();


        $('.recent-notification .notification-real-time').append(`
       <li>
       <a href="" style="text-decoration: none;">
       <img src="/site/img/tech.jpg" class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
       <div class="msg-users" style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
       <span style="color: white">{{__('trans_word.Site Administration')}} </span>
       <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">@if ( Config::get('app.locale') == 'en') ${n.message_en} @else ${n.message_ar} @endif</p>
       
       <span style="position: absolute;
       top: 2px;
       @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
       color: #e7e7e7;
       font-size: 12px;" class="date-message">${n.created_at}</span>

     </div>  

     </a>
       </li>
       <hr>
       `);


        var test=parseInt( $('.orders-badge').text());
        $('.orders-badge').text(test+1);

        $('body').append(`
       <div class="notification-approve-service wow bounceInLeft" data-wow-duration="1s" style="bottom: 33px;
        background: #067206;
        position: fixed;
        left: 30px;
        padding:12px;
        border-radius: 4px;
        max-width: 340px;
        overflow-wrap: break-word;">
        <a href="">
          <img src="/site/img/tech.jpg" class="img-rseponsive" style="width: 45px;height:45px;border-radius: 100%;margin-right: 10px">
          <span style="font-weight: bold;color: white;font-size: 14px">{{__('trans_word.Site Administration')}}</span>
          <p style="@if ( Config::get('app.locale') == 'en') padding-left: 59px; @else padding-right:59px;  @endif
          margin-top: -9px;
          color: #e3e3e3;"> <i class="fa fa-bell"></i> @if ( Config::get('app.locale') == 'en') ${n.message_en} @else ${n.message_ar} @endif </p>
        </a>
        </div>
       `);
       $('.notification-approve-service').delay(5000).fadeOut(1000);

      }


   });



</script>

    </body>
</html>
