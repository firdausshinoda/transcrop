@extends('admin.template')

@section('konten')
<div class="m-0 p-3">
    <div class="row">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin/jenis_kendaraan')}}">Jenis Kendaraan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
            <hr>
        </div>
        <div class="col-sm-12">
            <div class="card shadow-sm">
                <form id="formExecute">
                    <div class="card-header">
                        <h5><b>Tambah</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Jenis Kendaraan</label>
                            <input type="text" class="form-control" name="jenis_kendaraan" id="jenis_kendaraan" placeholder="Silahkan diisi...">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
                        <button onclick="history.back()" class="btn btn-sm btn-danger">BATAL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
       setItem('jenis_kendaraan');
        $(function() {
            $('#formExecute').validate({
                rules: {
                    jenis_kendaraan: { required: true, },
                },
                messages: {
                    jenis_kendaraan: { required: "Silahkan diisi..", },
                },
                errorElement : 'div',
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
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
                                var values = $('#formExecute').serialize();
                                $.ajax({
                                    type: "POST",data:values, url: "{{ url('/api_jenis_kendaraan_add') }}",
                                    dataType: 'json', headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    success: function(response) {
                                        if (response.status === "OK"){
                                            notif_success_with_url(response.data);
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
            });
        });
    </script>
@endsection
