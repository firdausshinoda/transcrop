@extends('admin.template')

@section('konten')
<div class="m-0 p-3">
    <div class="row">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/admin/bank')}}">Bank</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
            <hr>
        </div>
        <div class="col-sm-12">
            <div class="card shadow-sm">
                <form id="formExecute" enctype="multipart/form-data">
                    <div class="card-header">
                        <h3>Tambah Bank</h3>
                    </div>
                    <div class="card-body row">
                        <div class="form-group col-sm-12">
                            <label><b>Foto</b> <code>Max 1Mb</code></label>
                            <div class="text-center">
                                <img src="{{asset('img/empty.jpg')}}" class="w-50" id="PreviewImg">
                            </div>
                            <div class="custom-file mt-3" id="view_upload_paper">
                                <input type="file" class="custom-file-input" id="foto_bank" name="foto_bank" onchange="PreviewImagesp();"/>
                                <label class="custom-file-label text-default" for="ful_paper">CARI FOTO</label>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>Nama Bank</b></label>
                            <input type="text" class="form-control" id="nama_bank" name="nama_bank" placeholder="Masukkan nama bank..."/>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>Atas Nama Bank</b></label>
                            <input type="text" class="form-control" id="an_bank" name="an_bank" placeholder="Masukkan atas nama bank..."/>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>No Rekening</b></label>
                            <input type="text" class="form-control" id="norek_bank" name="norek_bank" placeholder="Masukkan no rekening..."/>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-sm btn-default">SIMPAN</button>
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
       setItem('bank');
       function PreviewImagesp() {
           var oFReader = new FileReader();
           oFReader.readAsDataURL(document.getElementById("foto_bank").files[0]);
           oFReader.onload = function (oFREvent) {
               document.getElementById("PreviewImg").src = oFREvent.target.result;
           };
       }
       $(function() {
           $('#formExecute').validate({
               rules: {
                   nama_bank: { required: true, }, an_bank: {required: true, }, norek_bank: {required: true, },
                   foto_bank: {required: true, extension: "png|jpeg|jpg|PNG|JPEG|JPG", filesize: 1000000, },
               },
               messages: {
                   nama_bank: { required: "Silahkan diisi...", }, an_bank: { required: "Silahkan diisi..." }, norek_bank: { required: "Silahkan diisi..." },
                   foto_bank: { required: "Silahkan dipilih...", extension: "Hanya PNG , JPEG , JPG...", },
               },
               errorElement : 'div', errorPlacement: function(error, element) {
                   var placement = $(element).data('error');
                   if (placement) {$(placement).append(error)} else {error.insertAfter(element);}
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
                               var values = new FormData();
                               values.append('foto_bank', $("#foto_bank")[0].files[0]);
                               values.append("nama_bank",$('#nama_bank').val());
                               values.append("an_bank",$('#an_bank').val());
                               values.append("norek_bank",$('#norek_bank').val());
                               $.ajax({
                                   type: "POST",data:values, url: "{{ url('/api_bank_add') }}",
                                   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                   dataType: 'json', processData: false, contentType: false,
                                   success: function(response) {
                                       if (response.status === "OK"){
                                           notif_success_with_url(response.data);
                                       } else {
                                           swalWithBootstrapButtons.fire({icon: 'error', title: 'Oops...', text: response.message});
                                       }
                                   },
                                   error:function(response){
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
