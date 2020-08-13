@extends('layouts.admin.app')
@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.Create question')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.Create question')}}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

     <!-- general form elements -->
     <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('trans_word.Create question')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="saveQuestion">
            @csrf
          <div class="box-body">

            <div class="form-group">
                <label>{{__('trans_word.Title question english')}}</label>
                <input type="text" class="form-control title_en" name="title_en">
                <span class="error-title_en" style="font-weight: bold;color: red"></span>
              </div>
  
              <div class="form-group">
                <label>{{__('trans_word.Answer question english')}}</label>
                <textarea class="form-control answer_en" name='answer_en'></textarea>
                <span class="error-answer_en" style="font-weight: bold;color: red"></span>
  
              </div>

           
              <div class="form-group">
                <label>{{__('trans_word.Title question arabic')}}</label>
                <input type="text" class="form-control title_ar" name="title_ar">
                <span class="error-title_ar" style="font-weight: bold;color: red"></span>
              </div>
  
              <div class="form-group">
                <label>{{__('trans_word.Answer question arabic')}}</label>
                <textarea class="form-control answer_ar" name='answer_ar'></textarea>
                <span class="error-answer_ar" style="font-weight: bold;color: red"></span>
  
              </div>
           
          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> {{__('trans_word.create')}}</button>
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

      $(document).on('submit','.saveQuestion',function(e){
          e.preventDefault();
          $('.error-title_en').text('');
          $('.error-answer_en').text('');
          $('.error-title_ar').text('');
          $('.error-answer_ar').text('');
          
          $.ajax({
              method:"POST",
              url:"{{route('question.store')}}",
              data:new FormData(this),
              dataType:"json",
              processData:false,
              contentType:false,        
              cache:false,
              success :function(data){
                $('body').append(`<div class="alert alert-success success wow bounceInRight data-wow-duration="3s" data-wow-delay="0s"">${data.message}</div>`);
                $('.success').delay(4000).fadeOut(1000);
           

                $('.title_en').val('');
                $('.answer_en').val('');
                $('.title_ar').val('');
                $('.answer_ar').val('');
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