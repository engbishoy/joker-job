@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')


          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
          
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
              <img src="{{asset('site/img/slideshow/photo-of-man-holding-a-book-927022.jpg')}}" alt="...">
            
              </div>
              <div class="item">
                <img src="{{asset('site/img/slideshow/photo-of-woman-using-her-laptop-935756.jpg')}}" alt="...">
                
              </div>
              <div class="item">
                <img src="{{asset('site/img/slideshow/two-women-looking-and-pointing-at-macbook-laptop-1569076.jpg')}}" alt="...">
                
              </div>
              
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


          <div class="services">
    
            <div class="container">
        
                @foreach($category as $categories)
                <h3 style="font-family: sans-serif;margin-bottom: 20px"> {{$categories->name}}</h3>          
                <hr>      
            <div class="row">
                <?php $service= $categories->service; // this rilation ship hasmanythrough ?>
                @foreach ($service as $services)
                <div class="col-md-3 col-sm-6 col-sm-offset-0 col-xs-10 col-xs-offset-1">

                    <div class="service  img-thumbnail" style="position: relative;overflow-wrap: break-word;cursor: pointer;margin-bottom: 15px">
                                         
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
                      @for($i=0;$i<=count($explodePhotos);$i++)
                      <img src="{{asset('site/img/servicework/'.$explodePhotos[$i])}}" style="width:100%;height:230px" class="img-responsive">
                      @break
                      @endfor
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
        
            </div>
        
                @endforeach
            </div>
        
        </div>
        


        @include('layouts.site.footer')
        
@endsection
