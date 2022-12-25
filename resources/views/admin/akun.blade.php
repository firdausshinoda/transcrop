@extends('admin.template')

@section('konten')
    <div class="m-0 p-3">
        <div class="row">
            <div class="col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Akun</li>
                    </ol>
                </nav>
                <hr>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card shadow-sm">
                   <form id="formExecuteAkun">
                       <div class="card-header">
                           <h5>Ubah Akun</h5>
                       </div>
                       <div class="card-body">
                           <div class="form-group">
                               <label><b>Username</b></label>
                               <input type="text" class="form-control" id="username" name="username" value="{{\Illuminate\Support\Facades\Session::get('username')}}" placeholder="Masukkan username..."/>
                           </div>
                       </div>
                       <div class="card-footer text-right">
                           <button type="submit" class="btn btn-default">SIMPAN</button>
                       </div>
                   </form>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card shadow-sm">
                    <form id="formExecutePassword">
                        <div class="card-header">
                            <h5>Ubah Password</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label><b>Password Lama</b></label>
                                <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Masukkan password lama..."/>
                            </div>
                            <div class="form-group">
                                <label><b>Password baru</b></label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Masukkan password baru..."/>
                            </div>
                            <div class="form-group">
                                <label><b>Ulangi Password baru</b></label>
                                <input type="password" class="form-control" id="password_ulangi" name="password_ulangi" placeholder="Masukkan ulangi password baru..."/>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-default">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $('#formExecuteAkun').validate({
                rules: {
                    username: { required: true, },
                },
                messages: {
                    username: { required: "Silahkan diisi..", },
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
                                var values = $('#formExecuteAkun').serialize();
                                $.ajax({
                                    type: "POST",data:values, url: "{{ url('/api_akun_update') }}",
                                    dataType: 'json', headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    success: function(response) {
                                        if (response.status === "OK"){
                                            notif_success_with_reload()
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
            $('#formExecutePassword').validate({
                rules: {
                    password_lama: { required: true, minlength: 6, },
                    password_baru: { required: true, minlength: 6,  },
                    password_ulangi: { required: true, minlength: 6,  equalTo: "#password_baru" },
                },
                messages: {
                    password_lama: { required: "Silahkan diisi..", minlength: "Minimal 6 karakter..", },
                    password_baru: { required: "Silahkan diisi..", minlength: "Minimal 6 karakter..", },
                    password_ulangi: { required: "Silahkan diisi..", minlength: "Minimal 6 karakter..", equalTo: "Password tidak sama.." },
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
                                var values = $('#formExecutePassword').serialize();
                                $.ajax({
                                    type: "POST",data:values, url: "{{ url('/api_password_update') }}",
                                    dataType: 'json', headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    success: function(response) {
                                        if (response.status === "OK"){
                                            notif_success_with_reload()
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
