<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TransCrop">
    <meta name="author" content="firdausns44@gmail.com">
    <meta name="keyword" content="TransCrop">
    <meta name="generator" content="TransCrop">
    <meta property="og:title" content="TransCrop">
    <meta property="og:site_name" content="TransCrop">
    <meta property="og:description" content="TransCrop">
    <meta property="og:type" content="website">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title>TransCrop</title>

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('img/ico/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('img/ico/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/ico/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/ico/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/ico/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('img/ico/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('img/ico/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/ico/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/ico/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('img/ico/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/ico/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/ico/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/ico/favicon-16x16.png')}}">

    <link href="{{asset('bootstrap-4.3.1/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesome-5.15.1/css/all.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesome-5.15.1/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesome-5.15.1/css/brands.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesome-5.15.1/css/solid.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="{{asset('custom/custom_dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/sweetalert2-9.5.4/package/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="{{asset('plugins/jQuery/jQuery-3.5.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap-4.3.1/js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('fontawesome-5.15.1/js/all.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/sweetalert2-9.5.4/package/dist/sweetalert2.all.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/jquery-validation-1.19.2/dist/jquery.validate.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/jquery-validation-1.19.2/dist/additional-methods.js')}}"></script>
    <style type="text/css">
        .error{
            color: red;
        }
    </style>
</head>
<body class="d-flex flex-column w-100 h-100 mx-auto" id="page-top">
<main class="main">
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow">
            <div class="container">
                <a class="navbar-brand d-block d-sm-none d-none d-sm-block d-md-none d-md-block d-lg-none" href="{{url('')}}">
                    <img src="{{asset('img/logo.png')}}" style="width: 20vw;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <div class="d-none d-sm-block" id="ic-logo" style="width: 15%;">
                        <a href="{{url('/')}}" class="text-light text-decoration-none">
                            <img src="{{asset('img/logo.png')}}" class="w-100"/>
                        </a>
                    </div>
                    <ul class="navbar-nav navbar-nav-dark ml-auto pr-2">
                        <li id="li-home" class="nav-item"><a class="nav-link" href="{{url('/')}}">HOME <span class="sr-only">(current)</span></a></li>
                        <li id="li-mitra" class="nav-item"><a class="nav-link" href="{{url('/mitra')}}">MITRA</a></li>
                        <li id="li-tentang" class="nav-item"><a class="nav-link" href="{{url('/tentang')}}">TENTANG</a></li>
                        <li id="li-masuk" class="nav-item"><a class="nav-link" href="{{url('/masuk')}}">MASUK</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @yield('konten')
    <footer style="background-color: #2f3133;">
        <div class="container">
            <div class="row ml-0 mr-0 pt-5 text-white">
                <div class="col-12 col-sm-4">
                    <img src="{{asset('img/logo.png')}}" class="w-50">
                    <p class="text-justify">
                        Aplikasi TransCrop adalah sebuah aplikasi berbasis mobile yang dapat digunakan untuk pemesanan alat angkut hasil panen dari agribisnis.
                    </p>
                </div>
                <div class="col-12 col-sm-4">
                    <h6 class="mt-5"><b>Kontak</b></h6>
                    <ul class="list-unstyled">
                        <li>Jl. Gajah Mada No. 65 Brebes Timur</li>
                        <li>0283-28192</li>
                    </ul>
                </div>
                <div class="col-12 col-sm-4">
                    <h6 class="mt-5"><b>Link</b></h6>
                    <ul class="list-unstyled">
                        <li>Home</li>
                        <li>Mitra</li>
                        <li>Tentang</li>
                        <li>Masuk</li>
                    </ul>
                </div>
                <div class="col-12">
                    <hr style="border-color: white"/>
                </div>
            </div>
        </div>
        <div class="text-center p-2">
            <small class="text-white">© 2021 TransCrop</small>
        </div>
    </footer>
</main>
<script type="text/javascript" src="{{asset('custom/custom_dashboard.js')}}"></script>
@yield('js')
</body>
</html>
