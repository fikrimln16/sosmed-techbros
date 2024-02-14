<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary"
   data-bs-theme="dark">
   <div class="container">
      <a class="navbar-brand fw-light" href="{{ route('dashboard')}}"> Sosmed Techbros</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
         aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
         <ul class="navbar-nav">
            @auth
            <li class="nav-item">
               <a class="nav-link" href="/profile/{{ Auth::user()->id }}">Profile</a>
            </li>
            <form action="{{ route('logout') }}" method="POST">
               @csrf
               <button type="submit" class="btn btn-link">Logout</button>
            </form>
            @else
            <li class="nav-item">
               <a class="nav-link active" aria-current="page" href="/login">Login</a>
            </li>
            <li class="nav-item">
               <a class="nav-link active" aria-current="page" href="/register">Register</a>
            </li>
            @endauth
         </ul>
      </div>
   </div>
</nav>