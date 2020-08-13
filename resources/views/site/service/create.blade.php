@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="create-service" style="padding-top: 30px;padding-bottom: 30px;">
    <div class="container">

        @include('layouts.message')

        <div class="panel panel-default">
            <div class="panel-heading " style="color: white;border: none;background: linear-gradient(40deg,#104c91,#1565c0c7)!important;"> <h4>{{__('trans_word.Create new service')}}</h4></div>

            <div class="panel-body">
                
            <form class="form-horizontal" action="{{route('service.store')}}" method="POST" id="form" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                    <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Title service')}}</p></label>  

                        <div class="col-lg-8 col-sm-8 col-xs-12">
                        <input type="text" name="title" class="form-control" required="required">
                        <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.Maximum number of characters: 200')}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Price')}}</p></label>  
    
                            <div class="col-lg-3 col-sm-4 col-xs-12">
                            <input type="number" name="price" class="form-control" required="required">
                            <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.The currency is the US dollar only')}}</p>
                            </div>

                            
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.The minimum price is $ 5.')}}</p>
                            </div>

                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Category')}}</p></label>  
    
                            <div class="col-lg-8 col-sm-8 col-xs-12">
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
    
                            <div class="col-lg-8 col-sm-8 col-xs-12">
                                <select class="form-control sections" name="section">
                                </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Description')}}</p></label>  
    
                        <div class="col-lg-8 col-sm-8 col-xs-12">
                        <textarea name="description" id="description" class="form-control" required> </textarea>
                        <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.Maximum number of characters: 1000')}}</p>
                        </div>

                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Delivery term')}}</p></label>  
    
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
                            <select class="form-control time" name="time_execute">
                            <option value="1">{{__('trans_word.1 Day')}}</option>
                            <option value="2">{{__('trans_word.2 Day')}}</option>
                            <option value="3">{{__('trans_word.3 Day')}}</option>
                            <option value="4">{{__('trans_word.4 Day')}}</option>
                            <option value="5">{{__('trans_word.5 Day')}}</option>
                            <option value="6">{{__('trans_word.6 Day')}}</option>
                            <option value="7">{{__('trans_word.1 Week')}}</option>
                            <option value="14">{{__('trans_word.2 Week')}}</option>
                            <option value="21">{{__('trans_word.3 Week')}}</option>
                            <option value="30">{{__('trans_word.1 Mounth')}}</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-sm-4 col-xs-12">
                        <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.Choose an appropriate delivery period and take into account time differences, free time and other links. The buyer can cancel the service directly in case of delay in delivering the service on time.')}}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Add photos')}}</p></label>  
    
                        <div class="col-lg-8 col-md-7 col-sm-8 col-xs-12" style="position: relative">
                            <input type="file" name="photos[]" class="file"  multiple>
                            <p style="color: rgb(94, 94, 94);margin-top: 5px">{{__('trans_word.The photo must be related to your service.Choosing a well designed image will show your service professionally and increase your sales.Never use pictures of other sellersAllowed formats: jpeg, jpg, gif and png')}}</p>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-4 col-xs-12 control-label"><p class="lead"> {{__('trans_word.Tags')}}</p></label>  
    
                        <div class="col-lg-6 col-md-4 col-sm-5 col-xs-12">
                            <input type="text" name="tags" data-role="tagsinput" class="form-control tags" required>

                        </div>

                     
                    </div>

                    <div class="col-lg-offset-2 col-sm-offset-4">
                        <p style="color: rgb(94, 94, 94);"> <input type="checkbox" required> {{__('trans_word.I acknowledge and agree that the service does not violate the conditions')}}</p>
                    </div>
                    <br>
                    <div class="col-lg-offset-2 col-sm-offset-4">
                        <input type="submit" class="btn btn-primary" id="btnSubmit" value="{{__('trans_word.Add service')}}">
                    </div>    
            
            </form>

            </div>
          </div>

    </div>
</div>


<style>
.form-control{
box-shadow: 0px 5px 15px 0px rgba(0,0,0,.075);
border: none
}
</style>



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
    $('.tags').tagsinput({
        confirmKeys: [13,44,32], 
        
    });
    });     
    

</script>

@endsection