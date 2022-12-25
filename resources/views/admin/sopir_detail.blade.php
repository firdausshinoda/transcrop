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
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label><b>Foto</b></label>
                            <div class="text-center">
                                @if(empty($data->foto_user))
                                    <img src="{{asset('img/ic_icon.png')}}" class="w-1" alt="Gambar Rusak">
                                @else
                                    @if($data->stt_login=="FB" || $data->stt_login=="GOOGLE")
                                        <img src="{{$data->foto_user}}" class="w-50" alt="Gambar Rusak">
                                    @else
                                        <img src="{{asset('upload/user/'.$data->foto_user)}}" class="w-50" alt="Gambar Rusak">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>Kode Pengguna</b></label>
                            <div class="form-control h-auto">{{$data->kd_user}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>NIK</b></label>
                            <div class="form-control h-auto h-min-input">{{$data->nik}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>Nama Pengguna</b></label>
                            <div class="form-control h-auto">{{$data->nama_user}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>E-mail</b></label>
                            <div class="form-control h-auto">{{$data->email_user}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>Jenis Kelamin</b></label>
                            <div class="form-control h-auto">{{$data->jenis_kelamin}}</div>
                        </div>
                        <div class="form-group col-sm-12 col-md-4">
                            <label><b>SIM</b></label>
                            <div class="form-control h-auto">{{$data->nama_sim}}</div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label><b>Pengalaman</b></label>
                            <div class="form-control h-auto h-min-textarea">{{$data->pengalaman}}</div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label><b>Alamat</b></label>
                            <div class="form-control h-auto h-min-textarea">{{$data->alamat_user}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
       setItem('sopir');
    </script>
@endsection
