@extends('layouts.admin.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.Required transfer')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.Required transfer')}}</li>
    </ol>
  </section>
<br>

@include('layouts.message')

<section class="content">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('trans_word.Required transfer')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body" style="overflow: auto">


        <form action="{{route('transfer.search')}}" id="form" method="get" style="margin-bottom: 30px">
          @csrf
          <div class="row">
            
            <div class="col-md-4 col-xs-6">
                <input type="email" class="form-control" name="search" placeholder="{{__('trans_word.Search by email paypal')}}">
            </div>

            <div class="col-md-8 col-xs-6">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{__('trans_word.Search')}} </button>
            </div>

          </div>
        </form>


        @if(count($pullcredit)>0)

        <table id="example2" class="table table-bordered table-hover">
          <thead>
          <tr>
          <th>#</th>
          <th>{{__('trans_word.user photo')}}</th>
          <th>{{__('trans_word.username')}}</th>
          <th>{{__('trans_word.Email Paypal')}}</th>
          <th>{{__('trans_word.amount')}}</th>
          <th>{{__('trans_word.status')}}</th>
          <th>{{__('trans_word.Created at')}}</th>
          <th>{{__('trans_word.Pay')}}</th>
        
          </tr>
          </thead>
          <tbody>

        @foreach ($pullcredit as $pull)
          <tr>
        <td><strong>{{$loop->iteration}}</strong></td>
          <td><img class="img-responsive" style="width: 50px;margin: auto;" src="{{asset('site/img/users/'.$pull->user->photo)}}"> </td>
          <td>{{$pull->user->name}}</td>
          <td>{{$pull->email_paypal}}</td>
          <td><strong style="color: rgb(1, 146, 1)"> {{$pull->amount}} $ </strong></td>
        <td>
            @if($pull->pull_status==0)
            <span style="color: rgb(236, 162, 0);font-weight:bold;"> {{__('trans_word.Awaiting transfer')}} </span>
            @endif
        </td>
          <td>{{$pull->created_at->diffForHumans()}}</td>
        <td>

          @if(auth()->user()->hasPermission('moneyTransfer_update'))
        <form method="POST" action="{{route('transfer.pay')}}">
                @csrf
                <input type="hidden" value="{{$pull->amount}}" name="amount">
                <input type="hidden" value="{{$pull->email_paypal}}" name="email_paypal">
                <input type="hidden" value="{{$pull->id}}" name="pull_id">
                <button type="submit" class="btn btn-primary"><i class="fa fa-paypal"></i> {{__('trans_word.Pay with Paypal')}}</button>
        </form>

        @else
        <button class="btn btn-primary" disabled><i class="fa fa-paypal"></i> {{__('trans_word.Pay with Paypal')}}</button>
        @endif
        </td>

    </tr>
    
        @endforeach
          </tbody>
        </table>
        @else
        <h2 style="color:red;font-weight: bold;text-align: center">{{__('trans_word.No transfers are required yet')}}</h2>
        @endif
      </div>
      <!-- /.box-body -->
    </div>
</section>



@endsection

