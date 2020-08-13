<div class="footer" style="background: linear-gradient(40deg,#104c91,#1565c0c7)!important;
    color: white;
    padding-top: 30px;
    padding-bottom: 30px;
    position: relative;
    bottom: 0;
    width: 100%;">

    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <div class="links">
                <h3>{{__('trans_word.Links')}}</h3>
                    <ul style="margin-top: 10px">
                    <li><a href="{{route('site.aboutus')}}">{{__('trans_word.About joker job')}}</a></li>
                    <li><a href="{{route('site.usagePolicy')}}">{{__('trans_word.Usage Policy')}}</a></li>
                    <li><a href="{{route('site.conditions')}}">{{__('trans_word.Terms and Conditions')}}</a></li>
                    <li><a href="{{route('site.questions')}}">{{__('trans_word.Questions and Answer')}}</a></li>
                    <li><a href="{{route('ticket.all')}}">{{__('trans_word.Technical support')}}</a></li>
                    
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="follow">
                    <h3>{{__('trans_word.Follow us')}}</h3>
                        <ul style="margin-top: 10px">
                            <li>
                                <a href="#"><span style="width: 35px;
                                height: 35px;
                                padding:6px 0px;
                                border: 1px solid var(--bg-font-6);
                                color: #3b5998;
                                cursor: pointer;
                                background: #ebebeb;
                                border-radius: 50%!important;" class="fab fa-facebook-f"></span></a>
                            </li>

                            <li>
                                <a href="#"><span style="width: 35px;
                                height: 35px;
                                padding:6px 0px;
                                border: 1px solid var(--bg-font-6);
                                color: #00aced;
                                cursor: pointer;
                                background: #ebebeb;
                                border-radius: 50%!important;" class="fab fa-twitter"></span></a>
                            </li>

                            <li>
                                <a href="#"><span style="width: 35px;
                                height: 35px;
                                padding:6px 0px;
                                border: 1px solid var(--bg-font-6);
                                color: #ee4b00;
                                cursor: pointer;
                                background: #ebebeb;
                                border-radius: 50%!important;" class="fab fa-instagram"></span></a>
                            </li>

                            <li>
                                <a href="#"><span style="width: 35px;
                                height: 35px;
                                padding:6px 0px;
                                border: 1px solid var(--bg-font-6);
                                color: #eb0000;
                                cursor: pointer;
                                background: #ebebeb;
                                border-radius: 50%!important;" class="fab fa-youtube"></span></a>
                            </li>

                            <li>
                                <a href="#"><span style="width: 35px;
                                height: 35px;
                                padding:6px 0px;
                                border: 1px solid var(--bg-font-6);
                                color: #047beb;
                                cursor: pointer;
                                background: #ebebeb;
                                border-radius: 50%!important;" class="fab fa-linkedin-in"></span></a>
                            </li>
                     
                        
                        </ul>
                    </div>
            </div>

            <div class="col-sm-4 col-xs-12">
                <div class="payments">
                    <h3>{{__('trans_word.Payment methods')}}</h3>

                <img src="{{asset('site/img/8-2-paypal-donate-button-high-quality-png.png')}}" style="width: 175px;margin-top: 10px;" class="img-responsive">
                </div>
                
            </div>
        </div>
        
    </div>
</div>


<style>

    .links ul li{
        list-style:none;
        padding: 6px 0px;
    }
    .links ul li a{
        color:white;
        text-decoration: none;
        font-size: 16px;
    }

    .links ul li a:hover{
        color:orangered;
        font-weight: bold;
    }


    .follow ul{
        display: inline-flex;
    }

    .follow ul li{
        list-style:none;
        padding:0 6px;
    }

</style>


@if( Config::get('app.locale') == 'en')
<style>
    .links ul{
        left: -39px;
        position: relative;
    }
    .follow ul{
        margin-left: -43px;
    }
</style>
@else
<style>
    .links ul{
        right: -39px;
        position: relative;
        
    }

    .follow ul{
        margin-right: -43px;
    }
</style>
@endif