<div class="card-body">
    <div class="form-group">
        <label for="">Jenis Peraturan *</label>
        <select name="produk_hukum_types_id" class="form-control form-control-sm select2" required="true">
            <option value="">{{ '-Pilih-' }}</option>
            @foreach($produkHukumType as $row)
                <option value="{{ $row->id }}" @if($row->id == $produkHukumList->produk_hukum_types_id) selected @endif>{{ $row->type_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Judul Peraturan *</label>
                    <input type="text" name="judul_peraturan" class="form-control form-control-sm" value="{{ $produkHukumList->judul_peraturan }}" autofocus required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Bahasa</label>
                    <select name="bahasa" class="form-control form-control-sm">
                        <option value="">{{ '-Pilih-' }}</option>
                        @foreach($produkHukumLanguage as $row)
                            <option value="{{ $row->language_name }}" @if($row->language_name == $produkHukumList->bahasa) selected @endif>{{ $row->language_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Nomor Peraturan</label>
                    <input type="text" name="nmr_peraturan" class="form-control form-control-sm" value="{{ $produkHukumList->nmr_peraturan }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">

            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tahun Peraturan</label>
                    <input type="text" name="thn_peraturan" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" class="form-control form-control-sm" value="{{ $produkHukumList->thn_peraturan }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Singkatan Jenis Peraturan</label>
                    <input type="text" name="singkatan_peraturan" class="form-control form-control-sm" value="{{ $produkHukumList->singkatan_peraturan }}">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Lokasi</label>
                    <input type="text" name="instansi" class="form-control form-control-sm" value="{{ $produkHukumList->instansi }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Pengajuan</label>
                    <input id="tgl_pengajuan" type="text" name="tgl_pengajuan" class="form-control form-control-sm" value="{{ $produkHukumList->tgl_pengajuan != null ? Carbon\Carbon::parse($produkHukumList->tgl_pengajuan)->format('d-m-Y') : '' }}" style="background-color: white;" readonly>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">Tgl Pembahasan</label>
                    <div class="input-group mb-3">
                        <input type="text" name="tgl_pembahasan" class="form-control form-control-sm" readonly="true" value="{{ $produkHukumList->tgl_pembahasan }}">
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
                    <input type="text" name="tempat_penetapan" class="form-control form-control-sm" value="{{ $produkHukumList->tempat_penetapan }}">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Penetapan</label>
                    <input id="tgl_penetapan" type="text" name="tgl_penetapan" class="form-control form-control-sm" value="{{ $produkHukumList->tgl_penetapan != null ? Carbon\Carbon::parse($produkHukumList->tgl_penetapan)->format('d-m-Y') : '' }}" style="background-color: white;" readonly>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="">Tgl Pengundangan</label>
                    <input id="tgl_pengundangan" type="text" name="tgl_pengundangan" class="form-control form-control-sm" value="{{ $produkHukumList->tgl_pengundangan != null ? Carbon\Carbon::parse($produkHukumList->tgl_pengundangan)->format('d-m-Y') : '' }}" style="background-color: white;" readonly>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Sumber</label>
                    <input type="text" name="sumber" class="form-control form-control-sm" value="{{ $produkHukumList->sumber }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Subjek</label>
                    <input type="text" name="subjek" class="form-control form-control-sm" value="{{ $produkHukumList->subjek }}">
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
                            <option value="{{ $row->id }}" @if($row->id == $produkHukumList->urusan) selected @endif>
                                {{ $row->up_code}}. {{ $row->up_name }}
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
                            <option value="{{ $row->id }}" @if($row->id == $produkHukumList->bidang_hukum) selected @endif>
                                {{ $row->bh_code}}. {{ $row->bh_name }}
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
                    <input type="text" name="teu_badan" class="form-control form-control-sm" value="{{ $produkHukumList->teu_badan }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Pemrakarsa</label>
                    <input type="text" name="pemrakarsa" class="form-control form-control-sm" value="{{ $produkHukumList->pemrakarsa }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="">File Peraturan</label>
                <div>
                    @if($produkHukumList->file_peraturan)
                        <a target="_blank" href="{{ url('storage/places/peraturan/'.$produkHukumList->file_peraturan) }}">
                            {{ $produkHukumList->file_peraturan }}
                        </a>
                    @else
                        {{ 'Tidak ada file' }}
                    @endif
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Ubah File Peraturan</label>
                    <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf, .zip || Maks.: 250 MB)</span>
<!--                    <div>
                        <input type="file" name="file_peraturan" accept=".pdf, .zip">
                    </div>-->
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="customFilePeraturan" name="file_peraturan" accept=".pdf, .zip">
                        <label class="custom-file-label" for="customFile">Pilih file</label>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <label for="">Abstrak File</label>
                <div>
                    @if($produkHukumList->abstrak)
                        <a target="_blank" href="{{ url('storage/places/peraturan/'.$produkHukumList->abstrak) }}">
                            {{ $produkHukumList->abstrak }}
                        </a>
                    @else
                        {{ 'Tidak ada file' }}
                    @endif
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Ubah Abstrak File</label>
                    <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf, .zip || Maks.: 250 MB)</span>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="customAbstrak" name="abstrak" accept=".pdf, .zip">
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
                        <option value="Berlaku" @if($produkHukumList->status_akhir == 'Berlaku') selected @endif>Berlaku</option>
<!--                        <option value="Diubah" @if($produkHukumList->status_akhir == 'Diubah') selected @endif>Diubah</option>
                        <option value="Mengubah" @if($produkHukumList->status_akhir == 'Mengubah') selected @endif>Mengubah</option>
                        <option value="Dicabut" @if($produkHukumList->status_akhir == 'Dicabut') selected @endif>Dicabut</option>
                        <option value="Mencabut" @if($produkHukumList->status_akhir == 'Mencabut') selected @endif>Mencabut</option>-->
                        <option value="Tidak Berlaku" @if($produkHukumList->status_akhir == 'Tidak Berlaku') selected @endif>Tidak Berlaku</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Hasil Uji MK</label>
                    <input type="text" name="hasil_uji" class="form-control form-control-sm" value="{{ $produkHukumList->hasil_uji }}">
                </div>
            </div>
        </div>
    </div>
    
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Catatan Status</legend>
        <div class="row">
            <div class="col-md-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineDiubah" name="chkDiubah" value="Diubah" @if($catatanStatus->contains('jenis_status', 'Diubah')) checked @endif>
                    <label class="form-check-label" for="inlineDiubah">
                        {{ 'Diubah' }}
                    </label>
                </div>
                
                <div class="diubah-section">
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
                            @for ($i = 0; $i < count($catatanStatus); $i++)
                                @if($catatanStatus[$i]->jenis_status == 'diubah')
                                    <tr>
                                        <td>
                                            <input type="hidden" name="existing_diubah[]" value="{{ $catatanStatus[$i]->peraturan_catatan }}">
                                            <select name="peraturan_diubah[]" id="diubah_id_{{ $i }}" class="form-control form-control-sm peraturan_select" disabled>
                                                <option value="">-- Pilih Dokumen --</option>
                                                @foreach($produkJudulPeraturan as $row)
                                                <option value="{{ $row->id }}" @if($row->id == $catatanStatus[$i]->peraturan_catatan) selected @endif>
                                                    {{ $row->judul_peraturan }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-input-documents">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineMengubah" name="chkMengubah" value="Mengubah" @if($catatanStatus->contains('jenis_status', 'Mengubah')) checked @endif>
                    <label class="form-check-label" for="inlineMengubah">
                        {{ 'Mengubah' }}
                    </label>
                </div>
                
                <div class="mengubah-section">
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
                            @for ($i = 0; $i < count($catatanStatus); $i++)
                                @if($catatanStatus[$i]->jenis_status == 'mengubah')
                                    <tr>
                                        <td>
                                            <input type="hidden" name="existing_mengubah[]" value="{{ $catatanStatus[$i]->peraturan_catatan }}">
                                            <select name="peraturan_mengubah[]" id="mengubah_id_{{ $i }}" class="form-control form-control-sm peraturan_select" disabled>
                                                <option value="">-- Pilih Dokumen --</option>
                                                @foreach($produkJudulPeraturan as $row)
                                                <option value="{{ $row->id }}" @if($row->id == $catatanStatus[$i]->peraturan_catatan) selected @endif>
                                                    {{ $row->judul_peraturan }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-input-documents">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineDicabut" name="chkDicabut" value="Dicabut" @if($catatanStatus->contains('jenis_status', 'Dicabut')) checked @endif>
                    <label class="form-check-label" for="inlineDicabut">
                        {{ 'Dicabut' }}
                    </label>
                </div>
                
                <div class="dicabut-section">
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
                            @for ($i = 0; $i < count($catatanStatus); $i++)
                                @if($catatanStatus[$i]->jenis_status == 'dicabut')
                                    <tr>
                                        <td>
                                            <input type="hidden" name="existing_dicabut[]" value="{{ $catatanStatus[$i]->peraturan_catatan }}">
                                            <select name="peraturan_dicabut[]" id="dicabut_id_{{ $i }}" class="form-control form-control-sm peraturan_select" disabled>
                                                <option value="">-- Pilih Dokumen --</option>
                                                @foreach($produkJudulPeraturan as $row)
                                                <option value="{{ $row->id }}" @if($row->id == $catatanStatus[$i]->peraturan_catatan) selected @endif>
                                                    {{ $row->judul_peraturan }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-input-documents">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineMencabut" name="chkMencabut" value="Mencabut" @if($catatanStatus->contains('jenis_status', 'Mencabut')) checked @endif>
                    <label class="form-check-label" for="inlineMencabut">
                        {{ 'Mencabut' }}
                    </label>
                </div>
                
                <div class="mencabut-section">
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
                            @for ($i = 0; $i < count($catatanStatus); $i++)
                                @if($catatanStatus[$i]->jenis_status == 'mencabut')
                                    <tr>
                                        <td>
                                            <input type="hidden" name="existing_mencabut[]" value="{{ $catatanStatus[$i]->peraturan_catatan }}">
                                            <select name="peraturan_mencabut[]" id="mencabut_id_{{ $i }}" class="form-control form-control-sm peraturan_select" disabled>
                                                <option value="">-- Pilih Dokumen --</option>
                                                @foreach($produkJudulPeraturan as $row)
                                                <option value="{{ $row->id }}" @if($row->id == $catatanStatus[$i]->peraturan_catatan) selected @endif>
                                                    {{ $row->judul_peraturan }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-sm remove-input-documents">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endfor
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
                    <textarea name="catatan_status" class="form-control form-control-sm h_100" cols="30" rows="10">{{ $produkHukumList->catatan_status }}</textarea>
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
            <table class="table table-bordered table-striped" id="dynamicAddDocuments">
                <tr style="vertical-align: middle; text-align: center;">
                    <th style="width: 100%;">Nama Peraturan</th>
                    <th style="width: 10%;">Aksi</th>
                </tr>
                @if(count($produkPeraturanTerkait) != 0)
                    @for ($i = 0; $i < count($produkPeraturanTerkait); $i++)
                        <tr>
                            <td>
                                <input type="hidden" name="existing_peraturan_terkait[]" value="{{ $produkPeraturanTerkait[$i]->peraturan_terkait }}">
                                <select name="peraturan_terkait[]" id="peraturan_id_{{ $i }}" class="form-control form-control-sm peraturan_select" disabled>
                                    <option value="">-- Pilih Dokumen --</option>
                                    @foreach($produkJudulPeraturan as $row)
                                    <option value="{{ $row->id }}" @if($row->id == $produkPeraturanTerkait[$i]->peraturan_terkait) selected @endif>
                                        {{ $row->judul_peraturan }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm remove-input-documents">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @endfor
                @endif
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
            <table class="table table-bordered table-striped" id="dynamicAddDocumentsTerkait">
                <tr style="vertical-align: middle; text-align: center;">
                    <th style="width: 100%;">Dokumen</th>
                    <th style="width: 10%;">Aksi</th>
                </tr>
                @if(count($produkDokumenTerkait) != 0)
                    @for ($i = 0; $i < count($produkDokumenTerkait); $i++)
                        <tr>
                            <td>
<!--                                <input type="file" class="form-control-file" name="file_doc_terkait[]" id="file_doc_terkait[{{ $i }}]" accept=".pdf">-->
                                <input type="hidden" name="existing_dokumen_terkait[]" value="{{ $produkDokumenTerkait[$i]->dokumen_terkait }}">
                                <div>
                                    <a target="_blank" href="{{ url('storage/places/peraturan/'.$produkDokumenTerkait[$i]->dokumen_terkait) }}">
                                        <small>{{ $produkDokumenTerkait[$i]->dokumen_terkait }}</small>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-danger btn-sm remove-input-documents-terkait">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @endfor
                @endif
            </table>
        </div>
    </fieldset>
    
    <div class="form-group">
        <label for="">Publish Peraturan</label>
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