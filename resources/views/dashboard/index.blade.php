@extends('dashboard.template')

@section('konten')
    <section id="index-page-top" class="bg-map">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6" style="margin-top: 35vh;">
                    <h1 class="text-black"><b>Download Aplikasi, Mulai Pemesanan Angkutan, dan Pesanan Sampai!</b></h1>
                    <p class="text-justify text-black">{{$deskripsi}}</p>
                    <img src="{{asset('img/google-play-store.png')}}" class="w-25">
                </div>
                <div class="col-12 col-sm-6 text-center">
                    <img src="{{asset('img/icon-apps.png')}}" style="height: 70vh;margin-top: 20vh;">
                </div>
            </div>
        </div>
    </section>
    <section style="padding: 15vh 0;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <h3 class="font-weight-bold">Bagaimana Alur Pemesanan</h3>
                </div>
                <div class="col-12 col-sm-8 offset-sm-2 text-center mb-3">
                    <p>Unduh aplikasi TransCrop di playstore, buat akun kamu, cari kendaraan dan lakukan pemesanan untuk mengantarkan hasil panen anda.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="text-right mt-5">
                        <span class="badge badge-default p-3 number-step"><b>1</b></span><br/>
                        <p class="mt-2 mb-0"><b>Memilih Jenis Kendaraan atau Perusahaan</b></p>
                        <p class="mt-2">Pilih jenis kendaraan atau Perusahaan dan tentukan lokasi titik jemput dan tujuan serta tanggal pemesanan.</p>
                    </div>
                    <div class="text-right mt-5">
                        <span class="badge badge-default p-3 number-step"><b>2</b></span><br/>
                        <p class="mt-2 mb-0"><b>Menunggu Konfirmasi</b></p>
                        <p class="mt-2">Silahkan menunggu konfirmasi lanjutan dari pemesanan anda untuk dilanjutkan melakukan pengantaran hasil panen.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-4 text-center">
                    <img src="{{asset('img/icon-apps-map.png')}}" class="w-75">
                </div>
                <div class="col-12 col-sm-4">
                    <div class="text-left mt-5">
                        <span class="badge badge-default p-3 number-step"><b>3</b></span><br/>
                        <p class="mt-2 mb-0"><b>Pembayaran</b></p>
                        <p class="mt-2">Setelah pemesanan anda diterima, silahkan untuk segera melakukan pembayaran untuk dilanjutkan ke proses selanjutnya.</p>
                    </div>
                    <div class="text-left mt-5">
                        <span class="badge badge-default p-3 number-step"><b>4</b></span><br/>
                        <p class="mt-2 mb-0"><b>Sopir Menghubungi Anda</b></p>
                        <p class="mt-2">Setelah pemesanan anda terkonfirmasi, sopir akan memberi tau anda bahwa akan datang menjemput hasil panen anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="padding: 15vh 0;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-3">
                    <h3 class="font-weight-bold">Bagaimana Aplikasi Ini Bekerja</h3>
                </div>
                <div class="col-12 col-sm-8 offset-sm-2 text-center mb-3">
                    <p>{{$penggunaan}}</p>
                    <span class="badge badge-apps-work p-3">Pengguna</span>
                    <span class="badge badge-apps-work p-3">Perusahaan</span>
                    <span class="badge badge-apps-work p-3">Sopir</span>
                </div>
            </div>
        </div>
    </section>
    <section style="padding: 15vh 0;">
        <div class="container">
            <div class="card bg-rounded-default border-0">
                <div class="card-body">
                    <h2 class="font-weight-bold text-light">Unduh Aplikasi TransCrop</h2>
                    <div class="row">
                        <div class="col-8">
                            <p class="text-justify text-light">
                                {{$tentang2}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="padding: 10vh 0;">
        <div class="container">
            <h2 class="font-weight-bold text-center">KRITK DAN SARAN</h2>
            <div class="row mt-5">
                <div class="col-12 col-sm-3">
                    <input type="text" class="form-control form-control-kritik-saran p-4 mb-1" placeholder="Masukkan Nama...">
                    <input type="text" class="form-control form-control-kritik-saran p-4 mb-1" placeholder="Masukkan No HP...">
                    <input type="text" class="form-control form-control-kritik-saran p-4" placeholder="Masukkan E-mail...">
                </div>
                <div class="col-12 col-sm-5">
                    <textarea class="form-control form-control-kritik-saran p-4 h-100" placeholder="Masukkan Kritik dan Saran..."></textarea>
                </div>
            </div>
            <button type="button" class="btn btn-default mt-3 w-25">KIRM</button>
        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#li-home').addClass("active");
        });
    </script>
@endsection
