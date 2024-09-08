<!-- Modal -->
<div class="modal fade-blur" id="exampleModal{{ $item->nim }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('anggota/' . $item->nim) }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama</label>
                            <input class="form-control" id="input" value="{{ $item->nama_lengkap }}"
                                name="nama_lengkap">
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input class="form-control" id="input" value="{{ $item->nim }}" name="nim">
                        </div>
                        <div class="form-group">
                            <label for="asal_kampus">Kampus</label>
                            <input class="form-control" id="input" value="{{ $item->asal_kampus }}"
                                name="asal_kampus">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">Nomor HP</label>
                            <input class="form-control" id="input" value="{{ $item->no_hp }}" name="no_hp">
                        </div>
                        <div class="form-group">
                            <label for="password">Ganti Password</label>
                            <input class="form-control" id="input" type="password" name="password">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
