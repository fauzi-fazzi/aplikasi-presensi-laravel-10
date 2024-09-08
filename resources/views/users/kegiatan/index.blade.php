@extends('layouts.app')
@section('content')
    <!-- Modal Tambah -->
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambah" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="status">Tanggal</label>
                            <input type="text" class="form-control" id="status" value="{{ date('Y-m-d') }}"
                                name="tgl_kegiatan" readonly>
                        </div>
                        <div class="form-group">
                            <label for="kegiatan">Kegiatan</label>
                            <textarea class="form-control" id="kegiatan" name="nama_kegiatan" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Tambah -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="content-header">
        <div class="container-fluid">
            <div class="clearfix">
                <div class="float-right mb-3 mr-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                        Tambah Kegiatan
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kegiatan</th>
                                    <th>Foto</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($kegiatan) > 0)
                                    @foreach ($kegiatan as $item)
                                        <tr>
                                            <td>{{ $item->tgl_kegiatan }}</td>
                                            <td>{{ $item->nama_kegiatan }}</td>
                                            <td>
                                                @if ($item->foto)
                                                    <img src="{{ Storage::url($item->foto) }}" alt="Foto Kegiatan"
                                                        width="70">
                                                @else
                                                    Tidak ada foto
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-primary btn-sm mr-1"
                                                        data-toggle="modal" data-target="#modal-detail-{{ $item->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn-edit btn-warning btn-sm mr-1"
                                                        data-toggle="modal" data-target="#modal-edit-{{ $item->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ url('kegiatan/' . $item->id) }}" method="POST"
                                                        class="d-inline"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('users.kegiatan.detail', ['item' => $item])
                                    @endforeach
                            </tbody>
                        @else
                            <tbody>
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada kegiatan</td>
                                </tr>
                            </tbody>
                            @endif
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>
@endsection
