@extends('layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Monitoring Kegiatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Kegiatan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" id="tanggal" value="{{ date('Y-m-d') }}" name="tanggal"
                                            class="form-control" placeholder="Tanggal Presensi " autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th style="width: 10px">No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Kegiatan</th>
                                            <th>Foto</th>
                                        </thead>
                                        <tbody id="loadkegiatan"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(function() {
            function loadkegiatan() {
                var tanggal = $("#tanggal").val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('getkegiatan') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggal: tanggal
                    },
                    cache: false,
                    success: function(respond) {
                        $('#loadkegiatan').html(respond);
                    }
                });
            }
            $('#tanggal').change(function(e) {
                loadkegiatan();
            });
            loadkegiatan();
        });
    </script>
@endpush
