<div class="mb-3">
   <div class="row g-0 d-flex justify-content-center">
      <div class="col-md-8" >
         <div class="d-flex flex-column justify-content-center align-items-center w-100 mx-auto p-4">
            <h1 class="card-title">{{ $profile->name }}</h1>
            @if(isset($latest_post->created_at))
                <p class="card-text"><small class="text-body-secondary">Last updated {{ $latest_post->created_at->diffForHumans() }}</small></p>
                @else
                <p class="card-text"><small class="text-body-secondary">Last updated none</small></p>
            @endif
            <div class='d-flex gap-5'>
               <h5>Followers : <span class="text-danger">{{ $followers->count() }}</span></h5>
               <h5>Following : <span class="text-danger">{{ $following->count() }}</span></h5>
            </div>
        </div>        
      </div>
      <hr>
   </div>