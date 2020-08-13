@extends('layouts.admin.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.Details service')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.Details service')}}</li>
    </ol>
  </section>
<br>

@include('layouts.message')
  <!-- Main content -->
  <section class="content">
    <div class="col-lg-8 col-md-6 col-xs-12">
  <h2 style="margin-bottom: 10px;overflow-wrap: break-word">{{$service->title}}</h2>
    </div>
      <div class="row">
        <div class="col-lg-8 col-md-6 col-xs-12" style="overflow-wrap: break-word">

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
                <img src="{{asset('site/img/servicework/'.$explodePhotos[$i])}}" class="img-responsive img-sevice" style="height: 470px; width: 100%">
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

      
          <p style="margin-top: 15px" class="lead">{!! $service->description !!}</p>
          </div>


          <div class="col-lg-4 col-md-6 col-xs-12">

          <p class="lead" style="font-weight: 400"><i style="color: #646464;" class="fa fa-clock-o"></i> {{__('trans_word.Delivery term')}} :
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
        <p class="lead" style="font-weight: 400"><i style="color: #646464;" class="fa fa-eye"></i> {{__('trans_word.countview')}} : {{$service->viewer}}</p>

           
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
  
  
  </section>



@endsection