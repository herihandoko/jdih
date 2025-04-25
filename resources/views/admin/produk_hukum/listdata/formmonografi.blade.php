<div class="card-body">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="">Jenis *</label>
                <select name="produk_hukum_types_id" class="form-control form-control-sm select2" required="true">
                    <option value="">{{ '-Pilih-' }}</option>
                    @foreach($produkHukumType as $row)
                        <option value="{{ $row->id }}">{{ $row->type_name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="">Judul *</label>
                <input type="text" name="judul_peraturan" class="form-control form-control-sm" value="{{ old('judul_peraturan') }}" autofocus>
            </div>
        </div>
        
        <input type="hidden" name="produk_hukum_categories_id" class="form-control form-control-sm" value="{{ $registerJenisDok }}" autofocus>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">TEU Orang/Badan</label>
                    <input type="text" name="teu_badan" class="form-control form-control-sm" value="{{ old('teu_badan') }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor Panggil</label>
                    <input type="text" name="nmr_peraturan" class="form-control form-control-sm" value="{{ old('nmr_peraturan') }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Cetakan/Edisi</label>
                    <input type="text" name="cetakan" class="form-control form-control-sm" value="{{ old('cetakan') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Tempat Terbit</label>
                    <input type="text" name="tempat_penetapan" class="form-control form-control-sm" value="{{ old('tempat_penetapan') }}">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Penerbit</label>
                    <input type="text" name="pemrakarsa" class="form-control form-control-sm" value="{{ old('pemrakarsa') }}">
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tahun Terbit</label>
                    <input type="text" name="thn_peraturan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" class="form-control form-control-sm" value="{{ old('thn_peraturan') }}">
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Deskripsi Fisik</label>
                    <input type="text" name="deskripsi_fisik" class="form-control form-control-sm" value="{{ old('deskripsi_fisik') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Subjek</label>
                    <input type="text" name="subjek" class="form-control form-control-sm" value="{{ old('subjek') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">ISBN/ISSN</label>
                    <input type="text" name="isbn" class="form-control form-control-sm" value="{{ old('isbn') }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Bahasa</label>
                    <select name="bahasa" class="form-control form-control-sm select2">
                        <option value="">{{ '-Pilih-' }}</option>
                        @foreach($produkHukumLanguage as $row)
                            <option value="{{ $row->language_name }}">{{ $row->language_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Bidang Hukum</label>
                    <input type="text" name="bidang_hukum" class="form-control form-control-sm" value="{{ old('bidang_hukum') }}">
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nomor Induk Buku</label>
                    <input type="text" name="nmr_indukbuku" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control form-control-sm" value="{{ old('nmr_indukbuku') }}">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Lokasi Buku</label>
                    <input type="text" name="lokasi" class="form-control form-control-sm" value="{{ old('lokasi') }}">

                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Lampiran</label>
                    <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf, .zip || Maks.: 200 MB)</span>
                    <div>
                        <input type="file" name="file_peraturan" accept=".pdf, .zip">
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Publish</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_publish" id="rr1" value="1" checked>
                            <label class="form-check-label font-weight-normal" for="rr1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_publish" id="rr2" value="2">
                            <label class="form-check-label font-weight-normal" for="rr2">Tidak</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-footer">
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('admin.produk_hukum.listdata.jenisdokumen') }}" class="btn btn-block btn-sm btn-primary">
                Batal
            </a>
        </div>

        <div class="col-md-6">
            <button type="submit" class="btn btn-block btn-sm btn-success">
                Simpan
            </button>
        </div>
    </div>
</div>