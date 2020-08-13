@extends('layouts.admin.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.Technical support')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.Tickets')}}</li>
    </ol>
  </section>
<br>

@include('layouts.message')
  <!-- Main content -->
  <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{__('trans_word.Tickets') }}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            @if($tickets->count()>0)
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
              <th>#</th>
              <th>{{__('trans_word.user photo')}}</th>
              <th>{{__('trans_word.username')}}</th>
              <th>{{__('trans_word.Title ticket')}}</th>
              <th>{{__('trans_word.Message')}}</th>
              <th>{{__('trans_word.Updated at')}}</th>
              <th>{{__('trans_word.Control')}}</th>
              </tr>
              </thead>
              <tbody>
    
            @foreach ($tickets as $ticket)
              <tr>
            <td>{{$ticket->id}}</td>
            <td> <img style="width: 50px;margin: auto" class="img-responsive" src="{{asset('site/img/users/'.$ticket->user->photo)}}"> </td>
            <td>{{$ticket->user->name}}</td>
            <td>{{Str::limit($ticket->title,30)}}</td>
            <td>{!! Str::limit($ticket->message,30) !!}</td>
            <td>{{$ticket->updated_at->format('Y M d')}}</td>
            
            <td>

            <a href="{{route('technical.ticket.show',['id'=>$ticket->id])}}" class="btn btn-info"><strong><i class="fa fa-info"></i> {{__('trans_word.Show ticket')}}</strong></a>
            </td>
            </tr>
            @endforeach
              </tbody>
            </table>
            @else
            <h3 style="color:red;font-weight: bold;text-align: center">{{__('trans_word.No found any tickets')}}</h3>
            @endif
          </div>
          <!-- /.box-body -->
        </div>
  </section>

        


@endsection
