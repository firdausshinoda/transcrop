@extends('admin.template')

@section('konten')
<div class="m-0 p-3">
    <div class="row">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
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
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->deskripsi}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <a href="{{url('admin/pengaturan_ubah/'.$item->id_pengaturan)}}" type="button" class="btn btn-sm btn-primary btn-block">UBAH</a>
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
       setItem('pengaturan')
    </script>
@endsection
