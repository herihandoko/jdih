@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Ubah Berita</h1>

    <form id="createBerita" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-primary">Ubah Berita</h6>
                <div class="float-right d-inline">
                    <a href="{{ route('admin.media_hukum.berita.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat List</a>
                </div>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label for="">Judul Berita *</label>
                    <input type="hidden" id="idBerita" value="{{ $beritaList->id }}">
                    <input type="text" name="judul_berita" class="form-control" value="{{ $beritaList->judul_berita }}" autofocus>
                </div>
                
                <div class="form-group">
                    <label for="">Kategori Berita *</label>
                    <select name="berita_categories_id" class="form-control" required>
                        <option value="">{{ '-Pilih-' }}</option>
                        @foreach($beritaCategory as $row)
                            <option value="{{ $row->id }}" @if($row->id == $beritaList->berita_categories_id) selected @endif>
                                {{ $row->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Content Berita</label>
                    <textarea id="editorContent" class="form-control form-control-sm" cols="30" rows="10">{!! $beritaList->content_berita !!}</textarea>
                    <div id="divEditorContent" style="display: none;"></div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Foto Saat Ini</label>
                                <div>
                                    @if($beritaList->photo_berita)
                                        <img src="{{ url('storage/places/berita/'.$beritaList->photo_berita) }}" alt="" class="w_300">
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
                                <span style="font-style: italic; font-size: smaller;">(Ekstensi Foto: .jpeg, .png, .jpg || Maks.: 1.5MB)</span>
                                <div class="file-upload-container">
                                    <input id="file-upload" type="file" name="photo_berita" accept=".jpeg, .png, .jpg">
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
                    <label for="">Status *</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_active" id="rr1" value="1" @if($beritaList->publish == 1) checked @endif>
                            <label class="form-check-label font-weight-normal" for="rr1">Publish</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_active" id="rr2" value="0" @if($beritaList->publish == 0) checked @endif>
                            <label class="form-check-label font-weight-normal" for="rr2">Tidak Publish</label>
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
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#createBerita').on('submit', function (e) {
                e.preventDefault();
                
                $("#btnSubmit").prop("disabled", true);
                $("#btnSubmit").html(
                        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Proses..."
                );
        
                var valEditorContent = tinymce.get('editorContent').getContent();
                $('#divEditorContent').text(valEditorContent);
                var valhtmlEditorContent = $('#divEditorContent').html();

                var formData = new FormData(this);
                formData.append('content_berita',valhtmlEditorContent);
                
                $(".invalid-feedback").children("strong").text("");
                $("#createBerita input").removeClass("is-invalid");
                
                var idBerita = $("#idBerita").val();
                var url = "{{ route('admin.media_hukum.berita.update', ':id') }}";
                url = url.replace(':id', idBerita);
                
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json"
                    },
                    url: url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: (response) => {
                        Swal.fire(
                            'Informasi!',
                            'Data berhasil diubah',
                            'success'
                        ).then((result)=>{
                            $("#btnSubmit").html(
                                "Ubah"
                            );
                            $("#btnSubmit").prop("disabled", false);
                            
                            window.location.reload();
                        });
                    },
                    error: (response) => {
                        if(response.status === 422) {
                            var errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function (key) {
                                $("#" + key + "Input").addClass("is-invalid");
                                $("#" + key + "Error").children("strong").text(errors[key][0]);
                            });

                            $("#btnSubmit").html(
                                "Ubah"
                            );
                            $("#btnSubmit").prop("disabled", false);
                        } else {
                            window.location.reload();
                        }
                    }
                })
            });
        });
    </script>
@endsection