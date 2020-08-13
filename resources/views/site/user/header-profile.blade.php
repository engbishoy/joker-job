
<div class="profile-user" style="background: url('{{asset('site/img/noprofilecover.jpg')}}') no-repeat;width:100%;background-size:cover">
    <div class="container">
    
      <div class="row" style="margin-top: 131px;">
        <div class="col-sm-8 col-xs-12">
            <div class="left-profile">        
    
            <div class="media">
              <div class="media-left">
                  <img src="{{asset('site/img/users/'.$user->photo)}}" class="media-object img-thumbnail" style='width: 110px;height: 110px;border-radius: 100%;border: 1px solid white;'>
              </div>
              <div class="media-body" style="padding-top: 24px">
                
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
                <h4 class="media-heading" style="color: white;font-size: 30px; @if ( Config::get('app.locale') == 'en') margin-left: 10px; @else margin-right:10px; @endif "> {{$user->name}}</h4>
    
           </div>
                
                <p style="color: white;"> <i class="fa fa-calendar"></i> {{__('trans_word.Member since')}} : {{$user->created_at->format('d M Y')}}</p>
              </div>
            </div>
           
            </div>
          </div>
    
          <div class="col-sm-4 col-xs-12">

            <div class="stars-user @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif">
              <i class="fa fa-star fa-2x evaluation1" data-number="0" data-evaluation="1"></i>
              <i class="fa fa-star fa-2x evaluation2" data-number="1" data-evaluation="2"></i>
              <i class="fa fa-star fa-2x evaluation3" data-number="2" data-evaluation="3"></i>
              <i class="fa fa-star fa-2x evaluation4" data-number="3" data-evaluation="4"></i>
              <i class="fa fa-star fa-2x evaluation5" data-number="4" data-evaluation="5"></i>
            </div>
          

            <!-- حساب عدد النجوم   -->
            <?php 
            $stars=0; 
            $count=0;
            ?>
                @foreach ($user->service as $service)
                    @foreach ($service->evaluation as $evaluation)    
                    <?php   
                    $count=$count+$service->evaluation->count();
                    $stars=$stars+$evaluation->evaluation;
                    ?>
                    @endforeach
                @endforeach
            
              @if($count>0)
              
              <?php $rate= ($stars/$count); ?>               
               @for ($i =0 ; $i <=round($rate) ; $i++)
                 <style>
                  .stars-user .evaluation{{$i}}{
                     color:yellow;
                   }
                 </style>
               @endfor

               @endif

               

          </div>

      </div>
        </div>
    </div>
    
    
    
    <div class="links-user">
      <div class="container">
      
      
      <ul>
      <li @if(Route::current()->getName() =='user.profile') class="active" @endif><a href="{{route('user.profile',['id'=>$user->id])}}">{{__('trans_word.About me')}}</a></li>
      <li @if(Route::current()->getName() =='user.profile.businessExhibition') class="active" @endif ><a href="{{route('user.profile.businessExhibition',['id'=>$user->id])}}">{{__('trans_word.Previous works')}}</a></li>
      <li @if(Route::current()->getName() =='user.profile.service') class="active" @endif ><a href="{{route('user.profile.service',['id'=>$user->id])}}">{{__('trans_word.Services')}}</a></li>
      <li @if(Route::current()->getName() =='user.profile.sales') class="active" @endif><a href="{{route('user.profile.sales',['id'=>$user->id])}}">{{__('trans_word.Sales')}}</a></li>
      </ul>
    
      </div>
    </div>
    
    @if ( Config::get('app.locale') == 'en')
    <style>
        .links-user ul li{
     margin-right: 20px; 
        }

        @media(max-width:575px){
    .links-user ul li a{
        font-size: 13px;
    }
    .links-user ul li{
        margin-right: 10px;
    }
      }   
    </style>
    @else 
    <style>
        .links-user ul li{
     margin-left: 20px; 
        }

        @media(max-width:575px){
    .links-user ul li a{
        font-size: 13px;
    }
    .links-user ul li{
        margin-left: 10px;
    }
      }
    </style>
    @endif


