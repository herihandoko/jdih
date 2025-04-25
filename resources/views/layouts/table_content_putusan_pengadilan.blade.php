<table class="table table-fixed table-condensed table-striped shadow" width="100%" cellspacing="0" style="font-size: small;">
    <thead class="text-white" style="background-color: #11D694;">
        <tr>
            <th scope="col" style="width: 220px;">{{ translateText('META') }}</th>
            <th scope="col">{{ translateText('KETERANGAN') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tipe Dokumen</td>
            <td>{{ $produkHukumDetail->produk_hukum_categories->category_name }}</td>
        </tr>

        <tr>
            <td>Jenis Putusan</td>
            <td>{{ $produkHukumDetail->produk_hukum_types->type_name }}</td>
        </tr>

        <tr>
            <td>Judul</td>
            <td>{{ $produkHukumDetail->judul_peraturan }}</td>
        </tr>

        <tr>
            <td>TEU Badan</td>
            <td>{{ $produkHukumDetail->teu_badan }}</td>
        </tr>

        <tr>
            <td>Nomor Putusan</td>
            <td>{{ $produkHukumDetail->nmr_peraturan }}</td>
        </tr>

        <tr>
            <td>Jenis Peradilan</td>
            <td>{{ $produkHukumDetail->instansi }}</td>
        </tr>

        <tr>
            <td>Singkatan Jenis Peradilan</td>
            <td>{{ $produkHukumDetail->singkatan_peraturan }}</td>
        </tr>

        <tr>
            <td>Tempat Peradilan</td>
            <td>{{ $produkHukumDetail->tempat_penetapan }}</td>
        </tr>

        <tr>
            <td>Tanggal-Bulan-Tahun dibacakan</td>
            <td>{{ $produkHukumDetail->tgl_pengajuan }}</td>
        </tr>

        <tr>
            <td>Sumber</td>
            <td>{{ $produkHukumDetail->sumber }}</td>
        </tr>

        <tr>
            <td>Subjek</td>
            <td>{{ $produkHukumDetail->subjek }}</td>
        </tr>

        <tr>
            <td>Status Putusan</td>
            <td>{{ $produkHukumDetail->status_akhir }}</td>
        </tr>

        <tr>
            <td>Amar</td>
            <td>{{ $produkHukumDetail->amar }}</td>
        </tr>

        <tr>
            <td>Bahasa</td>
            <td>{{ $produkHukumDetail->bahasa }}</td>
        </tr>

        <tr>
            <td>Bidang Hukum/Jenis Perkara</td>
            <td>{{ $produkHukumDetail->bidang_hukum }}</td>
        </tr>

        <tr>
            <td>Lokasi</td>
            <td>{{ $produkHukumDetail->lokasi }}</td>
        </tr>
    </tbody>
</table>