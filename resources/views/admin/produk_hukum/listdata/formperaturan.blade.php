<div class="card-body">
    <div class="form-group">
        <label for="">Jenis Peraturan *</label>
        <select name="produk_hukum_types_id" class="form-control" required="true">
            <option value="">{{ '-Pilih-' }}</option>
            @foreach($produkHukumType as $row)
                <option value="{{ $row->id }}">{{ $row->type_name }}</option>
            @endforeach
        </select>
        
        <input type="hidden" name="produk_hukum_categories_id" class="form-control" value="{{ $registerJenisDok }}" autofocus>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Judul Peraturan *</label>
                    <input type="text" name="judul_peraturan" class="form-control" value="{{ old('judul_peraturan') }}" autofocus>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Bahasa</label>
                    <select name="bahasa" class="form-control">
                        <option value="Indonesia">Indonesia</option>
                        <option value="English">English</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor Peraturan</label>
                    <input type="text" name="nmr_peraturan" class="form-control" value="{{ old('nmr_peraturan') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">

            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tahun Peraturan</label>
                    <input type="text" name="thn_peraturan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" class="form-control" value="{{ old('thn_peraturan') }}">
<!--                    <select id="thn_peraturan" class="form-control" name="thn_peraturan">
                        <option value="">-- Pilih Tahun --</option>
                        {{ $years = date('Y') }}
                        @for ($year = $years - 12; $year <= $years; $year++)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>-->
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Singkatan Jenis Peraturan</label>
                    <input type="text" name="singkatan_peraturan" class="form-control" value="{{ old('singkatan_peraturan') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Lokasi</label>
                    <input type="text" name="instansi" class="form-control" value="{{ old('instansi') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Pengajuan</label>
                    <input id="tgl_pengajuan" type="text" name="tgl_pengajuan" class="form-control" value="{{ old('tgl_pengajuan') }}" style="background-color: white;" readonly>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Tgl Pembahasan</label>
                    <div class="input-group mb-3">
                        <input type="text" name="tgl_pembahasan" class="form-control" readonly="true" value="{{ old('tgl_pembahasan') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" id="openFormTglPembahasan" type="button" data-target="#tglPembahasanForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- <input id="tgl_pembahasan" type="text" name="tgl_pembahasan" class="form-control" value="{{ old('tgl_pembahasan') }}"> -->
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Tempat Penetapan</label>
                    <input type="text" name="tempat_penetapan" class="form-control" value="{{ old('tempat_penetapan') }}">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Penetapan</label>
                    <input id="tgl_penetapan" type="text" name="tgl_penetapan" class="form-control" value="{{ old('tgl_penetapan') }}" style="background-color: white;" readonly>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Pengundangan</label>
                    <input id="tgl_pengundangan" type="text" name="tgl_pengundangan" class="form-control" value="{{ old('tgl_pengundangan') }}" style="background-color: white;" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Sumber</label>
                    <input type="text" name="sumber" class="form-control" value="{{ old('sumber') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Subjek</label>
                    <input type="text" name="subjek" class="form-control" value="{{ old('subjek') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Urusan Pemerintahan</label>
                    <select name="urusan" class="form-control" required="true">
                        <option value="">{{ '-Pilih-' }}</option>
                        @foreach($produkHukumUrusanPemerintahan as $row)
                            @php 
                                $tes = $row->up_code;
                                $int_value = (float) $tes;
                            @endphp
                            <option value="{{ $row->id }}">
                                {{$row->up_code}}. {{ $row->up_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Bidang Hukum</label>
                    <select name="bidang_hukum" class="form-control" required="true">
                        <option value="">{{ '-Pilih-' }}</option>
                        @foreach($produkHukumBidangHukum as $row)
                            <option value="{{ $row->id }}">
                                {{ $row->bh_code }}. {{ $row->bh_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">TEU Badan</label>
                    <input type="text" name="teu_badan" class="form-control" value="{{ old('teu_badan') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Pemrakarsa</label>
                    <input type="text" name="pemrakarsa" class="form-control" value="{{ old('pemrakarsa') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="">File Peraturan</label>
                <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf, .zip || Maks.: 250 MB)</span>
                <div>
                    <input type="file" name="file_peraturan" accept=".pdf, .zip">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Abstrak File</label>
                    <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf, .zip || Maks.: 250 MB)</span>
                    <div>
                        <input type="file" name="abstrak" accept=".pdf, .zip">
                    </div>
                    <!-- <input type="text" name="abstrak" class="form-control" value="{{ old('abstrak') }}"> -->
                </div>
            </div>
        </div>
    </div>

    <hr/>
        <div style="margin-bottom: 5px;">
            <button type="button" name="addDocuments" id="dynamic-documents" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i>&nbsp;Tambah
            </button>
        </div>

        <div>
            <table class="table table-bordered" id="dynamicAddDocuments">
                <tr>
                    <th>Peraturan Terkait</th>
                    <th>Aksi</th>
                </tr>
            </table>
        </div>
    <hr/>

    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Hasil Uji MK</label>
                    <input type="text" name="hasil_uji" class="form-control" value="{{ old('hasil_uji') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status_akhir" class="form-control">
                        <option value="Berlaku">Berlaku</option>
                        <option value="Diubah">Diubah</option>
                        <option value="Mengubah">Mengubah</option>
                        <option value="Dicabut">Dicabut</option>
                        <option value="Mencabut">Mencabut</option>
                        <option value="Tidak Berlaku">Tidak Berlaku</option>
                    </select>
                </div>
            </div>

            <div class="col-md-10">
                <div class="form-group">
                    <label for="">Catatan Status</label>
                    <textarea name="catatan_status" class="form-control h_100" cols="30" rows="10">{{ old('catatan_status') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
</div>