@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('site.requests_received.navbar')

<div class="my-order" style="padding-top: 50px;padding-bottom: 50px">
    <div class="container">
    @if(count($user->receivedOrderComplete)>0)
    <div class="table-responsive">

    <table class="table">
        <thead>
          <tr>
            <th scope="col">{{__('trans_word.Order id')}}</th>
          <th scope="col">{{__('trans_word.Photo')}}</th>
          <th scope="col">{{__('trans_word.Name')}}</th>
          <th scope="col">{{__('trans_word.Price')}}</th>
          <th scope="col">{{__('trans_word.Status order')}}</th>
          <th scope="col">{{__('trans_word.Date')}}</th>
          <th scope="col">{{__('trans_word.control')}}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($user->receivedOrderComplete as $orders)

            <?php
            
            $service= App\Models\Service_work::find($orders->service_work_id);
            
            ?>
            <tr>
                <th scope="row">#{{$orders->id}}</th>

                <?php $explodePhotos=explode(',',$orders->service->photos); ?>
                @for($i=0;$i<=count($explodePhotos);$i++)
                <td><img class="img-responsive img-thumbnail" style="width: 80px;height: 80px;" src="{{asset('site/img/servicework/'.$explodePhotos[$i])}}"> </td>
                @break
                @endfor
                
            <td>{{Str::limit($service->title,20)}}</td>
            <td>{{$service->price}}$</td>
            <td>
            @if($orders->status==1)
            <span style="color: green;font-weight: bold">{{__('trans_word.Completed')}}</span>
            @endif
            </td>
            <td>{{$orders->created_at->format('d M Y')}} </td>
            <td> 
                <a href="{{route('requests_received.show',['id'=>$orders->id])}}" class="btn btn-info" style="display: inline-block"><strong><i class="fa fa-info"></i> {{__('trans_word.Show order')}}</strong></a>
            </td>
            </tr>    
            @endforeach
        </tbody>
    </table>
    </div>
            @else
            <h3 style="text-align: center;padding-top: 40px;padding-bottom: 40px;color: red; font-weight: bold">{{__('trans_word.There are no incoming requests yet')}}</h3>

            @endif
        
            </div>
        </div>
        
        @include('layouts.site.footer')

        @endsection
