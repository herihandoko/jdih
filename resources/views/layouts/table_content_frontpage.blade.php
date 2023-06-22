<table class="table table-striped">
	<thead class="text-white" style="background-color: #11D694;">
        <tr>
            <th scope="col" style="width: 220px;">META</th>
            <th scope="col">KETERANGAN</th>
        </tr>
    </thead>
    
    @if($menu->menu_name == 'Artikel Hukum')
        <tbody>
            <tr>
                <td>Tipe Dokumen</td>
                <td>{{ $produkHukumDetail->produk_hukum_categories->category_name }}</td>
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
                <td>Tempat Terbit</td>
                <td>{{ $produkHukumDetail->tempat_penetapan }}</td>
            </tr>
            
            <tr>
                <td>Tahun Terbit</td>
                <td>{{ $produkHukumDetail->thn_peraturan }}</td>
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
                <td>Bahasa</td>
                <td>{{ $produkHukumDetail->bahasa }}</td>
            </tr>
            
            <tr>
                <td>Bidang Hukum</td>
                <td>{{ $produkHukumDetail->bidang_hukum }}</td>
            </tr>
            
            <tr>
                <td>Lokasi</td>
                <td>{{ $produkHukumDetail->lokasi }}</td>
            </tr>
        </tbody>
    @elseif($menu->menu_name == 'Monografi Hukum')
        <tbody>
            <tr>
                <td>Tipe Dokumen</td>
                <td>{{ $produkHukumDetail->produk_hukum_categories->category_name }}</td>
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
                <td>Nomor Panggil</td>
                <td>{{ $produkHukumDetail->nmr_peraturan }}</td>
            </tr>
            
            <tr>
                <td>Cetakan/Edisi</td>
                <td>{{ $produkHukumDetail->cetakan }}</td>
            </tr>
            
            <tr>
                <td>Tempat Terbit</td>
                <td>{{ $produkHukumDetail->tempat_penetapan }}</td>
            </tr>
            
            <tr>
                <td>Penerbit</td>
                <td>{{ $produkHukumDetail->pemrakarsa }}</td>
            </tr>
            
            <tr>
                <td>Tahun Terbit</td>
                <td>{{ $produkHukumDetail->thn_peraturan }}</td>
            </tr>
            
            <tr>
                <td>Deskripsi Fisik</td>
                <td>{{ $produkHukumDetail->deskripsi_fisik }}</td>
            </tr>
            
            <tr>
                <td>Subjek</td>
                <td>{{ $produkHukumDetail->subjek }}</td>
            </tr>
            
            <tr>
                <td>ISBN/ISSN</td>
                <td>{{ $produkHukumDetail->isbn }}</td>
            </tr>
            
            <tr>
                <td>Bahasa</td>
                <td>{{ $produkHukumDetail->bahasa }}</td>
            </tr>
            
            <tr>
                <td>Bidang Hukum</td>
                <td>{{ $produkHukumDetail->bidang_hukum }}</td>
            </tr>
            
            <tr>
                <td>Nomor Induk Buku</td>
                <td>{{ $produkHukumDetail->nmr_indukbuku }}</td>
            </tr>
            
            <tr>
                <td>Lokasi Buku</td>
                <td>{{ $produkHukumDetail->lokasi }}</td>
            </tr>
        </tbody>
    @elseif($menu->menu_name == 'Putusan Pengadilan')
        <tbody>
            <tr>
                <td>Tipe Dokumen</td>
                <td>{{ $produkHukumDetail->produk_hukum_categories->category_name }}</td>
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
    @else
        <tbody>
            <tr>
                <td>Tipe Dokumen</td>
                <td>{{ $produkHukumDetail->produk_hukum_types->type_name }}</td>
            </tr>

            <tr>
                <td>Jenis peraturan</td>
                <td>{{ $produkHukumDetail->produk_hukum_categories->category_name }}</td>
            </tr>

            <tr>
                <td>Judul</td>
                <td>{{ $produkHukumDetail->judul_peraturan }}</td>
            </tr>

            <tr>
                <td>Nomor Peraturan</td>
                <td>{{ $produkHukumDetail->nmr_peraturan }}</td>
            </tr>

            <tr>
                <td>Tahun Peraturan</td>
                <td>{{ $produkHukumDetail->thn_peraturan }}</td>
            </tr>

            <tr>
                <td>Singkatan Jenis Peraturan</td>
                <td>{{ $produkHukumDetail->singkatan_peraturan }}</td>
            </tr>

            <tr>
                <td>Instansi</td>
                <td>{{ $produkHukumDetail->instansi }}</td>
            </tr>

            <tr>
                <td>Tanggal Pengajuan</td>
                <td>{!! date('d-m-Y', strtotime($produkHukumDetail->tgl_pengajuan)) !!}</td>
            </tr>

            <tr>
                <td>Tanggal Pembahasan</td>
                <td>{{ $produkHukumDetail->tgl_pembahasan }}</td>
            </tr>

            <tr>
                <td>Tempat Penetapan</td>
                <td>{{ $produkHukumDetail->tempat_penetapan }}</td>
            </tr>

            <tr>
                <td>Tanggal Penetapan</td>
                <td>{!! date('d-m-Y', strtotime($produkHukumDetail->tgl_penetapan)) !!}</td>
            </tr>

            <tr>
                <td>Tanggal Pengundangan</td>
                <td>{!! date('d-m-Y', strtotime($produkHukumDetail->tgl_pengundangan)) !!}</td>
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
                <td>Status Akhir</td>
                 @if($produkHukumDetail->status_akhir == 'Berlaku')
                    <td><font class="btn-success btn-sm">{{ $produkHukumDetail->status_akhir }}</font></td>
                @elseif($produkHukumDetail->status_akhir == 'Diubah')
                    <td><font class="btn-primary btn-sm">{{ $produkHukumDetail->status_akhir }}</font></td>
                @elseif($produkHukumDetail->status_akhir == 'Mengubah')
                    <td><font class="btn-primary btn-sm">{{ $produkHukumDetail->status_akhir }}</font></td>
                @elseif($produkHukumDetail->status_akhir == 'Dicabut')
                    <td><font class="btn-warning btn-sm">{{ $produkHukumDetail->status_akhir }}</font></td>
                @elseif($produkHukumDetail->status_akhir == 'Mencabut')
                    <td><font class="btn-warning btn-sm">{{ $produkHukumDetail->status_akhir }}</font></td>
                @else
                    <td><font class="btn-danger btn-sm">{{ $produkHukumDetail->status_akhir }}</font></td>
                @endif
            </tr>

            <tr>
                <td>Catatan Status</td>
                <td>{{ $produkHukumDetail->catatan_status }}</td>
            </tr>

            <tr>
                <td>Urusan Pemerintahan</td>
                <td>{{ $produkHukumDetail->urusan }}</td>
            </tr>

            <tr>
                <td>Bidang Hukum</td>
                <td>{{ $produkHukumDetail->bidang_hukum }}</td>
            </tr>

            <tr>
                <td>Bahasa</td>
                <td>{{ $produkHukumDetail->bahasa }}</td>
            </tr>

            <tr>
                <td>TEU Badan</td>
                <td>{{ $produkHukumDetail->teu_badan }}</td>
            </tr>

            <tr>
                <td>Pemrakarsa</td>
                <td>{{ $produkHukumDetail->pemrakarsa }}</td>
            </tr>

            <tr>
                <td>File Peraturan</td>
                <td>{{ $produkHukumDetail->file_peraturan }}</td>
            </tr>

            <tr>
                <td>Abstrak</td>
                <td>{{ $produkHukumDetail->abstrak }}</td>
            </tr>

            <tr>
                <td>Peraturan Terkait</td>
                <td>
                    @if(count($produkHukumDocument) != 0)
                        @for($i = 0; $i < count($produkHukumDocument); $i++)
                            <p>{{'- '}}{{ $produkHukumDocument[$i]->peraturan_terkait }}</p>
                        @endfor
                    @endif
                </td>
            </tr>

            <tr>
                <td>Dokumen Terkait</td>
                <td>{{ $produkHukumDetail->dokumen_terkait }}</td>
            </tr>

            <tr>
                <td>Hasil Uji MK</td>
                <td>{{ $produkHukumDetail->hasil_uji }}</td>
            </tr>
        </tbody>
    @endif
</table>