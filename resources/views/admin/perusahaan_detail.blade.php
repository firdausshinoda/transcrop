@extends('admin.template')

@section('konten')
<div class="m-0 p-3">
    <div class="row">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Perusahaan</li>
                </ol>
            </nav>
            <hr>
        </div>
        <div class="col-sm-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profil-tab" data-toggle="tab" href="#profil" role="tab" aria-controls="profil" aria-selected="true">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="kendaraan-tab" data-toggle="tab" href="#kendaraan" role="tab" aria-controls="kendaraan" aria-selected="false">Kendaraan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="sopir-tab" data-toggle="tab" href="#sopir" role="tab" aria-controls="sopir" aria-selected="false">Sopir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pemesanan-tab" data-toggle="tab" href="#pemesanan" role="tab" aria-controls="pemesanan" aria-selected="false">Pemesanan</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active mt-5" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label><b>Foto</b></label>
                                    <div class="text-center">
                                        <img src="{{asset('upload/cv/'.$data->foto_cv)}}" class="w-50">
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label><b>Nama Perusahaan</b></label>
                                    <div class="form-control h-auto">{{$data->nama_cv}}</div>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label><b>Nama Pemilik Perusahaan</b></label>
                                    <div class="form-control h-auto">{{$data->nama_user}}</div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label><b>Alamat</b></label>
                                        <div class="form-control h-auto">{{$data->alamat_cv}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Latitude</b></label>
                                        <div class="form-control h-auto">{{$data->lt_cv}}</div>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Longitude</b></label>
                                        <div class="form-control h-auto">{{$data->lg_cv}}</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label><b>Lokasi</b></label>
                                    <div id="map-canvas" class="border border-dark" style="width: 100%;height: 40vh"></div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label><b>Deskripsi</b></label>
                                    <div class="form-control h-auto">
                                        {{$data->deskripsi_cv}}
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label><b>SKDP(Surat Keterangan Domisili Perusahaan)</b></label>
                                    <img src="{{asset('/upload/skdp/'.$data->skdp)}}" class="w-100 form-control h-auto">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label><b>SIUP(Surat Izin Usaha Perdagangan)</b></label>
                                    <img src="{{asset('/upload/siup/'.$data->skdp)}}" class="w-100 form-control h-auto">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kendaraan" role="tabpanel" aria-labelledby="kendaraan-tab">
                            <table class="table table-bordered w-100 mt-5">
                                <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Kendaraan</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Jenis Barang</th>
                                    <th>Deskripsi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data_kendaraan as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img class="w-100" src="{{asset('/upload/kendaraan/'.$item->foto_kendaraan)}}" alt="Gambar Rusak"></td>
                                        <td>{{$item->nama_kendaraan}}</td>
                                        <td>{{$item->jenis_kendaraan}}</td>
                                        <td>{{$item->jenis_barang}}</td>
                                        <td class="text-justify">{{$item->deskripsi_kendaraan}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="sopir" role="tabpanel" aria-labelledby="sopir-tab">
                            <table class="table table-bordered w-100 mt-5">
                                <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Kode Sopir</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data_sopir as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            @if(empty($item->foto_user))
                                                <img src="{{asset('img/ic_icon.png')}}" style="width: 100px;" class="img-circle">
                                            @else
                                                @if($item->stt_login=="FB" || $item->stt_login=="GOOGLE")
                                                    <img src="{{$item->foto_user}}" style="width: 100px;" class="img-circle">
                                                @else
                                                    <img src="{{asset('upload/user/'.$item->foto_user)}}" style="width: 100px;" class="img-circle">
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{$item->kd_sopir}}</td>
                                        <td>{{$item->nama_user}}</td>
                                        <td>{{$item->alamat_user}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="pemesanan" role="tabpanel" aria-labelledby="pemesanan-tab">
                            <table class="table table-bordered w-100 mt-5">
                                <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Pemesanan</th>
                                    <th>Barang</th>
                                    <th>Alamat Jemput</th>
                                    <th>Alamat Tujuan</th>
                                    <th>Status Pemesanan</th>
                                    <th>Tanggal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data_pemesanan as $key => $item)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img src="{{asset('upload/kendaraan/'.$item->foto_kendaraan)}}" style="width: 100px;" alt="Gambar Rusak" class="w-100"></td>
                                        <td><a href="{{url('/admin/pemesanan_detail/'.$item->id_pemesanan)}}">{{$item->nama_user}}</a></td>
                                        <td>{{$item->deskripsi_barang}}</td>
                                        <td>{{$item->deskripsi_berangkat}}</td>
                                        <td>{{$item->deskripsi_tujuan}}</td>
                                        <td>{{$item->stt_pemesanan}}</td>
                                        <td>{{$item->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnNpZ0vxJXqcMDTaclUEIxUTUB8Izb1V0&?sensor=true"></script>
    <script type="text/javascript">
       setItem('perusahaan');
       var map;
       var lt_cv = "{{$data->lt_cv}}";
       var lg_cv = "{{$data->lg_cv}}";
       var markers = [];
       var position = {lat: parseFloat(lt_cv), lng: parseFloat(lg_cv)};
       function initMap() {
           map = new google.maps.Map(document.getElementById('map-canvas'), {
               zoom: 16,
               center: position,
               mapTypeControl: true,
               mapTypeControlOptions: {
                   style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                   position: google.maps.ControlPosition.LEFT_BOTTOM
               },
               gestureHandling: 'greedy',
               fullscreenControl: false,
               draggable: false
           });
           var marker = new google.maps.Marker({
               position: position,
               map: map
           });
           markers.push(marker);
       }
       initMap();
    </script>
@endsection
