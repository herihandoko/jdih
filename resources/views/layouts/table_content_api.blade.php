<table class="table table-fixed table-condensed td" width="100%" cellspacing="0" style="font-size: small;">
    <thead class="text-white" style="background-color: #11D694;">
        <tr>
            <th scope="col" style="width: 24%;">META</th>
            <th scope="col" style="width: 1%;"></th>
            <th scope="col" style="width: 75%;">KETERANGAN</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Jenis</td>
            <td>:</td>
            <td>{{ $produkHukumDetail->jenis }}</td>
        </tr>

        <tr>
            <td>Judul</td>
            <td>:</td>
            <td>{{ $produkHukumDetail->judul_peraturan }}</td>
        </tr>

        @if($produkHukumDetail->nomor)
        <tr>
            <td>Nomor Peraturan</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->nomor)
                    {{ $produkHukumDetail->nomor }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->no_panggil)
        <tr>
            <td>Nomor Panggil</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->no_panggil)
                    {{ $produkHukumDetail->no_panggil }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->tahun_pengundangan)
        <tr>
            <td>Tahun Pengundangan</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->tahun_pengundangan)
                    {{ $produkHukumDetail->tahun_pengundangan }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->tanggal_pengundangan)
        <tr>
            <td>Tanggal Pengundangan</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->tanggal_pengundangan)
                    {{ $produkHukumDetail->tanggal_pengundangan }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->singkatan_jenis)
        <tr>
            <td>Singkatan Jenis</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->singkatan_jenis)
                    {{ $produkHukumDetail->singkatan_jenis }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->tempat_terbit)
        <tr>
            <td>Tempat Terbit</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->tempat_terbit)
                    {{ $produkHukumDetail->tempat_terbit }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->penerbit)
        <tr>
            <td>Penerbit</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->penerbit)
                    {{ $produkHukumDetail->penerbit }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->deskripsi_fisik)
        <tr>
            <td>Deskripsi Fisik</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->deskripsi_fisik)
                    {{ $produkHukumDetail->deskripsi_fisik }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->sumber)
        <tr>
            <td>Sumber</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->sumber)
                    {{ $produkHukumDetail->sumber }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->subjek)
        <tr>
            <td>Subjek</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->subjek)
                    {{ $produkHukumDetail->subjek }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->isbn)
        <tr>
            <td>ISBN</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->isbn)
                    {{ $produkHukumDetail->isbn }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->bahasa)
        <tr>
            <td>Bahasa</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->bahasa)
                    {{ $produkHukumDetail->bahasa }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->bidang_hukum)
        <tr>
            <td>Bidang Hukum</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->bidang_hukum)
                    {{ $produkHukumDetail->bidang_hukum }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->teu_badan)
        <tr>
            <td>TEU Badan</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->teu_badan)
                    {{ $produkHukumDetail->teu_badan }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->nomor_induk_buku)
        <tr>
            <td>Nomor Induk Buku</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->nomor_induk_buku)
                    {{ $produkHukumDetail->nomor_induk_buku }}
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>
        @endif

        @if($produkHukumDetail->status_akhir)
        <tr>
            <td>Status</td>
            <td>:</td>
            @if($produkHukumDetail->status_akhir == 'BERLAKU')
                <td><font class="btn-success btn-sm" style="font-weight: 600;">{{ $produkHukumDetail->status_akhir }}</font></td>
            @elseif($produkHukumDetail->status_akhir == 'TIDAK BERLAKU')
                <td><font class="btn-danger btn-sm" style="font-weight: 600;">{{ 'Tidak Berlaku' }}</font></td>
            @else
                <td><font class="btn-primary btn-sm" style="font-weight: 600;">{{ '-' }}</font></td>
            @endif
        </tr>
        @endif

    </tbody>
</table>