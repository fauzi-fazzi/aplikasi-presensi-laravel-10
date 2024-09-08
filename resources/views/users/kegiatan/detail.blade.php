<!-- Modal -->
<div class="modal fade" id="modal-detail-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modal-detail-{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Tanggal</label>
                        <input type="text" class="form-control" id="status" value="{{ $item->tgl_kegiatan }}"
                            name="tgl_kegiatan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kegiatan">Kegiatan</label>
                        <textarea class="form-control" id="kegiatan" name="kegiatan" readonly>{{ $item->nama_kegiatan }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <div class="avatar">

                            <img src="{{ Storage::url($item->foto) }}" class="img-fluid" alt="Responsive image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modal-detail-{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ url('kegiatan/' . $item->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Tanggal</label>
                        <input type="date" class="form-control" id="status" value="{{ $item->tgl_kegiatan }}"
                            name="tgl_kegiatan">
                    </div>
                    <div class="form-group">
                        <label for="kegiatan">Kegiatan</label>
                        <textarea class="form-control" id="kegiatan" name="nama_kegiatan">{{ $item->nama_kegiatan }}</textarea>
                    </div>
                    <div class="avatar">

                        <img src="{{ Storage::url($item->foto) }}" class="img-fluid" width="70px"
                            alt="Responsive image">
                    </div>
                    <br>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" id="customFile">
                        <label class="custom-file-label" for="customFile">Pilih foto</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
