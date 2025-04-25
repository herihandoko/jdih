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

<h1 class="h3 mb-3 text-gray-800">Integrasi API</h1>

<form action="{{ url('admin/api-link/update') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">List API</h6>
                    <div class="float-right d-inline">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#modalCreateApi" id="createApi">
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
                                <th>API Name</th>
                                <th>API URL</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($apiLink as $index => $row)
                                    <input type="hidden" name="api_id[]" value="{{ $row->id }}">
                                    <tr>
                                        <td style="width: 5%; vertical-align: middle;">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td>
                                            <input type="text" name="api_name[]" value="{{ $row->api_name }}" class="form-control form-control-sm" required>
                                        </td>
                                        
                                        <td>
                                            <input type="text" name="api_url[]" value="{{ $row->api_url }}" class="form-control form-control-sm" required>
                                        </td>
                                        
                                        <td style="text-align: center;">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="api_active[{{ $index }}]" id="ra1_{{ $index }}" value="1" @if($row->api_active == 1) checked @endif>
                                                            <label class="form-check-label font-weight-normal" for="ra1_{{ $index }}">Aktif</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="api_active[{{ $index }}]" id="ra2_{{ $index }}" value="0" @if($row->api_active == 0) checked @endif>
                                                            <label class="form-check-label font-weight-normal" for="ra2_{{ $index }}">Tidak Aktif</label>
                                                        </div>
                                                    </div>
                                                    <span id="apiActiveError" class="text-red"></span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-sm btn-success">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
    
<!-- Modal -->
<form method="post" action="{{url('admin/api-link/store')}}" id="form">
    @csrf
    <div class="modal fade" tabindex="-1" role="dialog" id="modalCreateApi" aria-hidden="true" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Daftar API</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="Name">API Name:</label>
                            <input type="text" class="form-control form-control-sm" name="api_name" id="api_name">
                            <span id="apiNameError" class="text-red"></span>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="Url">API URL:</label>
                            <input type="text" class="form-control form-control-sm" name="api_url" id="api_url">
                            <span id="apiUrlError" class="text-red"></span>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="Status">Status:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="api_active" id="ra1" value="1">
                                    <label class="form-check-label font-weight-normal" for="ra1">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="api_active" id="ra2" value="0">
                                    <label class="form-check-label font-weight-normal" for="ra2">Tidak Aktif</label>
                                </div>
                            </div>
                            <span id="apiActiveError" class="text-red"></span>
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
            $('#api_name').val('');
            $('#api_url').val('');
            $('input[name="api_active"]').prop('checked', false);
            $('#apiNameError').text('');
            $('#apiUrlError').text('');
            $('#apiActiveError').text('');
            $("#modalCreateApi").modal("hide");
        });
        
        $('#ajaxSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            jQuery.ajax({
                url: '/admin/api-link/store',
                type: 'post',
                data: {
                    api_name: $('#api_name').val(),
                    api_url: $('#api_url').val(),
                    api_active: $('input[name="api_active"]:checked').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    if(response.code == 200) {
                        window.location.reload();
                        $("#modalCreateApi").modal("hide");
                    }
                },
                error: function(response) {
                    $('#apiNameError').text(response.responseJSON.errors.api_name);
                    $('#apiUrlError').text(response.responseJSON.errors.api_url);
                    $('#apiActiveError').text(response.responseJSON.errors.api_active);
                }
            });
        });
    });
</script>
        
@endsection