@extends('admin.template')

@section('konten')
    <script async defer src="https://maps.googleapis.com/maps/api/js?libraries=geometry&key=AIzaSyAmiWD35dSHhBRU_xaQTyg09o0GKmeRrPQ&callback=initMap" type="text/javascript"></script>
    <style>
        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
        #right-panel {
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #right-panel select, #right-panel input {
            font-size: 15px;
        }

        #right-panel select {
            width: 100%;
        }

        #right-panel i {
            font-size: 12px;
        }
        #right-panel {
            height: 100%;
            float: right;
            width: 390px;
            overflow: auto;
        }
        #floating-panel {
            background: #fff;
            padding: 5px;
            font-size: 14px;
            font-family: Arial;
            border: 1px solid #ccc;
            box-shadow: 0 2px 2px rgba(33, 33, 33, 0.4);
            display: none;
        }
        @media print {
            #map {
                margin: 0;
            }
            #right-panel {
                float: none;
                width: auto;
            }
        }

    </style>
    <div class="m-0 p-3">
        <div class="row">
            <div class="col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
                    </ol>
                </nav>
                <hr>
            </div>
            <div class="col-sm-12">
                @if($data->stt_pemesanan=="MENUNGGU" || $data->stt_pemesanan=="MENUNGGU KONFIRMASI PEMESANAN" || $data->stt_pemesanan=="MENUNGGU KONFIRMASI PEMBAYARAN")
                    <div class="alert alert-warning alert-dismissible">
                        <h5><i class="icon fas fa-ban"></i> Status Pemesanan!</h5>
                        Status Pemesanan {{$data->stt_pemesanan}}
                    </div>
                @elseif($data->stt_pemesanan=="TERKONFIRMASI" || $data->stt_pemesanan=="PEMBAYARAN TERKONFIRMASI" || $data->stt_pemesanan=="DIANTARKAN")
                    <div class="alert alert-info alert-dismissible">
                        <h5><i class="icon fas fa-info"></i> Status Pemesanan!</h5>
                        Status Pemesanan {{$data->stt_pemesanan}}
                    </div>
                @elseif($data->stt_pemesanan=="SELESAI")
                    <div class="alert alert-success alert-dismissible">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Status Pemesanan!</h5>
                        Status Pemesanan {{$data->stt_pemesanan}}
                    </div>
                @elseif($data->stt_pemesanan=="DITOLAK"||$data->stt_pemesanan=="DIBATALKAN")
                    <div class="alert alert-danger alert-dismissible">
                        <h5><i class="icon fas fa-check"></i> Status Pemesanan!</h5>
                        Status Pemesanan {{$data->stt_pemesanan}}
                    </div>
                @endif
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5><b>Detail Pemesanan</b></h5>
                    </div>
                    <div class="card-body row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Foto Pengguna</b></label>
                            <div class="text-center">
                                @if(empty($data->foto_user))
                                    <img src="{{asset('img/ic_icon.png')}}" class="w-1" alt="Gambar Rusak">
                                @else
                                    @if($data->stt_login=="FB" || $data->stt_login=="GOOGLE")
                                        <img src="{{$data->foto_user}}" class="w-50" alt="Gambar Rusak">
                                    @else
                                        <img src="{{asset('upload/user/'.$data->foto_user)}}" class="w-50" alt="Gambar Rusak">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Foto Kendaraan</b></label>
                            <div class="text-center">
                                <img src="{{asset('upload/kendaraan/'.$data->foto_kendaraan)}}" class="w-100">
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Nama Pengguna</b></label>
                            <div class="form-control h-auto">{{$data->nama_user}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>KTP</b></label>
                            <div class="form-control h-auto">{{$data->nik}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>Nama Barang</b></label>
                            <div class="form-control h-auto">{{$data->deskripsi_barang}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-5">
                            <label><b>Nama CV.</b></label>
                            <div class="form-control h-auto">{{$data->nama_cv}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-3">
                            <label><b>Total Kendaraan</b></label>
                            <div class="form-control h-auto">{{$data->total_kendaraan}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Tanggal Pemesanan</b></label>
                            <div class="form-control h-auto">{{$data->date_from}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Waktu Pemesanan</b></label>
                            <div class="form-control h-auto">{{$data->time_from}}</div>
                        </div>
                        <div class="col-sm-12 mb-2">
                            <div class="row">
                                <div class="col-12 col-sm-8">
                                    <label><b>Peta</b></label>
                                    <div id="map" style="width: 100%;height: 50vh;"></div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <label><b>Arah</b></label>
                                    <div id="right-panel" style="width: 100%;height: 50vh;"></div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary btn-block" onclick="open_map()">Buka Google Map</button>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Alamat Jemput</b></label>
                            <div class="form-control h-auto">{{$data->alamat_berangkat}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Alamat Tujuan</b></label>
                            <div class="form-control h-auto">{{$data->alamat_tujuan}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Catatan Alamat Jemput</b></label>
                            <div class="form-control h-auto">{{$data->deskripsi_berangkat}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Catatan Alamat Tujuan</b></label>
                            <div class="form-control h-auto">{{$data->deskripsi_tujuan}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Jarak</b></label>
                            <div class="form-control h-auto">{{$data->jarak}} KM</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-6">
                            <label><b>Berat</b></label>
                            <div class="form-control h-auto">{{str_replace(",",".",number_format($data->berat_barang))}} KG</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>Harga Kendaraan</b></label>
                            <div class="form-control h-auto">Rp {{str_replace(",",".",number_format($data->harga))}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>Harga Tol</b></label>
                            <div class="form-control h-auto">Rp {{str_replace(",",".",number_format($data->harga_tol))}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>Harga Total</b></label>
                            <div class="form-control h-auto">Rp {{str_replace(",",".",number_format($data->harga_total))}}</div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-3">
                    <div class="card-header">
                        <h5><b>Sopir</b></h5>
                    </div>
                    <div class="card-body row">
                        @foreach($data_sopir as $item)
                            <div class="col-12 col-sm-6">
                                <div class="row border p-3">
                                    <div class="col-3">
                                        @if(empty($item->foto_user))
                                            <img src="{{asset('img/ic_icon.png')}}" class="w-100" alt="Gambar Rusak">
                                        @else
                                            @if($item->stt_login=="FB" || $item->stt_login=="GOOGLE")
                                                <img src="{{$item->foto_user}}" class="w-100" alt="Gambar Rusak">
                                            @else
                                                <img src="{{asset('upload/user/'.$item->foto_user)}}" class="w-100" alt="Gambar Rusak">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control form-control-sm" value="{{$item->nama_user}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Sopir</label>
                                            <input type="text" class="form-control form-control-sm" value="{{$item->kd_sopir}}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        setItem('pemesanan');
        var avoid = "{{$data->avoid}}";
        var map;
        var markers = [];
        var markers2 = [];
        var lat_berangkat = "{{$data->lt_berangkat}}";
        var lng_berangkat= "{{$data->lg_berangkat}}";
        var lokasi_berangkat = {lat: parseFloat(lat_berangkat), lng: parseFloat(lng_berangkat)};
        var lat_tujuan = "{{$data->lt_tujuan}}";
        var lng_tujuan= "{{$data->lg_tujuan}}";
        var lokasi_tujuan = {lat: parseFloat(lat_tujuan), lng: parseFloat(lng_tujuan)};
        var directionsDisplay;
        var directionsService;

        function initMap() {
            directionsDisplay = new google.maps.DirectionsRenderer;
            directionsService = new google.maps.DirectionsService;
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: lokasi_berangkat,
                streetViewControl: false,
                gestureHandling: 'greedy',
                fullscreenControl: false,
            });
            var marker = new google.maps.Marker({
                position: lokasi_berangkat,
                map: map
            });
            markers.push(marker);
            var marker2 = new google.maps.Marker({
                position: lokasi_tujuan,
                map: map
            });
            markers2.push(marker2);

            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById('right-panel'));

            calculateAndDisplayRoute(directionsService, directionsDisplay);
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay) {
            directionsService.route({
                origin: lokasi_berangkat,
                destination: lokasi_tujuan,
                travelMode: 'DRIVING',
                avoidTolls: avoid !== "tolls",
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Gagal merutekan ' + status);
                }
            });
        }

        function open_map() {
            var url = "https://www.google.com/maps/dir/"+lat_berangkat+","+lng_berangkat+"/"+lat_tujuan+","+lng_tujuan+"/@"+lat_tujuan+","+lng_tujuan;
            if (avoid!=="tolls") {
                url += "/data=!3m1!4b1!4m4!4m3!2m1!2b1!3e0";
            }
            console.log(url);
            window.open(url);
        }
    </script>
@endsection
