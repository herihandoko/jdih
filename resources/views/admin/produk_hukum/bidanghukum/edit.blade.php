@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah Bidang Hukum</h1>

    <form action="{{ url('admin/produk-hukum/bidang-hukum/update/'.$produkHukumBidangHukum->id) }}" method="post">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah Bidang Hukum</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.produk_hukum.bh.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Kode *</label>
                            <input type="text" name="bh_code" class="form-control" value="{{ $produkHukumBidangHukum->bh_code }}" autofocus required>
                        </div>
                    </div>
                    
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="">Bidang Hukum *</label>
                            <input type="text" name="bh_name" class="form-control" value="{{ $produkHukumBidangHukum->bh_name }}" autofocus required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Status *</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bh_active" id="rr1" value="1" @if($produkHukumBidangHukum->bh_active == 1) checked @endif>
                            <label class="form-check-label font-weight-normal" for="rr1">Aktif</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="bh_active" id="rr2" value="0" @if($produkHukumBidangHukum->bh_active == 0) checked @endif>
                            <label class="form-check-label font-weight-normal" for="rr2">Tidak Aktif</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Ubah</button>
            </div>
        </div>
    </form>

@endsection