@extends('layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Peserta Magang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Anggota</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Kampus</th>
                                        <th>No HP</th>
                                        <th style="width: 60px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggota as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + $anggota->firstItem() - 1 }}
                                            </td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ substr($item->nim, 0, 2) . '.' . substr($item->nim, 2, 1) . '.' . substr($item->nim, 3, 1) . '.' . substr($item->nim, 4) }}
                                            </td>
                                            <td>{{ $item->asal_kampus }}</td>
                                            <td>{{ $item->no_hp }}</td>
                                            <td class="d-flex justify-content-center">
                                                <button type="button" class="btn-edit btn-warning btn-sm mr-1"
                                                    data-toggle="modal" data-target="#exampleModal{{ $item->nim }}"><i
                                                        class="fas fa-edit"></i></button>
                                                <form action="{{ url('anggota/' . $item->nim) }}" method="POST"
                                                    class="d-inline"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @include('admin.anggota.edit')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                            </ul>
                            {{ $anggota->links() }}
                        </div>
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
        </div>
    </section>
@endsection
@push('scripts')
@endpush
