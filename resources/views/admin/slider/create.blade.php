@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Add Slider</h1>

    <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Add Slider</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label for="">Slider Heading</label>
                    <input type="text" name="slider_heading" class="form-control form-control-sm" value="{{ old('slider_heading') }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Slider Text</label>
                    <textarea name="slider_text" class="form-control form-control-sm h_100" cols="30" rows="10">{{ old('slider_text') }}</textarea>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Slider Button Text *</label>
                                <input type="text" name="slider_button_text" class="form-control form-control-sm" value="{{ old('slider_button_text') }}" autofocus required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Slider Button URL *</label>
                                <input type="text" name="slider_button_url" class="form-control form-control-sm" value="{{ old('slider_button_url') }}" autofocus required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file-upload" class="custom-file-upload btn btn-primary">
                                    Slider Photo *
                                </label>
                                <span style="font-style: italic; font-size: smaller;">(Ekstensi Foto: .jpeg, .png, .jpg || Maks.: 2MB)</span>
                                <div class="file-upload-container">
                                    <input id="file-upload" type="file" name="slider_photo" accept=".jpeg, .png, .jpg">
                                    <div id="file-name" class="file-name">Tidak ada file yang dipilih</div>
                                    <div id="preview-container" class="preview-container">
                                        <img id="image-preview" class="image-preview" src="#" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Order</label>
                                <input type="text" name="slider_sort" class="form-control form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="1" value="{{ old('column_item_order', '0') }}">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Publish</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_publish" id="rr1" value="1" checked>
                                        <label class="form-check-label font-weight-normal" for="rr1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_publish" id="rr2" value="0">
                                        <label class="form-check-label font-weight-normal" for="rr2">Tidak</label>
                                    </div>
                                </div>
                            </div>
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
