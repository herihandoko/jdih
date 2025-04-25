@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Add Footer Column Item</h1>

    <form action="{{ route('admin.footer.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Add Footer Column Item</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.footer.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Column Item Text *</label>
                                <input type="text" name="column_item_text" class="form-control form-control-sm" value="{{ old('column_item_text') }}" autofocus>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Column Item URL *</label>&nbsp;(<font style="font-style: italic;">contoh: https://www.bantenprov.go.id/ </font>)
                                <input type="text" name="column_item_url" class="form-control form-control-sm" value="{{ old('column_item_url') }}" autofocus>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file-upload" class="custom-file-upload btn btn-primary">
                                    Pilih File
                                </label>
                                <span style="font-style: italic; font-size: smaller;">(Ekstensi Foto: .jpeg, .png, .jpg || Maks.: 1.5 MB)</span>
                                <div class="file-upload-container">
                                    <input id="file-upload" type="file" name="logo" accept=".jpeg, .png, .jpg">
                                    <div id="file-name" class="file-name">Tidak ada file yang dipilih</div>
                                    <div id="preview-container" class="preview-container">
                                        <img id="image-preview" class="image-preview" src="#" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Column Item Order</label>
                                <input type="text" name="column_item_order" class="form-control form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="1" value="{{ old('column_item_order', '0') }}">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tampil sebagai anggota</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_member" id="rr1" value="1" checked>
                                        <label class="form-check-label font-weight-normal" for="rr1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_member" id="rr2" value="0">
                                        <label class="form-check-label font-weight-normal" for="rr2">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" hidden>
                            <label for="">Select Column</label>
                            <select name="column_name" class="form-control">
                                <option value="Column 1">Column 1</option>
                                <option value="Column 2" selected>Column 2</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-sm btn-success">
                    Submit
                </button>
            </div>
        </div>
    </form>

@endsection