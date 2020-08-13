@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')


<div class="container">

    <div class="active" style="position: relative;height: 300px;">

    <div class="col-md-offset-3 col-md-6 col-xs-offset-0 col-xs-12" style="position: absolute;top:50%">
        <div class="panel panel-default">
        <div class="panel-heading">{{__('auth.Reset Password')}}</div>
        <div class="panel-body">            
           
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" style="margin-top: 6px" class="col-md-4 col-form-label">{{ __('auth.E-Mail Address') }}</label>

                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: rgb(235, 0, 0);font-weight: bold">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('auth.Send Password Reset Link') }}
                        </button>
                    </div>
                </div>
            </form>


        </div>
      </div>
    </div>
</div>

    
</div>
@endsection



