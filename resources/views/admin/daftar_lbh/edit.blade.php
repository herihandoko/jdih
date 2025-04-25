@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah LBH</h1>

    <form action="{{ url('admin/daftar-lbh/update/'.$lbhList->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah LBH</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.daftar_lbh.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Lihat List</a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nama LBH</label>
                            <input type="text" name="lbh_name" class="form-control form-control-sm" value="{{ $lbhList->lbh_name }}" autofocus required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Alamat LBH</label>
                            <textarea name="lbh_address" class="form-control form-control-sm" rows="5">{{ $lbhList->lbh_address }}</textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Deskripsi LBH</label>
                            <textarea name="lbh_desc" class="form-control form-control-sm" rows="5">{{ $lbhList->lbh_desc }}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">No. Telp.</label>
                            <input type="text" name="lbh_phone" class="form-control form-control-sm" value="{{ $lbhList->lbh_phone }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Akreditasi</label>
                            <input type="text" name="lbh_accreditation" class="form-control form-control-sm" value="{{ $lbhList->lbh_accreditation }}">
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="">Urut</label>
                            <input type="number" name="lbh_order" class="form-control form-control-sm" value="{{ $lbhList->lbh_order }}">
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="form-group">
                            <label for="">Status</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="lbh_status" id="rr1" value="1" @if($lbhList->publish == 1) checked @endif>
                                    <label class="form-check-label font-weight-normal" for="rr1">Publish</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="lbh_status" id="rr2" value="0" @if($lbhList->publish == 0) checked @endif>
                                    <label class="form-check-label font-weight-normal" for="rr2">Tidak Publish</label>
                                </div>
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
