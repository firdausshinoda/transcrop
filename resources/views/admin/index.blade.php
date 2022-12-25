@extends('admin.template')

@section('konten')
<div class="m-0 p-3">
    <div class="row">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <hr>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-3" style="margin-top: 20px">
            <div class="card shadow card-dashboard-text text-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-7 col-lg-8">
                            <h5 style="line-height: 1.5;">
                                <b>
                                    Welcome Back<br>
                                    TransCrop!
                                </b>
                            </h5>
                            <p class="pt-2 pt-md-3">Gunakan hak akses anda untuk mengelola setiap data.</p>
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-4">
                            <img src="{{ asset('img/bg-icon-dasbor.png') }}" style="width: 90%;margin-top: -9.5vh;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="info-box border shadow">
                <div class="info-box-icon bg-success"><i class="fas fa-users"></i></div>
                <div class="info-box-content">
                    <span class="info-box-number">{{$ttl_user}}</span>
                    <span class="info-box-text">Pengguna</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="info-box border shadow">
                <div class="info-box-icon bg-info"><i class="far fa-building"></i></div>
                <div class="info-box-content">
                    <span class="info-box-number">{{$ttl_cv}}</span>
                    <span class="info-box-text">Perusahaan</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="info-box border shadow">
                <div class="info-box-icon bg-secondary"><i class="fas fa-truck-moving"></i></div>
                <div class="info-box-content">
                    <span class="info-box-number">{{$ttl_kendaraan}}</span>
                    <span class="info-box-text">Kendaraan</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="info-box border shadow">
                <div class="info-box-icon bg-warning"><i class="fas fa-users"></i></div>
                <div class="info-box-content">
                    <span class="info-box-number">{{$ttl_sopir}}</span>
                    <span class="info-box-text">Sopir</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <div class="row flex-between-center">
                        <div class="col-6">
                            <h6 class="mb-0">
                                Total Pemesanan {{date('Y')}}
                                <div class="spinner-border spinner-border-sm d-none" id="spinner_ttl_pemesanan" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </h6>
                        </div>
                        <div class="col-6 text-right">
                            <select class="form-control form-control-sm" id="bulan_pemesanan" onchange="getTTLPemesanan()">
                                <option value="1" <?= $_month == "1" ? "selected" : ''?>>Januari</option>
                                <option value="2" <?= $_month == "2" ? "selected" : ''?>>Februari</option>
                                <option value="3" <?= $_month == "3" ? "selected" : ''?>>Maret</option>
                                <option value="4" <?= $_month == "4" ? "selected" : ''?>>April</option>
                                <option value="5" <?= $_month == "5" ? "selected" : ''?>>Mei</option>
                                <option value="6" <?= $_month == "6" ? "selected" : ''?>>Juni</option>
                                <option value="7" <?= $_month == "7" ? "selected" : ''?>>Juli</option>
                                <option value="8" <?= $_month == "8" ? "selected" : ''?>>Agustus</option>
                                <option value="9" <?= $_month == "9" ? "selected" : ''?>>September</option>
                                <option value="10" <?= $_month == "10" ? "selected" : ''?>>Oktober</option>
                                <option value="11" <?= $_month == "11" ? "selected" : ''?>>November</option>
                                <option value="12" <?= $_month == "12" ? "selected" : ''?>>Desember</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body h-100 px-0 py-0">
                    <div id="echart_pemesanan" style="height: 65vh"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <div class="row flex-between-center">
                        <div class="col-6">
                            <h6 class="mb-0">Pemesanan Berjalan</h6>
                        </div>
                        <div class="col-6 text-center">
                            <div class="form-control form-control-sm">{{$_month_name}}</div>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="height: 65vh">
                    <div class="row align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col pl-5 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl mr-3">
                                    <div class="avatar-name rounded-circle bg-soft-primary text-dark"><span class="fs-0 text-primary">M</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-dark text-decoration-none" href="#!">MENUNGGU</a><span class="badge rounded-pill ml-2 bg-200 text-primary">{{$pemesanan_berjalan[0][0]}}%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pr-2">
                                    <div class="fs--1 font-weight-semi-bold">{{$pemesanan_berjalan[0][1]}}</div>
                                </div>
                                <div class="col-5 pr-card pl-2">
                                    <div class="progress mr-2" style="height: 5px;">
                                        <div class="progress-bar rounded-pill" role="progressbar" style="width: {{$pemesanan_berjalan[0][0]}}%" aria-valuenow="{{$pemesanan_berjalan[0][0]}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col pl-5 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl mr-3">
                                    <div class="avatar-name rounded-circle bg-soft-success text-dark"><span class="fs-0 text-success">T</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-dark text-decoration-none" href="#!">TERKONFIRMASI</a><span class="badge rounded-pill ml-2 bg-200 text-primary">{{$pemesanan_berjalan[1][0]}}%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pr-2">
                                    <div class="fs--1 font-weight-semi-bold">{{$pemesanan_berjalan[1][1]}}</div>
                                </div>
                                <div class="col-5 pr-card pl-2">
                                    <div class="progress mr-2" style="height: 5px;">
                                        <div class="progress-bar rounded-pill" role="progressbar" style="width: {{$pemesanan_berjalan[1][0]}}%" aria-valuenow="{{$pemesanan_berjalan[1][0]}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col pl-5 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl mr-3">
                                    <div class="avatar-name rounded-circle bg-soft-info text-dark"><span class="fs-0 text-info">P</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-dark text-decoration-none" href="#!">PEMBAYARAN</a><span class="badge rounded-pill ml-2 bg-200 text-primary">{{$pemesanan_berjalan[2][0]}}%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pr-2">
                                    <div class="fs--1 font-weight-semi-bold">{{$pemesanan_berjalan[2][1]}}</div>
                                </div>
                                <div class="col-5 pr-card pl-2">
                                    <div class="progress mr-2" style="height: 5px;">
                                        <div class="progress-bar rounded-pill" role="progressbar" style="width: {{$pemesanan_berjalan[2][0]}}%" aria-valuenow="{{$pemesanan_berjalan[2][0]}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col pl-5 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl mr-3">
                                    <div class="avatar-name rounded-circle bg-soft-warning text-dark"><span class="fs-0 text-warning">D</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-dark text-decoration-none" href="#!">DIANTARKAN</a><span class="badge rounded-pill ml-2 bg-200 text-primary">{{$pemesanan_berjalan[3][0]}}%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pr-2">
                                    <div class="fs--1 font-weight-semi-bold">{{$pemesanan_berjalan[3][1]}}</div>
                                </div>
                                <div class="col-5 pr-card pl-2">
                                    <div class="progress mr-2" style="height: 5px;">
                                        <div class="progress-bar rounded-pill" role="progressbar" style="width: {{$pemesanan_berjalan[3][0]}}%" aria-valuenow="{{$pemesanan_berjalan[3][0]}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col pl-5 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl mr-3">
                                    <div class="avatar-name rounded-circle bg-soft-danger text-dark"><span class="fs-0 text-danger">S</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-dark text-decoration-none" href="#!">SELESAI</a><span class="badge rounded-pill ml-2 bg-200 text-primary">{{$pemesanan_berjalan[4][0]}}%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pr-2">
                                    <div class="fs--1 font-weight-semi-bold">{{$pemesanan_berjalan[4][1]}}</div>
                                </div>
                                <div class="col-5 pr-card pl-2">
                                    <div class="progress mr-2" style="height: 5px;">
                                        <div class="progress-bar rounded-pill" role="progressbar" style="width: {{$pemesanan_berjalan[4][0]}}%" aria-valuenow="{{$pemesanan_berjalan[4][0]}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col pl-5 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl mr-3">
                                    <div class="avatar-name rounded-circle bg-soft-danger text-dark"><span class="fs-0 text-danger">DT</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-dark text-decoration-none" href="#!">DITOLAK</a><span class="badge rounded-pill ml-2 bg-200 text-primary">{{$pemesanan_berjalan[5][0]}}%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pr-2">
                                    <div class="fs--1 font-weight-semi-bold">{{$pemesanan_berjalan[5][1]}}</div>
                                </div>
                                <div class="col-5 pr-card pl-2">
                                    <div class="progress mr-2" style="height: 5px;">
                                        <div class="progress-bar rounded-pill" role="progressbar" style="width: {{$pemesanan_berjalan[5][0]}}%" aria-valuenow="{{$pemesanan_berjalan[5][0]}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center py-2 position-relative border-bottom border-200">
                        <div class="col pl-5 py-1 position-static">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl mr-3">
                                    <div class="avatar-name rounded-circle bg-soft-danger text-dark"><span class="fs-0 text-danger">DB</span></div>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 d-flex align-items-center"><a class="text-dark text-decoration-none" href="#!">DIBATALKAN</a><span class="badge rounded-pill ml-2 bg-200 text-primary">{{$pemesanan_berjalan[6][0]}}%</span></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col py-1">
                            <div class="row flex-end-center g-0">
                                <div class="col-auto pr-2">
                                    <div class="fs--1 font-weight-semi-bold">{{$pemesanan_berjalan[6][1]}}</div>
                                </div>
                                <div class="col-5 pr-card pl-2">
                                    <div class="progress mr-2" style="height: 5px;">
                                        <div class="progress-bar rounded-pill" role="progressbar" style="width: {{$pemesanan_berjalan[6][0]}}%" aria-valuenow="{{$pemesanan_berjalan[6][0]}}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 mt-3">
            <div class="card shadow">
                <div class="card-header bg-white">
                    <div class="row flex-between-center">
                        <div class="col-6">
                            <h6 class="mb-0">
                                Pemesanan Terbanyak
                                <div class="spinner-border spinner-border-sm d-none" id="spinner_terbanyak_pemesanan" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </h6>
                        </div>
                        <div class="col-6 text-right">
                            <select class="form-control form-control-sm" id="tahun_pemesanan">
                                @foreach($_year as $item)
                                    <option value="{{$item->year}}">{{$item->year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body h-100 px-0 py-0">
                    <div id="echart_pemesanan_terbanyak" style="height: 65vh"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript">
       setItem('dashboard');
       $(document).ready(function () {
           getTTLPemesanan();
           getTerbanyakPemesanan();
       });

       function getTTLPemesanan() {
           $.ajax({
               type: "POST", data: {bulan:$('#bulan_pemesanan').val()},
               url: "{{ url('/api_grafik_pemesanan_bulan') }}", dataType: 'json',
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function(response)
               {
                   if (response.status === "OK"){
                       var data = [];
                       $.each(response.data, function (index,element) {
                           console.log(element.day+""+element.total);
                           data[index] = [element.day,element.total];
                       });
                       totalPemesanan(data);
                   } else {
                       swalWithBootstrapButtons.fire({icon: 'error', title: 'Oops...', text: response.message});
                   }
               },
               error:function(data){
                   swalWithBootstrapButtons.fire({icon: 'error', title: 'Oops...', text: "Terjadi kesalahan. Silahkan coba lagi..."});
               }
           });
       }

       function getTerbanyakPemesanan() {
           $.ajax({
               type: "POST", data: {tahun:$('#tahun_pemesanan').val()},
               url: "{{ url('/api_grafik_pemesanan_tahun') }}", dataType: 'json',
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function(response)
               {
                   if (response.status === "OK"){
                       var data = [];
                       var data_name = [];
                       console.log(response.data);
                       $.each(response.data, function (index,element) {
                           data_name[index] = element.nama_cv;
                           data[index] = element.total;
                       });
                       totalPemesanan_terbanyak(data,data_name);
                   } else {
                       swalWithBootstrapButtons.fire({icon: 'error', title: 'Oops...', text: response.message});
                   }
               },
               error:function(data){
                   swalWithBootstrapButtons.fire({icon: 'error', title: 'Oops...', text: "Terjadi kesalahan. Silahkan coba lagi..."});
               }
           });
       }

       function totalPemesanan(data) {
           var myChart = echarts.init(document.getElementById('echart_pemesanan'));
           // const data = [
           //     [1, 2],[4,6],[10,2],[15,18],[20,9],[25,8],[30,13]
           // ];
           var option = {
               title: {
                   text: ''
               },
               tooltip: {
                   padding: [7, 10],
                   backgroundColor: grays.white,
                   borderColor: grays['300'],
                   borderWidth: 1,
                   textStyle: {
                       color: colors.dark
                   },
                   transitionDuration: 0,
                   formatter: function (params) {
                       var data = params.data || [0, 0];
                       return data[0].toFixed(2) + ', ' + data[1].toFixed(2);
                   },
                   position: function position(pos, params, dom, rect, size) {
                       return getPosition(pos, params, dom, rect, size);
                   }
               },
               grid: {
                   containLabel: false,
                   right: '5%',
                   left: '8%',
                   bottom: '20%',
                   top: '10%'
               },
               xAxis: {
                   min: 1,
                   max: 30,
                   type: 'value',
                   boundaryGap: false,
                   axisPointer: {
                       lineStyle: {
                           color: grays['300'],
                           type: 'dashed'
                       }
                   },
                   splitLine: {
                       show: true
                   },
                   axisLine: {
                       lineStyle: {
                           // color: utils.grays['300'],
                           color: rgbaColor('#000', 0.01),
                           type: 'dashed'
                       },
                       onZero: true
                   },
                   axisTick: {
                       show: false
                   },
                   axisLabel: {
                       color: grays['400'],
                       formatter: function formatter(value) {
                           return "Tgl "+value;
                       },
                       margin: 15
                   }
               },
               yAxis: {
                   min: 0,
                   max: 40,
                   type: 'value',
                   axisLine: {
                       onZero: true,
                       show: false
                   },
                   axisPointer: {
                       show: false
                   },
                   splitLine: {
                       lineStyle: {
                           color: grays['300'],
                           type: 'dashed'
                       }
                   },
                   boundaryGap: false,
                   axisLabel: {
                       show: true,
                       color: grays['400'],
                       margin: 15
                   },
                   axisTick: {
                       show: false
                   }
               },
               series: [{
                   type: 'line',
                   smooth: false,
                   symbolSize: 10,
                   hoverAnimation: true,
                   data: data,
                   lineStyle: {
                       color: colors.primary
                   },
                   itemStyle: {
                       borderColor: colors.primary,
                       borderWidth: 2
                   },
                   areaStyle: {
                       color: {
                           type: 'linear',
                           x: 0,
                           y: 0,
                           x2: 0,
                           y2: 1,
                           colorStops: [{
                               offset: 0,
                               color: rgbaColor(colors.primary, 0.2)
                           }, {
                               offset: 1,
                               color: rgbaColor(colors.primary, 0)
                           }]
                       }
                   }
               }],
           };
           myChart.setOption(option);
       }
       function totalPemesanan_terbanyak(data,data_name) {

           var myChart = echarts.init(document.getElementById('echart_pemesanan_terbanyak'));

           // const data = [120, 200, 150, 80, 70];
           // const data_name = ['PT Cakra Mineral', 'PT Dino Logistik Perkasa', 'CKB Logistics', 'CV.NEW MANDIRI TRANS LOGISTIC', 'CV.KREATIF MAJU BERSAMA'];
           var option = {
               color: [colors.primary, grays['300']],
               tooltip: {
                   trigger: 'item',
                   padding: [7, 10],
                   backgroundColor: grays.white,
                   borderColor: grays['300'],
                   borderWidth: 1,
                   textStyle: {
                       color: colors.dark
                   },
                   transitionDuration: 0,
                   formatter: function formatter(params) {
                       return '<div class="fs--1 text-600"><strong>'+params.name+':</strong>'+params.data+'</div>';
                   }
               },
               legend: {
                   left: 'left',
                   itemWidth: 10,
                   itemHeight: 10,
                   borderRadius: 0,
                   icon: 'circle',
                   inactiveColor: grays['500'],
                   textStyle: {
                       color: grays['700']
                   }
               },
               xAxis: {
                   type: 'category',
                   data: data_name,
                   axisLabel: {
                       color: grays['400'],
                       interval: 0, rotate: 20
                   },
                   axisLine: {
                       lineStyle: {
                           color: grays['300'],
                           type: 'dashed'
                       }
                   },
                   axisTick: false,
                   boundaryGap: true,
               },
               yAxis: {
                   axisPointer: {
                       type: 'none'
                   },
                   axisTick: 'none',
                   splitLine: {
                       lineStyle: {
                           color: grays['300'],
                           type: 'dashed'
                       }
                   },
                   axisLine: {
                       show: false
                   },
                   axisLabel: {
                       color: grays['400']
                   }
               },
               series: [{
                   data: data,
                   type: 'bar',
                   barWidth: '12%',
                   barGap: '30%',
                   label: {
                       normal: {
                           show: false
                       }
                   },
                   z: 10,
                   itemStyle: {
                       normal: {
                           barBorderRadius: [10, 10, 0, 0],
                           color: colors.primary
                       }
                   }
               }],
               grid: {
                   right: '5%',
                   left: '8%',
                   bottom: '20%',
                   top: '10%'
               }
           };
           myChart.setOption(option);
       }
    </script>
@endsection
