@extends('layouts.admin.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.Orders')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.Orders')}}</li>
    </ol>
  </section>
<br>

@include('layouts.message')
  <!-- Main content -->

  <section class="content">



<div class="panel panel-default">
    <div class="panel-body" style="position: relative">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-xs-12" style="padding-bottom: 50px">

                <?php $explodePhotos=explode(',',$order->service->photos); ?>
                @for($i=0;$i<=count($explodePhotos);$i++)
                <img class="img-responsive img-thumbnail" style="width:100%;margin-bottom: 20px;height: 412px;" src="{{asset('site/img/servicework/'.$explodePhotos[$i])}}">

                @break
                @endfor
            
            @if($order->status==3)
            <span class="btn btn-danger" style="position: absolute;top: 6px;">{{__('trans_word.Canceled from admin')}}</span>
            @elseif($order->status==4)
            <span class="btn btn-success" style="position: absolute;top: 6px;">{{__('trans_word.Completed from admin')}}</span>
           @elseif($order->sale_service_approve==0)
            <span class="btn btn-warning" style="position: absolute;top: 6px;">{{__('trans_word.Waiting for sale service approval')}}</span>
        
            @elseif($order->sale_service_approve==2)
            <span class="btn btn-danger" style="position: absolute;top: 6px;">{{__('trans_word.Canceled')}}</span>
            
            @elseif(count($order->attachment)==0)
            <span class="btn btn-warning" style="position: absolute;top: 6px;">{{__('trans_word.Awaiting receipt')}}</span>
            @elseif($order->status==0)
            <span class="btn btn-warning" style="position: absolute;top: 6px;">{{__('trans_word.Waiting for your review')}}</span>
            @elseif($order->status==1)
            <span class="btn btn-success" style="position: absolute;top: 6px;">{{__('trans_word.Completed')}}</span>
            @elseif($order->status==2)
            <span class="btn btn-danger" style="position: absolute;top: 6px;">{{__('trans_word.Refusal Service')}}</span>

            @endif

            <a href="{{route('service.show',['id'=>$order->service->id])}}" style="text-decoration: none;color: rgb(51, 51, 51);font-size:22px;padding-top: 30px">{{Str::title($order->service->title)}}</a>
            <br>
            <span style="color: rgb(94, 94, 94)"><i class="fa fa-calendar"></i> {{$order->service->created_at->format('d M Y')}}</span>
            <br><br>
            <p class="lead" style="color: rgb(85, 85, 85)">{!! $order->service->description !!}</p>




            <!-- attachment service --> 

 <!-- attachment service --> 

 @if(count($order->attachment)>0)
 <hr>
 @foreach ($order->attachment as $attachment)
 <div class="row" style="padding-bottom: 30px;padding-top: 30px">
     <div class="col-md-2 col-xs-3">
 <img class="img-responsive" style="width: 61px;height:61px;border-radius: 100%;" src="{{asset('site/img/users/'.$attachment->user->photo)}}">
     </div>

     <div class="col-md-10 col-xs-9">

 <div class="attachment" style="background: #06adde;padding: 10px 14px;border-radius: 4px;overflow-x: overlay">
 <h4 style="color: #146fca;border-bottom: 1px solid rgb(209, 209, 209);padding-bottom: 10px;margin-bottom: 15px;font-size:15px;font-weight:bold">{{$attachment->user->name}}</h4>
 <img style="position: absolute;
 top: 7px;
 @if ( Config::get('app.locale') == 'en') right: 21px; @else left:21px @endif" src="{{asset('site/img/icon-delivered-seller.png')}}" class="img-responsive">

 <p class="lead" style="color:white; overflow-wrap: break-word;">{{$attachment->description}}</p>
 
 <?php
 $fileExplode=explode(',',$attachment->files);
 ?>
 @foreach ($fileExplode as $files)
 <a class="btn btn-default" href="{{route('attachment.file.download',['file'=>$files])}}">{{$files}} <i class="fa fa-file"></i> </a> 
 <br>
 <br>
 @endforeach
     
 
  <!-- icon caret left -->
  @if ( Config::get('app.locale') == 'en')

  <span class="fa fa-caret-left" style="font-size: 29px;
  position: absolute;
  top: 15px;
  color: #06adde;
  left: 5px;"></span>
  @else
  <span class="fa fa-caret-right" style="font-size: 29px;
  position: absolute;
  top: 15px;
  color: #06adde;
  right: 5px;"></span>
  @endif


 </div>   

     </div>   
 </div>
 @endforeach

 @endif
            
            <!-- complete order or cancel order from admin -->

            @if($order->status!=3 && $order->status!=4 && $order->status!=1)
            <div style="padding-top: 20px;padding-bottom:20px ">

                @if(auth()->user()->hasPermission('controlOrder_update'))
                <form method="POST" id="form" action="{{route('order.complete',['id'=>$order->id])}}" style="@if ( Config::get('app.locale') == 'en') margin-right: 10px; @else margin-left:10px @endif">
                    @csrf
                <button type="submit" id="btnSubmit" class="btn btn-primary approve pull-left"><strong><i class="fa fa-thumbs-up"></i> {{__('trans_word.Complete order')}}</strong></button>
                </form>  

                <form  method="POST" id="form" action="{{route('order.cancel',['id'=>$order->id])}}">
                @csrf
                
                <button type="submit" id="btnSubmit" class="btn btn-danger pull-right"><strong><i class="fa fa-times"></i> {{__('trans_word.Cancel order')}}</strong></button>
                </form>  

                @endif
            </div>

            @endif

            </div>


            <div class="col-lg-4 col-md-5 col-xs-12" @if(Config::get('app.locale') =='en') style="border-left: 1px solid #c8c8c8;" @else style="border-right: 1px solid #c8c8c8;" @endif>
           
            <p style="color: rgb(51, 51, 51);font-size:22px"> <i class="fas fa-money-check-alt" style="font-size: 20px"></i> {{__('trans_word.Order details')}}</p>
            <br>
            <p style="text-decoration: none;color: rgb(51, 51, 51)"> {{__('trans_word.Sale service')}} : <a href=""><img class="img-responsive" src="{{asset('site/img/users/'.$order->service->user->photo)}}" style="width: 50px;height: 50px;border-radius: 100%;display: inline-block;"> <strong> {{$order->service->user->name}} </strong></a> 

            </p>
           
            <p style="text-decoration: none;color: rgb(51, 51, 51)"> {{__('trans_word.Order id')}} : <strong># {{$order->id}} </strong></p>

            <p style="text-decoration: none;color: rgb(51, 51, 51)"> {{__('trans_word.Price')}} : <strong> {{$order->service->price}} </strong></p>
            
            <p style="text-decoration: none;color: rgb(51, 51, 51)"> {{__('trans_word.Date')}} : <strong> {{$order->created_at->format('d M Y')}}</strong></p>
        
            @if(auth()->user()->hasPermission('services_update'))

            <form  method="POST" action="{{route('servicework.block',['id'=>$order->service_work_id])}}">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-danger"><strong><i class="fa fa-times"></i> {{__('trans_word.Block service')}}</strong></button>
            </form>  

            @endif
        </div>
        </div>
    </div>
</div>           


  </section>

  @endsection