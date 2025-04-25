@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Privacy Policy</h1>

    <form id="updatePrivacy" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Name *</label>
                    @if($page_privacy)
                        <input type="text" name="name" class="form-control form-control-sm" value="{{ $page_privacy->name }}" autofocus required>
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                    @else
                        <input type="text" name="name" class="form-control form-control-sm" autofocus required>
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Detail</label>
                    @if($page_privacy)
                        <textarea id="editorContent" class="form-control form-control-sm" cols="30" rows="10">{!! $page_privacy->detail !!}</textarea>
                        <div id="divEditorContent" style="display: none;"></div>
                    @else
                        <textarea name="detail" class="form-control form-control-sm" cols="30" rows="10"></textarea>
                    @endif
                </div>
            </div>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">SEO Information</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Title</label>
                    @if($page_privacy)
                        <input type="text" name="seo_title" class="form-control form-control-sm" value="{{ $page_privacy->seo_title }}">
                    @else
                        <input type="text" name="seo_title" class="form-control form-control-sm">
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Meta Description</label>
                    @if($page_privacy)
                        <textarea name="seo_meta_description" class="form-control form-control-sm h_100" cols="30" rows="10">{{ $page_privacy->seo_meta_description }}</textarea>
                    @else
                        <textarea name="seo_meta_description" class="form-control form-control-sm h_100" cols="30" rows="10"></textarea>
                    @endif
                </div>
                <button type="submit" class="btn btn-success" id="btnSubmit">Update</button>
            </div>
        </div>
    </form>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#updatePrivacy').on('submit', function (e) {
                
                e.preventDefault();
                
                $("#btnSubmit").prop("disabled", true);
                $("#btnSubmit").html(
                        "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Proses..."
                );
        
                var valEditorContent = tinymce.get('editorContent').getContent();
                $('#divEditorContent').text(valEditorContent);
                var valhtmlEditorContent = $('#divEditorContent').html();

                var formData = new FormData(this);
                formData.append('detail',valhtmlEditorContent);
                
                $(".invalid-feedback").children("strong").text("");
                $("#updatePrivacy input").removeClass("is-invalid");
                
                $.ajax({
                    method: "POST",
                    headers: {
                        Accept: "application/json"
                    },
                    url: "{{ route('admin.web_setting.page_privacy.update') }}",
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
                                    "Save"
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
                                "Save"
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
