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

            @if(count($user->businessExhibition)>0)

            <div class="row">
                @foreach ($user->businessExhibition as $works)

                <div class="col-md-4 col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1">
                <div class="thumbnail" style="position: relative;overflow-wrap: break-word;cursor: pointer;">
                            
            <div class="media">
                <div class="media-left">
                <a href="{{route('user.profile',['id'=>$user->id])}}">
                    <img src="{{asset('site/img/users/'.$user->photo)}}" class="media-object img-thumbnail" style='width: 50px;height: 50px;border-radius: 100%;border: 1px solid white;'>
                </a>
                </div>
                <div class="media-body">
                  
              <div class="status-active" style="display: inline-flex;">
                <div class="online-right-{{$user->id}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #00ff1f;
                  width: 10px;
                  height: 10px;
                  display: inline-block;
                  border-radius: 100%;
                  font-weight: bold;
                  "></span></div>
      
                <div class="offline-right-{{$user->id}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #adadad;
                  width: 10px;
                  height: 10px;
                  display: inline-block;
                  border-radius: 100%;
                  font-weight: bold;
                  "></span></div>
                <a href="{{route('user.profile',['id'=>$user->id])}}">
                  <p class="media-heading" style="font-size: 16px;color: rgb(54, 54, 54);font-weight: bold ;padding-top: 10px; @if ( Config::get('app.locale') == 'en') margin-left: 5px; @else margin-right:5px; @endif "> {{$user->name}}</p>
                </a>

             </div>

             <p style="font-size: 13px;color: rgb(128 128 128);font-weight: bold ; @if ( Config::get('app.locale') == 'en') margin-left: 10px; @else margin-right:10px; @endif "> {{$works->created_at->diffForHumans()}}</h4>

                </div>
              </div>


              @if($user->id==auth()->user()->id)

              <li class="dropdown" style="position: absolute;list-style: none; @if ( Config::get('app.locale') == 'en') right: 7px; @else left:7px; @endif top:17px;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-option-vertical"></span>
                </a>
                <ul class="dropdown-menu" style="background: linear-gradient(40deg,#2ac4ca,#1565C0)!important">
                <li><a href="{{route('BusinessExhibition.edit',['id'=>$works->id])}}"><i class="fa fa-edit"></i> {{__('trans_word.Edit')}}</a></li>
                <li>
                    <a class="delete" data-id="{{$works->id}}"><i class="fa fa-trash"></i> {{__('trans_word.Delete')}}</a>
                </li>
                </ul>
              </li>
       
              @endif

            
                        <a href="{{route('BusinessExhibition.show',['id'=>$works->id])}}">
                            <?php $explodePhotos=explode(',',$works->photos); ?>
                          <img src="{{asset('site/img/servicework/'.$explodePhotos[0])}}" style="width:100%;height:270px" class="img-responsive">
                          <p style="font-size: 13px;color: rgb(128 128 128);font-weight: bold ; @if ( Config::get('app.locale') == 'en') margin-left: 10px; @else margin-right:10px; @endif "> {{Str::title(Str::limit($works->title,20))}}</p>
                        </a>
                                                          
                        </div>
                </div>

                @endforeach

            </div>
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


@endsection


@section('jscode')
<script>

$(document).on('click','.delete',function(e){
          e.preventDefault();
          $(window).scrollTop(0);
          var id=$(this).attr('data-id');
          var el=this;

          var r= confirm("Are you sure delete the work!");
          if(r==true){
          $.ajax({
              method:"delete",
              url:'/'+"{{LaravelLocalization::getCurrentLocale()}}"+'/home/BusinessExhibition/delete/'+id,
              data:{"_token": "{{ csrf_token() }}"},
              success :function(data){
                $('body').append(`<div class="alert alert-success success wow bounceInRight data-wow-duration="3s" data-wow-delay="0s"">${data.message}</div>`);
                $('.success').delay(5000).fadeOut(1000);
                $(el).parent().parent().parent().parent().remove();
              }
          });
        }

          
      });


</script>



@include('layouts.site.footer')

@endsection