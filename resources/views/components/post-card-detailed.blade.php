<div class="card tweet-card">
   <div class="px-3 pt-4 pb-2">
      <div class="d-flex align-items-center justify-content-between">
         <div class="d-flex align-items-center justify-content-between w-100">
            <div class="profile d-flex align-items-center w-100">
               <a href="/profile/{{$data->user->id}}">
                  <img style="width: 50px" class="me-2 avatar-sm rounded-circle border border-black"
                     src="{{ $data->user->avatar }}" alt="Mario Avatar" /></a>
               <div>
                  <h5 class="card-title mb-0 w-100">
                     <a href="/profile/{{$data->user->id}}"> {{ $data->user->name }} </a>
                  </h5>
               </div>
            </div>
            <div class="w-100 text-end">
               <span class="fs-6 fw-light text-muted">
                  <span class="fas fa-clock text-md"> </span>
                  {{ date('Y-m-d H:i:s', strtotime($data->created_at) + (7 * 3600)) }}
               </span>
            </div>
         </div>
      </div>
   </div>
   <div class="card-body">
      <p class="fs-6 text-muted">
         {{ $data->body}}
      </p>
      <div class="d-flex justify-content-between">
         <div class="d-flex gap-2">
            <form action="{{ route('like-post', ['id' => $data->id]) }}" method="post">
               @csrf
               <button type="submit" name='id' class="btn btn-link fw-light nav-link fs-6">
                  <span class="fas fa-heart me-1"></span> {{ $data->likes }}
               </button>
            </form>
            <a href=" #" class="fw-light nav-link fs-6">
               <i class="bx bxs-comment"></i> {{ $data->comments->count() }}
            </a>
         </div>
         <div>
            <a href="{{ route('show-post', $data->id) }}" class="text-decoration-none cursor-pointer">view post...</a>
         </div>
      </div>
      <div>
         @auth
         <form action="{{ route('comment-post', $data->id) }}" method="post">
            @csrf
            <div class="mb-3">
               <textarea name='body' id="commentTextarea" class="fs-6 form-control" style="resize: none" rows="2"
                  required></textarea>
            </div>
            <div class="w-100 d-flex justify-content-end align-items-center">
               @if (Auth::check())
                  <button type='submit' class="btn btn-primary btn-sm px-4" id="submit-button">
                     Post Comment
                  </button>
               @else
                  <button class="btn btn-primary btn-sm px-4" id="submit-button" disabled>
                     Post Comment
                  </button>
               @endif
               <!-- <span class="mx-2 my-auto counter fw-light" id="charCounter">280</span> -->
            </div>
         </form>
         @endauth
         @if ($data->comments->isEmpty())
            <hr>
            <div class="d-flex justify-content-center">
               <h4>No comments found</h4>
            </div>
         @else
            @foreach($data->comments as $comment)
               @include('components.comment')
            @endforeach
         @endif
      </div>
   </div>
</div>