@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Tambah Majalah Hukum</h1>

    <form action="{{ route('admin.media_hukum.majalahhukum.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Tambah Majalah Hukum</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.media_hukum.majalahhukum.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat List</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Judul Majalah *</label>
                    <input type="text" name="judul_majalah" class="form-control" value="{{ old('judul_majalah') }}" autofocus>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Penulis Majalah</label>
                                <input type="text" name="penulis_majalah" class="form-control" value="{{ old('penulis_majalah') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Bahasa</label>
                                <select name="bahasa_majalah" class="form-control">
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="English">English</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Edisi Majalah</label>
                                <input type="number" name="edisi_majalah" class="form-control" value="{{ old('edisi_majalah') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Penerbit Majalah</label>
                                <input type="text" name="penerbit_majalah" class="form-control" value="{{ old('penerbit_majalah') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tempat Terbit</label>
                                <input type="text" name="tempatterbit_majalah" class="form-control" value="{{ old('tempatterbit_majalah') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tahun Majalah</label>
                                <input type="number" name="tahun_majalah" class="form-control" value="{{ old('tahun_majalah') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Kategori Majalah</label>
                                <input type="text" name="kategori_majalah" class="form-control" value="{{ old('kategori_majalah') }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Lokasi Majalah</label>
                                <input type="text" name="lokasi_majalah" class="form-control" value="{{ old('lokasi_majalah') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Cover Majalah</label>
                            <div>
                                <input type="file" name="cover_majalah" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="">File Majalah</label>
                            <div>
                                <input type="file" name="file_majalah" accept=".pdf, .zip">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>
@endsection