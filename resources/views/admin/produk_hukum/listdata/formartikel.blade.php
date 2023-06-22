<div class="card-body">
    <div class="form-group">
        <label for="">Judul *</label>
        <input type="text" name="judul_peraturan" class="form-control" value="{{ old('judul_peraturan') }}" autofocus>
        
        <input type="hidden" name="produk_hukum_categories_id" class="form-control" value="{{ $registerJenisDok }}" autofocus>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">TEU Orang/Badan</label>
                    <input type="text" name="teu_badan" class="form-control" value="{{ old('teu_badan') }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Tempat Terbit</label>
                    <input type="text" name="tempat_penetapan" class="form-control" value="{{ old('tempat_penetapan') }}">
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tahun Terbit</label>
                    <input type="text" name="thn_peraturan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" class="form-control" value="{{ old('thn_peraturan') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Sumber</label>
                    <input type="text" name="sumber" class="form-control" value="{{ old('sumber') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Subjek</label>
                    <input type="text" name="subjek" class="form-control" value="{{ old('subjek') }}">
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
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Bidang Hukum</label>
                    <input type="text" name="bidang_hukum" class="form-control" value="{{ old('bidang_hukum') }}">

                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}">

                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label for="">Lampiran</label>
        <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf, .zip || Maks.: 200 MB)</span>
        <div>
            <input type="file" name="file_peraturan" accept=".pdf, .zip">
        </div>
    </div>
    
    <div class="form-group">
        <label for="">Publish</label>
        <div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_publish" id="rr1" value="1" checked>
                <label class="form-check-label font-weight-normal" for="rr1">Publish</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_publish" id="rr2" value="2">
                <label class="form-check-label font-weight-normal" for="rr2">Tidak Publish</label>
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-success">Simpan</button>
</div>