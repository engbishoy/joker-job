@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')


<div class="service-section" style="padding-top: 30px;padding-bottom:30px;">

    @if(count($service)>0)
    <div class="container">
<div class="row">
    <div class="col-sm-3 col-sm-offset-0 col-xs-10 col-xs-offset-1" style="margin-bottom:20px;">

        <div class="panel panel-default" style="margin-top:20px">
            <div class="panel-heading">
            <span style="font-size: 24px">{{__('trans_word.Delivery term')}}</span>
            </div>
            <div class="panel-body" style="overflow-wrap: break-word;">
                <form method="POST" class="check-time">
                @csrf
                @method('POST')

                @foreach ($servicetime as $services)
                <input type="checkbox" name="filter_time[]"  value="{{$services->time_execute}}">
                <label>
                    <h4>
                    @if($services->time_execute==1) {{__('trans_word.1 Day')}}  @endif
                    @if($services->time_execute==2) {{__('trans_word.2 Day')}}  @endif
                    @if($services->time_execute==3) {{__('trans_word.3 Day')}} @endif
                    @if($services->time_execute==4) {{__('trans_word.4 Day')}} @endif
                    @if($services->time_execute==5) {{__('trans_word.5 Day')}} @endif
                    @if($services->time_execute==6) {{__('trans_word.6 Day')}}   @endif
                    @if($services->time_execute==7) {{__('trans_word.1 Week')}}  @endif
                    @if($services->time_execute==14) {{__('trans_word.2 Week')}} @endif
                    @if($services->time_execute==21) {{__('trans_word.3 Week')}} @endif
                    @if($services->time_execute==30) {{__('trans_word.1 Mounth')}} @endif
                
                    </h4>
                </label> 
                <br>
                @endforeach

                <input type="hidden" name="section_id" value="{{$section->id}}">

                <input type="submit" class="btn btn-primary" value="{{__('trans_word.Execute')}}" style="background: linear-gradient(40deg,#2ac4ca,#1565C0)!important;
                border: none;
                padding: 2px 31px;
                font-size: 22px;">
                </form>
            </div>
          </div>

    </div>
    <div class="col-sm-9 col-sm-offset-0 col-xs-10 col-xs-offset-1">

        <div class="section-title">
        <div class="col-xs-8">
            <h3>{{$section->name}}</h3>
        </div>

        <div class="col-xs-4">
            <div style="margin-top: 18px" class="@if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif">
            <select name='sortby' class="form-control sort" style="font-size: 18px">
            <option>{{__('trans_word.Sort by')}}</option>

            <option value="toprate">{{__('trans_word.Top rated')}}</option>
            <option value="highprice">{{__('trans_word.The highest price')}}</option>
            <option value="lowprice">{{__('trans_word.The lowest price')}}</option>
            <option value="latestadd">{{__('trans_word.The latest addition')}}</option>
            <option value="oldadd">{{__('trans_word.The Oldest addition')}}</option>
            </select>
            </div>

 

        </div>
        </div>
        <div style="clear: both"></div>
        <hr>

        <div class="services">
        @foreach ($service as $services)
        <div class="col-md-4 col-sm-6 col-xs-12" style="margin-bottom:15px;">

            <div class="service  img-thumbnail" style="position: relative;overflow-wrap: break-word;cursor: pointer;">
                                 
    <div class="media">
      <div class="media-left">
      <a href="{{route('user.profile',['id'=>$services->user_id])}}">
          <img src="{{asset('site/img/users/'.$services->user->photo)}}" class="media-object img-thumbnail" style='width: 50px;height: 50px;border-radius: 100%;border: 1px solid white;'>
      </a>
      </div>
      <div class="media-body">
        
    <div class="status-active" style="display: inline-flex;">
      <div class="online-right-{{$services->user_id}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #00ff1f;
        width: 10px;
        height: 10px;
        display: inline-block;
        border-radius: 100%;
        font-weight: bold;
        "></span></div>

      <div class="offline-right-{{$services->user_id}}" style="margin-top: 10px;font-weight: bold;display:none"><span style="background-color: #adadad;
        width: 10px;
        height: 10px;
        display: inline-block;
        border-radius: 100%;
        font-weight: bold;
        "></span></div>
      <a href="{{route('user.profile',['id'=>$services->user_id])}}">
        <p class="media-heading" style="font-size: 16px;color: rgb(54, 54, 54);font-weight: bold ;padding-top: 10px; @if ( Config::get('app.locale') == 'en') margin-left: 5px; @else margin-right:5px; @endif "> {{$services->user->name}}</p>
      </a>

   </div>

   <p style="font-size: 13px;color: rgb(128 128 128);font-weight: bold ; @if ( Config::get('app.locale') == 'en') margin-left: 10px; @else margin-right:10px; @endif "> {{$services->created_at->diffForHumans()}}</h4>

      </div>
    </div>



    <a class="service-link" href="{{route('service.show',['id'=>$services->id])}}">

              <?php $explodePhotos=explode(',',$services->photos); ?>
              <img src="{{asset('site/img/servicework/'.$explodePhotos[0])}}" style="width:100%;height:230px" class="img-responsive">

            <span class="btn btn-primary" style="position: absolute;
            top: 76px;
            left: 0px;
            border-radius: 3px;
            font-size: 17px;
            box-shadow: 2px 0px 6px black;">{{$services->price}}$</span>
            <h4 style="text-align: center;color: rgb(37, 37, 37)"> {{Str::title(Str::limit($services->title,20))}} </h4>

            <div class="stars-{{$services->id}}"  style="color: rgb(58, 58, 58);text-align: center">
              <i class="fa fa-star  evaluation1" data-number="0" data-evaluation="1"></i>
              <i class="fa fa-star  evaluation2" data-number="1" data-evaluation="2"></i>
              <i class="fa fa-star  evaluation3" data-number="2" data-evaluation="3"></i>
              <i class="fa fa-star  evaluation4" data-number="3" data-evaluation="4"></i>
              <i class="fa fa-star  evaluation5" data-number="4" data-evaluation="5"></i>
            </div>
          
    <!-- حساب عدد النجوم   -->
    <?php 
    $stars=0; 
    ?>
            @foreach ($services->evaluation as $evaluation)    
            <?php   
            $stars=$stars+$evaluation->evaluation;
            ?>
            @endforeach
    
       @if($count=$services->evaluation->count()>0)
       
     <?php  $rate= ($stars/$count); ?> 
       @for ($i =0 ; $i <=round($rate) ; $i++)
         <style>
           .stars-{{$services->id}} .evaluation{{$i}}{
             color:yellow;
           }
         </style>
       @endfor

       @endif

      </a>

            </div>

          </div>
    
        @endforeach        
        <div style="clear: both"></div>
        {{$service->links()}}
        </div>

    </div>
</div>


    </div>
    @else
    <h3 style="color:red;font-weight: bold;text-align: center">{{__('trans_word.nofoundservice')}}</h3>

    @endif
</div>

@endsection




@section('jscode')
<script>

$(document).on('submit','.check-time',function(e){ 
    e.preventDefault();
    $.ajax({
      method:"POST",
      url:"{{route('service.filter.time')}}",
      data:new FormData(this),
      processData:false,
      contentType:false,    
      cache:true,
      success:function(data){
        $('.services').empty();
        $('.services').html(data);
      },
      error:function(data){
      }
    });

});




$(document).on('change','.sort',function(){
var typesort=$(this).find("option:selected").val();
var sectionid="{{$section->id}}";

    $.ajax({
    url : "{{route('service.filter.sort')}}" ,
    type: 'POST',
    data:{
        "_token": "{{ csrf_token() }}",
        "type_sort":typesort,
        "section_id":sectionid,
    },
    success:function(data) {
      $('.services').empty();
        $('.services').html(data);
    }
    });

});


</script>

@include('layouts.site.footer')

@endsection