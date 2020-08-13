@extends('layouts.admin.app')
@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.editsection')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.editsection')}}</li>
    </ol>
  </section>
<br>
<br>
  @include('layouts.message')
  <!-- Main content -->
  <section class="content">

     <!-- general form elements -->
     <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{__('trans_word.editsection')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
    <form method="POST" action="{{route('section.update',['id'=>$section->id])}}">
            @csrf
            @method('PUT')
          <div class="box-body">

            <div class="form-group">
              <label >{{__('trans_word.name_en')}}</label>
            <input type="text" class="form-control name_en" name="name_en" value="{{$section->name_en}}">
              <span class="error error-name_en" style="font-weight: bold;color: red"></span>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('trans_word.name_ar')}}</label>
                <input type="text" class="form-control name_ar" name='name_ar' value="{{$section->name_ar}}">
                <span class="error error-name_ar" style="font-weight: bold;color: red"></span>
            </div>
           
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('trans_word.chooseCategory')}}</label>
                <select class="form-control" name='category'>
                    @foreach ($category as $cats)
                <option value="{{$cats->id}}" @if($cats->id==$section->category_id) selected @endif >{{$cats->name_en}}</option>                        
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('trans_word.description_en')}}</label>
            <textarea class="form-control description_en" style="height: 120px"  name='description_en'>{{$section->description_en}}</textarea>
                <span class="error error-description_en" style="font-weight: bold;color: red"></span>  
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">{{__('trans_word.description_ar')}}</label>
                <textarea class="form-control description_ar" style="height: 120px" name='description_ar'>{{$section->description_ar}}</textarea>
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

