<div class="mb-3">
   <div class="row g-0 d-flex justify-content-center">
      <div class="col-md-8" >
         <div class="d-flex flex-column justify-content-center align-items-center w-100 mx-auto p-4">
            <h2 class="card-title">{{ $profile->name }}</h2>
            @if(isset($latest_post->created_at))
                <p class="card-text"><small class="text-body-secondary">Last updated {{ $latest_post->created_at->diffForHumans() }}</small></p>
                @else
                <p class="card-text"><small class="text-body-secondary">Last updated none</small></p>
            @endif
        </div>        
      </div>
      <hr>
   </div>