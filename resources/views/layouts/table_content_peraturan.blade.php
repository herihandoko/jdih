<table class="table table-striped">
	<thead class="text-white" style="background-color: #11D694;">
        <tr>
            <th scope="col" style="width: 220px;">META</th>
            <th scope="col">KETERANGAN</th>
        </tr>
    </thead>

    <tbody>
    	<tr>
            <td>Tipe Dokumen</td>
            <td>{{ $produkHukumDetail->produk_hukum_categories->category_name }}</td>
        </tr>

        <tr>
            <td>Jenis peraturan</td>
            <td>{{ $produkHukumDetail->produk_hukum_types->type_name }}</td>
        </tr>

        <tr>
            <td>Judul</td>
            <td>{{ $produkHukumDetail->judul_peraturan }}</td>
        </tr>

        <tr>
            <td>Nomor Peraturan</td>
            <td>
                @if($produkHukumDetail->nmr_peraturan)
                    {{ $produkHukumDetail->nmr_peraturan }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Tahun Peraturan</td>
            <td>
                @if($produkHukumDetail->thn_peraturan)
                    {{ $produkHukumDetail->thn_peraturan }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Singkatan Jenis Peraturan</td>
            <td>
                @if($produkHukumDetail->singkatan_peraturan)
                    {{ $produkHukumDetail->singkatan_peraturan }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Lokasi</td>
            <td>
                @if($produkHukumDetail->instansi)
                    {{ $produkHukumDetail->instansi }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Tanggal Pengajuan</td>
            <td>
                @if($produkHukumDetail->tgl_pengajuan)
                    {!! date('d-m-Y', strtotime($produkHukumDetail->tgl_pengajuan)) !!}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Tanggal Pembahasan</td>
            <td>
                @if($produkHukumDetail->tgl_pembahasan)
                    {{ $produkHukumDetail->tgl_pembahasan }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Tempat Penetapan</td>
            <td>
               @if($produkHukumDetail->tempat_penetapan)
                    {{ $produkHukumDetail->tempat_penetapan }}
               @else
                    {{ '-' }}
               @endif
            </td>
        </tr>

        <tr>
            <td>Tanggal Penetapan</td>
            <td>
                @if($produkHukumDetail->tgl_penetapan)
                    {!! date('d-m-Y', strtotime($produkHukumDetail->tgl_penetapan)) !!}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Tanggal Pengundangan</td>
            <td>
                @if($produkHukumDetail->tgl_pengundangan)
                    {!! date('d-m-Y', strtotime($produkHukumDetail->tgl_pengundangan)) !!}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Sumber</td>
            <td>
                @if($produkHukumDetail->sumber)
                    {{ $produkHukumDetail->sumber }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Subjek</td>
            <td>
                @if($produkHukumDetail->subjek)
                    {{ $produkHukumDetail->subjek }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Status Akhir</td>
             @if($produkHukumDetail->status_akhir == 'Berlaku')
                <td><font class="btn-success btn-sm" style="font-weight: 600;">{{ $produkHukumDetail->status_akhir }}</font></td>
            @elseif($produkHukumDetail->status_akhir == 'Diubah')
                <td><font class="btn-primary btn-sm" style="font-weight: 600;">{{ $produkHukumDetail->status_akhir }}</font></td>
            @elseif($produkHukumDetail->status_akhir == 'Mengubah')
                <td><font class="btn-primary btn-sm" style="font-weight: 600;">{{ $produkHukumDetail->status_akhir }}</font></td>
            @elseif($produkHukumDetail->status_akhir == 'Dicabut')
                <td><font class="btn-warning btn-sm" style="font-weight: 600;">{{ $produkHukumDetail->status_akhir }}</font></td>
            @elseif($produkHukumDetail->status_akhir == 'Mencabut')
                <td><font class="btn-warning btn-sm" style="font-weight: 600;">{{ $produkHukumDetail->status_akhir }}</font></td>
            @elseif($produkHukumDetail->status_akhir == 'Tidak Berlaku')
                <td><font class="btn-danger btn-sm" style="font-weight: 600;">{{ 'Tidak Berlaku' }}</font></td>
            @else
                <td><font class="btn-success btn-sm" style="font-weight: 600;">{{ 'Berlaku' }}</font></td>
            @endif
        </tr>

        <tr>
            <td>Catatan Status</td>
            <td>
                @if($produkHukumDetail->catatan_status)
                    {{ $produkHukumDetail->catatan_status }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Urusan Pemerintahan</td>
            <td>
                @if($produkHukumDetail->urusan)
                    {{ $produkHukumDetail->up_name }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Bidang Hukum</td>
            <td>
                @if($produkHukumDetail->bidang_hukum)
                    {{ $produkHukumDetail->bh_name }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Bahasa</td>
            <td>
                @if($produkHukumDetail->bahasa)
                    {{ $produkHukumDetail->bahasa }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>TEU Badan</td>
            <td>
                @if($produkHukumDetail->teu_badan)
                    {{ $produkHukumDetail->teu_badan }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Pemrakarsa</td>
            <td>
                @if($produkHukumDetail->pemrakarsa)
                    {{ $produkHukumDetail->pemrakarsa }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>File Peraturan</td>
            <td>
                @if($produkHukumDetail->file_peraturan)
                <a target="_blank" href="{{ url('storage/places/peraturan/'.$produkHukumDetail->file_peraturan) }}">
                        <i class="fas fa-file-pdf" style="color: red;"></i>
                        {{ $produkHukumDetail->file_peraturan }}
                    </a>
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Abstrak</td>
            <td>
                @if($produkHukumDetail->abstrak)
                    <a target="_blank" href="{{ url('storage/places/peraturan/'.$produkHukumDetail->abstrak) }}">
                        <i class="fas fa-file-pdf" style="color: red;"></i>
                        {{ $produkHukumDetail->abstrak }}
                    </a>
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Peraturan Terkait</td>
            <td>
                @if(count($produkHukumDocument) != 0)
                    @php
                        $menu = new App\Models\Admin\Menu;
                    @endphp
                    @for($i = 0; $i < count($produkHukumDocument); $i++)
                        <ul>
                            <li>
                                @php
                                    $slugJnsPeraturan = $menu::where('type_ruledoc', '=', $produkHukumDocument[$i]->produk_hukum_types_id)->get();
                                @endphp
                                <a href="{{ url('produkhukum/'.$slugJnsPeraturan[0]->slug.'/'.$produkHukumDocument[$i]->slug) }}">
                                    {{ $produkHukumDocument[$i]->judul_peraturan }}
                                </a>
                            </li>
                        </ul>
                    @endfor
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Dokumen Terkait</td>
            <td>
                @if(count($produkHukumDocument) != 0)
                    @for($i = 0; $i < count($produkHukumDocument); $i++)
                        <ul>
                            <li>
                                <a target="_blank" href="{{ url('storage/places/peraturan/'.$produkHukumDocument[$i]->file_peraturan) }}">
                                    {{ $produkHukumDocument[$i]->file_peraturan }}
                                </a>
                            </li>
                        </ul>
                    @endfor
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Hasil Uji MK</td>
            <td>
                @if($produkHukumDetail->hasil_uji)
                    {{ $produkHukumDetail->hasil_uji }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
    </tbody>
</table>