@extends('admin.template')

@section('konten')
<div class="m-0 p-3">
    <div class="row">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Sopir</li>
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
                            <th>Nama</th>
                            <th>KD Sopir</th>
                            <th>Alamat</th>
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
                                            <img src="{{$item->foto_user}}" style="width: 100px;">
                                        @else
                                            <img src="{{asset('upload/user/'.$item->foto_user)}}" style="width: 100px;">
                                        @endif
                                    @endif
                                </td>
                                <td><a href="{{url('/admin/sopir_detail/'.$item->id_sopir)}}">{{$item->nama_user}}</a></td>
                                <td>{{$item->kd_sopir}}</td>
                                <td>{{$item->alamat_user}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger btn-block" onclick="ajax_delete('bank','{{$item->id_sopir}}')">HAPUS</button>
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
       setItem('sopir')
    </script>
@endsection
