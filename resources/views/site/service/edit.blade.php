@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="create-service" style="padding-top: 30px;padding-bottom: 30px;">
    <div class="container">

        @include('layouts.message')

        <div class="panel panel-default">
            <div class="panel-heading" style="background: linear-gradient(40deg,#104c91,#1565c0c7)!important; color: white;border: none"><h4> {{__('trans_word.Edit service')}} </h4> </div>
            <div class="panel-body">
                
            <form class="form-horizontal" action="{{route('service.update',['id'=>$service->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="form-group">
                    <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Title service')}}</p></label>  

                        <div class="col-lg-8 col-xs-8 ">
                        <input type="text" name="title" class="form-control" value="{{$service->title}}" required="required">
                        <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.Maximum number of characters: 200')}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Price')}}</p></label>  
    
                            <div class="col-lg-3 col-xs-4 ">
                            <input type="number" name="price" class="form-control" value="{{$service->price}}" required="required">
                            <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.The currency is the US dollar only')}}</p>
                            </div>

                            
                        <div class="col-md-4 col-xs-4">
                            <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.The minimum price is $ 5.')}}</p>
                            </div>

                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Category')}}</p></label>  
    
                            <div class="col-lg-8 col-xs-8 ">
                                <select class="form-control category" name="category" required >
                                <option>{{__('trans_word.Choose category')}}</option>
                                @foreach ($category as $cats)
                                <option @if($service->category_id==$cats->id) selected @endif value= "{{$cats->id}}">{{$cats->name}}</option>                                    
                                @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Section')}}</p></label>  
    
                            <div class="col-lg-8 col-xs-8 ">
                                <select class="form-control sections" name="section" required>
                                    <option value= "{{$service->section_id}}">{{$service->section->name}}</option>                                    
                                </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Description')}}</p></label>  
    
                        <div class="col-lg-8 col-xs-8">
                        <textarea name="description" id="description" class="form-control" required>{!! $service->description !!}</textarea>
                        <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.Maximum number of characters: 1000')}}</p>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Delivery term')}}</p></label>  
    
                        <div class="col-lg-2 col-md-3 col-xs-4">
                            <select class="form-control time" name="time_execute">
                            <option  @if($service->time_execute==1) selected @endif value="1">{{__('trans_word.1 Day')}}</option>
                            <option  @if($service->time_execute==2) selected @endif value="2">{{__('trans_word.2 Day')}}</option>
                            <option  @if($service->time_execute==3) selected @endif value="3">{{__('trans_word.3 Day')}}</option>
                            <option  @if($service->time_execute==4) selected @endif value="4">{{__('trans_word.4 Day')}}</option>
                            <option  @if($service->time_execute==5) selected @endif value="5">{{__('trans_word.5 Day')}}</option>
                            <option  @if($service->time_execute==6) selected @endif value="6">{{__('trans_word.6 Day')}}</option>
                            <option  @if($service->time_execute==7) selected @endif value="7">{{__('trans_word.1 Week')}}</option>
                            <option  @if($service->time_execute==14) selected @endif value="14">{{__('trans_word.2 Week')}}</option>
                            <option  @if($service->time_execute==21) selected @endif value="21">{{__('trans_word.3 Week')}}</option>
                            <option  @if($service->time_execute==30) selected @endif value="30">{{__('trans_word.1 Mounth')}}</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-4 col-xs-4">
                        <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.Choose an appropriate delivery period and take into account time differences, free time and other links. The buyer can cancel the service directly in case of delay in delivering the service on time.')}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Add photos')}}</p></label>  
    
                        <div class="col-lg-8 col-md-7 col-xs-8" style="position: relative">
                            <input type="file" name="photos[]" class="file"  multiple>
                            <br>
                            <?php $explodephoto=explode(',',$service->photos); ?>
                        @foreach ($explodephoto as $photos)
                        <img class="img-responsive imges-service" style="width: 80px;height: 80px;display: inline-block;" src="{{asset('site/img/servicework/'.$photos)}}">
                            
                        @endforeach
                            <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.The photo must be related to your service.Choosing a well designed image will show your service professionally and increase your sales.Never use pictures of other sellersAllowed formats: jpeg, jpg, gif and png')}}</p>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Tags')}}</p></label>  
    
                        <div class="col-lg-6 col-md-4 col-xs-5">
                            <?php $explodetags=explode(",",$service->tags);  ?>

                        <input type="text" name="tags" data-role="tagsinput" class="form-control tags" value="@foreach ($explodetags as $tags) {{$tags}} @endforeach" required>
                        </div>

                        <div class="col-lg-3 col-md-3 col-xs-3">
                            <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.The photo must be related to your service.Choosing a well designed image will show your service professionally and increase your sales.Never use pictures of other sellersAllowed formats: jpeg, jpg, gif and png')}}</p>
                        </div>

                    </div>

                    <div class="col-lg-offset-2 col-xs-offset-4">
                        <p style="color: rgb(94, 94, 94);"> <input type="checkbox" required> {{__('trans_word.I acknowledge and agree that the service does not violate the conditions')}}</p>
                    </div>
                    <br>
                    <div class="col-lg-offset-2 col-xs-offset-4">
                        <input type="submit" class="btn btn-primary" value="{{__('trans_word.Edit service')}}">
                    </div>    
            
            </form>

            </div>
          </div>

    </div>
</div>

@include('layouts.site.footer')
@endsection


@section('jscode')
<script>

$(document).on('change','.category',function(){
var categoryid=$(this).find("option:selected").val();

$('.sections option').remove();

    $.ajax({
    url : "{{route('sectionsByCategory')}}" ,
    type: 'POST',
    data:{
        "_token": "{{ csrf_token() }}",
        "id":categoryid
    },
    success:function(data) {
        $.each(data.sections,function(key,value){
        $('.sections').append(`
        <option value="${value.id}">${value.name}</option>
        `);
        });
    }
    });

});

$(function(){
$('input[name="photos[]"]').fileuploader();

$('input[name="photos[]"]').on('click',function(){
$('.imges-service').css('display','none');
});

});
 
</script>



<script>
    $(document).ready(function() {
    $('.tags').tagsinput({
        confirmKeys: [13,44,32], 
        
    });
    });     
    
</script>
@endsection