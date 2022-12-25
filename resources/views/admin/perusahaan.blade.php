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
                    <table id="dt_table" class="table table-striped" width="100%">
                        <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama Perusahaan</th>
                            <th>Deskripsi</th>
                            <th>Alamat</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><img src="{{asset('upload/cv/'.$item->foto_cv)}}" style="width: 100px;"></td>
                                <td><a href="{{url('/admin/perusahaan_detail/'.$item->id_cv)}}">{{$item->nama_cv}}</a></td>
                                <td>{{substr($item->deskripsi_cv, 0 ,200)}}...</td>
                                <td>{{$item->alamat_cv}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger btn-block" onclick="ajax_delete('bank','{{$item->id_cv}}')">HAPUS</button>
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
       setItem('perusahaan')
    </script>
@endsection
