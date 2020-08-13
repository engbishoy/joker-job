@extends('layouts.admin.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.admins')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.admins')}}</li>
    </ol>
  </section>
<br>

@include('layouts.message')
  <!-- Main content -->
  <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{__('trans_word.admins')}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

          <form action="{{route('admin.search')}}" id="form" method="get" style="margin-bottom: 30px">
            @csrf
            <div class="row">
              
              <div class="col-md-4 col-xs-6">
                  <input type="text" class="form-control" name="search" placeholder="{{__('trans_word.Search Name or phone number or email')}}">
              </div>

              <div class="col-md-8 col-xs-6">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{__('trans_word.Search')}} </button>
                
                @if(auth()->user()->hasPermission('admins_create'))
              <a href="{{route('admin.create')}}" class="btn btn-primary"> <i class='fa fa-plus'></i> {{__('trans_word.create')}} </a>
                @else
                <a href="#" disabled class="btn btn-primary"> <i class='fa fa-plus'></i> {{__('trans_word.create')}} </a>

                @endif
            </div>

            </div>
          </form>

            @if(count($admin)>0)
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
              <th>#</th>
              <th>{{__('trans_word.Photo')}}</th>
              <th>{{__('trans_word.name')}}</th>
              <th>{{__('trans_word.email')}}</th>
              <th>{{__('trans_word.codecountry')}}</th>
              <th>{{__('trans_word.phone')}}</th>
              <th>{{__('trans_word.Role')}}</th>
              <th>{{__('trans_word.Created at')}}</th>
              <th>{{__('trans_word.control')}}</th>
              
              </thead>
              <tbody>
    
            @foreach ($admin as $admins)
            <tr>
            <td><strong>{{$admins->id}}</strong></td>
            <td><img src="{{asset('admin/dist/img/admins/'.$admins->photo)}}" class="img-responsive" style="width:60px;height: 60px;margin: auto"> </td>
            <td>{{$admins->name}}</td>
            <td>{{$admins->email}}</td>
            <td>{{$admins->code_phone}}</td>
            <td>{{$admins->phone}}</td>
            <td>{{$admins->role}}</td>
            <td>{{$admins->created_at->format('d M Y')}}</td>
      
            <td>

            <a @if(auth()->user()->hasPermission('admins_update')) href="{{route('admin.edit',['id'=>$admins->id])}}" @else href="#" disabled  @endif class="btn btn-success" ><strong><i class="fa fa-edit"></i> {{__('trans_word.Edit')}}</strong></a>
                
            
            @if(auth()->user()->hasPermission('admins_delete'))
                <form style="display: inline-block" id='form'>
                  @csrf
                  @method('DELETE')
                <button type="submit" class="btn btn-danger delete" id="btnSubmit" data-id="{{$admins->id}}"><strong><i class="fa fa-trash"></i> {{__('trans_word.Delete')}}</strong></button>
                </form>
    
            @else
            <button class="btn btn-danger" disabled><strong><i class="fa fa-trash"></i> {{__('trans_word.Delete')}}</strong></button>

            @endif

                </td>

            </tr>
            @endforeach
              </tbody>
            </table>
            {{$admin->links()}}
            @else
            <h2 style="color:red;font-weight: bold;text-align: center;margin-top:40px">{{__('trans_word.No found admins')}}</h2>
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

          var r= confirm("Are you sure delete the admin!");
          if(r==true){
          $.ajax({
              method:"delete",
              url:'/'+"{{LaravelLocalization::getCurrentLocale()}}"+'/dashboard/admin/delete/'+id,
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