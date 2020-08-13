@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="usagePolicy" style="padding-top: 30px;padding-bottom: 30px;">
    <div class="container">

    <h3>{{__('trans_word.common questions')}}</h3>

    <hr>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                
            <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading{{$questions[0]->id}}">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$questions[0]->id}}" aria-expanded="true" aria-controls="collapse{{$questions[0]->id}}">
                        {!! $questions[0]->title !!}
                        </a>
                    </h4>
              </div>
              <div id="collapse{{$questions[0]->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$questions[0]->id}}">
                <div class="panel-body">
                    {!! $questions[0]->answer !!}
                </div>
              </div>
            </div>


            @for ($i=1 ; $i <count($questions); $i++)
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="heading{{$questions[$i]->id}}">
                <h4 class="panel-title">
                  <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$questions[$i]->id}}" aria-expanded="false" aria-controls="collapse{{$questions[$i]->id}}">
                   {!! $questions[$i]->title !!}
                  </a>
                </h4>
              </div>
              <div id="collapse{{$questions[$i]->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$questions[$i]->id}}">
                <div class="panel-body">
                    {!! $questions[$i]->answer !!}
                </div>
              </div>
            </div>
            @endfor



    </div>
</div>


@include('layouts.site.footer')
@endsection