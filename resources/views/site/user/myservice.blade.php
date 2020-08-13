@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

            <div class="myservices" style="padding-top:30px;padding-bottom:30px;">
             <div class="container">
                 @if($service->count()>0)

                 @foreach($service as $services)                     
                <div class="panel panel-default" style="margin-bottom: 10px">
                    <div class="panel-body" style="overflow-wrap: break-word">
                        <div class="row">
                        <div class="col-md-3 col-sm-5 col-xs-12">
                            <?php $explodephoto=explode(',',$services->photos); ?>
                        <a href="{{route('service.show',['id'=>$services->id])}}"><img class="img-responsive" style="height: 200px;width:100%;border-radius: 5px" src="{{asset("site/img/servicework/$explodephoto[0]")}}"> </a>
                            <span class="btn btn-primary" style="position: absolute;top: 6px;">{{$services->price}} $</span>

                        </div>

                            <div class="col-md-9 col-sm-7 col-xs-12">

                                <div class="title" style="margin-top: -16px;margin-bottom: 40px;">
                                    <div class="col-md-8 col-xs-12">
                                    <h3 class="title-myservice"><a href="{{route('service.show',['id'=>$services->id])}}" style="text-decoration: none;color: rgb(43, 43, 43);">{{Str::title($services->title)}}</a></h3>
                                    <br>
                                    <p style="color: rgb(92, 92, 92)">{!! Str::limit($services->description,500) !!} </p>
   
                                </div>

                                    <div class="col-md-4 col-xs-12">
                                <div class="stars-{{$services->id}} @if( Config::get('app.locale') == 'en') pull-right @else pull-left @endif"  style="color: rgb(58, 58, 58);text-align: center;margin-top: 20px;">
                                    <i class="fa fa-star fa-2x  evaluation1" data-number="0" data-evaluation="1"></i>
                                    <i class="fa fa-star fa-2x  evaluation2" data-number="1" data-evaluation="2"></i>
                                    <i class="fa fa-star fa-2x  evaluation3" data-number="2" data-evaluation="3"></i>
                                    <i class="fa fa-star fa-2x  evaluation4" data-number="3" data-evaluation="4"></i>
                                    <i class="fa fa-star fa-2x  evaluation5" data-number="4" data-evaluation="5"></i>
                                
                                    
                                <!-- حساب عدد النجوم   -->
                                <?php 
                                $stars=0; 
                                ?>
                                        @foreach ($services->evaluation as $evaluation)    
                                        <?php   
                                        $stars=$stars+$evaluation->evaluation;
                                        ?>
                                        @endforeach
                                
                                   @if($count=$services->evaluation->count()>0)
                                   
                                 <?php  $rate= ($stars/$count); ?> 
                                   @for ($i =0 ; $i <=round($rate) ; $i++)
                                     <style>
                                       .stars-{{$services->id}} .evaluation{{$i}}{
                                         color:yellow;
                                       }
                                     </style>
                                   @endfor
                    
                                   @endif
                                </div>
                            </div>

                                   
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="footer-myservice" style="padding: 6px;margin-top: -16px;background: rgb(243 243 243)">
                        <div class="col-md-offset-3 col-sm-offset-5">
                            <div class="row">
                        <div class="col-md-5 col-xs-12" style="margin-bottom: 10px">
                        <a href="{{route('service.edit',['id'=>$services->id])}}" class="btn btn-success"><i class="fa fa-edit"></i> {{__('trans_word.Edit service')}}</a>
                            <i class="fa fa-eye"></i> {{count($services->views)}}
                        </div>

                        <div class="col-md-7 col-xs-12">

                            <div class="@if( Config::get('app.locale') == 'en') pull-right  @else pull-left @endif">

                                <span style="margin-bottom: 10px" class="btn btn-success">{{__('trans_word.Completed sales')}} : {{count($services->completedSale)}}</span>
                                <span style="margin-bottom: 10px" class="btn btn-danger">{{__('trans_word.Canceled sales')}} : {{count($services->canceledSale)}} </span>
                          
                           @if($services->approve==0)
                           <span class="btn btn-warning"  style="margin-bottom: 10px">{{__('trans_word.Status')}} : {{__('trans_word.Wait approve')}}</span>
                           @elseif($services->approve==1)
                           <span class="btn btn-success"  style="margin-bottom: 10px">{{__('trans_word.Status')}} :  {{__('trans_word.Active')}}</span>
                           @elseif($services->approve==2)
                           <span class="btn btn-danger"  style="margin-bottom: 10px">{{__('trans_word.Status')}} :  {{__('trans_word.rejected')}}</span>
             
                           @elseif($services->approve==3)
                          <span class="btn btn-danger"  style="margin-bottom: 10px">{{__('trans_word.Status')}} :  <i class="fa fa-ban"></i> {{__('trans_word.Prohibited')}}</span>
                           @endif
                        </div>
                        </div>
                            </div>
                        </div>
                    </div>
                   
                

                </div>
                @endforeach

                @else
                <h3 style="font-weight: bold;text-align: center;margin-top: 50px;margin-bottom: 40px;color: red">{{__('trans_word.There are no services yet')}}</h3>
            
                @endif
            </div>
            </div>


            @include('layouts.site.footer')

@endsection
