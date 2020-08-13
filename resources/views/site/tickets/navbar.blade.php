<div class="header-order-status" style="background:linear-gradient(40deg,#104c91,#1565c0c7)!important;
color: white;
margin-top: -19px;padding-top: 10px;padding-bottom: 10px">
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
            <span style="font-size: 18px;font-weight: bold">{{__('trans_word.Technical support tickets')}}</span>
            </div>
            <div class="col-xs-6">
            <ul class="tickets @if ( Config::get('app.locale') == 'en') pull-right @else pull-left @endif">
            <li><a class="btn btn-success" href="{{route('ticket.create')}}">{{__('trans_word.Open new ticket')}}</a></li>
            </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .tickets li{
        list-style-type: none;
        display: inline-block;
        margin-left: 10px;
    }
    .tickets li .status-ticket{
        color: white;
        text-decoration: none;
    }
    .tickets li .status-ticket .badg{
        border-radius: 3px;
        margin-top: -5px;
        background: azure;
        padding: 3px 4px;
        color: #0087b7;
    }

    .tickets li .status-ticket:hover{
        border-bottom:2px solid #a70000;
        padding-bottom: 12px
    }
</style>
