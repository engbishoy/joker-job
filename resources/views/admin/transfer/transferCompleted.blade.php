@extends('layouts.admin.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.Completed transfers')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.Completed transfers')}}</li>
    </ol>
  </section>
<br>

@include('layouts.message')

<section class="content">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">{{__('trans_word.Completed transfers')}}</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body" style="overflow: auto">

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
        
          </tr>
          </thead>
          <tbody>

        @foreach ($pullcredit as $pull)
          <tr>
        <td><strong>{{$pull->id}}</strong></td>
          <td><img class="img-responsive" style="width: 50px;margin: auto;" src="{{asset('site/img/users/'.$pull->user->photo)}}"> </td>
          <td>{{$pull->user->name}}</td>
          <td>{{$pull->email_paypal}}</td>
          <td><strong style="color: rgb(1, 146, 1)"> {{$pull->amount}} $ </strong></td>
        <td>
            @if($pull->pull_status==1)
            <span style="color: green;font-weight:bold;">{{__('trans_word.Completed transfer')}}</span>
            @endif
        </td>
          <td>{{$pull->created_at->diffForHumans()}}</td>
      

    </tr>
    
        @endforeach
          </tbody>
        </table>
        @else
        <h2 style="color:red;font-weight: bold;text-align: center">{{__('trans_word.No transfers are completed yet')}}</h2>
        @endif
      </div>
      <!-- /.box-body -->
    </div>
</section>



@endsection

