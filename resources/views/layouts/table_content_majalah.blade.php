<table class="table table-striped">
	<thead class="text-white" style="background-color: #11D694;">
        <tr>
            <th scope="col" style="width: 220px;">META</th>
            <th scope="col">KETERANGAN</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Judul</td>
            <td>{{ $majalahHukumDetail->judul_majalah }}</td>
        </tr>

        <tr>
            <td>Tajuk Entri Utama</td>
            <td>{{ $majalahHukumDetail->penulis_majalah }}</td>
        </tr>

        <tr>
            <td>Cetakan/Edisi</td>
            <td>{{ $majalahHukumDetail->edisi_majalah }}</td>
        </tr>

        <tr>
            <td>Penerbit</td>
            <td>{{ $majalahHukumDetail->penerbit_majalah }}</td>
        </tr>

        <tr>
            <td>Tempat Terbit</td>
            <td>{{ $majalahHukumDetail->tempatterbit_majalah }}</td>
        </tr>

        <tr>
            <td>Tahun Terbit</td>
            <td>{{ $majalahHukumDetail->tahun_majalah }}</td>
        </tr>

        <tr>
            <td>Bahasa</td>
            <td>{{ $majalahHukumDetail->bahasa_majalah }}</td>
        </tr>

        <tr>
            <td>Kategori Buku</td>
            <td>{{ $majalahHukumDetail->kategori_majalah }}</td>
        </tr>

        <tr>
            <td>Lokasi</td>
            <td>{{ $majalahHukumDetail->lokasi_majalah }}</td>
        </tr>
    </tbody>
</table>