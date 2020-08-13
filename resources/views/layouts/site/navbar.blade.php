<nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="/"><img src="{{asset('site/img/joker_2019_logo_by_buffy2ville_ddf2d7e-fullview.png')}}" class="img-responsive"></a>
      </div>
  
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
        
        <div class="links-cat">

        <ul class="nav navbar-nav">

          <h3 style="font-size: 20px;font-weight: bold;color: white;margin:7px">{{__('trans_word.Categories')}}</h3>
          <hr>
            @foreach ($category as $categories)
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$categories->name}}</a>
                <ul class="dropdown-menu nav-drob">
                @foreach ($categories->section as $sections)
                <li><a style="font-size: 14px" href="{{route('section',['id'=>$sections->id])}}">{{$sections->name}}</a></li>
                @endforeach
                </ul>
              </li> 
            @endforeach
              
        </ul>
        <hr>
        </div>
          





        @if(isset(auth()->user()->id) && auth()->user()->email_verified_at!='' && auth()->user()->status==0)
        

        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{__('trans_word.theservices')}} </a>
                <ul class="dropdown-menu nav-drob">
                <li><a href="{{route('myservice')}}"><i class="fa fa-folder"></i> {{__('trans_word.myservices')}}</a></li>
                <li><a href="{{route('service.create')}}"><i class="fa fa-plus-circle"></i> {{__('trans_word.createservice')}}</a></li>
                </ul>
              </li>

            <li><a href="{{route('orders.index')}}">{{__('trans_word.orders')}}</a></li>
            <li><a href="{{route('requests_received.index')}}">{{__('trans_word.Requests received')}}</a></li>
            <li><a href="{{route('BusinessExhibition.index')}}">{{__('trans_word.Business exhibition')}}</a></li>
        </ul>



        <ul class="nav navbar-nav @if ( Config::get('app.locale') == 'en') navbar-right @else navbar-left @endif" style="margin-top: -5px;">
        

          
          <li class="dropdown" style="margin-top: 5px">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-flag"></i> 
              <span class="badge" style="background: #f0ad4e;
              position: absolute;
              top: 9px;
              right: 2px;
              font-size: 10px;"> {{count(LaravelLocalization::getSupportedLocales())}} </span>
            </a>
            <ul class="dropdown-menu nav-drob">
           
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <li>
                  <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                      {{ $properties['native'] }}
                  </a>
              </li>
          @endforeach
            </ul>
          </li>



                <!-- notification message-->
                <li class="dropdown" style="margin-top: 5px;">
                  <a href="#" class="dropdown-toggle notifi-message" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-envelope"></i> 
                  <span class="badge message-badge" style="background: #e31818;
                    position: absolute;
                    top: 9px;
                    right: 2px;
                    font-size: 10px;"> {{count(auth()->user()->unreadNotificationsMessage)}} </span></a>
                    @if(count(auth()->user()->unreadNotificationsMessage)==0)
                    <style>
                      .message-badge{
                        display: none;
                      }
                    </style>
                    @endif

                  <ul class="dropdown-menu nav-drob" style="min-width: 294px;box-shadow: 0px 10px 33px 5px #0288d159;">
                  <span style="border-bottom: 1px solid #ebebeb;
                  font-size: 12px;
                  display: block;
                  padding: 8px;
                  color: #efefef;
                  font-weight: bold;">{{__('trans_word.messages')}}</span>
                  
                  <div class="recent-messages" style="padding: 15px 7px;overflow-y: scroll;">
                
                    <div class="notification-real-time" style="display: none">

                    </div>

                    @foreach (auth()->user()->notificationsMessage as $notification)

                  <li class="notification-message-from-{{$notification->data['fromuserid']}} read-message" data-fromuserid="{{$notification->fromuserid}}" data-notifiId="{{$notification->id}}">
                  <a href="{{route('chat',['id'=>$notification->data['fromuserid']])}}" style="text-decoration: none;">
                    <img src='{{asset('site/img/users/'.$notification->data['fromuserphoto'])}}' class="img-rseponsive" style="width: 34px;height: 34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
                  <div class="msg-users" style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
                    <span style="color: white">{{$notification->data['fromusername']}} </span> 
                    
                    <span class="count-unread-message" style="padding: 1px 5px;color: #ebebeb;">(<span>{{auth()->user()->unreadnotificationsMessage->where('fromuserid',$notification->data['fromuserid'])->count()}}</span>)</span>
   
                    @if(auth()->user()->unreadnotificationsMessage->where('fromuserid',$notification->data['fromuserid'])->count()==0)
                    <style>
                      .count-unread-message{
                        display: none;
                      }
                    </style>
                    @endif
                    
                    <p class="last-message" style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">{{$notification->data['message']}}</p>
                    <span style="position: absolute;
                    top: 2px;
                    @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
                    color: #e7e7e7;
                    font-size: 12px;" class="date-message">{{$notification->created_at->diffForHumans()}}</span>

                  </div>  

                  </a>
                    </li>

                    <hr>
                    @endforeach
                  </div>

                  </ul>
                </li>

              <!-- notification order service-->
              <li class="dropdown" style="margin-top: 5px;">
                <a href="#" class="dropdown-toggle notifi-service" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i> <span class="badge orders-badge" style="background: #e31818;
                  position: absolute;
                  top: 9px;
                  right: 2px;
                font-size: 10px;">{{count(auth()->user()->unreadNotificationsOrderservice)}}</span></a>

                @if(count(auth()->user()->unreadNotificationsOrderservice)==0)
                <style>
                  .orders-badge{
                    display: none;
                  }
                </style>
                @endif

             <ul class="dropdown-menu nav-drob" style="min-width: 294px;box-shadow: 0px 10px 33px 5px #0288d159;">
              <span style="border-bottom: 1px solid #ebebeb;
              font-size: 12px;
              display: block;
              padding: 8px;
              color: #efefef;
              font-weight: bold;">{{__('trans_word.Notifications')}}</span>


              <div class="recent-notification" style="padding: 15px 7px;overflow-y: scroll;">

                
                <div class="notification-real-time" style="display: none">

                </div>

                @foreach (auth()->user()->notificationsOrderservice as $notification)
                @if($notification->type=='App\Notifications\orderService')
              <li>
              <a href="{{route('requests_received.show',['id'=>$notification->data['order_id']])}}" style="text-decoration: none;">
                <img src='{{asset('site/img/users/'.$notification->data['userphoto'])}}' class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
              <div style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
                <span style="color: white">{{$notification->data['username']}} </span>  
                <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">{{__('trans_word.Send you a request for a service')}}</p>
                <span style="position: absolute;
                top: 2px;
                @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
                color: #e7e7e7;
                font-size: 12px;" class="date-message">{{$notification->created_at->diffForHumans()}}</span>

              </div>  

              </a>

              </li>
              @endif

              @if($notification->type=='App\Notifications\statusSaleService')

              <li>
              <a href="{{route('orders.show',['id'=>$notification->data['order_id']])}}" style="text-decoration: none;">
                <img src='{{asset('site/img/users/'.$notification->data['userphoto'])}}' class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
              <div style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
                <span style="color: white">{{$notification->data['username']}} </span>  
              <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">  @if ( Config::get('app.locale') == 'en') {{$notification->data['message_en']}} @else {{$notification->data['message_ar']}} @endif</p>
                <span style="position: absolute;
                top: 2px;
                @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
                color: #e7e7e7;
                font-size: 12px;" class="date-message">{{$notification->created_at->diffForHumans()}}</span>

              </div>  

              </a>

              </li>
              @endif


              @if($notification->type=='App\Notifications\sendAttachment')


              <li>
              <a href="{{route('orders.show',['id'=>$notification->data['order_id']])}}" style="text-decoration: none;">
                <img src='{{asset('site/img/users/'.$notification->data['userphoto'])}}' class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
              <div style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
                <span style="color: white">{{$notification->data['username']}} </span>  
              <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">{{__('trans_word.Send you service attachments')}}</p>
                <span style="position: absolute;
                top: 2px;
                @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
                color: #e7e7e7;
                font-size: 12px;" class="date-message">{{$notification->created_at->diffForHumans()}}</span>

              </div>  

              </a>

              </li>
              @endif


              @if($notification->type=='App\Notifications\statusOrderService')
              
              <li>
              <a href="{{route('requests_received.show',['id'=>$notification->data['order_id']])}}" style="text-decoration: none;">
                <img src='{{asset('site/img/users/'.$notification->data['userphoto'])}}' class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
              <div style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
                <span style="color: white">{{$notification->data['username']}} </span>  

              
                <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">  @if ( Config::get('app.locale') == 'en') {{$notification->data['message_en']}} @else {{$notification->data['message_ar']}} @endif</p>

                <span style="position: absolute;
                top: 2px;
                @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
                color: #e7e7e7;
                font-size: 12px;" class="date-message">{{$notification->created_at->diffForHumans()}}</span>

              </div>  

              </a>

              </li>
              @endif

              @if($notification->type=='App\Notifications\commentTicket')
              <li>
              <a href="{{route('ticket.show',['id'=>$notification->data['ticket_id']])}}" style="text-decoration: none;">
                <img src='{{asset('site/img/tech.jpg')}}' class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
              <div style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
                <span style="color: white">{{__('trans_word.Technical support')}} </span>  
                <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">{{__('trans_word.Your ticket was answered by technical support.')}}</p>
                <span style="position: absolute;
                top: 2px;
                @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
                color: #e7e7e7;
                font-size: 12px;" class="date-message">{{$notification->created_at->diffForHumans()}}</span>

              </div>  

              </a>

              </li>
              @endif

              <!-- cron job expire time -->
              @if($notification->type=='App\Notifications\cronJobExpireTime')
              <li>
              <a @if($notification->data['type_user']=='buyer') href="{{route('orders.show',['id'=>$notification->data['order_id']])}}" @elseif($notification->data['type_user']=='seller') href="{{route('requests_received.show',['id'=>$notification->data['order_id']])}}"  @endif style="text-decoration: none;">
                <img src='{{asset('site/img/tech.jpg')}}' class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
              <div style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
                <span style="color: white">{{__('trans_word.Site Administration')}} </span>  
              <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">{{__('trans_word.'.$notification->data['message'])}}</p>
                <span style="position: absolute;
                top: 2px;
                @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
                color: #e7e7e7;
                font-size: 12px;" class="date-message">{{$notification->created_at->diffForHumans()}}</span>

              </div>  

              </a>

              </li>
              @endif

              <!-- notification approve service from admin -->
              @if($notification->type=='App\Notifications\approve_service_from_admin')
              <li>
              <a style="text-decoration: none;">
                <img src='{{asset('site/img/tech.jpg')}}' class="img-rseponsive" style="width: 34px;height:34px;border-radius: 100%; @if ( Config::get('app.locale') == 'en') float:left  @else float:right  @endif">
              <div style="@if ( Config::get('app.locale') == 'en') padding-left: 46px; @else padding-right:56px; @endif  position: relative;">
                <span style="color: white">{{__('trans_word.Site Administration')}} </span>  
              <p style="margin-top: 2px;color:rgb(238, 238, 238);font-size: 13px">@if ( Config::get('app.locale') == 'en') {{$notification->data['message_en']}} @else {{$notification->data['message_ar']}} @endif</p>
                <span style="position: absolute;
                top: 2px;
                @if ( Config::get('app.locale') == 'en') right: 0px; @else left:0px; @endif
                color: #e7e7e7;
                font-size: 12px;" class="date-message">{{$notification->created_at->diffForHumans()}}</span>

              </div>  

              </a>

              </li>
              @endif

                <hr>
                @endforeach
              </div>

              </ul>
              </li>



            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img class="photo-profile" src="{{asset('site/img/users/'.auth()->user()->photo)}}"> {{auth()->user()->name}}<span class="caret"></span></a>
                <ul class="dropdown-menu nav-drob">
                  
                <li><a href="{{route('account.setting')}}"><i class="fa fa-cog"></i> {{__('trans_word.Account setting')}}</a></li>
                <li><a href="{{route('user.profile',['id'=>auth()->user()->id])}}"><i class="fa fa-user"></i> {{__('trans_word.myprofile')}}</a></li>
                <li><a href="{{route('chat.index')}}"><i class="fa fa-comments"></i> {{__('trans_word.Chat')}}</a></li>
                
                <li><a href="{{route('BusinessExhibition.myworks')}}"><i class="fa fa-images"></i> {{__('trans_word.Business exhibition')}}</a></li>

                <li><a href="{{route('credit.index')}}"><i class="fas fa-credit-card"></i> {{__('trans_word.Credit')}}</a></li>
                <li><a href="{{route('ticket.all')}}"><i class="fa fa-life-ring"></i> {{__('trans_word.Technical support')}}</a></li>
                

                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                  <i class="fa fa-power-off"></i> {{ __('Logout') }}
                    </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
                  </li>
                </ul>
              </li>


        </ul>


        @else


        <ul class="nav navbar-nav  @if ( Config::get('app.locale') == 'en') navbar-right @else navbar-left @endif" style="margin-top: -5px">

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-flag"></i> 
              <span class="badge" style="background: #f0ad4e;
              position: absolute;
              top: 9px;
              right: 2px;
              font-size: 10px;"> {{count(LaravelLocalization::getSupportedLocales())}} </span>
            </a>
            <ul class="dropdown-menu nav-drob">
           
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <li>
                  <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                      {{ $properties['native'] }}
                  </a>
              </li>
          @endforeach
            </ul>
          </li>

        <li><a href="{{route('register')}}">{{__('trans_word.register')}}</a></li>
        <li><a href="{{route('login')}}">{{__('trans_word.login')}}</a></li>
        </ul>
        
  
        @endif




      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
