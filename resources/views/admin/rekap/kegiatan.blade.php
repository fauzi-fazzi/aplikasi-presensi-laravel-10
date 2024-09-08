@extends('layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rekap Kegiatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Rekap Kegiatan</li>
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
                            <form action="/cetakkegiatan" method="POST">
                                @csrf
                                <div class="form-group">
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>
                                                {{ $namabulan[$i] }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value="">tahun</option>
                                        @php
                                            $tahunmulai = 2023;
                                            $tahunskrg = date('Y');
                                        @endphp
                                        @for ($tahun = $tahunmulai; $tahun <= $tahunskrg; $tahun++)
                                            <option value="{{ $tahun }}" {{ date('Y') == $tahun ? 'selected' : '' }}>
                                                {{ $tahun }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Cetak</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
