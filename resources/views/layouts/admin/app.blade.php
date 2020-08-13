<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if ( Config::get('app.locale') == 'en')
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">

  @else
  
  <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/fonts-fa.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/bootstrap-rtl.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bootstrap-ar/rtl.css')}}">

  @endif
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">


  <link rel="stylesheet" href="{{asset('admin/dist/css/animate.css')}}">
  <link rel="stylesheet" href="{{asset('admin/dist/css/style.css')}}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>


<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        
  <header class="main-header">
    <!-- Logo -->
    <a href="/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
          <a href="{{route('notification.seen')}}" class="dropdown-toggle seen-admin-notification" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
            <span class="label label-warning count-notifi">{{count(auth()->user()->unreadnotificationsAdmin)}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">{{__('trans_word.Notifications')}}</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

                  <li class="notification-real-time">
                  </li>
                  <li>
                    @foreach (auth()->user()->notificationsAdmin as $notification)
                    @if($notification->type=='App\Notifications\commentTicket')
                  <a href="{{route('technical.ticket.show',['id'=>$notification->data['ticket_id']])}}">
                  <img style="width: 33px;
                  height: 36px; 
                  border-radius: 100%;
                  margin-right: 8px;" src="{{asset('site/img/users/'.$notification->data['userphoto'])}}"> {{__('trans_word.Add a comment to Ticket No')}} <strong> #{{$notification->data['ticket_id']}} </strong>  
                    </a>
                    @endif

                    @if($notification->type=='App\\Notifications\\openTicket')
                    <a href="{{route('technical.ticket.show',['id'=>$notification->data['ticket_id']])}}">
                      <img style="width: 33px;
                      height: 36px; 
                      border-radius: 100%;
                      margin-right: 8px;" src="{{asset('site/img/users/'.$notification->data['userphoto'])}}"> {{__('trans_word.Open new ticket')}}  
                    </a>
                    @endif
                    @endforeach
                  </li>


                 
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">{{count(LaravelLocalization::getSupportedLocales())}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"> {{count(LaravelLocalization::getSupportedLocales())}} languages </li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                                    
               
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
                  <!-- end task item -->
                </ul>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            
                <img src="{{asset('admin/dist/img/admins/'.auth()->user()->photo)}}"  class="user-image" alt="User Image">
            <span class="hidden-xs">{{auth()->user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('admin/dist/img/admins/'.auth()->user()->photo)}}" class="img-circle" alt="User Image">
                <p>
                  {{auth()->user()->name}}
                  
                <small>Member since {{auth()->user()->created_at->format('M Y')}}</small>
                </p>
              </li>
              <!-- Menu Body -->
         
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                <a href="{{route('profile.edit')}}" class="btn btn-default btn-flat">{{__('trans_word.Edit profile')}}</a>
                </div>
                <div class="pull-right">
                  <a  class="btn btn-default btn-flat" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                   {{ __('Logout') }}
               </a>

               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
               </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">

        <div @if( Config::get('app.locale') == 'en') class= "pull-left image" @else class="pull-right image" @endif>
          <img src="{{asset('admin/dist/img/admins/'.auth()->user()->photo)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
        <p>{{auth()->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
       
        @if( Config::get('app.locale') == 'en')
        <style>
          .badge{
            right: 4px;
            position: absolute;
            background: #09920e;
          }
        </style>
        @else
        <style>
          .badge{
            left: 4px;
            position: absolute;
            top:23px;
            background: #09920e;
          }
        </style>
        @endif
   
        @if(auth()->user()->hasPermission('categories_read'))

      <li><a href="{{route('category.index')}}"><i class="fa fa-circle-o"></i> {{__('trans_word.Categories')}} <span class="badge">{{count($categories)}}</span></a> </li>
        <li><a href="{{route('section.index')}}"><i class="fa fa-circle-o"></i> {{__('trans_word.Sections')}} <span class="badge">{{count($sections)}}</span></a></li>

        @endif

        @if(auth()->user()->hasPermission('services_read'))
          <li><a href="{{route('servicework.index')}}"><i class="fa fa-circle-o"></i>{{__('trans_word.All service')}} <span class="badge">{{count($services)}}</span></a></li>
        @endif

        @if(auth()->user()->hasPermission('controlOrder_read'))
        <li><a href="{{route('order.all')}}"><i class="fa fa-circle-o"></i>{{__('trans_word.Orders')}} <span class="badge">{{count($orders)}}</span></a></li>
        @endif

        @if(auth()->user()->hasPermission('moneyTransfer_read'))

        <li class="treeview">
          <a href="#">
          <i class="fa fa-edit"></i> <span>{{__('trans_word.Money transfers')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left "></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{route('transfer.required')}}"><i class="fa fa-circle-o"></i>{{__('trans_word.Required transfer')}} <span class="badge">{{count($requiredTransfer)}}</span></a></li>
            <li><a href="{{route('transfer.complete')}}"><i class="fa fa-circle-o"></i> {{__('trans_word.Completed transfers')}} <span class="badge">{{count($completedTransfer)}}</span></a></li>
          </ul>
        </li>

        @endif

        <li class="treeview">
          <a href="#">
          <i class="fa fa-edit"></i> <span>{{__('trans_word.Technical support')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <!-- category technical support -->
          @foreach ($categoryTechnical as $category)
          <li><a href="{{route('technical.category.tickets',['id'=>$category->id])}}"><i class="fa fa-circle-o"></i>{{$category->name}}</a></li>
          @endforeach          
            <!-- end category technical support -->
          

          <li><a href="{{route('technical.category.create')}}"><i class="fa fa-circle-o"></i>{{__('trans_word.Create category')}}</a></li>
          </ul>
        </li>


        @if(auth()->user()->hasPermission('admins_read'))
        <li>
        <a href="{{route('admin.index')}}">
          <i class="fa fa-users"></i> <span>{{__('trans_word.Admins')}}</span> <span class="badge">{{count($admins)}}</span>
          </a>
        </li>
        @endif

        @if(auth()->user()->hasPermission('users_read'))
        <li>
        <a href="{{route('users.index')}}">
          <i class="fa fa-users"></i> <span>{{__('trans_word.users')}}</span> <span class="badge">{{count($users)}}</span>
          </a>
        </li>
        @endif


 
      <li><a href="{{route('setting.index')}}"><i class="fa fa-book"></i> <span>{{__('trans_word.settings')}}</span></a></li>

      <li><a href="{{route('question.index')}}"><i class="fa fa-book"></i> <span>{{__('trans_word.Questions')}}</span></a></li>

    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    @yield('content')

  </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.4.18
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
        reserved.
      </footer>
    

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>

   <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
       <div class="control-sidebar-bg"></div>

    </div>

 @if(isset(auth()->user()->id))
          <script>
          localStorage.setItem('uid',{{auth()->guard('admin')->user()->id}});
          </script>
@endif    

<script src="{{asset('js/app.js')}}"></script>


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
@yield('contentjs')
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->


<script src="{{asset('admin/dist/js/wow.min.js')}}"></script>
<script> new WOW().init();</script>
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<script>
     CKEDITOR.replace('policyUsage_en', {
    language: 'en'
     });

  CKEDITOR.replace('policyUsage_ar', {
    language: 'ar'
  });


  CKEDITOR.replace('conditions_en', {
    language: 'en'
     });

  CKEDITOR.replace('conditions_ar', {
    language: 'ar'
  });

  CKEDITOR.replace('about_en', {
    language: 'en'
     });

  CKEDITOR.replace('about_ar', {
    language: 'ar'
  });

  
</script>
        



<script>

   // notification

   
   window.Echo.private('App.Models.Admin.'+localStorage.getItem('uid'))
      .notification((n) => {  
        console.log(n);

        if(n.type=='App\\Notifications\\commentTicket'){
          $('.notification-real-time').append(`
          <a href="/{{LaravelLocalization::getCurrentLocale()}}/dashboard/technical/ticket/show/${n.ticket_id}"> 
            <img style="width: 33px;
                  height: 36px;
                  border-radius: 100%;
                  margin-right: 8px;" src="{{asset('site/img/users/${n.userphoto}')}}"> {{__('trans_word.Add a comment to Ticket No')}} <strong> # ${n.ticket_id} </strong>    
          </a>

          `);

          
          var test=parseInt( $('.count-notifi').text());    
          $('.count-notifi').text(test+1);

          $('body').append(`
       <div class="notification wow bounceInLeft" data-wow-duration="1s" style="bottom: 33px;
        background: #067206;
        position: fixed;
        left: 30px;
        padding:12px;
        border-radius: 4px;z-index:999999">
        <a href="/{{LaravelLocalization::getCurrentLocale()}}/dashboard/technical/ticket/show/${n.ticket_id}">
          <img src="{{asset('site/img/users/${n.userphoto}')}}" class="img-rseponsive" style="width: 45px;border-radius: 100%;margin-right: 10px">
          <span style="font-weight: bold;color: white;font-size: 14px">${n.username}</span>
          <p style="@if ( Config::get('app.locale') == 'en') padding-left: 59px; @else padding-right:59px;  @endif
          margin-top: -9px;
          color: #e3e3e3;"> <i class="fa fa-envelope"></i> {{__('trans_word.Add a comment to Ticket No')}} <strong> #${n.ticket_id} </strong> </p>
        </a>
        </div>
       `);


       $('.notification').delay(7000).fadeOut(1000);


        }

        if(n.type=='App\\Notifications\\openTicket'){
          $('.notification-real-time').append(`
          <a href="/{{LaravelLocalization::getCurrentLocale()}}/dashboard/technical/ticket/show/${n.ticket_id}"> 
            <img style="width: 33px;
                  height: 36px;
                  border-radius: 100%;
                  margin-right: 8px;" src="{{asset('site/img/users/${n.userphoto}')}}"> {{__('trans_word.Open new ticket')}}    
          </a>

          `);

          
          var test=parseInt( $('.count-notifi').text());    
          $('.count-notifi').text(test+1);

          $('body').append(`
       <div class="notification wow bounceInLeft" data-wow-duration="1s" style="bottom: 33px;
        background: #067206;
        position: fixed;
        left: 30px;
        padding:12px;
        border-radius: 4px;z-index:999999">
        <a href="/{{LaravelLocalization::getCurrentLocale()}}/dashboard/technical/ticket/show/${n.ticket_id}">
          <img src="{{asset('site/img/users/${n.userphoto}')}}" class="img-rseponsive" style="width: 45px;border-radius: 100%;margin-right: 10px">
          <span style="font-weight: bold;color: white;font-size: 14px">${n.username}</span>
          <p style="@if ( Config::get('app.locale') == 'en') padding-left: 59px; @else padding-right:59px;  @endif
          margin-top: -9px;
          color: #e3e3e3;"> <i class="fa fa-bell"></i> {{__('trans_word.Open new ticket')}}  </p>
        </a>
        </div>
       `);


       $('.notification').delay(7000).fadeOut(1000);


        }
  });
</script>








</body>