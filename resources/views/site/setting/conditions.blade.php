@extends('layouts.site.app')
@section('content')
@include('layouts.site.navbar')
@include('layouts.site.headerCategories')

<div class="conditions" style="padding-top: 30px;padding-bottom: 30px;">
    <div class="container">
        {!! $conditions !!}
    </div>
</div>


@include('layouts.site.footer')
@endsection