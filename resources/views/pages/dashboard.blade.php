@extends('layout.layout')

@section('container')
<div class="col col-md-12 col-sm-12">
   @include('components.alert')
   
   <!--Post Text Area Start-->
   @auth
   <h4> Welcome {{ Auth::user()->name }}, Share your ideas !!</h4>
   @include('components.textarea-post')
   @else
   <div class="d-flex justify-content-center">
      <h4 class="text-center">Login to post or comment something!!!</h4>
   </div>
   @endauth
   <!--Post Text Area End-->
   
   <hr>
   <div class="">
      <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              Sort by...
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="{{ route('sort-by-like') }}">Sort by Like</a></li>
              <li><a class="dropdown-item" href="{{ route('sort-by-newest') }}">Sort by Newest</a></li>
          </ul>
      </div>
   </div>


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