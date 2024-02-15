<form action="{{ route('textarea-post.form') }}" method="post">
   @csrf
   <div class="col">
      <div class="mb-3">
         <textarea id="postTextArea" class="form-control" id="body" name='body' rows="3"
            style="resize: none;"></textarea>
      </div>
      <div class=" d-flex align-items-center gap-2">
         <button type='submit' class="btn btn-dark" id="postSubmitButton"> Share </button>
         <span class="countCharPost" id="postCharCounter"> 480 </span>
      </div>
      @if(session('error'))
         <span class="text-danger">{{ session('error') }}</span>
      @endif
   </div>
</form>
