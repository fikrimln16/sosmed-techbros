@extends('layout.layout')

@section('container')
<div class="container">
  <div class="row justify-content-center align-items-center mt-4">
      <div class="col-md-6">
          <div class="card col-12">
              <div class="card-body">
                  <div class="d-flex justify-content-center align-items-center">
                    <h2 class="card-title">Login</h2>
                  </div>
                  <hr>
                  <form method="POST" action="">
                      @csrf
                      <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" id="email" name="email" class="form-control" required autofocus>
                      </div>

                      <div class="mb-3">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" id="password" name="password" class="form-control" required>
                      </div>

                      <div class="mb-3 form-check">
                          <input type="checkbox" id="remember" name="remember" class="form-check-input">
                          <label for="remember" class="form-check-label">Remember me</label>
                      </div>

                      <div class="d-grid gap-2">
                          <button type="submit" class="btn btn-primary">Login</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
{{-- <div class="container py-5 h-100">
  <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
      <form action="">
        <div class="card p-5 text-center">
          <h3 class="mb-5">Sign in</h3>
          <p>Untuk menggunakan web ini, anda dapat login menggunakan Google!</p>
          <hr class="my-4">
          <a href="{{ route('redirect-google') }}" class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;">
            <i class="fab fa-google me-2"></i> Sign in with Google
          </a>
        </div>
      </form>
    </div>
  </div>
</div> --}}
@endsection