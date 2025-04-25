<table class="table table-fixed table-condensed td" width="100%" cellspacing="0" style="font-size: small;">
    <thead class="text-white" style="background-color: #11D694;">
        <tr>
            <th scope="col" style="width: 24%;">META</th>
            <th scope="col" style="width: 1%;"></th>
            <th scope="col" style="width: 75%;">KETERANGAN</th>
        </tr>
    </thead>
    
    @if($menu->menu_name == 'Artikel Hukum')
        <tbody>
            <tr>
                <td>{{ translateText('Tipe Dokumen') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->produk_hukum_categories->category_name) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Jenis') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->produk_hukum_types->type_name) }}</td>
            </tr>

            <tr>
                <td>{{ translateText('Judul') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->judul_peraturan) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('TEU Badan') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->teu_badan) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Tempat Terbit') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->tempat_penetapan) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Tahun Terbit') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->thn_peraturan) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Sumber') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->sumber) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Subjek') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->subjek) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Bahasa') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->bahasa) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Bidang Hukum') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->bidang_hukum) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Lokasi') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->lokasi) }}</td>
            </tr>
        </tbody>
    @elseif($menu->menu_name == 'Monografi Hukum')
        <tbody>
            <tr>
                <td>{{ translateText('Tipe Dokumen') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->produk_hukum_categories->category_name) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Jenis') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->produk_hukum_types->type_name) }}</td>
            </tr>

            <tr>
                <td>{{ translateText('Judul') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->judul_peraturan) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('TEU Badan') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->teu_badan) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Nomor Panggil') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->nmr_peraturan) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Cetakan/Edisi') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->cetakan) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Tempat Terbit') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->tempat_penetapan) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Penerbit') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->pemrakarsa) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Tahun Terbit') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->thn_peraturan) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Deskripsi Fisik') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->deskripsi_fisik) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Subjek') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->subjek) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('ISBN/ISSN') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->isbn) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Bahasa') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->bahasa) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Bidang Hukum') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->bidang_hukum) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Nomor Induk Buku') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->nmr_indukbuku) }}</td>
            </tr>
            
            <tr>
                <td>{{ translateText('Lokasi Buku') }}</td>
                <td>:</td>
                <td>{{ translateText($produkHukumDetail->lokasi) }}</td>
            </tr>
        </tbody>
    @elseif($menu->menu_name == 'Putusan Pengadilan')
        <tbody>
            <tr>
                <td>Tipe Dokumen</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->produk_hukum_categories->category_name }}</td>
            </tr>
            
            <tr>
                <td>Jenis Putusan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->produk_hukum_types->type_name }}</td>
            </tr>

            <tr>
                <td>Judul</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->judul_peraturan }}</td>
            </tr>
            
            <tr>
                <td>TEU Badan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->teu_badan }}</td>
            </tr>
            
            <tr>
                <td>Nomor Putusan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->nmr_peraturan }}</td>
            </tr>
            
            <tr>
                <td>Jenis Peradilan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->instansi }}</td>
            </tr>
            
            <tr>
                <td>Singkatan Jenis Peradilan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->singkatan_peraturan }}</td>
            </tr>
            
            <tr>
                <td>Tempat Peradilan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->tempat_penetapan }}</td>
            </tr>
            
            <tr>
                <td>Tanggal-Bulan-Tahun dibacakan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->tgl_pengajuan }}</td>
            </tr>
            
            <tr>
                <td>Sumber</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->sumber }}</td>
            </tr>
            
            <tr>
                <td>Subjek</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->subjek }}</td>
            </tr>
            
            <tr>
                <td>Status Putusan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->status_akhir }}</td>
            </tr>
            
            <tr>
                <td>Amar</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->amar }}</td>
            </tr>
            
            <tr>
                <td>Bahasa</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->bahasa }}</td>
            </tr>
            
            <tr>
                <td>Bidang Hukum/Jenis Perkara</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->bidang_hukum }}</td>
            </tr>
            
            <tr>
                <td>Lokasi</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->lokasi }}</td>
            </tr>
        </tbody>
    @else
        <tbody>
            <tr>
                <td>Tipe Dokumen</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->produk_hukum_types->type_name }}</td>
            </tr>

            <tr>
                <td>Jenis peraturan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->produk_hukum_categories->category_name }}</td>
            </tr>

            <tr>
                <td>Judul</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->judul_peraturan }}</td>
            </tr>

            <tr>
                <td>Nomor Peraturan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->nmr_peraturan }}</td>
            </tr>

            <tr>
                <td>Tahun Peraturan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->thn_peraturan }}</td>
            </tr>

            <tr>
                <td>Singkatan Jenis Peraturan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->singkatan_peraturan }}</td>
            </tr>

            <tr>
                <td>Instansi</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->instansi }}</td>
            </tr>

            <tr>
                <td>Tanggal Pengajuan</td>
                <td>:</td>
                <td>{!! date('d-m-Y', strtotime($produkHukumDetail->tgl_pengajuan)) !!}</td>
            </tr>

            <tr>
                <td>Tanggal Pembahasan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->tgl_pembahasan }}</td>
            </tr>

            <tr>
                <td>Tempat Penetapan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->tempat_penetapan }}</td>
            </tr>

            <tr>
                <td>Tanggal Penetapan</td>
                <td>:</td>
                <td>{!! date('d-m-Y', strtotime($produkHukumDetail->tgl_penetapan)) !!}</td>
            </tr>

            <tr>
                <td>Tanggal Pengundangan</td>
                <td>:</td>
                <td>{!! date('d-m-Y', strtotime($produkHukumDetail->tgl_pengundangan)) !!}</td>
            </tr>

            <tr>
                <td>Sumber</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->sumber }}</td>
            </tr>

            <tr>
                <td>Subjek</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->subjek }}</td>
            </tr>

            <tr>
                <td>Status Akhir</td>
                <td>:</td>
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
                <td>:</td>
                <td>{{ $produkHukumDetail->catatan_status }}</td>
            </tr>

            <tr>
                <td>Urusan Pemerintahan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->urusan }}</td>
            </tr>

            <tr>
                <td>Bidang Hukum</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->bidang_hukum }}</td>
            </tr>

            <tr>
                <td>Bahasa</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->bahasa }}</td>
            </tr>

            <tr>
                <td>TEU Badan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->teu_badan }}</td>
            </tr>

            <tr>
                <td>Pemrakarsa</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->pemrakarsa }}</td>
            </tr>

            <tr>
                <td>File Peraturan</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->file_peraturan }}</td>
            </tr>

            <tr>
                <td>Abstrak</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->abstrak }}</td>
            </tr>

            <tr>
                <td>Peraturan Terkait</td>
                <td>:</td>
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
                <td>:</td>
                <td>{{ $produkHukumDetail->dokumen_terkait }}</td>
            </tr>

            <tr>
                <td>Hasil Uji MK</td>
                <td>:</td>
                <td>{{ $produkHukumDetail->hasil_uji }}</td>
            </tr>
        </tbody>
    @endif
</table>