@extends('layouts.site.app')
@section('logintempaltelinks')

    <!-- login stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('site/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('site/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('site/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('site/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('site/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('site/css/main.css')}}">

    <!-- sign up -->

     <!-- Font Icon -->
     <link rel="stylesheet" href="{{asset('site/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

     <!-- Main css -->
     <link rel="stylesheet" href="{{asset('site/css/stylesignup.css')}}">
@endsection

@section('content')

<div class="main" style="background: url('{{asset('site/img/signup-bg.jpg')}}') no-repeat;background-size:cover;height:100%">

    <section class="signup">
        <div class="container">
            <div class="signup-content" style="margin-top: 80px">

            <form method="POST" action="{{route('login')}}">
                @csrf
                    <h2 class="form-title">{{__('trans_word.login')}}</h2>                
                    
                    <div class="form-group">
                    <input type="text" class="form-input @error('identify') is-invalid @enderror" name="identify" id="email" required placeholder="{{__('trans_word.emailorphone')}}"/>
                    </div>
                    @error('identify')
                    <span style="color: red" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror 

                    <div class="form-group">
                        <input type="text" class="form-input @error('password') is-invalid @enderror" name="password" id="password" required placeholder="{{__('trans_word.password')}}"/>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>
                    @error('password')
                    <span style="color: red" class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
               
                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1"  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="label-checkbox100" for="ckb1">
                               {{ __('trans_word.remember')}}
                            </label>
                        </div>
    
                        <div>
                           
                            @if (Route::has('password.request'))
                            <a class="txt1" href="{{ route('password.request') }}">
                                {{ __('trans_word.Forgot Your Password?') }}
                            </a>
                        @endif
                        </div>
                    </div>
                  
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            {{__('trans_word.login')}}
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </section>

</div>




@endsection