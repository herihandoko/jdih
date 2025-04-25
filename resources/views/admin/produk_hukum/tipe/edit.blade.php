@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah Tipe Dokumen</h1>

    <form action="{{ url('admin/produk-hukum/tipe-dokumen/update/'.$produkHukumCategory->id) }}" method="post">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah Tipe Dokumen</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.produk_hukum.tipe.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat List</a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label for="">Tipe Dokumen *</label>
                    <input type="text" name="category_name" class="form-control" value="{{ $produkHukumCategory->category_name }}" autofocus>
                </div>

                <div class="form-group">
                    <label for="">Status *</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category_active" id="rr1" value="1" @if($produkHukumCategory->category_active == 1) checked @endif>
                            <label class="form-check-label font-weight-normal" for="rr1">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category_active" id="rr2" value="0" @if($produkHukumCategory->category_active == 0) checked @endif>
                            <label class="form-check-label font-weight-normal" for="rr2">Tidak Aktif</label>
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