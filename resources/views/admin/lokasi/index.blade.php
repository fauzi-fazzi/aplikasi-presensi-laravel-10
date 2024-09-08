@extends('layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Setting Lokasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Lokasi</li>
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
                            <form action="/setlokasi/update" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Lokasi</label>
                                    <input type="text" value="{{ $lok_tempat->lokasi_tempat }}" name="lokasi_tempat"
                                        id="lokasi" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Radius</label>
                                    <input type="text" value="{{ $lok_tempat->radius }}" name="radius" id="lokasi"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
