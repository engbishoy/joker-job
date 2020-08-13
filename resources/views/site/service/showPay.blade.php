@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="service-pay" style="padding-top: 80px;padding-bottom: 80px">
    <div class="container">

      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12" ><h3 style="text-align: center"> @include('layouts.message') </h3></div>
      </div>

        <div class="panel panel-default">
            <div class="panel-heading" style="position: relative;background:linear-gradient(40deg,#104c91,#1565c0c7)!important;color:white;padding: 18px;"> 
                <i class="fas fa-money-check-alt" style="font-size: 20px"></i>  <span style="font-size: 20px;">{{__('trans_word.Price service')}}</span>
                <span class="price-service" style="font-size: 20px;margin-top: 8px">{{$service->price}}$</span>
            </div>
            
            <div class="panel-body">
            <div class="details-service" style="margin-bottom:50px">
            <h3 style="color: #5a5a5a;">{{__('trans_word.Required service')}} :  <strong> {{$service->title}} </strong></h3>
            <h3 style="color: #5a5a5a;">{{__('trans_word.The service is provided by')}} :  <strong> {{$service->user->name}} </strong></h3>
            </div>
            
            <h3 style="text-align: center;color: #5a5a5a;"> {{__('trans_word.You can pay for the service in one of the following ways')}} :</h3>
            
            <div class="paypal-image" style="background: whitesmoke;margin-top: 40px">

                <form method="POST" id="form" action="{{route('service.pay',['id'=>$service->id])}}">
                    @csrf
                    @method('post')
                <button type="submit" id="btnSubmit" style="width: 100%"> <img src="{{asset('site/img/Paypal-Logo.png')}}" style="width: 40%;margin: auto;" class="img-responsive"> </button>
                
                </form>

            </div>

        <br><br>
        <h1 style="text-align: center">{{__('trans_word.OR')}}</h1>
        <br>
        <br>
            <div class="paywithcredit" style="background: whitesmoke;text-align: center;padding: 60px">

                <form method="POST" id="form" action="{{route('service.paymycredit',['id'=>$service->id])}}">
                    @csrf
                    @method('post')
                    <button type="submit" id="btnSubmit" style="font-size: 26px;
                    padding: 14px 69px;" class="btn btn-primary">{{__('trans_word.Pay with my credit')}}</button>                
                </form>
            </div>


        </div>
        </div>    
  
  </div>
</div>



@if(Config::get('app.locale') =='en')
<style>
    .price-service{
    position: absolute;
    top: 10px;
    right: 13px;
    }
</style>
@else
<style>
    .price-service{
    position: absolute;
    top: 10px;
    left: 13px;
    }
</style>

@endif


@include('layouts.site.footer')

@endsection