@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="create-works" style="padding-top: 30px;padding-bottom: 30px;">
    <div class="container">
        <div class="panel panel-default" style="border:none;box-shadow: 0px 0px 8px -5px black;">
            <div class="panel-body">
            <h4>{{__('trans_word.Business exhibition')}}</h4>
            
            <a href="{{route('BusinessExhibition.create')}}" class="btn btn-primary  @if(Config::get('app.locale') =='en') pull-right  @else pull-left @endif" style="margin-top: -34px;"><i class="fa fa-plus"></i> {{__('trans_word.Add work')}}</a>
            </div>
        </div>

        <div class="my-works" style="padding-top: 20px;padding-bottom: 20px;">

            @if(count($work)>0)

            <div class="row">
                @foreach ($work as $works)

                <div class="col-md-4 col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1" style="margin-bottom: 15px;">
                <div class="thumbnail" style="position: relative;overflow-wrap: break-word;cursor: pointer;">
                            
            <div class="media">
                <div class="media-left">
                <a href="{{route('user.profile',['id'=>$works->user->id])}}">
                    <img src="{{asset('site/img/users/'.$works->user->photo)}}" class="media-object img-thumbnail" style='width: 50px;height: 50px;border-radius: 100%;border: 1px solid white;'>
                </a>
                </div>
                <div class="media-body">
                  
              <div class="status-active" style="display: inline-flex;">
                <div class="online-right-{{$works->user->id}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #00ff1f;
                  width: 10px;
                  height: 10px;
                  display: inline-block;
                  border-radius: 100%;
                  font-weight: bold;
                  "></span></div>
      
                <div class="offline-right-{{$works->user->id}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #adadad;
                  width: 10px;
                  height: 10px;
                  display: inline-block;
                  border-radius: 100%;
                  font-weight: bold;
                  "></span></div>
                <a href="{{route('user.profile',['id'=>$works->user->id])}}">
                  <p class="media-heading" style="font-size: 16px;color: rgb(54, 54, 54);font-weight: bold ;padding-top: 10px; @if ( Config::get('app.locale') == 'en') margin-left: 5px; @else margin-right:5px; @endif "> {{$works->user->name}}</p>
                </a>

             </div>

             <p style="font-size: 13px;color: rgb(128 128 128);font-weight: bold ; @if ( Config::get('app.locale') == 'en') margin-left: 10px; @else margin-right:10px; @endif "> {{$works->created_at->diffForHumans()}}</h4>

                </div>
              </div>


            
            <a href="{{route('BusinessExhibition.show',['id'=>$works->id])}}">
                <?php $explodePhotos=explode(',',$works->photos); ?>
                <img src="{{asset('site/img/servicework/'.$explodePhotos[0])}}" style="width:100%;height:270px" class="img-responsive">
                <p style="font-size: 13px;color: rgb(128 128 128);font-weight: bold ; @if ( Config::get('app.locale') == 'en') margin-left: 10px; @else margin-right:10px; @endif "> {{Str::title(Str::limit($works->title,20))}}</p>
            </a>
                                                          
                        </div>
                </div>

                @endforeach

            </div>

            {{$work->links()}}

            @else
            <h3 style="margin-top: 30px; margin-bottom: 30px;color: red;font-weight: bold;text-align: center">{{__('trans_word.There are no works yet')}}</h3>
            @endif
        </div>
    </div>
</div>

<style>
    a:hover{
        text-decoration: none;
    }
</style>



@include('layouts.site.footer')

@endsection
