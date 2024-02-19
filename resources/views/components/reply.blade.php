<div class="d-flex align-items-start fs-4">
   <a href="/profile/{{ $reply->user_id }}">
      <img class="me-2 avatar-sm rounded-circle border border-black" src="{{ $reply->user->avatar }}" alt="" style='width: 35px'>
   </a>
   <div class='w-100'>
      <div class="d-flex justify-content-between">
         <div class="d-flex gap-1">
               <a href="/profile/{{ $reply->user_id }}" class="text-decoration-none">
                  <h6 class="mt-2">{{ $reply->user->name }}</h6>
               </a>
               <i class="bx bx-message-rounded-dots"></i>
         </div>
         <small class="fs-6 fw-light text-muted">
               {{ date('Y-m-d H:i:s', strtotime($reply->created_at) + (7 * 3600)) }}</small>
      </div>
      <p class='fs-6 fw-light'>{{ $reply->body }}</p>
   </div>
</div>