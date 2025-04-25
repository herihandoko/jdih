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
    
    .caret {
        cursor: pointer;
        user-select: none;
        vertical-align: middle;
      }

    .caret::before {
      content: "\25B6";
      color: red;
      display: inline-block;
      margin-right: 6px;
    }

    .caret-down::before {
      transform: rotate(90deg);
    }
    
    .nested {
      display: none;
    }

    .active {
      display: block;
    }
</style>

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
                        <table class="table table-fixed table-sm table-responsive" id="" cellspacing="0">
                            <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th>Menu Name</th>
                                <th>Menu Parent</th>
                                <th>Menu Slug</th>
                                <th>Link</th>
                                <th>Jenis Peraturan</th>
                                <th>Page</th>
                                <th style="width: 5%;">Order</th>
                                <th style="width: 8%;">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $row)
                                    <input type="hidden" name="menu_id[]" value="{{ $row->id }}">
                                    <tr>
                                        <td style="width: 5%; vertical-align: middle;">
                                            {{ $loop->iteration }}
                                            @if(count($row->children))
                                                <span class="caret" data-toggle="collapse" data-target="#collapse{{$row->id}}"></span>
                                            @endif
                                            <ul class="nested"></ul>
                                        </td>

                                        <td style="width: auto;">
                                            @if($row->editabled == 1 && $row->type_doc == 0)
                                                <input type="text" name="menu_name[]" value="{{ $row->menu_name }}" class="form-control form-control-sm" required>
                                            @else
                                                <input type="text" name="menu_name[]" value="{{ $row->menu_name }}" class="form-control form-control-sm" readonly>
                                            @endif
                                                <input type="hidden" name="type_doc[]" value="{{ $row->type_doc }}" class="form-control form-control-sm" readonly>
                                        </td>

                                        <td style="width: auto;">
                                            @if($row->editabled == 0)
                                                <select name="parent_id[]" class="form-control form-control-sm" disabled="true">
                                                    <option value="0" selected>{{ '-Pilih Menu Parent-' }}</option>
                                                </select>
                                                <input type="hidden" name="parent_id[]" value="0"/>
                                            @else
                                                <select name="parent_id[]" class="form-control form-control-sm">
                                                    <option value="0">{{ '-Pilih Menu Parent-' }}</option>
                                                    @foreach($menus_name as $row_parent)
                                                        <option value="{{ $row_parent->id }}" @if($row->parent_id == $row_parent->id) selected @endif>{{ $row_parent->menu_name }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </td>
                                        <td style="width: auto;">
                                            <input type="text" name="slug[]" value="{{ $row->slug }}" class="form-control form-control-sm" readonly>
                                            <input type="hidden" name="editabled[]" value="{{ $row->editabled }}" class="form-control form-control-sm" readonly>
                                        </td>
                                        <td style="width: auto;">
                                            <input type="text" name="free_link[]" value="{{ $row->free_link }}" class="form-control form-control-sm">
                                        </td>

                                        <td style="width: auto;">
                                            @if($row->type_doc == 0 && $row->parent_id != 0 && $row->editabled == 1)
                                                <select name="type_ruledoc[]" class="form-control form-control-sm">
                                                    <option value="0">{{ '-Pilih Peraturan-' }}</option>
                                                    @foreach($rules_name as $row_rules)
                                                        <option value="{{ $row_rules->id }}" @if($row->type_ruledoc == $row_rules->id) selected @endif>{{ $row_rules->type_name }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="type_ruledoc[]" class="form-control form-control-sm" disabled="true">
                                                    <option value="0" selected>{{ '-Pilih Peraturan-' }}</option>
                                                </select>
                                                <input type="hidden" name="type_ruledoc[]" value="0"/>
                                            @endif
                                        </td>
                                        
                                        <td style="width: auto;">
                                            <select name="page_id[]" class="form-control form-control-sm">
                                                <option value="0">{{ '-Pilih Page-' }}</option>
                                                @foreach($pages_name as $row_pages)
                                                    <option value="{{ $row_pages->id }}" @if($row->page_id == $row_pages->id) selected @endif>{{ $row_pages->page_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td style="width: 5%;">
                                            @if($row->editabled == 0)
                                                <input type="text" name="menu_order[]" value="0" class="form-control form-control-sm" readonly>
                                            @else
                                                <input type="text" name="menu_order[]" value="{{ $row->order }}" class="form-control form-control-sm">
                                            @endif
                                        </td>

                                        <td style="width: 8%;">
                                            <select name="menu_status[]" class="form-control form-control-sm">
                                                <option value="Show" @if($row->menu_status == 'Show') selected @endif>Show</option>
                                                <option value="Hide" @if($row->menu_status == 'Hide') selected @endif>Hide</option>
                                            </select>
                                        </td>
                                    </tr>
                                    
                                    @if($row->children->count() > 0)
                                        @include('admin.menu.subrow', ['children' => $row->children, 'width' => 6])
                                    @endif

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
                            <input type="text" class="form-control form-control-sm" name="menu_name" id="menu_name">
                            <span id="menuNameError" class="text-red"></span>
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
            $('#menu_name').val('');
            $('#menuNameError').text('');
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
        
        var toggler = document.getElementsByClassName("caret");
        var i;
        
        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                var tes = this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    });
</script>
        
@endsection