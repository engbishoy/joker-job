@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

@include('site.user.header-profile')

<div class="aboutme" style="padding: 30px">
<div class="container">

  <div class="panel panel-default" style="border:none;box-shadow: 0px 0px 11px -5px black;">
    <div class="panel-body" style="overflow-wrap: break-word;">
    <h4>{{__('trans_word.About me')}}</h4>
    <hr>
    @if($user->about_you!='')
      <p>{!! $user->about_you !!}</p>

    @else
    <h3 style="font-weight: bold;text-align: center;margin-top: 50px;margin-bottom: 40px;color: red">{{__('trans_word.There is no profile')}}</h3>

    @endif

    <hr>

      <h4>{{__('trans_word.Skills')}}</h4>
      <hr>
      @if($user->skills!='')
      <?php $explodeskills=explode(",",$user->skills);  ?>
      @foreach ($explodeskills as $skills)
  <span style="@if( Config::get('app.locale') == 'en') margin-right: 5px; @else margin-left:5px; @endif margin-bottom: 7px;border-radius: 0px" class="btn btn-primary">{{$skills}}</span>
      @endforeach
      
    @else
    <h3 style="font-weight: bold;text-align: center;margin-top: 50px;margin-bottom: 40px;color: red">{{__('trans_word.There is no skills')}}</h3>

    @endif

  </div>
  </div>

</div>
</div>

@include('layouts.site.footer')

@endsection 