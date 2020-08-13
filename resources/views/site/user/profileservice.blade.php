@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

@include('site.user.header-profile')

<div class="services-profile" style="padding-top: 30px; padding-bottom: 30px;">
<div class="container">

    @if(count($user->service->where('approve',1))>0)
    <div class="row">
    @foreach ($user->service->where('approve',1) as $services)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-10 col-xs-offset-1">
        <a class="service-link" href="{{route('service.show',['id'=>$services->id])}}">
            <div class="service thumbnail" style="position: relative;overflow-wrap: break-word;cursor: pointer;">
              <?php $explodePhotos=explode(',',$services->photos); ?>
              @for($i=0;$i<=count($explodePhotos);$i++)
              <img src="{{asset('site/img/servicework/'.$explodePhotos[$i])}}" style="width:100%;height:230px" class="img-responsive">
              @break
              @endfor
            <span class="btn btn-primary" style="position: absolute;
            top: 4px;
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
        

            </div>
        </a>
    </div>
    @endforeach
    </div>
    @else
    <h3 style="margin-top: 30px; margin-bottom: 30px;color: red;font-weight: bold;text-align: center">{{__('trans_word.There are no services yet')}}</h3>
    @endif
 
</div>
</div>


@include('layouts.site.footer')

@endsection 