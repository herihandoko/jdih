@extends('admin.admin_layouts')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">Menus</h1>

<form action="{{ url('admin/menu/update') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 mt-2 font-weight-bold text-primary">List Menu</h6>
                    <div class="float-right d-inline">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#modalCreateMenu" id="createMenu">
                            <i class="fa fa-plus"></i> Tambah Menu
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="" width="100%" cellspacing="0">
                            <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Menu Name</th>
                                <th>Menu Parent</th>
                                <th>Menu Slug</th>
                                <th>Link</th>
                                <th>Jenis Peraturan</th>
                                <th style="width: 10%;">Menu Order</th>
                                <th style="width: 10%;">Menu Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $row)
                                <input type="hidden" name="menu_id[]" value="{{ $row->id }}">
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($row->editabled == 1 && $row->type_doc == 0)
                                        <input type="text" name="menu_name[]" value="{{ $row->menu_name }}" class="form-control" required>
                                        @else
                                            <input type="text" name="menu_name[]" value="{{ $row->menu_name }}" class="form-control" readonly>
                                        @endif
                                        <input type="hidden" name="type_doc[]" value="{{ $row->type_doc }}" class="form-control" readonly>
                                    </td>
                                    <td>
                                        @if($row->editabled == 0)
                                            <select name="parent_id[]" class="form-control" disabled="true">
                                                <option value="0" selected>{{ '-Pilih Menu Parent-' }}</option>
                                            </select>
                                            <input type="hidden" name="parent_id[]" value="0"/>
                                        @else
                                            <select name="parent_id[]" class="form-control">
                                                <option value="0">{{ '-Pilih Menu Parent-' }}</option>
                                                @foreach($menus_name as $row_parent)
                                                    <option value="{{ $row_parent->id }}" @if($row->parent_id == $row_parent->id) selected @endif>{{ $row_parent->menu_name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="slug[]" value="{{ $row->slug }}" class="form-control" readonly>
                                        <input type="hidden" name="editabled[]" value="{{ $row->editabled }}" class="form-control" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="free_link[]" value="{{ $row->free_link }}" class="form-control">
                                    </td>
                                    
                                    <td>
                                        @if($row->type_doc == 0 && $row->parent_id != 0 && $row->editabled == 1)
                                            <select name="type_ruledoc[]" class="form-control">
                                                <option value="0">{{ '-Pilih Peraturan-' }}</option>
                                                @foreach($rules_name as $row_rules)
                                                    <option value="{{ $row_rules->id }}" @if($row->type_ruledoc == $row_rules->id) selected @endif>{{ $row_rules->type_name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name="type_ruledoc[]" class="form-control" disabled="true">
                                                <option value="0" selected>{{ '-Pilih Peraturan-' }}</option>
                                            </select>
                                            <input type="hidden" name="type_ruledoc[]" value="0"/>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        @if($row->editabled == 0)
                                            <input type="text" name="menu_order[]" value="0" class="form-control" readonly>
                                        @else
                                            <input type="text" name="menu_order[]" value="{{ $row->order }}" class="form-control">
                                        @endif
                                    </td>
                                    <td>
                                        <select name="menu_status[]" class="form-control">
                                            <option value="Show" @if($row->menu_status == 'Show') selected @endif>Show</option>
                                            <option value="Hide" @if($row->menu_status == 'Hide') selected @endif>Hide</option>
                                        </select>
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
<form method="post" action="{{url('admin/menu/store')}}" id="form">
    @csrf
<div class="modal fade" tabindex="-1" role="dialog" id="modalCreateMenu" aria-hidden="true" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="Name">Menu Name:</label>
                        <input type="text" class="form-control" name="menu_name" id="menu_name">
                        <span id="menuNameError" class="alert-message"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-ok" id="closeModal">
                    Batal
                </button>
                <button  class="btn btn-success btn-ok" id="ajaxSubmit">
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
            $('#menu_name').val('');
            $("#modalCreateMenu").modal("hide");
        });
        
        $('#ajaxSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            jQuery.ajax({
                url: '/admin/menu/store',
                type: 'post',
                data: {
                    menu_name: $('#menu_name').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    if(response.code == 200) {
                        window.location.reload();
                        $("#modalCreateMenu").modal("hide");
                    }
                },
                error: function(response) {
                    $('#menuNameError').text(response.responseJSON.errors.menu_name);
                }
            });
        });
    });
</script>
        
@endsection