@extends('admin.template')

@section('konten')
<div class="m-0 p-3">
    <div class="row">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Notifikasi</li>
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
                                    <button type="button" onclick="konfirmasi({{$item->id_cv}})" class="btn btn-sm btn-primary btn-block">KONFIRMASI</button>
                                    <a href="{{url('/admin/notifikasi_tolak/'.$item->id_cv)}}" class="btn btn-sm btn-danger btn-block">TOLAK</a>
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
       setItem('notifikasi');
        function konfirmasi(id) {
            swalWithBootstrapButtons.fire({
                text: 'Apakah anda yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve) {
                        $.ajax({
                            type: "POST",data:{id:id}, url: "{{ url('/api_notifikasi_konfirmasi') }}",
                            dataType: 'json', headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(response) {
                                if (response.status === "OK"){
                                    notif_success_with_reload();
                                } else {
                                    swalWithBootstrapButtons.fire({icon: 'error', title: 'Oops...', text: response.message});
                                }
                            },
                            error:function(data){
                                swalWithBootstrapButtons.fire({icon: 'error', title: 'Oops...', text: "Terjadi kesalahan. Silahkan coba lagi..."});
                            }
                        });
                    })
                },
                allowOutsideClick: false,
            });
        }
    </script>
@endsection
