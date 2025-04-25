@extends('admin.admin_layouts')
@section('admin_content')
    <h1 class="h3 mb-3 text-gray-800">Sliders</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 mt-2 font-weight-bold text-primary">View Sliders</h6>
            <div class="float-right d-inline">
                <a href="{{ route('admin.slider.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-fixed table-condensed table-responsive table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: x-small;">
                    <thead>
                        <tr>
                            <th style="width: 2%;">No.</th>
                            <th>Photo</th>
                            <th>Slider Heading</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=0; @endphp
                        @foreach($slider as $row)
                        <tr style="text-align: center;s">
                            <td style="width: 2%; vertical-align: middle;">{{ $loop->iteration }}</td>
                            <td style="width: auto; vertical-align: middle;">
                                <img src="{{ asset('storage/places/'.$row->slider_photo) }}" alt="" class="w_150">
                            </td>
                            <td style="width: auto; vertical-align: middle;">{{ $row->slider_heading }}</td>
                            <td style="width: auto; vertical-align: middle;">
                                @if($row->is_publish == 1)
                                    <font class="btn-success btn-sm" style="font-size: xx-small;">{{ 'Publish' }}</font>
                                @else
                                    <font class="btn-danger btn-sm" style="font-size: xx-small;">{{ 'Tidak Publish' }}</font>
                                @endif
                            </td>
                            <td style="width: auto; vertical-align: middle;">{{ $row->slider_sort }}</td>
                            <td style="width: auto; vertical-align: middle;">
                                <a href="{{ URL::to('admin/slider/edit/'.$row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ URL::to('admin/slider/delete/'.$row->id) }}" class="btn btn-danger btn-sm" onClick="return confirm('Are you sure?');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
