@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

         
             <div class="container">

                 <div class="mycredit col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1" style="margin-top: 40px;margin-bottom: 40px">
                    @include('layouts.message')

                 <h3 style="margin-bottom: 20px">{{__('trans_word.Account balance')}}</h3>

                 <div class="details-credit" style="background: #f8f8f8;padding: 27px;border-radius: 5px;box-shadow: 0px 2px 8px 2px #ebebeb;">
                     <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="Profits" style="text-align: center">

                                <!-- رصيد قابل للسحب  -->
                             <h4>{{__('trans_word.Retractable balance')}}</h4>
                             <br>
                            @if($user->credit)
                            <span style="color: rgb(0, 168, 0);font-weight: bold;font-size:25px">{{$user->credit->amount}} <strong> $ </strong> </span>
                            @else
                            <span style="color: rgb(0, 168, 0);font-weight: bold;font-size:25px">0  <strong> $ </strong> </span>
                            @endif
                            <br>

                            <p style="margin-top: 14px;color: #282828;">{{__('trans_word.The amount you earned from selling the services can be withdrawn to your PayPal account.')}}</p>
                            </div>
                        </div>

                        <div class="col-md-4 col-xs-12">
                            
                            <div class="Profits" style="text-align: center">
                                <h4>{{__('trans_word.Outstanding balance')}}</h4>
                                <br>
                               <span style="color: rgb(0, 168, 0);font-weight: bold;font-size:25px">
                                <?php $total=0; ?>
                              
                               @foreach ($user->OutstandingCredit as $credit)
                                   <?php $total=$total+$credit->amount; ?>
                               @endforeach

                               {{$total}} <strong> $ </strong>
                               </span>
                            <br>
                            <p style="margin-top: 14px;color: #282828;">{{__('trans_word.Profits withdrawn are held for 5 days before they can be used.')}}</p> 
                            </div>

                        </div>

                        <div class="col-md-4 col-xs-12">
                    
                            <div class="Profits" style="text-align: center">
                             <h4>{{__('trans_word.Profits withdrawn')}}</h4>
                             <br>
                             <span style="color: rgb(0, 168, 0);font-weight: bold;font-size:25px">
                                @if($user->Profits_withdrawn)
                                <?php $totalprofits=0; ?>
                              
                                    @foreach ($user->Profits_withdrawn as $profits_withdrawn)
                                    <?php $totalprofits=$totalprofits+$profits_withdrawn->amount; ?>
                                    @endforeach
                                   {{$totalprofits}} <strong> $ </strong> 

                                @endif

                            </span>

                            <br>

                        <p style="margin-top: 14px;color: #282828;">{{__('trans_word.Funds withdrawn on your paypal account')}}</p>
                            </div>
                    
                        </div>
                     </div>
                 </div>
                </div>


                <div class="pull-money col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1" style="margin-top: 20px;margin-bottom: 20px;background: #f8f8f8;padding: 27px;border-radius: 5px;box-shadow: 0px 2px 8px 2px #ebebeb;">
                <h3>{{__('trans_word.money withdrawal')}}</h3>
                <p style="color: rgb(105, 105, 105)">{{__('trans_word.The amount will be transferred to your Paypal account within 5 days')}}</p>
                <hr>
                <form method="POST" id="form" action="{{route('credit.pull')}}">
                    @csrf
                        <div class="form-group">
                        <label style="font-size:15px; color: rgb(80, 80, 80)">{{__('trans_word.Your account in Paypal')}}</label>
                        <input class="form-control" name="email_paypal" type="email" required>
                        </div>
                        <div class="form-group">
                            <label style="font-size:15px; color: rgb(80, 80, 80)">{{__('trans_word.The amount required')}}</label>
                            <input class="form-control" name='amount' type="number" required>    
                        </div>
                        <p style=" color: rgb(107, 107, 107);">{{__('trans_word.Select the amount you want to be sent to your PayPal account')}}</p>
                        <input type="submit" class="btn btn-primary pull-credit" id="btnSubmit" value="{{__('trans_word.money withdrawal')}}">
                    </form>
                </div>

             </div>
         

             @include('layouts.site.footer')


@endsection



