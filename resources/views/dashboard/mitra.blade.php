@extends('dashboard.template')

@section('konten')
    <section id="index-page-top" class="bg-map">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6" style="margin-top: 35vh;">
                    <h1 class="text-black"><b>Gabung Sebagai Mitra!</b></h1>
                    <p class="text-justify text-black">{{$mitra}}</p>
                    <img src="{{asset('img/google-play-store.png')}}" class="w-25">
                </div>
                <div class="col-12 col-sm-6 text-center">
                    <img src="{{asset('img/icon-apps.png')}}" style="height: 70vh;margin-top: 20vh;">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#li-mitra').addClass("active");
        });
    </script>
@endsection
