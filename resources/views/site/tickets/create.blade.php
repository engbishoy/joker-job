@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('site.tickets.navbar')

    <div class="container">
        <div class="open-ticket col-md-offset-2 col-md-8" style="margin-top: 40px; margin-bottom: 40px">
        @include('layouts.message')

        <div class="panel panel-primary">
        <div class="panel-heading">{{__('trans_word.Open new ticket')}}</div>
            <div class="panel-body">
                
            <form action="{{route('ticket.store')}}" method="POST" id="form" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                        <label class=" col-sm-3 col-xs-4"><h4>{{__('trans_word.Title ticket')}}</h4></label>
                        <div class="col-sm-9 col-xs-8">
                        <input type="text" required class="form-control" name="title"> 
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-xs-4"><h4>{{__('trans_word.Category')}}</h4></label>
                        <div class="col-sm-9 col-xs-8">
                        <select class="form-control" name="category">
                        @foreach ($categoryTechnical as $categories)
                        <option value="{{$categories->id}}">{{$categories->name}}</option>
                        @endforeach
                        </select> 
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-xs-4"><h4>{{__('trans_word.Message')}}</h4></label>
                        <div class="col-sm-9 col-xs-8">
                        <textarea required class="form-control" name="message" style="height: 180px"> </textarea> 
                        <p style="color: rgb(95, 95, 95);margin-top: 10px;">{{__('trans_word.Please fully explain the matter to solve the problem as soon as possible.')}}</p>
    
                        </div>
                    </div>


                    <div class="form-group col-sm-offset-3 col-xs-offset-4" style="position: relative;">
                      <div class="icon">
                      <i class="fa fa-paperclip"></i> <span style="color: rgb(95, 95, 95);">{{__('trans_word.Add attachment')}}</span>
                      </div>
                      <input type="file" name="attachment[]" multiple>

                    </div>


                <br>

                <div class="accept-F-faq col-sm-offset-3 col-xs-offset-4">
                <input type="checkbox" required><a href="" style="color: rgb(95, 95, 95);text-decoration: none"> {{__('trans_word.I read the FAQ page and did not find an answer to my inquiry.')}}</a>
                </div>  

                <br><br>
                <button type="submit" class="btn btn-primary col-sm-offset-3 col-xs-offset-4" id='btnSubmit'>{{__('trans_word.Open new ticket')}}</button>
                  </form>

            </div>
          </div>

        </div>
    </div>


    @include('layouts.site.footer')

@endsection

