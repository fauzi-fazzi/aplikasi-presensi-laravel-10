@extends('layouts.app')
@section('content')
    <style>
        .webcam-capture,
        .webcam-capture video {
            display: inline-block;
            width: 100% !important;
            margin: auto;
            height: 100% !important;
            border-radius: 15px;
        }

        #map {
            height: 180px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">

            <!-- =========================================================== -->
            <h5 class="mt-4 mb-2"></h5>
            <div class="row justify-content-center mb-2">
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-center">
                            <h3 class="card-title text-center">Absensi</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div id="map"></div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <input type="text" id="lokasi" name="lokasi" class="form-control">
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="webcam-capture">

                                    </div>
                                </div>
                            </div>
                            @if ($cek > 0)
                                <div class="card-footer d-flex justify-content-center">
                                    <button id="takebasen" class="btn btn-warning"><i class="fas fa-camera"></i> Absen
                                        Pulang</button>
                                </div>
                            @else
                                <div class="card-footer d-flex justify-content-center">
                                    <button id="takebasen" class="btn btn-primary"><i class="fas fa-camera"></i> Absen
                                        Masuk</button>
                                </div>
                            @endif
                        </div>

                        <!-- /.card-body -->


                    </div>
                    <!-- /.card -->
                </div>


            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
@endsection

@push('scripts')
    <script>
        Webcam.set({
            width: 480,
            height: 640,
            image_format: 'jpeg',
            jpeg_quality: 80
        });

        Webcam.attach('.webcam-capture');


        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(position) {
            lokasi.value = position.coords.latitude + ',' + position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 18);
            var lokasi_tempat = "{{ $lok_tempat->lokasi_tempat }}";
            var lok = lokasi_tempat.split(',');
            var lat_tempat = lok[0];
            var long_tempat = lok[1];
            var radius = "{{ $lok_tempat->radius }}";
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            var circle = L.circle([lat_tempat, long_tempat], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: radius
            }).addTo(map);
        }

        function errorCallback(error) {
            // lokasi.value = 'Unable to retrieve your location';
        }

        $("#takebasen").click(function(e) {
            Webcam.snap(function(uri) {
                var image = uri;
                var lokasi = $('#lokasi').val();
                $.ajax({
                    url: "{{ route('presensi.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        image: image,
                        lokasi: lokasi,
                    },
                    cache: false,
                    success: function(respond) {
                        var status = respond.split("|");
                        if (status[0] == 'success') {
                            Swal.fire({
                                title: 'Berhasil',
                                text: status[1],
                                icon: 'success',
                            })
                            setTimeout("location.href='{{ route('home') }}'", 2000);
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: status[1],
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                });
            });
        });
    </script>
@endpush
