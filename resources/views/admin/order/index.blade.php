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
    <form action="{{route('order.search')}}" id="form" method="get" style="margin-bottom: 30px">
      @csrf
      <div class="row">
        
        <div class="col-md-4 col-xs-6">
            <input type="text" class="form-control" name="search" placeholder="{{__('trans_word.Search by id')}}">
        </div>

        <div class="col-md-8 col-xs-6">
          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{__('trans_word.Search')}} </button>
          
        </div>

      </div>
    </form>

    @if(count($order)>0)
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
            @foreach ($order as $orders)

            <tr>
            <th scope="row">#{{$orders->id}} </th>
            <?php $explodePhotos=explode(',',$orders->service->photos); ?>
            @for($i=0;$i<=count($explodePhotos);$i++)
            <td><img class="img-responsive img-thumbnail" style="width: 80px;height:80px ;" src="{{asset('site/img/servicework/'.$explodePhotos[$i])}}"> </td>
            @break
            @endfor
            <td>{{Str::limit($orders->service->title,20)}}</td>
            <td>{{$orders->service->price}} $</td>
            <td>
                @if($orders->status==3)
                <span class="btn btn-danger">{{__('trans_word.Canceled from admin')}}</span>
                @elseif($orders->status==4)
                <span class="btn btn-success">{{__('trans_word.Completed from admin')}}</span>
      
                @elseif($orders->sale_service_approve==0)
                <span class="btn btn-warning">{{__('trans_word.Waiting for sale service approval')}}</span>
    
                @elseif($orders->sale_service_approve==2)
                <span class="btn btn-danger">{{__('trans_word.Canceled')}}</span>
                
                @elseif(count($orders->attachment)==0)
                <span class="btn btn-warning">{{__('trans_word.Awaiting receipt')}}</span>
                @elseif($orders->status==0)
                <span class="btn btn-warning">{{__('trans_word.Waiting for your review')}}</span>
                @elseif($orders->status==1)
                <span class="btn btn-success">{{__('trans_word.Completed')}}</span>
                @elseif($orders->status==2)
                <span class="btn btn-danger">{{__('trans_word.Refusal Service')}}</span>
      
                @endif

            </td>
            <td>{{$orders->created_at->format('d M Y')}} </td>
            <td> 
                <a href="{{route('order.show',['id'=>$orders->id])}}" class="btn btn-info" style="display: inline-block"><strong><i class="fa fa-info"></i> {{__('trans_word.Show order')}}</strong></a>
            </td>
            </tr>    
            @endforeach
        </tbody>
    </table>

    @else
    <h3 style="color:red;font-weight: bold;text-align: center;margin-top: 30px">{{__('trans_word.No found any Order')}}</h3>

    @endif

  </section>

  @endsection