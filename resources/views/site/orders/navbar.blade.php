<div class="header-order-status" style="background: linear-gradient(40deg,#104c91,#1565c0c7)!important;
color: white;
margin-top: -19px;padding-top: 10px;padding-bottom: 10px">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-3">
            <span class="my-orders" style="font-weight: bold">{{__('trans_word.My orders')}}</span>
            </div>
            <div class="col-sm-6 col-xs-9">
            <ul class="order-type @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif">
            <li><a @if(Route::current()->getName() =='orders.index') class="active-navbar-order" @endif href="{{route('orders.index')}}">{{__('trans_word.All')}} <span class="badg">{{count($orderAll)}}</span> </a></li>
            <li><a @if(Route::current()->getName() =='orders.completed') class="active-navbar-order" @endif href="{{route('orders.completed')}}">{{__('trans_word.Completed')}} <span class="badg">{{count($orderCompleted)}}</span></a></li>
            <li><a @if(Route::current()->getName() =='orders.canceled') class="active-navbar-order" @endif href="{{route('orders.canceled')}}">{{__('trans_word.Canceled')}} <span  class="badg">{{count($orderCanceled)}}</span></a></li>
            </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .order-type li{
        list-style-type: none;
        display: inline-block;
        margin-left: 10px;
    }
    .order-type li a{
        color: white;
        text-decoration: none;
    }
    .order-type li a .badg{
        border-radius: 3px;
        margin-top: -5px;
        background: azure;
        padding: 3px 4px;
        color: #0087b7;
    }

    .order-type li a:hover{
        border-bottom:2px solid #a70000;
        padding-bottom: 20px
    }

</style>
