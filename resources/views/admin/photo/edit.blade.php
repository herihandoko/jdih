@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah Foto</h1>

    <form action="{{ url('admin/photo-gallery/update/'.$photo->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah Foto</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.photo.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Lihat List</a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nama Foto</label>
                            <input type="text" name="photo_caption" class="form-control" value="{{ $photo->photo_caption }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="">Urut</label>
                            <input type="number" name="photo_order" class="form-control" value="{{ $photo->photo_order }}">
                        </div>        
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Image Saat Ini</label>
                            <div>
                                @if($photo)
                                    <img src="{{ asset('storage/places/galeri_foto/'.$photo->photo_name) }}" alt="" class="w_300">
                                @else
                                    <img alt="" class="w_300">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Ubah Image</label>
                            <span style="font-style: italic; font-size: smaller;">(Ekstensi Foto: .jpeg, .png, .jpg, .gif || Maks.: 1.5 MB)</span>
                            <div>
                                <input type="file" name="photo_name" accept=".jpeg, .png, .jpg, .gif">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-block btn-sm btn-success">
                    Ubah
                </button>
            </div>
        </div>
    </form>

@endsection
