@extends('dashboard.template')

@section('konten')
    <section id="index-page-top" class="bg-map">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-8" style="margin-top: 20vh;">
                    <h1 class="text-black"><b>TransCrop</b></h1>
                    <p class="text-justify text-black pt-3" style="font-size: 18px"><?= $tentang; ?></p>
                </div>
                <div class="col-12 col-sm-4 text-center">
                    <img src="{{asset('img/icon-apps.png')}}" style="height: 70vh;margin-top: 20vh;">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#li-tentang').addClass("active");
        });
    </script>
@endsection
