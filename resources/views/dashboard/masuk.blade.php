@extends('dashboard.template')

@section('konten')
    <section id="index-page-top" class="bg-map">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 text-center">
                    <img src="{{asset('img/icon-apps.png')}}" style="height: 70vh;margin-top: 20vh;">
                </div>
                <div class="col-12 col-sm-6" style="margin-top: 30vh;">
                    @if ($message = Session::get('message'))
                        <?= $message; ?>
                    @endif
                    <div class="card">
                        <form id="formExecute">
                            @csrf
                            <div class="card-body">
                                <h5 class="text-center"><b>MASUK</b></h5>
                                <hr/>
                                <div class="form-group">
                                    <label>USERNAME</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username...">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password...">
                                </div>
                                <button type="submit" class="btn btn-default btn-block">MASUK</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#li-masuk').addClass("active");
        });
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {confirmButton: 'btn btn-success m-1', cancelButton: 'btn btn-danger m-1'},
            buttonsStyling: false
        });
        $(function() {
            $('#formExecute').validate({
                rules: {
                    username: { required: true, },password: { required: true, },
                },
                messages: {
                    username: { required: "Silahkan diisi..", },password: { required: "Silahkan diisi..", },
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
                                    type: "POST",data:values, url: "{{ url('/api_login') }}",
                                    dataType: 'json', headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    success: function(response) {
                                        if (response.status === "OK"){
                                            window.location.replace(response.data);
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
