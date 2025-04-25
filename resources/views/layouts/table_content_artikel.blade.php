<table class="shadow table table-striped">
	<thead class="text-white" style="background-color: #11D694;">
        <tr>
            <th scope="col" style="width: 220px;">META</th>
            <th scope="col">KETERANGAN</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Judul</td>
            <td>{{ $artikelHukumDetail->judul_artikel }}</td>
        </tr>

        <tr>
            <td>Tajuk Entri Utama</td>
            <td>{{ $artikelHukumDetail->penulis_artikel }}</td>
        </tr>

        <tr>
            <td>Cetakan/Edisi</td>
            <td>{{ $artikelHukumDetail->edisi_artikel }}</td>
        </tr>

        <tr>
            <td>Penerbit</td>
            <td>{{ $artikelHukumDetail->penerbit_artikel }}</td>
        </tr>

        <tr>
            <td>Tempat Terbit</td>
            <td>{{ $artikelHukumDetail->tempatterbit_artikel }}</td>
        </tr>

        <tr>
            <td>Tahun Terbit</td>
            <td>{{ $artikelHukumDetail->tahun_artikel }}</td>
        </tr>

        <tr>
            <td>Bahasa</td>
            <td>{{ $artikelHukumDetail->bahasa_artikel }}</td>
        </tr>

        <tr>
            <td>Lokasi</td>
            <td>{{ $artikelHukumDetail->lokasi_artikel }}</td>
        </tr>
    </tbody>
</table>