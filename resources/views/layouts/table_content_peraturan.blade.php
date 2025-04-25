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
            <td>Tipe Dokumen</td>
            <td>:</td>
            <td>{{ $produkHukumDetail->produk_hukum_categories->category_name }}</td>
        </tr>

        <tr>
            <td>Jenis Peraturan</td>
            <td>:</td>
            <td>{{ $produkHukumDetail->produk_hukum_types->type_name }}</td>
        </tr>

        <tr>
            <td>Judul</td>
            <td>:</td>
            <td>{{ $produkHukumDetail->judul_peraturan }}</td>
        </tr>

        <tr>
            <td>Nomor Peraturan</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->nmr_peraturan) ? '-' : $produkHukumDetail->nmr_peraturan }}
            </td>
        </tr>

        <tr>
            <td>Tahun Peraturan</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->thn_peraturan) ? '-' : $produkHukumDetail->thn_peraturan }}
            </td>
        </tr>

        <tr>
            <td>Singkatan Jenis Peraturan</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->singkatan_peraturan) ? '-' : $produkHukumDetail->singkatan_peraturan }}
            </td>
        </tr>

        <tr>
            <td>Lokasi</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->instansi) ? '-' : $produkHukumDetail->instansi }}
            </td>
        </tr>

        <tr>
            <td>Tanggal Pengajuan</td>
            <td>:</td>
            <td>
                {!! empty($produkHukumDetail->tgl_pengajuan) ? '-' : date('d-m-Y', strtotime($produkHukumDetail->tgl_pengajuan)) !!}
            </td>
        </tr>

        <tr>
            <td>Tanggal Pembahasan</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->tgl_pembahasan) ? '-' : $produkHukumDetail->tgl_pembahasan }}
            </td>
        </tr>

        <tr>
            <td>Tempat Penetapan</td>
            <td>:</td>
            <td>
               {{ empty($produkHukumDetail->tempat_penetapan) ? '-' : $produkHukumDetail->tempat_penetapan }}
            </td>
        </tr>

        <tr>
            <td>Tanggal Penetapan</td>
            <td>:</td>
            <td>
                {!! empty($produkHukumDetail->tgl_penetapan) ? '-' : date('d-m-Y', strtotime($produkHukumDetail->tgl_penetapan)) !!}
            </td>
        </tr>

        <tr>
            <td>Tanggal Pengundangan</td>
            <td>:</td>
            <td>
                {!! empty($produkHukumDetail->tgl_pengundangan) ? '-' : date('d-m-Y', strtotime($produkHukumDetail->tgl_pengundangan)) !!}
            </td>
        </tr>

        <tr>
            <td>Sumber</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->sumber) ? '-' : $produkHukumDetail->sumber }}
            </td>
        </tr>

        <tr>
            <td>Subjek</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->subjek) ? '-' : $produkHukumDetail->subjek }}
            </td>
        </tr>

        <tr>
            <td>Status Akhir</td>
            <td>:</td>
            <td>
                <span class="btn-sm" style="font-weight: bold; font-size: smaller; color: {{ $produkHukumDetail->status_akhir == 'Berlaku' ? '#000000' : ($produkHukumDetail->status_akhir == 'Tidak Berlaku' ? '#ffffff' : '#007bff') }}; background-color: {{ $produkHukumDetail->status_akhir == 'Berlaku' ? '#28a745' : ($produkHukumDetail->status_akhir == 'Tidak Berlaku' ? '#dc3545' : '#007bff') }};">
                    {{ ucwords($produkHukumDetail->status_akhir) }}
                </span>
            </td>
        </tr>
        
        <tr>
            <td>Catatan Status</td>
            <td>:</td>
            <td>
                @if(count($catatanStatus) != 0)
                    @foreach(['Diubah', 'Mengubah', 'Dicabut', 'Mencabut'] as $status)
                        @if($catatanStatus->contains('jenis_status', $status))
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">
                                <span class="btn-sm" style="font-size: smaller; background-color: #ffc107;">
                                    {{ ucwords(translateText($status)) }}
                                </span>
                            </legend>
                            @for($i = 0; $i < count($catatanStatus); $i++)
                            @if($catatanStatus[$i]->jenis_status == $status)
                                <ul>
                                    @if($routes == 'front.detail.peraturanhukum')
                                        @php
                                            $encryptedId = encrypt($catatanStatus[$i]->id);
                                            $encryptedKeyword = encrypt(request('keyword', ''));
                                            $encryptedNomor = encrypt(request('nomor', ''));
                                            $encryptedTahun = encrypt(request('tahun', 0));
                                            $encryptedPage = encrypt(request('page', 1));
                                            $encryptedRoutes = encrypt('front.detail.peraturanhukum');
                                        @endphp
                                        <form id="detailForm" action="{{ route('front.detail.peraturanhukum', ['menuslug' => $menu->slug, 'slug' => $catatanStatus[$i]->slug]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input style="display: none;" name="menuslug" value="{{ $menu->slug }}">
                                            <input style="display: none;" name="slug" value="{{ $catatanStatus[$i]->slug }}">
                                            <input style="display: none;" name="id" value="{{ $catatanStatus[$i]->id }}">
                                            <input style="display: none;" name="keyword" value="{{ $keyword }}">
                                            <input style="display: none;" name="nomor" value="{{ $nomor }}">
                                            <input style="display: none;" name="tahun" value="{{ $tahun }}">
                                            <input style="display: none;" name="page" value="{{ $page}}">
                                            <input style="display: none;" name="pagefrom" value="{{ 'terkait' }}">
                                            <input style="display: none;" name="routes" value="{{ $routes }}">

                                            <button type="submit" class="btn btn-outline-primary btn-information">
                                                <i class="fas fa-external-link" style="color: #0080ff;"></i>
                                                {{ ucwords(translateText($catatanStatus[$i]->judul_peraturan)) }}
                                            </button>
                                        </form>
                                    @else
                                        @php
                                            $encryptedKeyword = encrypt(request('keyword', ''));
                                            $encryptedNomor = encrypt(request('nomor', ''));
                                            if($catatanStatus[$i]->api_name) {
                                                $encryptedApiName = encrypt($catatanStatus[$i]->api_name);
                                                $encryptedId = encrypt($catatanStatus[$i]->idData);
                                            } else {
                                                $encryptedApiName = encrypt('Pemerintah Provinsi Banten');
                                                $encryptedId = encrypt($catatanStatus[$i]->id);
                                            }
                                            $encryptedKategori = encrypt(request('kategori', ''));
                                            $encryptedBentuk = encrypt(request('bentuk', ''));
                                            $encryptedTahun = encrypt(request('tahun', 0));
                                            $encryptedPage = encrypt(request('page', 1));
                                            $encryptedRoutes = encrypt('front.detail.search');
                                        @endphp
                                        <form id="detailForm" action="{{ route('front.detail.search') }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="keyword" value="{{ $keyword }}">
                                            <input type="hidden" name="nomor" value="{{ $nomor }}">
                                            @if($catatanStatus[$i]->api_name)
                                                <input type="hidden" name="id" value="{{ $catatanStatus[$i]->idData }}">
                                                <input type="hidden" name="api_name" value="{{ $catatanStatus[$i]->api_name }}">
                                            @else
                                                <input type="hidden" name="id" value="{{ $catatanStatus[$i]->id }}">
                                                <input type="hidden" name="api_name" value="{{ 'Pemerintah Provinsi Banten' }}">
                                            @endif
                                            <input type="hidden" name="kategori" value="{{ $kategori }}">
                                            <input type="hidden" name="bentuk" value="{{ $bentuk }}">
                                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                                            <input type="hidden" name="page" value="{{ $page }}">
                                            <input style="display: none;" name="pagefrom" value="{{ 'terkait' }}">
                                            <input type="hidden" name="routes" value="{{ $routes }}">

                                            <button type="submit" class="btn btn-outline-primary btn-information">
                                                <i class="fas fa-external-link" style="color: #0080ff;"></i>
                                                {{ ucwords(translateText($catatanStatus[$i]->judul_peraturan)) }}
                                            </button>
                                        </form>
                                    @endif
                                </ul>
                            @endif
                            @endfor
                        </fieldset>
                        @endif
                    @endforeach
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->catatan_status) ? '-' : $produkHukumDetail->catatan_status }}
            </td>
        </tr>

        <tr>
            <td>Urusan Pemerintahan</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->urusan) ? '-' : $produkHukumDetail->up_name }}
            </td>
        </tr>

        <tr>
            <td>Bidang Hukum</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->bidang_hukum) ? '-' : $produkHukumDetail->bh_name }}
            </td>
        </tr>

        <tr>
            <td>Bahasa</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->bahasa) ? '-' : $produkHukumDetail->bahasa }}
            </td>
        </tr>

        <tr>
            <td>TEU Badan</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->teu_badan) ? '-' : $produkHukumDetail->teu_badan }}
            </td>
        </tr>

        <tr>
            <td>Pemrakarsa</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->pemrakarsa) ? '-' : $produkHukumDetail->pemrakarsa }}
            </td>
        </tr>

        <tr>
            <td>File Peraturan</td>
            <td>:</td>
            <td>
                @if($produkHukumDetail->file_peraturan)
                <a class="btn btn-outline-success btn-information" target="_blank" href="{{ url('storage/places/peraturan/'.$produkHukumDetail->file_peraturan) }}">
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
            <td>:</td>
            <td>
                @if($produkHukumDetail->abstrak)
                    <a class="btn btn-outline-success btn-information" target="_blank" href="{{ url('storage/places/peraturan/'.$produkHukumDetail->abstrak) }}">
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
            <td>:</td>
            <td>
                @if(count($produkHukumDocument) != 0)
                    @for($i = 0; $i < count($produkHukumDocument); $i++)
                        <ul>
                            @if($routes == 'front.detail.peraturanhukum')
                                @php
                                    $encryptedId = encrypt($produkHukumDocument[$i]->id);
                                    $encryptedKeyword = encrypt(request('keyword', ''));
                                    $encryptedNomor = encrypt(request('nomor', ''));
                                    $encryptedTahun = encrypt(request('tahun', 0));
                                    $encryptedPage = encrypt(request('page', 1));
                                    $encryptedRoutes = encrypt('front.detail.peraturanhukum');
                                @endphp
                                <form id="detailForm" action="{{ route('front.detail.peraturanhukum', ['menuslug' => $menu->slug, 'slug' => $produkHukumDocument[$i]->slug]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input style="display: none;" name="menuslug" value="{{ $menu->slug }}">
                                    <input style="display: none;" name="slug" value="{{ $produkHukumDocument[$i]->slug }}">
                                    <input style="display: none;" name="id" value="{{ $produkHukumDocument[$i]->id }}">
                                    <input style="display: none;" name="keyword" value="{{ $keyword }}">
                                    <input style="display: none;" name="nomor" value="{{ $nomor }}">
                                    <input style="display: none;" name="tahun" value="{{ $tahun }}">
                                    <input style="display: none;" name="page" value="{{ $page}}">
                                    <input style="display: none;" name="pagefrom" value="{{ 'terkait' }}">
                                    <input style="display: none;" name="routes" value="{{ $routes }}">

                                    <button type="submit" class="btn btn-outline-primary btn-information">
                                        <i class="fas fa-external-link" style="color: #0080ff;"></i>
                                        {{ ucwords(translateText($produkHukumDocument[$i]->judul_peraturan)) }}
                                    </button>
                                </form>
                            @else
                                @php
                                    $encryptedKeyword = encrypt(request('keyword', ''));
                                    $encryptedNomor = encrypt(request('nomor', ''));
                                    if($produkHukumDocument[$i]->api_name) {
                                        $encryptedApiName = encrypt($produkHukumDocument[$i]->api_name);
                                        $encryptedId = encrypt($produkHukumDocument[$i]->idData);
                                    } else {
                                        $encryptedApiName = encrypt('Pemerintah Provinsi Banten');
                                        $encryptedId = encrypt($produkHukumDocument[$i]->id);
                                    }
                                    $encryptedKategori = encrypt(request('kategori', ''));
                                    $encryptedBentuk = encrypt(request('bentuk', ''));
                                    $encryptedTahun = encrypt(request('tahun', 0));
                                    $encryptedPage = encrypt(request('page', 1));
                                    $encryptedRoutes = encrypt('front.detail.search');
                                @endphp
                                <form id="detailForm" action="{{ route('front.detail.search') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="keyword" value="{{ $keyword }}">
                                    <input type="hidden" name="nomor" value="{{ $nomor }}">
                                    @if($produkHukumDocument[$i]->api_name)
                                        <input type="hidden" name="id" value="{{ $produkHukumDocument[$i]->idData }}">
                                        <input type="hidden" name="api_name" value="{{ $produkHukumDocument[$i]->api_name }}">
                                    @else
                                        <input type="hidden" name="id" value="{{ $produkHukumDocument[$i]->id }}">
                                        <input type="hidden" name="api_name" value="{{ 'Pemerintah Provinsi Banten' }}">
                                    @endif
                                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                                    <input type="hidden" name="bentuk" value="{{ $bentuk }}">
                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="page" value="{{ $page }}">
                                    <input style="display: none;" name="pagefrom" value="{{ 'terkait' }}">
                                    <input type="hidden" name="routes" value="{{ $routes }}">

                                    <button type="submit" class="btn btn-outline-primary btn-information">
                                        <i class="fas fa-external-link" style="color: #0080ff;"></i>
                                        {{ ucwords(translateText($produkHukumDocument[$i]->judul_peraturan)) }}
                                    </button>
                                </form>
                            @endif
                        </ul>
                    @endfor
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Dokumen Terkait</td>
            <td>:</td>
            <td>
                @if(count($dokumenTerkait) != 0)
                    @for($i = 0; $i < count($dokumenTerkait); $i++)
                        <ul>
                            <a class="btn btn-outline-success btn-information" target="_blank" href="{{ url('storage/places/peraturan/'.$dokumenTerkait[$i]->dokumen_terkait) }}">
                                <i class="fas fa-file-pdf" style="color: red;"></i>
                                {{ $dokumenTerkait[$i]->dokumen_terkait }}
                            </a>
                        </ul>
                    @endfor
                @else
                    {{ '-' }}
                @endif
            </td>
        </tr>

        <tr>
            <td>Hasil Uji MK</td>
            <td>:</td>
            <td>
                {{ empty($produkHukumDetail->hasil_uji) ? '-' : $produkHukumDetail->hasil_uji }}
            </td>
        </tr>
    </tbody>
</table>