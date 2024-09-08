@extends('layouts.app')
@section('content')
    <!-- Modal Tambah -->
    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambah" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Izin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('izin.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="status">Tanggal</label>
                            <input type="text" class="form-control" id="status" value="{{ date('Y-m-d') }}"
                                name="tgl_izin" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="" hidden>Izin / Sakit</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="ket" required></textarea>
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
                        Tambah Izin
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Pengajuan</th>
                                    <th>lihat</th>
                                </tr>
                            </thead>
                            @if (count($izin) > 0)
                                <tbody>
                                    @foreach ($izin as $item)
                                        <tr>
                                            <td>{{ $item->tgl_izin }}</td>
                                            <td>{{ $item->status }}</td>
                                            @if ($item->status_approved == 1)
                                                <td><span class="badge badge-success">Diterima</span></td>
                                            @elseif ($item->status_approved == 2)
                                                <td><span class="badge badge-danger">Ditolak</span></td>
                                            @else
                                                <td><span class="badge badge-warning">Menunggu</span></td>
                                            @endif
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-detail-{{ $item->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @include('users.izin.detail', ['item' => $item])
                                    @endforeach
                                </tbody>
                            @else
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center">Tidak ada data izin</td>
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
