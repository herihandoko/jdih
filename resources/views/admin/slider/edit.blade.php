@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Edit Slider</h1>

    <form action="{{ url('admin/slider/update/'.$slider->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="current_photo" value="{{ $slider->slider_photo }}">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Edit Slider</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label for="">Slider Heading</label>
                    <input type="text" name="slider_heading" class="form-control" value="{{ $slider->slider_heading }}" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Slider Text</label>
                    <textarea name="slider_text" class="form-control h_100" cols="30" rows="10">{{ $slider->slider_text }}</textarea>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Slider Button Text *</label>
                                <input type="text" name="slider_button_text" class="form-control" value="{{ $slider->slider_button_text }}" autofocus required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Slider Button URL *</label>
                                <input type="text" name="slider_button_url" class="form-control" value="{{ $slider->slider_button_url }}" autofocus required>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Existing Slider</label>
                                <div>
                                    @if($slider->slider_photo)
                                        <img src="{{ url('storage/places/'.$slider->slider_photo) }}" alt="" class="w_300">
                                    @else
                                        <img src="{{ url('storage/places/logo_institusi/no-logo.png') }}" alt="" class="w_200">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file-upload" class="custom-file-upload btn btn-primary">
                                    Pilih File
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
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Order</label>
                                <input type="text" name="slider_sort" class="form-control form-control-sm" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="1" value="{{ $slider->slider_sort }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Publish</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_publish" id="rr1" value="1" @if($slider->is_publish == 1) checked @endif>
                                        <label class="form-check-label font-weight-normal" for="rr1">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="is_publish" id="rr2" value="0" @if($slider->is_publish == 0) checked @endif>
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
                    Update
                </button>
            </div>
        </div>
    </form>

@endsection