@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

@include('site.user.header-profile')


<div class="completeorder" style="padding: 30px">
    <div class="container">    

        @if(count($user->receivedOrderComplete)>0)
        <div class="panel panel-default" style="border:none;box-shadow: 0px 0px 11px -5px black;">
            <div class="panel-body">

                @foreach ($user->receivedOrderComplete as $order)

            <div class="media">
                <div class="media-left">
                    <img src="{{asset('site/img/users/'.$order->user->photo)}}" class="media-object img-thumbnail" style='width: 63px;height: 63px;border-radius: 100%;border: 1px solid white;'>
                </div>
                <div class="media-body">
                    <a style="text-decoration: none" href="{{route('service.show',['id'=>$order->service_work_id])}}"><h4><span style="font-size: 11px;padding: 4px;" class="btn btn-primary">{{__('trans_word.Completed')}}</span>  {{$order->service->title}}</h4></a>
                    <span style="color: rgb(110, 110, 110)"><i class="fa fa-user"></i> {{$order->user->name}}</span>
                    <span style="color: rgb(110, 110, 110)"><i class="fa fa-clock"></i> {{$order->updated_at->diffForHumans()}}</span>
                    <span style="color: rgb(110, 110, 110)"><i class="fa fa-money-check-alt"></i> {{$order->price}}$</span>        
                </div>
            </div>
            <hr>
                @endforeach

            </div>  
        </div>
        @else
        <h3 style="margin-top: 30px; margin-bottom: 30px;color: red;font-weight: bold;text-align: center">{{__('trans_word.There are no sales yet')}}</h3>
        @endif
    </div>
</div>

@include('layouts.site.footer')


@endsection