@extends('layout.layout')

@section('container')
<div class="container">
   <div class="row justify-content-center mt-4">
       <div class="col-md-6">
           <div class="card">
               <div class="card-body">
                  <div class="d-flex w-100 justify-content-center align-items-center">
                     <h2    class="card-title text-align-center">Register</h2>
                  </div>
                  <hr>
                   <form method="POST" action="{{ route('store-register') }}">
                       @csrf

                       <div class="mb-3">
                           <label for="name" class="form-label">Name</label>
                           <input type="text" id="name" name="name" class="form-control" required autofocus>
                       </div>

                       <div class="mb-3">
                           <label for="email" class="form-label">Email</label>
                           <input type="email" id="email" name="email" class="form-control" required>
                       </div>

                       <div class="mb-3">
                           <label for="password" class="form-label">Password</label>
                           <input type="password" id="password" name="password" class="form-control" required>
                       </div>

                       <div class="mb-3">
                           <label for="password_confirmation" class="form-label">Confirm Password</label>
                           <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                       </div>

                       <div class="d-grid gap-2">
                           <button type="submit" class="btn btn-primary">Register</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection