@extends('layouts.admin.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.All service')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.All service')}}</li>
    </ol>
  </section>
<br>

@include('layouts.message')
  <!-- Main content -->
  <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{__('trans_word.All service')}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="overflow: auto">

            <form action="{{route('service.search')}}" id="form" method="get" style="margin-bottom: 30px">
              @csrf
              <div class="row">
                
                <div class="col-md-4 col-xs-6">
                    <input type="text" class="form-control" name="search" placeholder="{{__('trans_word.Search')}}">
                </div>
  
                <div class="col-md-8 col-xs-6">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{__('trans_word.Search')}} </button>
                </div>
  
              </div>
            </form>


            @if(count($service)>0)
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
              <th>#</th>
              <th>{{__('trans_word.Photo')}}</th>
              <th>{{__('trans_word.Title')}}</th>
              <th>{{__('trans_word.Description')}}</th>
              <th>{{__('trans_word.Price')}}</th>
              <th>{{__('trans_word.Category')}}</th>
              <th>{{__('trans_word.Section')}}</th>
              <th>{{__('trans_word.Delivery term')}}</th>
              <th>{{__('trans_word.Status')}}</th>
              <th>{{__('trans_word.Created at')}}</th>
              <th>{{__('trans_word.Control')}}</th>
              </tr>
              </thead>
              <tbody>
    
            @foreach ($service as $services)
              <tr>
            <td>{{$services->id}}</td>
            <?php $explodePhotos=explode(',',$services->photos); ?>
            @for($i=0;$i<=count($explodePhotos);$i++)
            <td><img class="img-responsive img-thumbnail" style="width: 80px;height:80px;" src="{{asset('site/img/servicework/'.$explodePhotos[$i])}}"> </td>
            @break
            @endfor
            
            <td>{{Str::limit($services->title,30)}}</td>
            <td>{!! Str::limit($services->description,30) !!}</td>
            <td>{{$services->price}}$</td>
            <td>{{$services->category->name}}</td>
            <td>{{$services->section->name}}</td>
            <td>
                @if($services->time_execute<7)
                {{$services->time_execute}} day
                
                @elseif($services->time_execute==7)
                1 week
                
                @elseif($services->time_execute==14)
                2 week

                @elseif($services->time_execute==21)
                3 week

                @elseif($services->time_execute==30)
                1 mounth
                @endif

            </td>

            <td>



              @if($services->approve==0)
              <span class="btn btn-warning">{{__('trans_word.Wait approve')}}</span>
              @elseif($services->approve==1)
              <span class="btn btn-success"> {{__('trans_word.Done approve')}}</span>
              @elseif($services->approve==2)
<!-- محظور --> <span class="btn btn-danger">{{__('trans_word.rejected')}}</span>

              @elseif($services->approve==3)
<!-- محظور --><span class="btn btn-danger"><i class="fa fa-ban"></i> {{__('trans_word.Prohibited')}}</span>
              @endif
          
            </td>
            <td>{{$services->created_at->format('Y M D')}}</td>

            <td  style="display: inline-flex;">
            
            <a href="{{route('servicework.show',['id'=>$services->id])}}" class="btn btn-info" style="display: inline-block"><strong><i class="fa fa-info"></i> {{__('trans_word.Details')}}</strong></a>
            
            @if(auth()->user()->hasPermission('services_update'))

            @if($services->approve==0)
            <form action="{{route('servicework.approve',['id'=>$services->id])}}" method="POST">
                @csrf
                @method('PUT')
              <button type="submit" class="btn btn-primary approve"><strong><i class="fa fa-thumbs-up"></i> {{__('trans_word.approve')}}</strong></button>
            </form>  

            <form action="{{route('servicework.unapprove',['id'=>$services->id])}}" method="POST">
              @csrf
              @method('PUT')
            <button type="submit" class="btn btn-danger"><strong><i class="fa fa-thumbs-down"></i> {{__('trans_word.rejected')}}</strong></button>
            </form> 
            
            <form action="{{route('servicework.block',['id'=>$services->id])}}" method="POST">
              @csrf
              @method('PUT')
            <button type="submit" class="btn btn-primary approve"><strong><i class="fa fa-thumbs-down"></i> {{__('trans_word.Block service')}}</strong></button>
            </form>  

            @elseif($services->approve==1)
            
            <form action="{{route('servicework.unapprove',['id'=>$services->id])}}" method="POST">
              @csrf
              @method('PUT')
            <button type="submit" class="btn btn-danger"><strong><i class="fa fa-thumbs-down"></i> {{__('trans_word.rejected')}}</strong></button>
            </form> 

            <form action="{{route('servicework.block',['id'=>$services->id])}}" method="POST">
              @csrf
              @method('PUT')
            <button type="submit" class="btn btn-danger"><strong><i class="fa fa-ban"></i> {{__('trans_word.Block service')}}</strong></button>
            </form>  

            @elseif($services->approve==2) 
            <form action="{{route('servicework.approve',['id'=>$services->id])}}" method="POST">
              @csrf
              @method('PUT')
            <button type="submit" class="btn btn-primary approve"><strong><i class="fa fa-thumbs-up"></i> {{__('trans_word.approve')}}</strong></button>
          </form>

          <form action="{{route('servicework.block',['id'=>$services->id])}}" method="POST">
            @csrf
            @method('PUT')
          <button type="submit" class="btn btn-danger"><strong><i class="fa fa-ban"></i> {{__('trans_word.Block service')}}</strong></button>
          </form>  

          @elseif($services->approve==3) 

          <form action="{{route('servicework.approve',['id'=>$services->id])}}" method="POST">
            @csrf
            @method('PUT')
          <button type="submit" class="btn btn-success"><strong>{{__('trans_word.unblock')}}</strong></button>
          </form>
            
          @endif

          @endif

          @if(auth()->user()->hasPermission('services_delete'))

              <form action="{{route('servicework.delete',['id'=>$services->id])}}" method="POST">
                @csrf
                @method('DELETE')
              <button type="submit" class="btn btn-danger delete" data-id={{$services->id}}><strong><i class="fa fa-trash"></i> {{__('trans_word.Delete')}}</strong></button>
              </form>

           @else 
           <button class="btn btn-danger delete" disabled ><strong><i class="fa fa-trash"></i> {{__('trans_word.Delete')}}</strong></button>
           @endif

            </td>
            </tr>
            @endforeach
              </tbody>
            </table>
            {{$service->links()}}
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

          var r= confirm("Are you sure delete the service!");
          if(r==true){
          $.ajax({
              method:"delete",
              url:'/'+"{{LaravelLocalization::getCurrentLocale()}}"+'/dashboard/service_work/delete/'+id,
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