@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Pilih Jenis Dokumen</h1>
    
    <form action="{{ route('admin.produk_hukum.listdata.postjenisdokumen') }}" method="post" autocomplete="off">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Pilih Jenis Dokumen</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.produk_hukum.listdata.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat List</a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label for="">Jenis Dokumen *</label>
                    <select name="produk_hukum_categories_id" class="form-control" required="true">
                        <option value="">{{ '-Pilih-' }}</option>
                        @foreach($produkHukumCategory as $row)
                            <option value="{{ $row->id }}" @if($row->id == session()->get('registerJenisDok')) selected @endif>{{ $row->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success">Selanjutnya</button>
            </div>
        </div>
    </form>

@endsection