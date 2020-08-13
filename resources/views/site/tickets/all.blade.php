@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('site.tickets.navbar')

<div class="all-ticket" style="padding-top: 50px;padding-bottom: 50px">
    <div class="container">
        @include('layouts.message')
    @if($ticket->count()>0)
    <div class="table-responsive">

    <table class="table">
        <thead>
          <tr>
          <th scope="col">#</th>
          <th scope="col">{{__('trans_word.Title ticket')}}</th>
          <th scope="col">{{__('trans_word.Message')}}</th>
          <th scope="col">{{__('trans_word.Updated at')}}</th>
          <th scope="col">{{__('trans_word.Show ticket')}}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($ticket as $tickets)

            <tr>
            <th scope="row">{{$tickets->id}} </th>
            <td>{{Str::limit($tickets->title,30)}}</td>
            <td>{!! Str::limit($tickets->message,30) !!}</td> 
            <td>{{$tickets->updated_at->format('d M Y')}} </td>
            <td> 
            <a href="{{route('ticket.show',['id'=>$tickets->id])}}" class="btn btn-info" style="display: inline-block"><strong><i class="fa fa-info"></i> {{__('trans_word.Show ticket')}}</strong></a>
            </td>
            </tr>    
            @endforeach
        </tbody>
    </table>

    </div>
            @else

            <h3 style="font-weight: bold;text-align: center;margin-top: 40px;color: red">{{__('trans_word.There are no tickets yet')}}</h3>
            @endif
        
            </div>
        </div>
        
      
        @include('layouts.site.footer')

        @endsection
