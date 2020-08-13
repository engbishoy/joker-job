@extends('layouts.admin.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.Categories')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.Categories')}}</li>
    </ol>
  </section>
<br>

@include('layouts.message')
  <!-- Main content -->
  <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{__('trans_word.Categories')}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <form action="{{route('category.search')}}" id="form" method="get" style="margin-bottom: 30px">
              @csrf
              <div class="row">
                
                <div class="col-md-4 col-xs-6">
                    <input type="text" class="form-control" name="search" placeholder="{{__('trans_word.Search')}}">
                </div>
  
                <div class="col-md-8 col-xs-6">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{__('trans_word.Search')}} </button>
                  
                  @if(auth()->user()->hasPermission('categories_create'))
                <a href="{{route('category.create')}}" class="btn btn-primary"> <i class='fa fa-plus'></i> {{__('trans_word.create')}} </a>
                  @else
                  <a href="#" class="btn btn-primary" disabled> <i class='fa fa-plus'></i> {{__('trans_word.create')}} </a>
                  @endif
                </div>
  
              </div>
            </form>


            @if(count($category)>0)
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
              <th>#</th>
              <th>{{__('trans_word.name_en')}}</th>
              <th>{{__('trans_word.name_ar')}}</th>
              <th>{{__('trans_word.control')}}</th>
              </tr>
              </thead>
              <tbody>
    
            @foreach ($category as $cats)
              <tr id='{{$cats->id}}'>
            <td>{{$cats->id}}</td>
            <td>{{$cats->name_en}}</td>
            <td>{{$cats->name_ar}}</td>
            <td>

            @if(auth()->user()->hasPermission('categories_update'))
            <a href="{{route('category.edit',['id'=>$cats->id])}}" class="btn btn-success"><strong><i class="fa fa-edit"></i> {{__('trans_word.Edit')}}</strong></a>
            @else
            <a href="#" class="btn btn-success" disabled><strong><i class="fa fa-edit"></i> {{__('trans_word.Edit')}}</strong></a>
            @endif

            @if(auth()->user()->hasPermission('categories_delete'))
            <form style="display: inline-block">
              @csrf
              @method('DELETE')
            <button type="submit" class="btn btn-danger delete" data-id="{{$cats->id}}"><strong><i class="fa fa-trash"></i> {{__('trans_word.delete')}}</strong></button>
            </form>
            @else
            <button class="btn btn-danger delete" disabled><strong><i class="fa fa-trash"></i> {{__('trans_word.delete')}}</strong></button>
            @endif

            <a href="{{route('category.sections',['id'=>$cats->id])}}" class="btn btn-info"><strong><i class="fa fa-info"></i> {{__('trans_word.section_category')}}</strong></a>
            </td>
            </tr>
            @endforeach
              </tbody>
            </table>
            {{$category->links()}}
            @else
            <h2 style="color:red;font-weight: bold;text-align: center">{{__('trans_word.nofoundcategory')}}</h2>
            @endif
          </div>
          <!-- /.box-body -->
        </div>
  </section>

        


@endsection



@section('contentjs')
  <script>
  

      $(document).on('click','.delete',function(e){
          e.preventDefault();
          var id=$(this).attr('data-id');
          var el=this;

          var r= confirm("Are you sure delete the category!");
          if(r==true){
          $.ajax({
              method:"delete",
              url:'/'+"{{LaravelLocalization::getCurrentLocale()}}"+'/dashboard/category/delete/'+id,
              data:{"_token": "{{ csrf_token() }}"},
              success :function(data){
                $('body').append(`<div class="alert alert-success success wow bounceInRight data-wow-duration="3s" data-wow-delay="0s"">${data.message}</div>`);
                $('.success').delay(4000).fadeOut(1000);
                  $(el).parent().parent().parent().remove();
                
              },
              error :function(data){            
              }
          });
        }

          
      });
</script>
  
@endsection