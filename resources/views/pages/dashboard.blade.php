@extends('layout.layout')

@section('container')
<div class="col col-md-12 col-sm-12 main">
   @include('components.alert')
   
   <!--Post Text Area Start-->
   @auth
   <h4> Welcome {{ Auth::user()->name }}, Share yours ideas !!</h4>
   @include('components.textarea-post')
   @else
   <div class="d-flex justify-content-center">
      <h4 class="text-center">Login to post or comment something!!!</h4>
   </div>
   @endauth
   <!--Post Text Area End-->
   
   <hr>

   <!--Posts Card Start !-->
   <div class="mt-3">
      @foreach($datas as $data)
      @include('components.post-card')
      <hr>
      @endforeach
      {{ $datas->links()}}
   </div>
   <!--Posts Card End !-->
   
</div>
@endsection