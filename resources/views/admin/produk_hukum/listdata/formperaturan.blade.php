<div class="card-body">
    <div class="form-group">
        <label for="">Jenis Peraturan *</label>
        <select name="produk_hukum_types_id" class="form-control form-control-sm select2" required="true">
            <option value="">{{ '-Pilih-' }}</option>
            @foreach($produkHukumType as $row)
                <option value="{{ $row->id }}">{{ $row->type_name }}</option>
            @endforeach
        </select>
        
        <input type="hidden" name="produk_hukum_categories_id" class="form-control form-control-sm" value="{{ $registerJenisDok }}" autofocus>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Judul Peraturan *</label>
                    <input type="text" name="judul_peraturan" class="form-control form-control-sm" value="{{ old('judul_peraturan') }}" required autofocus>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Bahasa</label>
                    <select name="bahasa" class="form-control form-control-sm">
                        <option value="">{{ '-Pilih-' }}</option>
                        @foreach($produkHukumLanguage as $row)
                            <option value="{{ $row->language_name }}">{{ $row->language_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor Peraturan</label>
                    <input type="text" name="nmr_peraturan" class="form-control form-control-sm" value="{{ old('nmr_peraturan') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">

            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tahun Peraturan</label>
                    <input type="text" name="thn_peraturan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" class="form-control form-control-sm" value="{{ old('thn_peraturan') }}">
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
                    <input type="text" name="singkatan_peraturan" class="form-control form-control-sm" value="{{ old('singkatan_peraturan') }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Lokasi</label>
                    <input type="text" name="instansi" class="form-control form-control-sm" value="{{ old('instansi') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Pengajuan</label>
                    <input id="tgl_pengajuan" type="text" name="tgl_pengajuan" class="form-control form-control-sm" value="{{ old('tgl_pengajuan') }}" style="background-color: white;" readonly>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Tgl Pembahasan</label>
                    <div class="input-group mb-3">
                        <input type="text" name="tgl_pembahasan" class="form-control form-control-sm" readonly="true" value="{{ old('tgl_pembahasan') }}">
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
                    <input type="text" name="tempat_penetapan" class="form-control form-control-sm" value="{{ old('tempat_penetapan') }}">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Penetapan</label>
                    <input id="tgl_penetapan" type="text" name="tgl_penetapan" class="form-control form-control-sm" value="{{ old('tgl_penetapan') }}" style="background-color: white;" readonly>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Pengundangan</label>
                    <input id="tgl_pengundangan" type="text" name="tgl_pengundangan" class="form-control form-control-sm" value="{{ old('tgl_pengundangan') }}" style="background-color: white;" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Sumber</label>
                    <input type="text" name="sumber" class="form-control form-control-sm" value="{{ old('sumber') }}">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Urusan Pemerintahan</label>
                    <select name="urusan" class="form-control form-control-sm select2" required="true">
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
                    <select name="bidang_hukum" class="form-control form-control-sm select2" required="true">
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
                    <input type="text" name="teu_badan" class="form-control form-control-sm" value="{{ old('teu_badan') }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Pemrakarsa</label>
                    <input type="text" name="pemrakarsa" class="form-control form-control-sm" value="{{ old('pemrakarsa') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="">File Peraturan</label>
                <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf, .zip || Maks.: 250 MB)</span>
                <div class="custom-file mb-3">
                    <input type="file" class="form-control form-control-sm custom-file-input" id="customFilePeraturan" name="file_peraturan" accept=".pdf, .zip">
                    <label class="custom-file-label" for="customFile">Pilih file</label>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Abstrak File</label>
                    <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf, .zip || Maks.: 250 MB)</span>
                    <div class="custom-file mb-3">
                        <input type="file" class="form-control form-control-sm custom-file-input" id="customAbstrak" name="abstrak" accept=".pdf, .zip">
                        <label class="custom-file-label" for="customFile">Pilih file</label>
                    </div>
                    <!-- <input type="text" name="abstrak" class="form-control" value="{{ old('abstrak') }}"> -->
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Status Peraturan</label>
                    <select name="status_akhir" class="form-control form-control-sm select2">
                        <option value="Berlaku">Berlaku</option>
<!--                        <option value="Diubah">Diubah</option>
                        <option value="Mengubah">Mengubah</option>
                        <option value="Dicabut">Dicabut</option>
                        <option value="Mencabut">Mencabut</option>-->
                        <option value="Tidak Berlaku">Tidak Berlaku</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Hasil Uji MK</label>
                    <input type="text" name="hasil_uji" class="form-control form-control-sm" value="{{ old('hasil_uji') }}">
                </div>
            </div>
        </div>
    </div>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Catatan Status</legend>
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineDiubah" name="chkDiubah" value="Diubah">
                    <label class="form-check-label" for="inlineDiubah">
                        {{ 'Diubah' }}
                    </label>
                </div>
                
                <div class="diubah-section" style="display: none;">
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addDiubah" id="dynamic-diubah" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-bordered table-striped" id="dynamicAddDiubah" style="font-size: small;">
                            <tr style="vertical-align: middle; text-align: center;">
                                <th style="width: 100%;">Nama Peraturan</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineMengubah" name="chkMengubah" value="Mengubah">
                    <label class="form-check-label" for="inlineMengubah">
                        {{ 'Mengubah' }}
                    </label>
                </div>
                
                <div class="mengubah-section" style="display: none;">
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addMengubah" id="dynamic-mengubah" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-bordered table-striped" id="dynamicAddMengubah" width="100%" style="font-size: small;">
                            <tr style="vertical-align: middle; text-align: center;">
                                <th style="width: 100%;">Nama Peraturan</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineDicabut" name="chkDicabut" value="Dicabut">
                    <label class="form-check-label" for="inlineDicabut">
                        {{ 'Dicabut' }}
                    </label>
                </div>
                
                <div class="dicabut-section" style="display: none;">
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addDicabut" id="dynamic-dicabut" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-bordered table-striped" id="dynamicAddDicabut" width="100%" style="font-size: small;">
                            <tr style="vertical-align: middle; text-align: center;">
                                <th style="width: 100%;">Nama Peraturan</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineMencabut" name="chkMencabut" value="Mencabut">
                    <label class="form-check-label" for="inlineMencabut">
                        {{ 'Mencabut' }}
                    </label>
                </div>
                
                <div class="mencabut-section" style="display: none;">
                    <div style="margin-bottom: 5px;">
                        <button type="button" name="addMencabut" id="dynamic-mencabut" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i>&nbsp;Tambah
                        </button>
                    </div>

                    <div>
                        <table class="table table-bordered table-striped" id="dynamicAddMencabut" width="100%" style="font-size: small;">
                            <tr style="vertical-align: middle; text-align: center;">
                                <th style="width: 100%;">Nama Peraturan</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <textarea name="catatan_status" class="form-control form-control-sm h_100" cols="30" rows="10">{{ old('catatan_status') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    
    <hr>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Peraturan Terkait</legend>
        <div style="margin-bottom: 5px;">
            <button type="button" name="addDocuments" id="dynamic-documents" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i>&nbsp;Tambah
            </button>
        </div>

        <div>
            <table class="table table-bordered table-striped" id="dynamicAddDocuments" width="100%" style="font-size: small;">
                <tr style="vertical-align: middle; text-align: center;">
                    <th style="width: 100%;">Nama Peraturan</th>
                    <th style="width: 10%;">Aksi</th>
                </tr>
            </table>
        </div>
    </fieldset>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Dokumen Terkait</legend>
        <div style="margin-bottom: 5px;">
            <button type="button" name="addDocumentsTerkait" id="dynamic-documents-terkait" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i>&nbsp;Tambah
            </button>
        </div>

        <div>
            <table class="table table-bordered table-striped" id="dynamicAddDocumentsTerkait" width="100%" style="font-size: small;">
                <tr style="vertical-align: middle; text-align: center;">
                    <th style="width: 100%;">Dokumen</th>
                    <th style="width: 10%;">Aksi</th>
                </tr>
            </table>
        </div>
    </fieldset>
    
    <div class="form-group">
        <label for="">Publish Peraturan</label>
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