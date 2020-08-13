@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')


<?php
                   
$date = \Carbon\Carbon::createFromFormat('Y-m-d H:m',$order->created_at->format('Y-m-d H:m'));
$daysToAdd = $order->service->time_execute;
$date = $date->addDays($daysToAdd);
?>

<div class="received-order" style="padding-top: 50px;padding-bottom: 50px">
    <div class="container">


        @if($order->status==0)
        
        <div class="panel panel-default" style="background: rgb(240, 240, 240);position: relative; margin-top:30px;margin-bottom:30px;overflow-wrap: break-word">
            <div class="panel-body" style="padding: 0">
            
             <div class="row">   

            <div class="col-md-10 col-xs-9" style= " @if(Config::get('app.locale') =='en')  padding: 15px 0 15px 24px @else padding: 15px 24px 15px 0px @endif">
            <p class="lead" style="color: rgb(117, 117, 117)">{{__('trans_word.If you do not receive the attachment service on the specified date, it will be canceled automatically')}}</p>
            <h3 style="font-size: 20px">{{__('trans_word.Final date')}} : {{$date}}</h3>
            </div>

            <div class="col-md-2 col-xs-3">
            <img class="img-responsive  @if(Config::get('app.locale') =='en') pull-right @else pull-left @endif" src="{{asset('site/img/icon-time.png')}}" style="
            background: #FF9800;
            padding: 52px 22px;">
            </div>

             </div>
            </div>
        </div>
        @endif


        <div class="panel panel-default" style="overflow-wrap: break-word">
            <div class="panel-body" style="position: relative">
                @include('layouts.message')

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
            <span class="btn btn-success" style="position: absolute;top: 6px;">{{__('trans_word.Complete from admin')}}</span>
                    
            @elseif($order->sale_service_approve==0)
            <span class="btn btn-warning" style="position: absolute;top: 6px;">{{__('trans_word.Waiting for sale service approval')}}</span>

            @elseif($order->sale_service_approve==2)
            <span class="btn btn-danger" style="position: absolute;top: 6px;">{{__('trans_word.Canceled from sale service')}}</span>
            
            @elseif(count($order->attachment)==0)
            <span class="btn btn-warning" style="position: absolute;top: 6px;">{{__('trans_word.Awaiting receipt')}}</span>
            @elseif($order->status==0)
            <span class="btn btn-warning" style="position: absolute;top: 6px;">{{__('trans_word.Waiting for your review')}}</span>
            @elseif($order->status==1)
            <span class="btn btn-success" style="position: absolute;top: 6px;">{{__('trans_word.Completed')}}</span>
            @elseif($order->status==2)
            <span class="btn btn-danger" style="position: absolute;top: 6px;">{{__('trans_word.The service was rejected')}}</span>

            @endif

                    <a href="{{route('service.show',['id'=>$order->service->id])}}" style="text-decoration: none;color: rgb(51, 51, 51);font-size:22px;padding-top: 30px">{{Str::title($order->service->title)}}</a>
                    <br>
                    <span style="color: rgb(94, 94, 94)"><i class="fa fa-calendar"></i> {{$order->service->created_at->format('d M Y')}}</span>
                    <br><br>
                    <div style="font-weight: bold" style="margin-bottom: 30px;">{!! $order->service->description !!}</div>


                    <!-- status order panel -->
          
                    @if($order->expire_time_sale_approve==1)

                    <div class="panel panel-default" style="background: rgb(240, 240, 240);position: relative; margin-top: 30px;margin-bottom: 30px;">
                        <div class="panel-body" style="padding: 0">
                        
                         <div class="row">   
            
                        <div class="col-md-10 col-xs-9" style= " @if(Config::get('app.locale') =='en')  padding: 15px 0 15px 24px @else padding: 15px 24px 15px 0px @endif">
                        <p class="lead" style="color: rgb(117, 117, 117)">{{__('trans_word.The request was canceled because the seller did not respond to the acceptance or rejection of the request')}}</p>
                        </div>
            
                        <div class="col-md-2 col-xs-3">
                        <img class="img-responsive  @if(Config::get('app.locale') =='en') pull-right @else pull-left @endif" src="{{asset('site/img/icon-cross.png')}}" style="
                        background: rgb(218, 0, 65);
                        padding: 45px 22px;">
                        </div>
            
                         </div>
                        </div>
                    </div>
                    
                    @elseif($order->expire_time_sale_attachment==1)

                    <div class="panel panel-default" style="background: rgb(240, 240, 240);position: relative; margin-top: 30px;margin-bottom: 30px;">
                        <div class="panel-body" style="padding: 0">
                        
                         <div class="row">   
            
                        <div class="col-md-10 col-xs-9" style= " @if(Config::get('app.locale') =='en')  padding: 15px 0 15px 24px @else padding: 15px 24px 15px 0px @endif">
                        <p class="lead" style="color: rgb(117, 117, 117)">{{__('trans_word.The request was canceled by the manager for not delivering the service attachments on time')}}</p>
                        </div>
            
                        <div class="col-md-2 col-xs-3">
                        <img class="img-responsive  @if(Config::get('app.locale') =='en') pull-right @else pull-left @endif" src="{{asset('site/img/icon-cross.png')}}" style="
                        background: rgb(218, 0, 65);
                        padding: 55px 22px;">
                        </div>
            
                         </div>
                        </div>
                    </div>
                 

                    @elseif($order->expire_time_buyer_approve==1)
                    <div class="panel panel-default" style="background: rgb(240, 240, 240);position: relative; margin-top:30px;margin-bottom:30px;">
                        <div class="panel-body" style="padding: 0">
                        
                         <div class="row">   
            
                        <div class="col-md-10 col-xs-9" style= " @if(Config::get('app.locale') =='en')  padding: 15px 0 15px 24px @else padding: 15px 24px 15px 0px @endif">
                            <p class="lead" style="color: rgb(117, 117, 117)">{{__('trans_word.The request was completed because you did not respond to the acceptance or rejection of the latest attachment service')}}</p>
                        </div>
            
                        <div class="col-md-2 col-xs-3">
                        <img class="img-responsive  @if(Config::get('app.locale') =='en') pull-right @else pull-left @endif" src="{{asset('site/img/icon-checkmark.png')}}" style="
                        background: rgb(0, 172, 77);
                        padding: 52px 22px;">
                        </div>
            
                         </div>
                        </div>
                    </div>
            


                    @elseif($order->status==3)
                    <div class="panel panel-default" style="background: rgb(240, 240, 240);position: relative; margin-top:30px;margin-bottom:30px;">
                        <div class="panel-body" style="padding: 0">
                        
                         <div class="row">   
            
                        <div class="col-md-10 col-xs-9" style= " @if(Config::get('app.locale') =='en')  padding: 15px 0 15px 24px @else padding: 15px 24px 15px 0px @endif">
                        <p class="lead" style="color: rgb(117, 117, 117)">{{__('trans_word.The request was canceled by the manager')}}</p>
                        </div>
            
                        <div class="col-md-2 col-xs-3">
                        <img class="img-responsive  @if(Config::get('app.locale') =='en') pull-right @else pull-left @endif" src="{{asset('site/img/icon-checkmark.png')}}" style="
                        background: rgb(218, 0, 65);
                        padding: 45px 22px;">
                        </div>
            
                         </div>
                        </div>
                    </div>

                    @elseif($order->status==4)
                    <div class="panel panel-default" style="background: rgb(240, 240, 240);position: relative; margin-top:30px;margin-bottom:30px;">
                        <div class="panel-body" style="padding: 0">
                        
                         <div class="row">   
            
                        <div class="col-md-10 col-xs-9" style= " @if(Config::get('app.locale') =='en')  padding: 15px 0 15px 24px @else padding: 15px 24px 15px 0px @endif">
                        <p class="lead" style="color: rgb(117, 117, 117)">{{__('trans_word.The request was completed by the manager')}}</p>
                        </div>
            
                        <div class="col-md-2 col-xs-3">
                        <img class="img-responsive  @if(Config::get('app.locale') =='en') pull-right @else pull-left @endif" src="{{asset('site/img/icon-checkmark.png')}}" style="
                        background: rgb(0, 172, 77);
                        padding: 45px 22px;">
                        </div>
            
                         </div>
                        </div>
                    </div>
                    @endif


                    <!-- attachment service --> 

                    @if(count($order->attachment)>0)
                    <hr>
                    @foreach ($order->attachment as $attachment)
                    <div class="row" style="padding-bottom: 30px;padding-top: 30px">
                        <div class="col-md-2 col-xs-3">
                    <img class="img-responsive" style="width: 61px;border-radius: 100%;" src="{{asset('site/img/users/'.$attachment->user->photo)}}">
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

                    <!-- accept service from buyer order -->

                    @if($order->status==0 or $order->status==2)
                    
                    <div style="padding-top: 20px;padding-bottom:20px ">
                        <form method="POST" id="form" action="{{route('order.approve',['id'=>$order->id])}}" style="@if ( Config::get('app.locale') == 'en') margin-right: 10px; @else margin-left:10px @endif">
                            @csrf
                            <div class="form-group">
                            <textarea class="form-control" name="comment" style="height:150px" required></textarea>
                            </div>

                            <br>
                            <!-- rating -->

                            <div class="stars">
                                <i class="fa fa-star fa-2x evaluation" data-number="0" data-evaluation="1"></i>
                                <i class="fa fa-star fa-2x evaluation" data-number="1" data-evaluation="2"></i>
                                <i class="fa fa-star fa-2x evaluation" data-number="2" data-evaluation="3"></i>
                                <i class="fa fa-star fa-2x evaluation" data-number="3" data-evaluation="4"></i>
                                <i class="fa fa-star fa-2x evaluation" data-number="4" data-evaluation="5"></i>
                            </div>

                            <input type="hidden" class="count-star" name="evaluation" required>
                            <br>
                            <br>
                        <button type="submit" class="btn btn-primary approve pull-left" id="btnSubmit"><strong><i class="fa fa-thumbs-up"></i> {{__('trans_word.Approve service')}}</strong></button>
                        </form>  

                        <form  method="POST" id="form" action="{{route('order.refusal',['id'=>$order->id])}}">
                        @csrf
                        @method('PUT')
                        <button type="submit" id="btnSubmit" class="btn btn-danger pull-right"><strong><i class="fa fa-times"></i> {{__('trans_word.Refusal Service')}}</strong></button>
                        </form>  
                    </div>
                    @endif


                    @endif

                    </div>
      

                    <div class="col-lg-4 col-md-5 col-xs-12" @if(Config::get('app.locale') =='en') style="border-left: 1px solid #c8c8c8;" @else style="border-right: 1px solid #c8c8c8;" @endif>
                   
                    <p style="color: rgb(51, 51, 51);font-size:22px"> <i class="fas fa-money-check-alt" style="font-size: 20px"></i> {{__('trans_word.Order details')}}</p>
                    <br>
                    <p style="text-decoration: none;color: rgb(51, 51, 51)"> {{__('trans_word.Sale service')}} : <a href="{{route('user.profile',['id'=>$order->service->user_id])}}" style="text-decoration: none"><img class="img-responsive" src="{{asset('site/img/users/'.$order->service->user->photo)}}" style="height: 52px;width: 50px;border-radius: 100%;display: inline-block;"> <strong> {{$order->service->user->name}} </strong></a> 
                    <a style="@if(Config::get('app.locale') =='en') border-left: 1px solid #bdbdbd;padding-left: 10px;right: 67px; @else border-right: 1px solid #bdbdbd;padding-right: 10px; left:67px; @endif
                        position: absolute;
                        top: 74px;
                        font-size: 20px;
                    color: #48a50a;" href="{{route('chat',['id'=>$order->service->user_id])}}"><i class="fa fa-envelope"></i></a>
                        
                    </p>
                   
                    <p style="text-decoration: none;color: rgb(51, 51, 51)"> {{__('trans_word.Order id')}} : <strong># {{$order->id}} </strong></p>

                    <p style="text-decoration: none;color: rgb(51, 51, 51)"> {{__('trans_word.Price')}} : <strong> {{$order->price}}$ </strong></p>
                    
                    <p style="text-decoration: none;color: rgb(51, 51, 51)"> {{__('trans_word.Date')}} : <strong> {{$order->created_at->format('d M Y')}}</strong></p>
                    
                    <p style="text-decoration: none;color: rgb(51, 51, 51)"> {{__('trans_word.Final date')}} : <strong> {{$date}}</strong></p>
                

                </div>
                </div>
            </div>
        </div>           
       
    </div>
</div>


@section('jscode')
<script>

var ratedindex= -1;

$(document).ready(function(){
resetSetColors();
    $('.evaluation').on('click',function(){
        var ratedindex=parseInt($(this).data('number'));
        localStorage.setItem('ratedindex',ratedindex);
    });

    $('.evaluation').mouseover(function(){
        resetSetColors();
        var currentindex=parseInt($(this).data('number'));

        $('.count-star').val($(this).data('evaluation'));

        for(var i=0 ; i<=currentindex;i++){
            $('.evaluation:eq('+i+')').css('color','#FDD835');
        }
    });



});

    function resetSetColors(){
        $('.evaluation').css('color','black');
    }


</script>
@endsection

@include('layouts.site.footer')

@endsection