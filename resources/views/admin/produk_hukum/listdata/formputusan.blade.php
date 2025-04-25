<div class="card-body">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="">Jenis Putusan *</label>
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
                    <label for="">TEU Badan</label>
                    <input type="text" name="teu_badan" class="form-control form-control-sm" value="{{ old('teu_badan') }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor Putusan</label>
                    <input type="text" name="nmr_peraturan" class="form-control form-control-sm" value="{{ old('nmr_peraturan') }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Jenis Peradilan</label>
                    <input type="text" name="instansi" class="form-control form-control-sm" value="{{ old('instansi') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Singkatan Jenis Peradilan</label>
                    <input type="text" name="singkatan_peraturan" class="form-control form-control-sm" value="{{ old('singkatan_peraturan') }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Tempat Peradilan</label>
                    <input type="text" name="tempat_penetapan" class="form-control form-control-sm" value="{{ old('tempat_penetapan') }}">
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Dibacakan</label>
                    <input id="tgl_pengajuan" type="text" name="tgl_pengajuan" class="form-control form-control-sm" value="{{ old('tgl_pengajuan') }}" style="background-color: white;" readonly>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Sumber</label>
                    <input type="text" name="sumber" class="form-control form-control-sm" value="{{ old('sumber') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Subjek</label>
                    <input type="text" name="subjek" class="form-control form-control-sm" value="{{ old('subjek') }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Amar</label>
                    <input type="text" name="amar" class="form-control form-control-sm" value="{{ old('amar') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Status Putusan</label>
                    <select name="status_akhir" class="form-control form-control-sm select2">
                        <option value="Tetap">Tetap</option>
                        <option value="Temporary">Temporary</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-2">
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
                    <label for="">Bidang Hukum/Jenis Perkara</label>
                    <input type="text" name="bidang_hukum" class="form-control form-control-sm" value="{{ old('bidang_hukum') }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Lokasi</label>
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