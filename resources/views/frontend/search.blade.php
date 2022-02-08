<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- ===============================================-->
        <!--    Document Title-->
        <!-- ===============================================-->
        <title>HS Cargo Service</title>


        <!-- ===============================================-->
        <!--    Favicons-->
        <!-- ===============================================-->
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontend/assets/img/favicons/apple-touch-icon.png')}}">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/img/logo1update.jpg')}}">
        <link rel="manifest" href="{{asset('frontend/assets/img/favicons/manifest.json')}}">
        <meta name="msapplication-TileImage" content="{{asset('frontend/assets/img/favicons/mstile-150x150.png')}}">
        <meta name="theme-color" content="#ffffff">


        <!-- ===============================================-->
        <!--    Stylesheets-->
        <!-- ===============================================-->
        <link href="{{asset('frontend/assets/css/theme.css')}}" rel="stylesheet" />
        <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet" />
        {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}"> --}}
        {{-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'> --}}
        <!-- Font Awesome CSS -->
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>

    <style>
        /* .preloader{
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('../../../public/image/Profile/loader.gif') 50%50% no-repeat rgb(249, 249, 249);
            /* background: url('../../image/Profile/loader.gif') 50%50% no-repeat rgb(249, 249, 249); */
            /* opacity: 0.9;
        } */ */
        /* .plaintext {
            outline:0;
            border-width:0 0 1px;
        } */
    </style>
    <title>@yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css"> --}}



</head>

<body>
    <div class="preloader" id="preloaders"></div>

    @include('sweet::alert')
   {{-- sidebar --}}

   <main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" data-navbar-on-scroll="data-navbar-on-scroll">
      <div class="container"><a class="navbar-brand" href="#"><img src="{{asset('frontend/assets/img/logo10.jpg')}}" alt="" width="200"/><span class="text-1000 fs-1 ms-2 fw-medium"></span></a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto border-bottom border-lg-bottom-0 pt-2 pt-lg-0">
            {{-- <li class="nav-item float-left"><a class="nav-link" href=""><span style="color:rgb(81, 102, 223);font-size:17px;">Go to Home</span></a></li> --}}
          </ul>
          {{-- <form class="d-flex py-3 py-lg-0"> --}}
            {{-- <button class="btn btn-link text-1000 fw-medium order-1 order-lg-0" type="button">Loi in</button> --}}
            <a href="{{route('frontend.home')}}" class="mr-3" style="font-weight:bold;margin-right:30px;">Go to Home</a>

            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="language" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  English
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#">Myanmar</a>
                </div>
              </div>
            {{-- <a href=""><button type="button" class="btn outline rounded-pill order-0" data-toggle="modal"  data-target="#homee" onclick="show()">
                Login
            </button></a> --}}



            {{-- <button class="btn btn-outline-danger rounded-pill order-0" type="submit">Sign Up</button> --}}


          {{-- </form> --}}
        </div>
      </div>
    </nav>
    @yield('content')


   </main>

    <script src="{{asset('frontend/vendors/@popperjs/popper.min.js')}}"></script>
    <script src="{{asset('frontend/vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/vendors/is/is.min.js')}}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{asset('frontend/assets/js/theme.js')}}"></script>

    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
    <script src="{{asset('../assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('../assets/js/popper.min.js')}}"></script>
    <script src="{{asset('../assets/js/app.js')}}"></script>

<!-- Popper JS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<!-- Bootstrap JS -->
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>

    {{-- <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet"> --}}
    @yield('js')
</body>


</html>

<script>


</script>


