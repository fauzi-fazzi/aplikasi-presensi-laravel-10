@extends('layouts.main')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Izin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Data Izin</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="page-body">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Tanggal</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Pengajuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($izinsakit as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ date('d-m-Y', strtotime($d->tgl_izin)) }}</td>
                                            <td>{{ substr($d->nim, 0, 2) . '.' . substr($d->nim, 2, 1) . '.' . substr($d->nim, 3, 1) . '.' . substr($d->nim, 4) }}
                                            </td>
                                            <td>{{ $d->nama_lengkap }}</td>
                                            <td>{{ $d->status }}</td>
                                            <td>{{ $d->ket }}</td>
                                            <td>
                                                @if ($d->status_approved == 1)
                                                    <span class="badge badge-success">Disetujui</span>
                                                @elseif ($d->status_approved == 2)
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @else
                                                    <span class="badge badge-warning">Menunggu</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($d->status_approved == 0)
                                                    <a id_izin="{{ $d->id }}"
                                                        class="btn-approve btn-primary btn-sm"><i
                                                            class="fas fa-external-link-square-alt"></i></a>
                                                @else
                                                    <a href="/pengajuanizin/{{ $d->id }}/batalkan"
                                                        class="btn btn-danger btn-sm"><i
                                                            class="fas fa-window-close"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-labelledby="modal-detail-Label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-tittle">Izin / Sakit</h5>
                </div>
                <form action="{{ url('/pengajuanizin/sakit') }}" method="POST">
                    @csrf
                    <input type="text" hidden name="id_izinsakit_form" id="id_izinsakit_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control" name="status_approved" id="status_approved">
                                <option value="1">Disetujui</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('.btn-approve').click(function(e) {
                e.preventDefault();
                var id_izin = $(this).attr('id_izin');
                $('#id_izinsakit_form').val(id_izin);
                $('#modal-izinsakit').modal('show');
            });
        });
    </script>
@endpush
