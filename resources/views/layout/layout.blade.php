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

   <script>
      $(document).ready(function() {
          $('#likeButton').click(function() {
              $.ajax({
                  url: $('#likeForm').attr('action'),
                  type: 'POST',
                  data: $('#likeForm').serialize(),
                  success: function(response) {
                      $('#likeCount').text(response.likes);
                  },
                  error: function(xhr, status, error) {
                      console.error(xhr.responseText);
                  }
              });
          });
      });
  </script>
</body>

</html>