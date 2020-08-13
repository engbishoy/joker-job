@extends('layouts.admin.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      {{__('trans_word.Questions')}}
    </h1>
    <ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
      <li class="active">{{__('trans_word.Questions')}}</li>
    </ol>
  </section>
<br>
@include('layouts.message')
  <!-- Main content -->
  <section class="content">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{__('trans_word.Questions')}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">

            <form action="{{route('question.search')}}" id="form" method="get" style="margin-bottom: 30px">
              @csrf
              <div class="row">
                
                <div class="col-md-4 col-xs-6">
                    <input type="text" class="form-control" name="search" placeholder="{{__('trans_word.Search')}}">
                </div>
  
                <div class="col-md-8 col-xs-6">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{__('trans_word.Search')}} </button>
                <a href="{{route('question.create')}}" class="btn btn-primary"> <i class='fa fa-plus'></i> {{__('trans_word.create')}} </a>
                </div>
  
              </div>
            </form>

            @if(count($question)>0)


              @foreach ($question as $questions)
          <div class="panel-group" id="{{$questions->id}}" role="tablist" aria-multiselectable="true">
                  
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="{{$questions->id}}">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#{{$questions->id}}" href="#{{$questions->id}}" aria-expanded="true" aria-controls="collapseOne">
                      {{$questions->title}}
                    </a>
                  </h4>
                </div>
                <div id="{{$questions->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="{{$questions->id}}">
                  <div class="panel-body">
                    {{$questions->answer}}

                  </div>
                </div>
              </div>

            </div>

              @endforeach



            @else
            <h2 style="color:red;font-weight: bold;text-align: center">{{__('trans_word.No found questions')}}</h2>
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