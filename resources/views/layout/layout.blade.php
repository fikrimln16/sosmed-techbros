<!DOCTYPE html>
<html lang="EN">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>Sosmed Techbros - Beta</title>

   <link href="https://bootswatch.com/5/sketchy/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

   <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

   <link rel="stylesheet" href="style/style.css" />
</head>

<body>
   @include('partials.navbar')
   <div class="container py-4 d-flex justify-content-center ">
      @yield('container')
   </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
   </script>
   <script src="js/script.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
      $(document).ready(function() {
    $('.like-button').click(function() {
        var postId = $(this).data('post-id');
        var likeCount = $('#likeCount-' + postId);

        $.ajax({
            type: 'POST',
            url: '{{ route("like-post", ["id" => ":id"]) }}'.replace(':id', postId),
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                var currentLikes = parseInt(likeCount.text());
                likeCount.text(currentLikes + 1);
                $(this).text('Like (' + (currentLikes + 1) + ')');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
  </script>
{{-- 
<script>
    $(document).ready(function() {
        $('#commentForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert("success")
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Tambahkan logika untuk menampilkan pesan atau melakukan aksi lain jika terjadi kesalahan
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script> --}}
</body>

</html>