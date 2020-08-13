@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

         
             <div class="container">

                 <div class="myprofile col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1" style="margin-top: 20px">
                    @include('layouts.message')
                <div class="panel panel-default">
                <div class="panel-heading">{{__('trans_word.updateprofile')}}</div>

                <div class="panel-body">
                <form action="{{route('account.setting.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group row" style="position: relative;margin-bottom: 90px">
                        <label class="col-xs-3 label-update-profile">{{__('trans_word.photoprofile')}}</label>
                        <div class="col-xs-9">
                        <input type="file" class="photoprofile-file" name="photo"> 
                        <img src="{{asset('site/img/users/'.auth()->user()->photo)}}" class="img-responsive photo-profile-edit">
                        <i class="camera-icon-profile fa fa-camera"></i>
                        </div>
                    </div>
                    @if ( Config::get('app.locale') == 'en')
                    <style>
                        .photoprofile-file{
                            z-index: 99999999999;
                            position: absolute;
                            opacity: 0;
                            height: 101px;
                            width: 105px;
                        }
                        .photo-profile-edit{
                            border-radius: 100%;
                            border:1px solid rgb(230, 94, 16);
                            width: 100px;
                            height: 100px;
                            position: absolute;
                            top: 0px;
                            left: 16px;
                        }
                        .camera-icon-profile{
                            position: absolute;
                            top: 69px;
                            left: 95px;
                            font-size: 18px;
                        }
                    </style>
                    @else
                    <style>
                        .photoprofile-file{
                            z-index: 99999999999;
                            position: absolute;
                            opacity: 0;
                            height: 101px;
                            width: 105px;
                        }
                        .photo-profile-edit{
                            border-radius: 100%;
                            border:2px solid rgb(230, 94, 16);
                            width: 100px;
                            height: 100px;
                            position: absolute;
                            top: 0px;
                            right: 16px;
                        }
                        .camera-icon-profile{
                            position: absolute;
                            top: 69px;
                            right: 95px;
                            font-size: 18px;
                        }
                    </style>
                    @endif
                    <div class="form-group row">
                        <label class="col-xs-3 label-update-profile">{{__('trans_word.name')}}</label>
                        <div class="col-xs-9">
                        <input type="text" required class="form-control" name="name" value="{{auth()->user()->name}}"> 
                        </div>
                    </div>
                  
                    <div class="form-group row">
                        <label class="col-xs-3 label-update-profile">{{__('trans_word.password')}}</label>
                        <div class="col-xs-9">
                        <input type="password" class="form-control" name="password"> 
                        <span style="font-weight: bold">{{__('trans_word.leave it empty in case you do not change paasword')}}</span>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label class="col-xs-3 label-update-profile">{{__('trans_word.About you')}}</label>
                        <div class="col-xs-9">
                        <textarea class="form-control" name="about" id="description">{{auth()->user()->about_you}}</textarea> 
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-xs-3 label-update-profile">{{__('trans_word.Skills')}}</label>
                        <div class="col-xs-9">
                            <?php $explodeskills=explode(",",auth()->user()->skills);  ?>

                        <input type="text" name="skills" data-role="tagsinput" class="form-control skills" value="@foreach ($explodeskills as $skills) {{$skills}} @endforeach">

                        </div>
                    </div>


                <button type="submit" class="btn btn-primary col-xs-offset-3">{{__('trans_word.save')}}</button>
                </form>
                 </div>
                </div>
            </div>

             </div>
         

             
             @include('layouts.site.footer')

@endsection


@section('jscode')

<script>
    $(document).ready(function() {
    $('.skills').tagsinput({
        confirmKeys: [13,44,32], 
        
    });
    });     
    
</script>

@endsection