<!-- Modal -->
<div class="modal fade" id="modal-detail-{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modal-detail-{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Tanggal</label>
                        <input type="text" class="form-control" id="status" value="{{ $item->tgl_izin }}"
                            name="tgl_izin" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input class="form-control" id="status" value="{{ $item->status }}" name="status" readonly>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="ket" readonly>{{ $item->ket }}</textarea>
                    </div>
                    <div class="form-group">
                        @if ($item->status_approved == 1)
                            <span class="badge badge-success">Diterima</span>
                        @elseif ($item->status_approved == 2)
                            <span class="badge badge-danger">Ditolak</span>
                        @else
                            <span class="badge badge-warning">Menunggu</span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
