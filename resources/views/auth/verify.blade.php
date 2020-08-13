@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')


<div class="container">

    <div class="active" style="position: relative;height: 300px;">

    <div class="col-md-offset-3 col-md-6 col-xs-offset-0 col-xs-12" style="position: absolute;top:50%">
        <div class="panel panel-default">
        <div class="panel-heading">{{ __('auth.Verify Your Email Address') }}</div>
        <div class="panel-body">            
           
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('auth.A fresh verification link has been sent to your email address.') }}
            </div>
            @endif

        {{ __('auth.Before proceeding, please check your email for a verification link.') }}
        {{ __('auth.If you did not receive the email') }}
    <br><br>

        <div class="row">
        <form class="pull-right" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-primary">{{ __('auth.Resend Verify') }}</button>.
        </form>

        <form class="pull-left" method="POST" action="{{ route('user.delete') }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('auth.Cancel email') }}</button>.
        </form>
        </div>



        </div>
      </div>
    </div>
</div>

    
</div>
@endsection
