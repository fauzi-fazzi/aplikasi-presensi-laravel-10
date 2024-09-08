@foreach ($presensi as $item)
    @php
        $foto_in = Storage::url('uploads/absensi/' . $item->foto_in);
        $foto_out = Storage::url('uploads/absensi/' . $item->foto_out);
    @endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ substr($item->nim, 0, 2) . '.' . substr($item->nim, 2, 1) . '.' . substr($item->nim, 3, 1) . '.' . substr($item->nim, 4) }}
        </td>
        <td>{{ $item->nama_lengkap }}</td>
        <td>{{ $item->jam_in }}</td>
        <td>
            <div class="text-center">
                <img src="{{ url($foto_in) }}" class="img-fluid" style="height: 50px; width: 50px; border-radius: 0"
                    alt="">
            </div>
        </td>
        <td>{!! $item->jam_out != null ? $item->jam_out : '<span class="badge badge-warning">Belum Absen</span>' !!}</td>
        <td>
            @if ($item->jam_out != null)
                <div class="text-center">
                    <img src="{{ url($foto_out) }}" class="img-fluid" style="height: 50px; width: 50px; border-radius: 0"
                        alt="">
                </div>
            @else
                <div class="image text-center">
                    <i class="fas fa-user fa-2x mt-3"></i>
                </div>
            @endif
        </td>
        <td>
            @if ($item->jam_in >= '07:00')
                <span class="badge badge-danger">Terlambat</span>
            @else
                <span class="badge badge-success">Tepat Waktu</span>
            @endif
        </td>
    </tr>
@endforeach
