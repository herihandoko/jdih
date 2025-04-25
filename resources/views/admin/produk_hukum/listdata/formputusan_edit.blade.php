<div class="card-body">
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="">Jenis Putusan *</label>
                <select name="produk_hukum_types_id" class="form-control form-control-sm select2" required="true">
                    <option value="">{{ '-Pilih-' }}</option>
                    @foreach($produkHukumType as $row)
                        <option value="{{ $row->id }}" @if($row->id == $produkHukumList->produk_hukum_types_id) selected @endif>{{ $row->type_name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="">Judul *</label>
                <input type="text" name="judul_peraturan" class="form-control form-control-sm" value="{{ $produkHukumList->judul_peraturan }}" autofocus>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">TEU Badan</label>
                    <input type="text" name="teu_badan" class="form-control form-control-sm" value="{{ $produkHukumList->teu_badan }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor Putusan</label>
                    <input type="text" name="nmr_peraturan" class="form-control form-control-sm" value="{{ $produkHukumList->nmr_peraturan }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Jenis Peradilan</label>
                    <input type="text" name="instansi" class="form-control form-control-sm" value="{{ $produkHukumList->instansi }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Singkatan Jenis Peradilan</label>
                    <input type="text" name="singkatan_peraturan" class="form-control form-control-sm" value="{{ $produkHukumList->singkatan_peraturan }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Tempat Peradilan</label>
                    <input type="text" name="tempat_penetapan" class="form-control form-control-sm" value="{{ $produkHukumList->tempat_penetapan }}">
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Dibacakan</label>
                    <input id="tgl_pengajuan" type="text" name="tgl_pengajuan" class="form-control form-control-sm" value="{{ $produkHukumList->tgl_pengajuan != null ? Carbon\Carbon::parse($produkHukumList->tgl_pengajuan)->format('d-m-Y') : '' }}" style="background-color: white;" readonly>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Sumber</label>
                    <input type="text" name="sumber" class="form-control form-control-sm" value="{{ $produkHukumList->sumber }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Subjek</label>
                    <input type="text" name="subjek" class="form-control form-control-sm" value="{{ $produkHukumList->subjek }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Amar</label>
                    <input type="text" name="amar" class="form-control form-control-sm" value="{{ $produkHukumList->amar }}">
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
                        <option value="Tetap" @if($produkHukumList->status_akhir == 'Tetap') selected @endif>Tetap</option>
                        <option value="Temporary" @if($produkHukumList->status_akhir == 'Temporary') selected @endif>Temporary</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Bahasa</label>
                    <select name="bahasa" class="form-control form-control-sm select2">
                        <option value="">{{ '-Pilih-' }}</option>
                        @foreach($produkHukumLanguage as $row)
                            <option value="{{ $row->language_name }}" @if($row->language_name == $produkHukumList->bahasa) selected @endif>{{ $row->language_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Bidang Hukum/Jenis Perkara</label>
                    <input type="text" name="bidang_hukum" class="form-control form-control-sm" value="{{ $produkHukumList->bidang_hukum }}">
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control form-control-sm" value="{{ $produkHukumList->lokasi }}">

                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Lampiran</label>
                    <div>
                        <a target="_blank" href="{{ url('storage/places/peraturan/'.$produkHukumList->file_peraturan) }}">
                            {{ $produkHukumList->file_peraturan }}
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Ubah Lampiran</label>
                    <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf, .zip || Maks.: 200 MB)</span>
                    <div>
                        <input type="file" name="file_peraturan" accept=".pdf, .zip">
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Publish</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_publish" id="rr1" value="1" @if($produkHukumList->is_publish == 1) checked @endif>
                            <label class="form-check-label font-weight-normal" for="rr1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_publish" id="rr2" value="2" @if($produkHukumList->is_publish == 2) checked @endif>
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
            <a href="{{ route('admin.produk_hukum.listdata.index') }}" class="btn btn-block btn-sm btn-danger">
                Batal
            </a>
        </div>

        <div class="col-md-6">
            <button type="submit" class="btn btn-block btn-sm btn-success">
                Ubah
            </button>
        </div>
    </div>
</div>