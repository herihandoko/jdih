@extends('admin.admin_layouts')
@section('admin_content')
<style>
    tbody {
      display:block;
      max-height:500px;
      overflow-y:auto;
      font-size: small;
    }
    thead, tbody tr {
      display:table;
      width:100%;
      table-layout:fixed;
      font-size: small;
    }
    thead {
      width: calc( 100% - 1em )
    }
</style>

<h1 class="h3 mb-3 text-gray-800">Pages</h1>

<form action="{{ url('admin/page-manage/update') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">List Page</h6>
                    <div class="float-right d-inline">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#modalCreatePage" id="createPage">
                            <i class="fa fa-plus"></i> Tambah Baru
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-fixed table-sm table-responsive" id="" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>Page Name</th>
                                <th>Page View</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $row)
                                    <input type="hidden" name="page_id[]" value="{{ $row->id }}">
                                    <tr>
                                        <td style="width: 5%; vertical-align: middle;">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            <input type="text" name="page_name[]" value="{{ $row->page_name }}" class="form-control form-control-sm" required>
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="page_view[]" value="{{ $row->page_view }}" class="form-control form-control-sm" required>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
    
<!-- Modal -->
<form method="post" action="{{url('admin/page-manage/store')}}" id="form">
    @csrf
    <div class="modal fade" tabindex="-1" role="dialog" id="modalCreatePage" aria-hidden="true" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Page</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="Name">Page Name:</label>
                            <input type="text" class="form-control form-control-sm" name="page_name" id="page_name">
                            <span id="pageNameError" class="text-red"></span>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="View">Page View:</label>
                            <input type="text" class="form-control form-control-sm" name="page_view" id="page_view">
                            <span id="pageViewError" class="text-red"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger btn-ok" id="closeModal">
                        Batal
                    </button>
                    <button  class="btn btn-sm btn-success btn-ok" id="ajaxSubmit">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $('#closeModal').click(function(e){
            $('#page_name').val('');
            $('#page_view').val('');
            $('#pageNameError').text('');
            $('#pageViewError').text('');
            $("#modalCreatePage").modal("hide");
        });
        
        $('#ajaxSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            jQuery.ajax({
                url: '/admin/page-manage/store',
                type: 'post',
                data: {
                    page_name: $('#page_name').val(),
                    page_view: $('#page_view').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    if(response.code == 200) {
                        window.location.reload();
                        $("#modalCreatePage").modal("hide");
                    }
                },
                error: function(response) {
                    $('#pageNameError').text(response.responseJSON.errors.page_name);
                    $('#pageViewError').text(response.responseJSON.errors.page_view);
                }
            });
        });
    });
</script>
        
@endsection