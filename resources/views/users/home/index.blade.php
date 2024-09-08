@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ Auth::guard('peserta')->user()->nama_lengkap }}</h1>
                    <h4 class="m-0 text-secondary">{{ Auth::guard('peserta')->user()->asal_kampus }}</h4>
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
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('presensi.create') }}">
                        <div class="info-box bg-gradient-success">
                            @if ($presensihariini != null)
                                <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
                            @else
                                <span class="info-box-icon"><i class="fas fa-user"></i></span>
                            @endif

                            <div class="info-box-content">
                                <span class="info-box-text">Absensi Masuk</span>
                                <span class="badge badge-secondary">
                                    {{ $presensihariini != null ? $presensihariini->jam_in : 'Belum Absen' }}
                                </span>

                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('presensi.create') }}">
                        <div class="info-box bg-gradient-warning">
                            @if ($presensihariini != null && $presensihariini->jam_out != null)
                                <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
                            @else
                                <span class="info-box-icon"><i class="fas fa-user"></i></span>
                            @endif

                            <div class="info-box-content">
                                <span class="info-box-text">Absensi Pulang</span>
                                <span class="badge badge-secondary">
                                    {{ $presensihariini != null && $presensihariini->jam_out != null ? $presensihariini->jam_out : 'Belum Absen' }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('izin.index') }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-file-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Izin</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('kegiatan.index') }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calendar-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Kegiatan Harian</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>


            </div>
            <!-- /.row -->
            <div class="card-footer">
                <h5>Rekap Presensi {{ $namabulan[$bulanini] }} {{ $tahunini }}</h5>
                <div class="row">
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <h5 class="description-header">
                                <span class="description-percentage text-success">{{ $rekap_presensi->jmlhhadir }}</span>
                            </h5>
                            <span class="description-text">Hadir</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <h5 class="description-header">
                                @if ($rekap_izin->jmlhizin == null)
                                    <span class="description-percentage text-warning">0</span>
                                @else
                                    <span class="description-percentage text-warning">{{ $rekap_izin->jmlhizin }}</span>
                                @endif
                            </h5>
                            <span class="description-text">IZIN</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">

                            <h5 class="description-header">
                                @if ($rekap_izin->jmlhsakit == null)
                                    <span class="description-percentage text-secondary">0</span>
                                @else
                                    <span class="description-percentage text-secondary">{{ $rekap_izin->jmlhsakit }}</span>
                                @endif
                            </h5>
                            <span class="description-text">SAKIT</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">

                            @if ($rekap_presensi->jmlhterlambat == null)
                                <h5 class="description-header"><span class="description-percentage text-danger">0</span>
                                </h5>
                            @else
                                <h5 class="description-header"><span
                                        class="description-percentage text-danger">{{ $rekap_presensi->jmlhterlambat }}</span>
                                </h5>
                            @endif
                            <span class="description-text">TELAT</span>
                        </div>
                        <!-- /.description-block -->
                    </div>

                </div>
                <!-- /.row -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
@endsection
