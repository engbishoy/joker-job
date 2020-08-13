@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')


<div class="show-work" style="padding-top: 30px;padding-bottom:30px;">
<div class="container">

    <div class="row">

    <div class="col-md-6 col-xs-9" style="overflow-wrap: break-word">
    <h3>{{Str::title($work->title)}}</h3>
    <p style="font-size: 13px;color: rgb(128 128 128);font-weight: bold ; "><i class="fa fa-clock"></i> {{$work->created_at->diffForHumans()}}</p>
    </div>

    <div class="col-md-2 col-xs-3" style="overflow-wrap: break-word">
    <a target="_blank" href="{{$work->link_work}}" class="btn btn-primary @if( Config::get('app.locale') == 'en') pull-right @else pull-left @endif" style="border-radius:0;margin-top: 19px"><i class="fa fa-link"></i> {{__('trans_word.Link work')}} </a>
    </div>

    </div>


    <div class="row">
    <div class="col-md-8 col-xs-12">
    <div class="details-work" style="padding-bottom: 50px">
    

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <?php $explodePhotos=explode(',',$work->photos); ?>

            <ol class="carousel-indicators">
              @for($i=0;$i<count($explodePhotos);$i++)
              <li style="background: orangered;border: none" data-target="#carousel-example-generic" data-slide-to="0" @if($i==0) class="active" @endif></li>
              @endfor
            </ol>
          
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
            @for($i=0;$i<count($explodePhotos);$i++)
            <div class="item @if($i==0) active @endif">
            <img src="{{asset('site/img/servicework/'.$explodePhotos[$i])}}" class="img-responsive img-sevice">
            </div>
            @endfor
       
            </div>
          
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>



    <h3>{{__('trans_word.Description')}}</h3>
    <hr>
    <div style="font-weight: bold"> {!!$work->description !!} </div>
    
    </div>
    
    </div>
        
       
    <div class="col-md-4 col-xs-12">

        <div class="media">
            <div class="media-left">
              <a href="{{route('user.profile',['id'=>$work->user_id])}}">
              <img src="{{asset('site/img/users/'.$work->user->photo)}}" style="width:70px;height:70px;border-radius:100%">
              </a>
            </div>
            <div style="padding-top:15px" class="media-body">

                <div class="status-active" style="display: inline-flex">
                  <div class="online-right-{{$work->user->id}}" style="font-weight: bold;display:none"><span style="background-color: #00ff1f;
                    width: 10px;
                    height: 10px;
                    display: inline-block;
                    border-radius: 100%;
                    font-weight: bold;
                    "></span></div>
        
                  <div class="offline-right-{{$work->user->id}}" style="font-weight: bold;display:none"><span style="background-color: #adadad;
                    width: 10px;
                    height: 10px;
                    display: inline-block;
                    border-radius: 100%;
                    font-weight: bold;
                    "></span></div>

                  <h4 class="media-heading" style= '@if ( Config::get('app.locale') == 'en') margin-left:5px; @else margin-right:5px; @endif'><a style="text-decoration: none" href="{{route('user.profile',['id'=>$work->user_id])}}"> {{$work->user->name}} </a> </h4>

                  </div>

                  <a class=" @if( Config::get('app.locale') == 'en') pull-right @else pull-left @endif" href="{{route('chat',['id'=>$work->id])}}"><i class="fa fa-envelope fa-2x" style="color: green"></i></a>


            </div>
          </div>   

          <br><br>
    <div class="skills-me">
        <div class="panel panel-default">
            <div class="panel-body">
            <h3>{{__('trans_word.Skills')}}</h3>
            <hr>
            <div class="skill">
                <?php $explodeskills=explode(",",$work->skills);  ?>

                @foreach ($explodeskills as $skills)
            <span style="@if( Config::get('app.locale') == 'en') margin-right: 5px; @else margin-left:5px; @endif margin-bottom: 7px;border-radius: 0px" class="btn btn-primary">{{$skills}}</span>
                @endforeach
            </div>
            </div>
        </div>
    </div>
    </div>

    </div>

</div>
</div>

@include('layouts.site.footer')

@endsection