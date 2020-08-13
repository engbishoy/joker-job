
@if($errors->any())
<div class="alert alert-danger" role="alert">
@foreach ($errors->all() as $errors)
    {{$errors}}<br>
@endforeach
</div>
@endif
@if(session('success'))
   <div class="alert alert-success" role="alert"> {{session('success')}}</div>
@endif