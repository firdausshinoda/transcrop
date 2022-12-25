@extends('admin.template')

@section('konten')
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
            <div class="card shadow-sm">
                <div class="card-body">
                    <table id="dt_table" class="table table-striped" width="100%">
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
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    @if(empty($item->foto_user))
                                        <img src="{{asset('img/ic_icon.png')}}" style="width: 100px;">
                                    @else
                                        @if($item->stt_login=="FB" || $item->stt_login=="GOOGLE")
                                            <img src="{{$item->foto_user}}" style="width: 100px;" alt="Gambar Rusak">
                                        @else
                                            <img src="{{asset('upload/user/'.$item->foto_user)}}" style="width: 100px;" alt="Gambar Rusak">
                                        @endif
                                    @endif
                                </td>
                                <td><a href="{{url('/admin/pemesanan_detail/'.$item->id_pemesanan)}}">{{$item->nama_user}}</a></td>
                                <td>{{$item->deskripsi_barang}}</td>
                                <td>{{$item->deskripsi_berangkat}}</td>
                                <td>{{$item->deskripsi_tujuan}}</td>
                                <td>{{$item->stt_pemesanan}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger btn-block" onclick="ajax_delete('bank','{{$item->id_pemesanan}}')">HAPUS</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        $('#dt_table').DataTable();
       setItem('pemesanan')
    </script>
@endsection
