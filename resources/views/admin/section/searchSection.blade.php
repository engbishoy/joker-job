@extends('layouts.admin.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.Sections')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.Sections')}}</li>
    </ol>
  </section>
<br>
@include('layouts.message')
  <!-- Main content -->
  <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{__('trans_word.Sections')}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <form action="{{route('section.search')}}" id="form" method="get" style="margin-bottom: 30px">
              @csrf
              <div class="row">
                
                <div class="col-md-4 col-xs-6">
                    <input type="text" class="form-control" name="search" placeholder="{{__('trans_word.Search')}}">
                </div>
  
                <div class="col-md-8 col-xs-6">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{__('trans_word.Search')}} </button>
                <a href="{{route('section.create')}}" class="btn btn-primary"> <i class='fa fa-plus'></i> {{__('trans_word.create')}} </a>
                </div>
  
              </div>
            </form>

            @if(count($sections)>0)

            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
              <th>#</th>
              <th>{{__('trans_word.name_en')}}</th>
              <th>{{__('trans_word.name_ar')}}</th>
              <th>{{__('trans_word.description_en')}}</th>
              <th>{{__('trans_word.description_ar')}}</th>
              <th>{{__('trans_word.control')}}</th>
              </tr>
              </thead>
              <tbody>
    
            @foreach ($sections as $section)
            <tr>
            <td><strong>{{$section->id}}</strong></td>
            <td>{{$section->name_en}}</td>
            <td>{{$section->name_ar}}</td>
            <td>{{$section->description_en}}</td>
            <td>{{$section->description_ar}}</td>
            <td>
            <a href="{{route('section.edit',['id'=>$section->id])}}" class="btn btn-success"><strong><i class="fa fa-edit"></i> {{__('trans_word.Edit')}}</strong></a>
            <form method="POST" action="{{route('section.delete',['id'=>$section->id])}}" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger delete" data-id="{{$section->id}}"><strong><i class="fa fa-trash"></i> {{__('trans_word.delete')}}</strong></button>
            </form>
            </td>
            </tr>
            @endforeach
              </tbody>
            </table>
            @else
            <h2 style="color:red;font-weight: bold;text-align: center;margin-top:40px">{{__('trans_word.There are no records for this search')}}</h2>
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

          var r= confirm("Are you sure delete the section!");
          if(r==true){
          $.ajax({
              method:"delete",
              url:'/'+"{{LaravelLocalization::getCurrentLocale()}}"+'/dashboard/section/delete/'+id,
              data:{"_token": "{{ csrf_token() }}"},
              success :function(data){
                $('body').append(`<div class="alert alert-success success wow bounceInRight data-wow-duration="3s" data-wow-delay="0s"">${data.message}</div>`);
                $('.success').delay(4000).fadeOut(1000);
                  $(el).parent().parent().parent().remove();
                
              },
              error :function(data){            
              }
          });

          $(window).scrollTop(0);
        }

          
      });
</script>
  
@endsection