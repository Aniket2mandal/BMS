<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blood Donation</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-THf9MWkPfS0LFGe+ym6XsIYZdYEG9w2T+KbX2Yu2HzmcDdQkY1ZaDCjz3h9fAdLkZMkXHYHTIfn64U5yTw3VxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="{{ asset('css/front/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/front/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/front/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/front/about.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
      
    </style>
</head>

<body>

    <!-- Navbar -->
      @include('frontend.layout.nav')



        @yield('content')


  

    <!-- Footer -->
    @include('frontend.layout.footer')

</body>

</html>
