@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="showservice" style="padding-top:30px;padding-bottom: 30px">
    <div class="container">
      <div class="col-lg-8 col-md-6 col-xs-12" style="margin-bottom: 10px;overflow-wrap: break-word;">
      <h3>{{Str::title($service->title)}}</h3>
      <p style="font-size: 13px;color: rgb(128 128 128);font-weight: bold ; "><i class="fa fa-clock"></i> {{$service->created_at->diffForHumans()}}</p>
    </div>
      <div class="row">
        <div class="col-lg-8 col-md-6 col-xs-12">

          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->

            <?php $explodePhotos=explode(',',$service->photos); ?>

            <ol class="carousel-indicators">
              @for($i=0;$i<count($explodePhotos);$i++)
              <li style="background: orangered;border: none" data-target="#carousel-example-generic" data-slide-to="0" @if($i==0) class="active" @endif></li>
              @endfor
            </ol>
          
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

              @for($i=0;$i<count($explodePhotos);$i++)
              <div class="item @if($i==0) active @endif">
                <img src="{{asset('site/img/servicework/'.$explodePhotos[$i])}}" class="img-responsive img-sevice">
              </div>
              @endfor

              

            
            </div>
          
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

  

        <h3>{{__('trans_word.Description')}}</h3>
        <hr>
        <div style="font-weight: bold;overflow-wrap: break-word"> <p style="margin-top: 15px" class="lead">{!! $service->description !!}</p></div>
      
        <div class="tags-service" style="margin-top: 50px">
          <i class="fa fa-tag"></i>
          <?php $explodetags=explode(',',$service->tags); ?>
          @foreach ($explodetags as $tags)
        <span class="btn btn-primary" style="@if( Config::get('app.locale') == 'en') margin-right:5px; @else margin-left:5px; @endif padding: 3px 15px; margin-bottom: 10px;border-radius: 0;">{{$tags}}</span>
          @endforeach
        </div>

        <div class="comments" style="margin-top: 30px">
          <div class="panel panel-default">
            <div class="panel-body">
              <h3>{{__('trans_word.Buyer comments')}}</h3>
              <hr>
              @if(count($service->evaluation)>0)
              @foreach ($service->evaluation as $evaluation)
              <div class="media">
                <div class="media-left">
                <a href="{{route('user.profile',['id'=>$evaluation->user_id])}}">
                  <img class="media-object" src="{{asset('site/img/users/'.$evaluation->user->photo)}}" class="img-responsive" style="width:60px;height: 60px;border-radius: 100%">
                  </a>
                </div>
                <div class="media-body">
                  <a href="{{route('user.profile',['id'=>$evaluation->user_id])}}"> <h4 class="media-heading">{{$evaluation->user->name}}</h4></a>
                <p style="color: rgb(65, 65, 65)"><i class="fa fa-calendar" aria-hidden="true"></i> {{$evaluation->created_at->format('d M Y')}}</p>
                
                <div class="stars-buyer-{{$evaluation->user_id}} @if( Config::get('app.locale') == 'en') pull-right @else pull-left @endif" style="color: rgb(58, 58, 58);margin-top: -50px" >
                    <i class="fa fa-star fa-2x  evaluation1" data-number="0" data-evaluation="1"></i>
                    <i class="fa fa-star fa-2x  evaluation2" data-number="1" data-evaluation="2"></i>
                    <i class="fa fa-star fa-2x  evaluation3" data-number="2" data-evaluation="3"></i>
                    <i class="fa fa-star fa-2x  evaluation4" data-number="3" data-evaluation="4"></i>
                    <i class="fa fa-star fa-2x  evaluation5" data-number="4" data-evaluation="5"></i>
                    
                  @for($i=0;$i<=$evaluation->evaluation;$i++)
                  <style>
                    .stars-buyer-{{$evaluation->user_id}} .evaluation{{$i}} {
                      color:yellow;
                    }
                  </style>
                  @endfor
                </div>

                
                <div style="font-weight: bold">{!! $evaluation->comment !!}</div>
                </div>
              </div>
              <hr>
              @endforeach

              @else
            <p class="lead" style="text-align: center;margin-top:10px"> {{__('trans_word.There is no buyer for the service yet')}}</p>
              @endif

            </div>
          </div>
        </div>
      </div>

          <div class="col-lg-4 col-md-6 col-xs-12">
          <a class="order" href="{{route('service.pay.show',['id'=>$service->id])}}" @if( Config::get('app.locale') == 'en') style="text-align: left" @else style="text-align: right" @endif >{{__('trans_word.orderservice')}}</a> 

          <span class="orderprice" @if( Config::get('app.locale') == 'en') style="right: 22px;
          border-left: 1px solid #a9a59f;
          padding-left: 10px;" 

          @else style="left: 22px;
          border-right: 1px solid #a9a59f;
          padding-right: 10px;"
          
          @endif >{{$service->price .'$'}}</span>

          <p class="lead" style="font-weight: 400"><i style="color: #646464;" class="fa fa-clock"></i> {{__('trans_word.Delivery term')}} :
            @if($service->time_execute<7)
            {{$service->time_execute}} day
            
            @elseif($service->time_execute==7)
            1 week
            
            @elseif($service->time_execute==14)
            2 week

            @elseif($service->time_execute==21)
            3 week

            @elseif($service->time_execute==30)
            1 mounth
            @endif
        
          </p>
          <hr>
        <p class="lead" style="font-weight: 400"><i style="color: #646464;" class="fa fa-list-alt"></i> {{__('trans_word.category')}} : {{$service->section->name}}</p>
        <hr>

        <div class="stars" style="color: rgb(58, 58, 58);">
          
        <p class="lead" style="font-weight: 400;display:inline-flex;">
          {{__('trans_word.Evaluations')}} :
        </p>
          <i class="fa fa-star fa-2x  evaluation1" data-number="0" data-evaluation="1"></i>
          <i class="fa fa-star fa-2x  evaluation2" data-number="1" data-evaluation="2"></i>
          <i class="fa fa-star fa-2x  evaluation3" data-number="2" data-evaluation="3"></i>
          <i class="fa fa-star fa-2x  evaluation4" data-number="3" data-evaluation="4"></i>
          <i class="fa fa-star fa-2x  evaluation5" data-number="4" data-evaluation="5"></i>
        </div>

   
                    <!-- حساب عدد النجوم   -->
                    <?php 
                    $stars=0; 
                    ?>
                            @foreach ($service->evaluation as $evaluation)    
                            <?php   
                            $stars=$stars+$evaluation->evaluation;
                            ?>
                            @endforeach
                    
                       @if($count=$service->evaluation->count()>0)
                       
                     <?php  $rate= ($stars/$count); ?> 
                       @for ($i =0 ; $i <=round($rate) ; $i++)
                       <style>
                        .stars .evaluation{{$i}}{
                          color:yellow;
                        }
                         </style>
                       @endfor
        
                       @endif
  
        <hr>
        <p class="lead" style="font-weight: 400"><i style="color: #646464;" class="fa fa-eye"></i> {{__('trans_word.countview')}} : {{$service->views->count()}}</p>
        <hr>



        <div class="media">
          <div class="media-left">
          <a href="{{route('user.profile',['id'=>$service->user_id])}}">
                <img class="media-object" style="border-radius: 100%;width: 96px;height: 90px;" src="{{asset('site/img/users/'.$service->user->photo)}}">
            </a>
          </div>
          <div class="media-body">
            <h4 class="media-heading">
              
        <div class="status-active" style="display: inline-flex;">
          <div class="online-right-{{$service->user->id}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #00ff1f;
            width: 10px;
            height: 10px;
            display: inline-block;
            border-radius: 100%;
            font-weight: bold;
            "></span></div>

          <div class="offline-right-{{$service->user->id}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #adadad;
            width: 10px;
            height: 10px;
            display: inline-block;
            border-radius: 100%;
            font-weight: bold;
            "></span></div>
            
            <a style="text-decoration: none" href="{{route('user.profile',['id'=>$service->user_id])}}">
              <p style="font-weight: 400;margin-top: 10px">{{$service->user->name}}</p>
            </a>
          </div>
            </h4>

            @if(isset(auth()->user()->id) && auth()->user()->id!=$service->user_id or !isset(auth()->user()->id))

            <a href="{{route('chat',['id'=>$service->user_id])}}" class="btn btn-success "><i class="fa fa-envelope"></i> {{__('trans_word.sendmessage')}}</a>

            @endif
          </div>
        </div>


           
        @if( Config::get('app.locale') == 'en')
        <style>
          .sale-service{
            position: absolute;
            top: 18px;
            left: 141px;
            font-weight: 400;
          }
          .send-message{
            position: absolute;
            left: 141px;
            font-weight: bold;
          }
        </style>
        @else
        <style>
            .sale-service{
            position: absolute;
            top: 18px;
            right: 141px;
            font-weight: bold;
          }
          .send-message{
            position: absolute;
            right: 141px;
            font-weight: 400;
          }
        </style>
        @endif

      </div>

    </div>
  
  
    </div>
  </div>

  @include('layouts.site.footer')

@endsection