@foreach ($kegiatan as $item)
    @php
        $foto = Storage::url($item->foto);
    @endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ substr($item->nim, 0, 2) . '.' . substr($item->nim, 2, 1) . '.' . substr($item->nim, 3, 1) . '.' . substr($item->nim, 4) }}
        </td>
        <td>{{ $item->nama_lengkap }}</td>
        <td>{{ $item->nama_kegiatan }}</td>
        <td>
            <div class="text-center">
                <img src="{{ url($foto) }}" class="img-fluid" style="height: 50px; width: 50px; border-radius: 0"
                    alt="">
            </div>
        </td>
    </tr>
@endforeach
