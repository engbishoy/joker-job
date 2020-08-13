<div class="header-categories">
      <div class="container">
          <div class="row">
              <div class="col-md-9 col-sm-12">


                <ul class="header-links">
                    @foreach ($category as $categories)
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$categories->name}}</a>
                        <ul class="dropdown-menu">
                        @foreach ($categories->section as $sections)
                        <li><a style="font-size: 14px" href="{{route('section',['id'=>$sections->id])}}">{{$sections->name}}</a></li>
                        @endforeach
                        </ul>
                      </li> 
                    @endforeach
                    
                  </ul>


              </div>
              <div class="col-md-3 col-sm-12">
              <form method="GET" action="{{route('services.search')}}" style="position: relative">
                      <input type="text" class="form-control" style="border:0;border-radius: 25px;box-shadow: 0 1px 20px 0px rgba(0, 0, 0, 0.15);" placeholder="{{__('trans_word.searchservice')}}" name='search'>
                      <i class="fa fa-search icon-search"></i>
                      <input type="submit" style="display: none">
                  </form>
              </div>
          </div>
      </div>
  </div>
  
  
@if ( Config::get('app.locale') == 'en')
<style>
    .header-links{
        margin-left: -35px;
    }
    .header-links .dropdown{
        margin-right: 21px;
        display: inline-block;

    }
    .icon-search{
        position: absolute;
        top: 11px;
        right: 7px;
        color: #626262;
    }
    .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
        padding-left: 30px;
    }
</style>
@else
<style>
    .header-links{
        margin-right: -40px;
    }
    .header-links .dropdown{
        margin-left: 21px;
        display: inline-block;
    }

    .icon-search{
        position: absolute;
        top: 11px;
        left: 7px;
        color: #626262;
    }
    .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
        padding-right: 30px;
    }
</style>
@endif