@extends('admin.template')

@section('konten')
<div class="m-0 p-3">
    <div class="row">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Jenis SIM</li>
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
                            <th>SIM</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->nama_sim}}</td>
                                <td>{{$item->keterangan}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{url('admin/jenis_sim_ubah/'.$item->id_sim)}}" type="button" class="btn btn-sm btn-primary btn-block">UBAH</a>
                                    <button type="button" class="btn btn-sm btn-danger btn-block" onclick="ajax_delete('bank','{{$item->id_sim}}')">HAPUS</button>
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
<a href="{{url('/admin/jenis_sim_tambah')}}" class="btn btn-default btn-lg btn-floating shadow rounded-circle">
    <i class="fa fa-plus floating-icon"></i>
</a>
@endsection

@section('js')
    <script type="text/javascript">
        $('#dt_table').DataTable();
       setItem('jenis_sim')
    </script>
@endsection
