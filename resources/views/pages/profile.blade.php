@extends('layout.layout')

@section('container')
<div class="col col-md-12 col-sm-12 main">
   @include('components.profile-card')
   @foreach ( $datas as $data)
   @include('components.post-card')
   <hr>
   @endforeach
   {{ $datas->links()}}
</div>
@endsection