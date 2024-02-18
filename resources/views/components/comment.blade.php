<hr>
@if($comment->parent_comment_id === null)
   <div class="d-flex align-items-start fs-4">
      <a href="/profile/{{ $comment->user->id }}">
         <img style="width: 35px" class="me-2 avatar-sm rounded-circle border border-black"
            src="{{ $comment->user->avatar }}" alt="Luigi Avatar" />
      </a>
      <div class="w-100">
         <div class="d-flex justify-content-between">
            <div class="d-flex gap-1">
                  <a href="/profile/{{ $comment->user->id }}" class="text-decoration-none">
                     <h6 class="mt-2">{{ $comment->user->name }}</h6>
                  </a>
                  <i class="bx bx-message-rounded-dots"></i>
            </div>
            <small class="fs-6 fw-light text-muted">
                  {{ date('Y-m-d H:i:s', strtotime($comment->created_at) + (7 * 3600)) }}</small>
         </div>
         <p class="fs-6 fw-light">
            {{ $comment->body }}
         </p>
         {{-- <hr> --}}
         @auth
         <form action="{{ route('reply', $comment->id) }}" method="post">
            @csrf
            <div class="d-flex mb-3">
               <textarea name='body' id="commentTextarea" class="fs-6 form-control" style="resize: none" rows="1"
               required></textarea>
               <button type='submit' class="btn btn-primary btn-sm px-2" id="submit-button">
                  Reply
               </button>
            </div>
            </form>
            @endauth
         @if ($comment->replies->isNotEmpty())
            <h5>Replies:</h5>
            @foreach ($comment->replies->take(2) as $reply)
               @include('components.reply')
            @endforeach
            @if ($comment->replies->count() > 2)
                  <div class="w-100 d-flex justify-content-center align-items-center">
                      <a href="{{ route('show-post', $data->id) }}" class="btn btn-primary btn-sm px-4">
                          View all replies...
                      </a>  
                  </div>
              @endif
         @endif
      </div>
   </div>
@endif