@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="create-service" style="padding-top: 30px;padding-bottom: 30px;">
    <div class="container">

        @include('layouts.message')

        <div class="panel panel-default">
            <div class="panel-heading " style="color: white;border: none;background: linear-gradient(40deg,#104c91,#1565c0c7)!important;"> <h4>{{__('trans_word.Add work')}}</h4></div>
            <div class="panel-body">
                
            <form class="form-horizontal" id="form" action="{{route('BusinessExhibition.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                    <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Title')}}</p></label>  

                        <div class="col-lg-8 col-sm-8 col-xs-12 ">
                        <input type="text" name="title" class="form-control" required="required">
                        </div>
                    </div>


                    
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Description')}}</p></label>  
    
                        <div class="col-lg-8 col-sm-8 col-xs-12">
                        <textarea name="description" id="description" class="form-control" required> </textarea>
                        </div>

                    </div>
               

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Category')}}</p></label>  
    
                            <div class="col-lg-8 col-sm-8 col-xs-12 ">
                                <select class="form-control category" name="category">
                                <option>{{__('trans_word.Choose category')}}</option>
                                @foreach ($category as $cats)
                                <option value="{{$cats->id}}">{{$cats->name}}</option>                                    
                                @endforeach
                                </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Section')}}</p></label>  
    
                            <div class="col-lg-8 col-sm-8 col-xs-12 ">
                                <select class="form-control sections" name="section">
                                </select>
                            </div>
                    </div>




                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Add photos')}}</p></label>  
    
                        <div class="col-lg-8 col-md-7 col-sm-8 col-xs-12" style="position: relative">
                            <input type="file" name="photos[]" class="file" required multiple>
                            <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.The photo must be related to your service.Choosing a well designed image will show your service professionally and increase your sales.Never use pictures of other sellersAllowed formats: jpeg, jpg, gif and png')}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Skills')}}</p></label>  
    
                        <div class="col-lg-6 col-md-4 col-sm-5 col-xs-12">
                            <input type="text" name="skills" data-role="tagsinput" class="form-control skills" required>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Link')}} <span style="font-size: 14px">({{__('trans_word.Optional')}})</span> </p> </label>  
    
                        <div class="col-lg-6 col-md-4 col-sm-5 col-xs-12">
                            <input type="text" name="link" class="form-control">
                        </div>

                    </div>

          
            
                    <br>
                    <div class="col-lg-offset-2 col-sm-offset-4">
                        <h4><button type="submit" id="btnSubmit" class="btn btn-primary add-work">{{__('trans_word.Add work')}} </button></h4>
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

