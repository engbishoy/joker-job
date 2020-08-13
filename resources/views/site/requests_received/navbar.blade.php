<div class="header-order-status" style="background: linear-gradient(40deg,#104c91,#1565c0c7)!important;
color: white;
margin-top: -19px;padding-top: 10px;padding-bottom: 10px">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12">
            <span style="font-size: 18px;font-weight: bold">{{__('trans_word.Requests received')}}</span>
            </div>
            <div class="col-md-6 col-xs-12">
            <ul class="order-type @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif">
                
            <li><a @if(Route::current()->getName() =='requests_received.index') class="active-navbar-order" @endif href="{{route('requests_received.index')}}">{{__('trans_word.All')}} <span class="badg">{{count($user->receivedOrder)}}</span> </a></li>
            <li><a @if(Route::current()->getName() =='requests_received.completed') class="active-navbar-order" @endif href="{{route('requests_received.completed')}}">{{__('trans_word.Completed')}} <span class="badg">{{count($user->receivedOrderComplete)}}</span></a></li>
            <li><a @if(Route::current()->getName() =='requests_received.Refusal') class="active-navbar-order" @endif href="{{route('requests_received.Refusal')}}">{{__('trans_word.Refusal Service')}} <span  class="badg">{{count($user->receivedOrderRefusal)}}</span></a></li>
            <li><a @if(Route::current()->getName() =='requests_received.canceled') class="active-navbar-order" @endif href="{{route('requests_received.canceled')}}">{{__('trans_word.Canceled')}} <span  class="badg">{{count($user->receivedOrderCancel)}}</span></a></li>
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
