@extends('layouts.admin.app')
@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.addsection')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.addsection')}}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

     <!-- general form elements -->
     <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('trans_word.addsection')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="savesection" method="POST">
            @csrf
          <div class="box-body">

            <div class="form-group">
              <label for="exampleInputEmail1">{{__('trans_word.name_en')}}</label>
              <input type="text" class="form-control name_en" name="name_en" required>
              <span class="error error-name_en" style="font-weight: bold;color: red"></span>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('trans_word.name_ar')}}</label>
                <input type="text" class="form-control name_ar" name='name_ar' required>
                <span class="error error-name_ar" style="font-weight: bold;color: red"></span>
            </div>
           
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('trans_word.chooseCategory')}}</label>
                <select class="form-control" name='category'>
                    @foreach ($category as $cats)
                <option value="{{$cats->id}}">{{$cats->name_en}}</option>                        
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('trans_word.description_en')}}</label>
                <textarea class="form-control description_en" style="height: 120px" required name='description_en'></textarea>
                <span class="error error-description_en" style="font-weight: bold;color: red"></span>  
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('trans_word.description_ar')}}</label>
                <textarea class="form-control description_ar" style="height: 120px" required name='description_ar'></textarea>
                <span class="error error-description_ar" style="font-weight: bold;color: red"></span>
            </div>
          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{__('trans_word.save')}}</button>
          </div>
        </form>
      </div>
      <!-- /.box -->

      
<!-- successfully added category message -->


  </section>

  @endsection


  @section('contentjs')
      
  <script>
      $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      });

      $(document).on('submit','.savesection',function(e){
          e.preventDefault();
          $('.error').text('');
          $(window).scrollTop(0);

          $.ajax({
              method:"POST",
              url:"{{route('section.store')}}",
              data:new FormData(this),
              dataType:"json",
              processData:false,
              contentType:false,    
              cache:true,    
              success :function(data){
                $('body').append(`<div class="alert alert-success success wow bounceInRight data-wow-duration="3s" data-wow-delay="0s"">${data.message}</div>`);
                $('.success').delay(4000).fadeOut(1000);
                $('input:text').val('');
                $('textarea').val('');
              },
              error :function(data){
                var response=$.parseJSON(data.responseText);
                $.each(response.message,function(key,value){
                    $('.error-'+key).text(value[0]);
                })
              }
          });

          
      });

  </script>

  @endsection