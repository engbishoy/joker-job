    @extends('layouts.admin.app')
    @section('content')
        
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          {{__('trans_word.dashboard')}}
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{__('trans_word.home')}}</a></li>
          <li class="active">{{__('trans_word.dashboard')}}</li>
        </ol>
      </section>
  
      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
  
     <!-- Small boxes (Stat box) -->
     <div class="row">

      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
          <h3>{{count($users)}}</h3>
  
          <p>{{__('trans_word.User Registrations')}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>


       <!-- ./col -->
       <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
          <h3>{{count($admins)}}</h3>
  
          <p>{{__('trans_word.admins')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="{{route('admin.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>


           <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
              <h3>{{count($categories)}}</h3>
      
              <p>{{__('trans_word.categories')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            <a href="{{route('category.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>


          
           <!-- ./col -->
           <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
              <h3>{{count($sections)}}</h3>
      
              <p>{{__('trans_word.Sections')}}</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            <a href="{{route('section.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>


                <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{count($services)}}</h3>
  
          <p>{{__('trans_word.Services')}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
        <a href="{{route('servicework.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{count($orders)}}</h3>
  
          <p>{{__('trans_word.Orders')}}</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
        <a href="{{route('order.all')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>


      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{count($requiredTransfer)}}</h3>
  
          <p>{{__('trans_word.Required transfer')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-money"></i>
          </div>
        <a href="{{route('transfer.required')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
          <h3>{{count($tickets)}}</h3>
  
          <p>{{__('trans_word.Tickets')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-ticket"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
  
      </section>

      @endsection
