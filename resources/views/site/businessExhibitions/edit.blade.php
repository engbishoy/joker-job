@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="create-service" style="padding-top: 30px;padding-bottom: 30px;">
    <div class="container">

        @include('layouts.message')

        <div class="panel panel-default">
            <div class="panel-heading " style="color: white;border: none;background: linear-gradient(184deg,#2ac4ca,#1565C0)!important;"> <h4>{{__('trans_word.Add work')}}</h4></div>
            <div class="panel-body">
                
            <form class="form-horizontal" action="{{route('BusinessExhibition.update',['id'=>$businessExhibition->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="form-group">
                    <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Title')}}</p></label>  

                        <div class="col-lg-8 col-xs-8 ">
                        <input type="text" name="title" class="form-control" value="{{$businessExhibition->title}}" required="required">
                        </div>
                    </div>


                    
                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Description')}}</p></label>  
    
                        <div class="col-lg-8 col-xs-8">
                        <textarea name="description" id="description" class="form-control" required>{!!$businessExhibition->description!!}</textarea>
                        </div>

                    </div>
               

                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Category')}}</p></label>  
    
                            <div class="col-lg-8 col-xs-8 ">
                                <select class="form-control category" name="category">
                                <option>{{__('trans_word.Choose category')}}</option>
                                @foreach ($category as $cats)
                                <option @if($businessExhibition->category_id==$cats->id) selected @endif value="{{$cats->id}}">{{$cats->name}}</option>                                    
                                @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Section')}}</p></label>  
    
                            <div class="col-lg-8 col-xs-8 ">
                                <select class="form-control sections" name="section">
                                <option value="{{$businessExhibition->section_id}}">{{$businessExhibition->section->name}}</option>
                                </select>
                            </div>
                    </div>




                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Add photos')}}</p></label>  
    
                        <div class="col-lg-8 col-md-7 col-xs-8" style="position: relative">
                            <input type="file" name="photos[]" class="file"  multiple>
                            <br>
                            <?php $explodephotos=explode(',',$businessExhibition->photos); ?>
                            @foreach ($explodephotos as $photos)
                        <img src="{{asset('site/img/servicework/'.$photos)}}" class="img-resonsive img-work" style="width: 90px;height: 90px;">
                            @endforeach
                            <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.The photo must be related to your service.Choosing a well designed image will show your service professionally and increase your sales.Never use pictures of other sellersAllowed formats: jpeg, jpg, gif and png')}}</p>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Skills')}}</p></label>  
    
                        <div class="col-lg-6 col-md-4 col-xs-5">                           
                            <?php $explodeskills=explode(",",$businessExhibition->skills);  ?>

                        <input type="text" name="skills" data-role="tagsinput" value=" @foreach ($explodeskills as $skills) {{$skills}} @endforeach " class="form-control skills" required>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 col-xs-4 control-label"><p class="lead"> {{__('trans_word.Link')}} <span style="font-size: 14px">({{__('trans_word.Optional')}})</span> </p> </label>  
    
                        <div class="col-lg-6 col-md-4 col-xs-5">
                        <input type="text" name="link" value="{{$businessExhibition->link_work}}" class="form-control">
                        </div>

                    </div>

            
                    <br>
                    <div class="col-lg-offset-2 col-xs-offset-4">
                        <h4><input type="submit" class="btn btn-primary" value="{{__('trans_word.Add work')}}"></h4>
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
$('.img-work').css('display','none');
});
});
 
</script>



<script>
    $(document).ready(function() {
    $('.skills').tagsinput({
        confirmKeys: [13,44,32], 
        
    });
    });     
    
</script>

@endsection