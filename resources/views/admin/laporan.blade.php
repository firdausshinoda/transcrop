@extends('admin.template')

@section('konten')
    <div class="m-0 p-3">
        <div class="row">
            <div class="col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Laporan Statistik</li>
                    </ol>
                </nav>
                <hr>
            </div>
            <div class="col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6>Pilihan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-12 col-md-6">
                                <label>Tanggal Dari</label>
                                <input type="text" class="form-control form-control-sm datepicker" id="tgl_dari" name="tgl_dari" required>
                            </div>
                            <div class="form-group col-sm-12 col-md-6">
                                <label>Tanggal Sampai</label>
                                <input type="text" class="form-control form-control-sm datepicker" id="tgl_sampai" name="tgl_sampai" required>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" onclick="cari()" class="btn btn-sm btn-primary btn-block">TAMPILKAN</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-3">
                    <div class="card-header">
                        <div class="dropdown float-right">
                            <a class="dropdown-toggle nav-link text-dark" id="dropdown-print" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-print"></i> Cetak
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-print">
                                <a class="dropdown-item" target="_blank" href="{{url('admin/cetak_statistik_pemesanan').$filter}}">Excel</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="dt_table" class="table table-striped w-100">
                            <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Pemesanan</th>
                                <th>Barang</th>
                                <th>Alamat Jemput</th>
                                <th>Alamat Tujuan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            setItem('laporan');
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd",
                todayHighlight: true,
                autoclose: true
            }).attr("readonly", "readonly").css({"cursor":"pointer", "background":"white"});

            $('#dt_table').DataTable({
                processing: true, responsive:true, pagingType: "full_numbers", serverSide: true,destroy: true,
                ajax: {
                    url: "{{ url('/tbl_laporan_pemesanan') }}",
                    data: function (d) {
                        d.tgl_dari = $('#tgl_dari').val();
                        d.tgl_sampai = $('#tgl_sampai').val();
                    },
                    dataFilter: function(response){
                        return response
                    },
                },
                language : {"url" : "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"},
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { "render": function ( data, type, row ) {
                        if (row.stt_login==="FB" || row.stt_login === "GOOGLE") {
                            return '<img src="'+row.foto_user+'" alt="Gambar Rusak"/>'
                        } else {
                            return '<img src="{{asset('upload/user')}}/'+row.foto_user+'" alt="Gambar Rusak"/>'
                        }
                    }},
                    { "render": function ( data, type, row ) {
                        return '<a href="{{url('admin/pemesanan_detail')}}/'+row.id_pemesanan+'" target="_blank">'+row.nama_user+'</a>';
                    }},
                    {data: 'deskripsi_barang', name: 'deskripsi_barang'},
                    {data: 'deskripsi_berangkat', name: 'deskripsi_berangkat'},
                    {data: 'deskripsi_tujuan', name: 'deskripsi_tujuan'},
                    {data: 'stt_pemesanan', name: 'stt_pemesanan'},
                    { "render": function ( data, type, row ) {return moment(row.created_at).fromNow();}},
                ]
            });
        });

        function cari() {
            $('#dt_table').DataTable().ajax.reload();
        }
    </script>
@endsection
