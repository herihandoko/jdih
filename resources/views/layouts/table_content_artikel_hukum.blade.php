<table class="table table-fixed table-condensed table-striped shadow" width="100%" cellspacing="0" style="font-size: small;">
	<thead class="text-white" style="background-color: #11D694;">
        <tr>
            <th scope="col" style="width: 220px;">{{ translateText('META') }}</th>
            <th scope="col">{{ translateText('KETERANGAN') }}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ translateText('Tipe Dokumen') }}</td>
            <td>{{ translateText($produkHukumDetail->produk_hukum_categories->category_name) }}</td>
        </tr>

        <tr>
            <td>{{ translateText('Jenis') }}</td>
            <td>{{ translateText($produkHukumDetail->type_name) }}</td>
        </tr>

        <tr>
            <td>{{ translateText('Judul') }}</td>
            <td>{{ translateText($produkHukumDetail->judul_peraturan) }}</td>
        </tr>

        <tr>
            <td>{{ translateText('TEU Badan') }}</td>
            <td>{{ translateText($produkHukumDetail->teu_badan) }}</td>
        </tr>

        <tr>
            <td>{{ translateText('Tempat Terbit') }}</td>
            <td>{{ translateText($produkHukumDetail->tempat_penetapan) }}</td>
        </tr>

        <tr>
            <td>{{ translateText('Tahun Terbit') }}</td>
            <td>{{ translateText($produkHukumDetail->thn_peraturan) }}</td>
        </tr>

        <tr>
            <td>{{ translateText('Sumber') }}</td>
            <td>{{ translateText($produkHukumDetail->sumber) }}</td>
        </tr>

        <tr>
            <td>{{ translateText('Subjek') }}</td>
            <td>{{ translateText($produkHukumDetail->subjek) }}</td>
        </tr>

        <tr>
            <td>{{ translateText('Bahasa') }}</td>
            <td>{{ translateText($produkHukumDetail->bahasa) }}</td>
        </tr>

        <tr>
            <td>{{ translateText('Bidang Hukum') }}</td>
            <td>{{ translateText($produkHukumDetail->bidang_hukum) }}</td>
        </tr>

        <tr>
            <td>{{ translateText('Lokasi') }}</td>
            <td>{{ translateText($produkHukumDetail->lokasi) }}</td>
        </tr>
    </tbody>
</table>