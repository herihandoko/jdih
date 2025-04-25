@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Footer Column Items</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">View Footer Column Items</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.footer.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-fixed table-condensed table-responsive table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 2%;">No.</th>
                        <th>Logo</th>
                        <th>Text</th>
                        <th>URL</th>
                        <th>Anggota</th>
                        <th>Order</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($footer_columns as $row)
                        <tr>
                            <td style="text-align: center; width: 2%;">{{ $loop->iteration }}</td>
                            <td style="width: auto;">
                                @if($row->logo)
                                    <img src="{{ url('storage/places/logo_institusi/'.$row->logo) }}" alt="Logo" class="w_50">
                                @else
                                    <img src="{{ url('storage/places/logo_institusi/no-logo.png') }}" alt="Logo" class="w_50">
                                @endif
                            </td>
                            <td style="width: auto;">{{ $row->column_item_text }}</td>
                            <td style="width: auto;">{{ $row->column_item_url }}</td>
                            <td style="text-align: center; width: auto;">
                                @if($row->is_member == 1)
                                    <font class="btn-success btn-sm" style="font-size: small; font-weight: 600;">{{ 'Ya' }}</font>
                                @else
                                    <font class="btn-danger btn-sm" style="font-size: small; font-weight: 600;">{{ 'Tidak' }}</font>
                                @endif
                            </td>
                            <td style="text-align: center; width: auto;">{{ $row->column_item_order }}</td>
                            <td style="text-align: center; width: auto">
                                @php $footerID = Crypt::encrypt($row->id); @endphp
                                <a href="{{ URL::to('admin/footer/edit/'.$footerID) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <a href="#" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#confirm-delete" class="btn btn-danger btn-sm" data-href="{{ URL::to('admin/footer/delete/'.$row->id) }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title font-weight-bold">
                            <i class="fas fa-exclamation-triangle"></i>
                            Konfirmasi
                        </h4>
                    </div>
                    <div class="modal-body">
                        Anda yakin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-ok" data-dismiss="modal">
                            Batal
                        </button>

                        <a class="btn btn-danger btn-ok">
                            Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
       $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
@endsection