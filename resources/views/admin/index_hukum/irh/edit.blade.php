@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah Indeks IRH</h1>

    <form action="{{ url('admin/index-hukum/irh/update/'.$indexIrh->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah Indeks IRH</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.index_hukum.irh.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Lihat List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input type="text" name="irh_name" class="form-control form-control-sm" value="{{ $indexIrh->irh_name }}" autofocus required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="text" name="irh_year" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" class="form-control form-control-sm" value="{{ $indexIrh->irh_year }}">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="text" name="irh_score" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control form-control-sm" value="{{ $indexIrh->irh_score }}">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">File Saat Ini</label>
                            @if($indexIrh->irh_file)
                                <embed type="application/pdf" src="{{ url('storage/places/index_hukum/'.$indexIrh->irh_file) }}#scrollbar=0" style="height: 400px; width: 100%;" class="hidden-xs">
                            @else
                                <div>
                                    <i class="fas fa-ban fa-5x text-danger"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Ubah File</label>
                            <span style="font-style: italic; font-size: smaller;">(Ekstensi File: .pdf || Maks.: 4MB)</span>
                            <div>
                                <input type="file" name="irh_file" accept=".pdf">
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($indexIrh->irh_file)
                    <div class="form-group">
                        <label for="">File tampil di web</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="irh_file_view" id="ri1" value="0" @if($indexIrh->irh_file_view == 0) checked @endif>
                                <label class="form-check-label font-weight-normal" for="rr1">Tampil</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="irh_file_view" id="ri2" value="1" @if($indexIrh->irh_file_view == 1) checked @endif>
                                <label class="form-check-label font-weight-normal" for="rr2">Tidak Tampil</label>
                            </div>
                        </div>
                    </div>
                @endif
                
                <button type="submit" class="btn btn-success">Ubah</button>
            </div>
        </div>
    </form>

@endsection
