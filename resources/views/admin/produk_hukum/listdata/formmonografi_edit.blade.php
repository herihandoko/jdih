<div class="card-body">
    <div class="form-group">
        <label for="">Judul *</label>
        <input type="text" name="judul_peraturan" class="form-control" value="{{ $produkHukumList->judul_peraturan }}}" autofocus>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">TEU Orang/Badan</label>
                    <input type="text" name="teu_badan" class="form-control" value="{{ $produkHukumList->teu_badan }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor Panggil</label>
                    <input type="text" name="nmr_peraturan" class="form-control" value="{{ $produkHukumList->nmr_peraturan }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Cetakan/Edisi</label>
                    <input type="text" name="cetakan" class="form-control" value="{{ $produkHukumList->cetakan }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Tempat Terbit</label>
                    <input type="text" name="tempat_penetapan" class="form-control" value="{{ $produkHukumList->tempat_penetapan }}">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Penerbit</label>
                    <input type="text" name="pemrakarsa" class="form-control" value="{{ $produkHukumList->pemrakarsa }}">
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tahun Terbit</label>
                    <input type="text" name="thn_peraturan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" class="form-control" value="{{ $produkHukumList->thn_peraturan }}">
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Deskripsi Fisik</label>
                    <input type="text" name="deskripsi_fisik" class="form-control" value="{{ $produkHukumList->deskripsi_fisik }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Subjek</label>
                    <input type="text" name="subjek" class="form-control" value="{{ $produkHukumList->subjek }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">ISBN/ISSN</label>
                    <input type="text" name="isbn" class="form-control" value="{{ $produkHukumList->isbn }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Bahasa</label>
                    <select name="bahasa" class="form-control">
                        <option value="Indonesia" @if($produkHukumList->bahasa == 'Indonesia') selected @endif>Indonesia</option>
                        <option value="English" @if($produkHukumList->bahasa == 'English') selected @endif>English</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Bidang Hukum</label>
                    <input type="text" name="bidang_hukum" class="form-control" value="{{ $produkHukumList->bidang_hukum }}">
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nomor Induk Buku</label>
                    <input type="text" name="nmr_indukbuku" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" value="{{ $produkHukumList->nmr_indukbuku }}">
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Lokasi Buku</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ $produkHukumList->lokasi }}">

                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label for="">Lampiran</label>
        <div>
            <a target="_blank" href="{{ url('storage/places/peraturan/'.$produkHukumList->file_peraturan) }}">
                {{ $produkHukumList->file_peraturan }}
            </a>
        </div>
    </div>
    
    <div class="form-group">
        <label for="">Ubah Lampiran</label>
        <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf, .zip || Maks.: 200 MB)</span>
        <div>
            <input type="file" name="file_peraturan" accept=".pdf, .zip">
        </div>
    </div>
    
    <div class="form-group">
        <label for="">Publish</label>
        <div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_publish" id="rr1" value="1" @if($produkHukumList->is_publish == 1) checked @endif>
                <label class="form-check-label font-weight-normal" for="rr1">Publish</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="is_publish" id="rr2" value="2" @if($produkHukumList->is_publish == 2) checked @endif>
                <label class="form-check-label font-weight-normal" for="rr2">Tidak Publish</label>
            </div>
        </div>
    </div>
    
    <button type="submit" class="btn btn-success">Ubah</button>
</div>