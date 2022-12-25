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
    <title>TransCrop</title>
    <meta name="csrf-token" content="{!! csrf_token() !!}">

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
    <link href="{{asset('custom/custom_admin.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/DataTables-1.10.20/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/AutoFill-2.3.4/css/autoFill.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/Buttons-1.6.1/css/buttons.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/Responsive-2.2.3/css/responsive.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/Scroller-2.0.1/css/scroller.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/SearchPanes-1.0.1/css/searchPanes.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/sweetalert2-9.5.4/package/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css">
    <style type="text/css">
        .error{
            color: red;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top pl-sm-4 pr-sm-5" style="box-shadow: 0 5px 5px -5px #999,0 -1px 0 0 #fff;">
        <div class="navbar-brand pl-md-5">
            <img src="{{ asset('img/logo.png') }}" style="width: 120px;margin-top: -5px"/>
            <a class="text-dark text-decoration-none" href="{{ url('/admin') }}">
                <b><small>Admin</small></b>
            </a>
            <a href="javascript:void(0);" id="sidebarCollapse" class="text-dark pl-3 pl-md-5 ml-md-3"><i class="fas fa-bars"></i></a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse pr-5" id="navbarCollapse">
            <form class="form-inline form-inline-custom ml-5 display-none" id="form-search">
                <input class="mr-sm-2" type="text" id="form-input-search" placeholder="Search...">
                <button class="btn" type="button" id="form-btn-search"><i class="fas fa-search form-inline-custom-i"></i></button>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="javascript:void();" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </a>
                        <div class="dropdown-menu shadow shadow-sm" aria-labelledby="dropdownMenuButton" style="right: .5rem;left: unset;">
                            <a class="dropdown-item" href="{{ url('/admin/akun') }}">Akun</a>
                            <a class="dropdown-item" href="{{ url('/admin/keluar') }}">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="wrapper">
    <nav id="sidebar">
        <ul class="list-unstyled components pr-1 pt-5">
            <li id="i_dashboard"><a href="{{url('/admin')}}" class="pl-sidebar"><i class="fas fa-home fa-lg mr-3"></i> Dashboard</a></li>
            <li id="i_notifikasi"><a href="{{url('/admin/notifikasi')}}" class="pl-sidebar"><i class="far fa-bell fa-lg mr-3"></i>Notifikasi</a></li>
            <li id="i_jenis_kendaraan"><a href="{{url('/admin/jenis_kendaraan')}}" class="pl-sidebar"><i class="fas fa-truck fa-lg mr-3"></i>Jenis Kendaraan</a></li>
            <li id="i_jenis_barang"><a href="{{url('/admin/jenis_barang')}}" class="pl-sidebar"><i class="fas fa-archive fa-lg mr-3"></i>Jenis Barang</a></li>
            <li id="i_jenis_sim"><a href="{{url('/admin/jenis_sim')}}" class="pl-sidebar"><i class="far fa-address-card fa-lg mr-3"></i>Jenis SIM</a></li>
            <li id="i_bank"><a href="{{url('/admin/bank')}}" class="pl-sidebar"><i class="fas fa-money-bill-wave fa-lg mr-3"></i>Bank</a></li>
            <li id="i_pemesanan"><a href="{{url('/admin/pemesanan')}}" class="pl-sidebar"><i class="fas fa-shopping-cart fa-lg mr-3"></i> Pemesanan</a></li>
            <li id="i_perusahaan"><a href="{{url('/admin/perusahaan')}}" class="pl-sidebar"><i class="far fa-building fa-lg mr-3"></i> Perusahaan</a></li>
            <li id="i_sopir"><a href="{{url('/admin/sopir')}}" class="pl-sidebar"><i class="fas fa-users fa-lg mr-3"></i> Sopir</a></li>
            <li id="i_pengguna"><a href="{{url('/admin/pengguna')}}" class="pl-sidebar"><i class="fas fa-users fa-lg mr-3"></i> Pengguna</a></li>
            <li id="i_kritik_saran"><a href="{{url('/admin/kritik_saran')}}" class="pl-sidebar"><i class="far fa-comments fa-lg mr-3"></i> Kritik & Saran</a></li>
            <li id="i_laporan"><a href="{{url('/admin/laporan')}}" class="pl-sidebar"><i class="far fa-chart-bar fa-lg mr-3"></i> Laporan Statistik</a></li>
            <li id="i_pengaturan"><a href="{{url('/admin/pengaturan')}}" class="pl-sidebar"><i class="fas fa-cogs fa-lg mr-3"></i> Pengaturan</a></li>
        </ul>
    </nav>

    <div id="content">
        <div id="Modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
        <div class="content-view">
            @yield('konten')
        </div>
        <footer class="footer mt-auto py-3 shadow-sm-footer p-3 bg-white">
            <div class="container">
                <span class="text-dark">© 2021 TransCrop</span>
            </div>
        </footer>
    </div>
</div>
<script type="text/javascript" src="{{asset('plugins/jQuery/jQuery-3.5.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('bootstrap-4.3.1/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('bootstrap-4.3.1/js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('fontawesome-5.15.1/js/all.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery-validation-1.19.2/dist/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/jquery-validation-1.19.2/dist/additional-methods.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/sweetalert2-9.5.4/package/dist/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/JSZip-2.5.0/jszip.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/pdfmake-0.1.36/pdfmake.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/DataTables-1.10.20/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/DataTables-1.10.20/js/dataTables.bootstrap4.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/AutoFill-2.3.4/js/dataTables.autoFill.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/AutoFill-2.3.4/js/autoFill.bootstrap4.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/Buttons-1.6.1/js/dataTables.buttons.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/Buttons-1.6.1/js/buttons.bootstrap4.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/Buttons-1.6.1/js/buttons.flash.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/Buttons-1.6.1/js/buttons.html5.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/Buttons-1.6.1/js/buttons.print.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/Responsive-2.2.3/js/dataTables.responsive.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/Scroller-2.0.1/js/dataTables.scroller.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/DataTables/SearchPanes-1.0.1/js/dataTables.searchPanes.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/echarts-5.2.1/echarts.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/plugins/moment/locale/id.js') }}"></script>
<script type="text/javascript" src="{{ asset('custom/custom_admin.js')}}"></script>
@yield('js')
<script>
    function ajax_delete(type,id) {
        swalWithBootstrapButtons.fire({
            text: 'Apakah anda yakin ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    var values = new FormData();
                    values.append("type",type);
                    values.append("id",id);
                    $.ajax({
                        type: "POST",data:values, url: "{{ url('/api_delete') }}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json', processData: false, contentType: false,
                        success: function(response) {
                            if (response.status === "OK"){
                                swalWithBootstrapButtons.fire({title: 'Success.', text: "", icon: 'success',}).then((result) => {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            } else {
                                swalWithBootstrapButtons.fire({icon: 'error', title: 'Oops...', text: response.message});
                            }
                        },
                        error:function(response){
                            swalWithBootstrapButtons.fire({icon: 'error', title: 'Oops...', text: "Terjadi kesalahan. Silahkan coba lagi..."});
                        }
                    });
                })
            },
            allowOutsideClick: false,
        });
    }
</script>
</body>
</html>
