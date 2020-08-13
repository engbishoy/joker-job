@extends('layouts.admin.app')
@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.editcategory')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.editcategory')}}</li>
    </ol>
  </section>
<br>

@include('layouts.message')
  <!-- Main content -->
  <section class="content">

     <!-- general form elements -->
     <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('trans_word.editcategory')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
    <form action="{{route('category.update',['id'=>$category->id])}}" method="POST">
            @csrf
            @method('PUT')
          <div class="box-body">

            <div class="form-group">
              <label for="exampleInputEmail1">{{__('trans_word.name_en')}}</label>
              <input type="text" class="form-control name_en" name="name_en" value='{{$category->name_en}}'>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">{{__('trans_word.name_ar')}}</label>
              <input type="text" class="form-control name_ar" name='name_ar' value='{{$category->name_ar}}'>

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