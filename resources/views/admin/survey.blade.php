@extends('admin.admin_layouts')

@section('admin_content')
	<div class="form-row">
		<div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Jenis Kelamin</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div style="height: 300%" id="pie_jns_kelamin"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pendidikan Terakhir</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div style="height: 300%" id="pie_pendidikan_terakhir"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pekerjaan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div style="height: 300%" id="pie_pekerjaan"></div>
                </div>
            </div>
        </div>
	</div>

	<div class="card shadow mb-4">
    	<div class="card-body">
    		<div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: small;">
                    <thead style="text-align: center; background-color: lightsalmon;">
                    <tr>
                        <th style="width: 2%;">No.</th>
                        <th style="width: 10%;">Nama</th>
                        <th style="width: 6%;">Jenis Kelamin</th>
                        <th style="width: 2%;">Umur</th>
                        <th style="width: 5%;">Email</th>
                        <th style="width: 1%;">Pendidikan</th>
                        <th style="width: 5%;">Pekerjaan</th>
                        <th style="width: 5%;">Tgl Survey</th>
                        <th style="width: 2%;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    	@php $i=0; @endphp
                    	@foreach($listSurvey as $row)
                    	<tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>
                            	{{ $row->visitor_name }}
                            </td>

                            <td style="text-align: center;">
                            	@if($row->visitor_sex == "L")
                            		<font class="btn-primary btn-sm" style="font-size: small;">{{ 'Laki-Laki' }}</font>
                            	@else
                            		<font class="btn-warning btn-sm" style="font-size: small;">{{ 'Perempuan' }}</font>
                            	@endif
                            </td>

                            <td style="text-align: center;">
                            	{{ $row->visitor_age }}
                            </td>

                            <td>
                            	{{ $row->visitor_email }}
                            </td>

                            <td style="text-align: center;">
                            	{{ $row->visitor_education }}
                            </td>
                            
                            <td>
                            	@if($row->visitor_job == "LAINNYA")
                            		{{ $row->visitor_jobother }}
                            	@else
                            		{{ $row->visitor_job }}
                            	@endif
                            </td>

                            <td style="text-align: center;">
                            	{{ $row->created_at }}
                            </td>

                            <td style="text-align: center;">
                                @php $surveyID = Crypt::encrypt($row->id); @endphp
                                <a href="#" id="preview" data-toggle="modal" class="btn btn-warning btn-sm" data-identity="{{$surveyID}}">
                                	<i class="fas fa-file-text"></i>
                                </a>
                            </td>
                        </tr>
                    	@endforeach
                    </tbody>
                </table>
            </div>
    	</div>
    </div>

    @include('admin.modalPreview')

	<script type="text/javascript">
		$('.btn-close-modal').on('click', function() {
            $("#previewModal").modal('hide');
        });

		$('body').on('click', '#preview', function (event) {
			$('#pleaseWaitDialog').modal('show');
        
	        var i = 0;
	        if (i == 0) {
	            i = 1;
	            var elem = document.getElementById("myBar");
	            var width = 1;
	            var id = setInterval(frame, 10);
	            function frame() {
	                if (width >= 100) {
	                    clearInterval(id);
	                    i = 0;
	                } else {
	                    width++;
	                    elem.style.width = width + "%";
	                }
	            }
	        }

	        event.preventDefault();

            var identity = $(this).data('identity');

            $.ajax({
	            url: '{{ url("admin/survey/get-data/") }}',
	            type: 'GET',
	            data: {
	            	identity: identity
	            },
	            success: function (data) {
	            	$('.fa-check-circle').css('display','none');
	                $('#pleaseWaitDialog').modal('hide');
		            $('#previewModal').modal({
		                backdrop: 'static',
		                keyboard: false,
		                show: true
		            });

		            $('#headTitle').text(data.visitor_name + ' (' + data.visitor_email + ')');

		            if(data.informasi_radio == "Sangat Baik") {
		            	$('#informasi_radio_sb').css('display','block');
		            } else if(data.informasi_radio == "Baik") {
		            	$('#informasi_radio_b').css('display','block');
		            } else if(data.informasi_radio == "Cukup") {
		            	$('#informasi_radio_c').css('display','block');
		            } else {
		            	$('#informasi_radio_br').css('display','block');
		            }
		            $('#informasi_saran').val(data.informasi_saran);

		            if(data.koleksi_radio == "Sangat Baik") {
		            	$('#koleksi_radio_sb').css('display','block');
		            } else if(data.koleksi_radio == "Baik") {
		            	$('#koleksi_radio_b').css('display','block');
		            } else if(data.koleksi_radio == "Cukup") {
		            	$('#koleksi_radio_c').css('display','block');
		            } else {
		            	$('#koleksi_radio_br').css('display','block');
		            }
		            $('#koleksi_saran').val(data.koleksi_saran);

		            if(data.ragam_radio == "Sangat Baik") {
		            	$('#ragam_radio_sb').css('display','block');
		            } else if(data.ragam_radio == "Baik") {
		            	$('#ragam_radio_b').css('display','block');
		            } else if(data.ragam_radio == "Cukup") {
		            	$('#ragam_radio_c').css('display','block');
		            } else {
		            	$('#ragam_radio_br').css('display','block');
		            }
		            $('#ragam_saran').val(data.ragam_saran);

		            if(data.cantum_radio == "Sangat Baik") {
		            	$('#cantum_radio_sb').css('display','block');
		            } else if(data.cantum_radio == "Baik") {
		            	$('#cantum_radio_b').css('display','block');
		            } else if(data.cantum_radio == "Cukup") {
		            	$('#cantum_radio_c').css('display','block');
		            } else {
		            	$('#cantum_radio_br').css('display','block');
		            }
		            $('#cantum_saran').val(data.cantum_saran);

		            if(data.menu_radio == "Sangat Baik") {
		            	$('#menu_radio_sb').css('display','block');
		            } else if(data.menu_radio == "Baik") {
		            	$('#menu_radio_b').css('display','block');
		            } else if(data.menu_radio == "Cukup") {
		            	$('#menu_radio_c').css('display','block');
		            } else {
		            	$('#menu_radio_br').css('display','block');
		            }
		            $('#menu_saran').val(data.menu_saran);

		            if(data.tampilan_radio == "Sangat Baik") {
		            	$('#tampilan_radio_sb').css('display','block');
		            } else if(data.tampilan_radio == "Baik") {
		            	$('#tampilan_radio_b').css('display','block');
		            } else if(data.tampilan_radio == "Cukup") {
		            	$('#tampilan_radio_c').css('display','block');
		            } else {
		            	$('#tampilan_radio_br').css('display','block');
		            }
		            $('#tampilan_saran').val(data.tampilan_saran);

		            if(data.dokumen_radio == "Sangat Baik") {
		            	$('#dokumen_radio_sb').css('display','block');
		            } else if(data.dokumen_radio == "Baik") {
		            	$('#dokumen_radio_b').css('display','block');
		            } else if(data.dokumen_radio == "Cukup") {
		            	$('#dokumen_radio_c').css('display','block');
		            } else {
		            	$('#dokumen_radio_br').css('display','block');
		            }
		            $('#dokumen_saran').val(data.dokumen_saran);

		            if(data.informasidetail_radio == "Sangat Baik") {
		            	$('#informasidetail_radio_sb').css('display','block');
		            } else if(data.informasidetail_radio == "Baik") {
		            	$('#informasidetail_radio_b').css('display','block');
		            } else if(data.informasidetail_radio == "Cukup") {
		            	$('#informasidetail_radio_c').css('display','block');
		            } else {
		            	$('#informasidetail_radio_br').css('display','block');
		            }
		            $('#informasidetail_saran').val(data.informasidetail_saran);

		            if(data.isi_radio == "Sangat Baik") {
		            	$('#isi_radio_sb').css('display','block');
		            } else if(data.isi_radio == "Baik") {
		            	$('#isi_radio_b').css('display','block');
		            } else if(data.isi_radio == "Cukup") {
		            	$('#isi_radio_c').css('display','block');
		            } else {
		            	$('#isi_radio_br').css('display','block');
		            }
		            $('#isi_saran').val(data.isi_saran);

		            if(data.isi_radio == "Sangat Baik") {
		            	$('#isi_radio_sb').css('display','block');
		            } else if(data.isi_radio == "Baik") {
		            	$('#isi_radio_b').css('display','block');
		            } else if(data.isi_radio == "Cukup") {
		            	$('#isi_radio_c').css('display','block');
		            } else {
		            	$('#isi_radio_br').css('display','block');
		            }
		            $('#isi_saran').val(data.isi_saran);

		            if(data.kecepatan_radio == "Sangat Baik") {
		            	$('#kecepatan_radio_sb').css('display','block');
		            } else if(data.kecepatan_radio == "Baik") {
		            	$('#kecepatan_radio_b').css('display','block');
		            } else if(data.kecepatan_radio == "Cukup") {
		            	$('#kecepatan_radio_c').css('display','block');
		            } else {
		            	$('#kecepatan_radio_br').css('display','block');
		            }
		            $('#kecepatan_saran').val(data.kecepatan_saran);
	            },
	            error: function() {
	            	console.log('error');
	            }
	        });
		});

        var domJnsKelamin = document.getElementById('pie_jns_kelamin');
        var chartJnsKelamin = echarts.init(domJnsKelamin, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        
        var dataJnsKelamin = [
                @foreach ($jnsKelamin as $row)
                    { value: {{ $row->total_visitorsex }}, name: '{{ $row->visitor_sex }}' },
                @endforeach
                ];
        
        var app = {};
    
        var optionJnsKelamin;

        optionJnsKelamin = {
            textStyle: {
                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                fontSize: 10
            },
            tooltip: {
              trigger: 'item',
              formatter: '<strong>{b}</strong> : {c} ({d}%)'
            },
            legend: {
              top: '1%',
              left: 'center'
            },
            series: [
              {
                top: '20%',
                type: 'pie',
                radius: '90%',
                avoidLabelOverlap: false,
                data: dataJnsKelamin,
                itemStyle: {
                    borderRadius: 5,
                    borderColor: '#fff',
                    borderWidth: 1
                },
                label: {
                    show: false,
                    position: 'center'
                },
                labelLine: {
                    show: false
                },
              }
            ]
        };

        if (optionJnsKelamin && typeof optionJnsKelamin === 'object') {
            chartJnsKelamin.setOption(optionJnsKelamin);
        }
        
        window.addEventListener('resize', chartJnsKelamin.resize);
    </script>

    <script type="text/javascript">
        var domPendidikan = document.getElementById('pie_pendidikan_terakhir');
        var chartPendidikan = echarts.init(domPendidikan, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        
        var dataPendidikan = [
                @foreach ($pendidikan as $row)
                    { value: {{ $row->total_visitoreducation }}, name: '{{ $row->visitor_education }}' },
                @endforeach
                ];
    
        var optionPendidikan;

        optionPendidikan = {
            textStyle: {
                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                fontSize: 10
            },
            tooltip: {
              trigger: 'item',
              formatter: '<strong>{b}</strong> : {c} ({d}%)'
            },
            legend: {
              top: '1%',
              left: 'center'
            },
            series: [
              {
                top: '20%',
                type: 'pie',
                radius: '90%',
                avoidLabelOverlap: false,
                data: dataPendidikan,
                itemStyle: {
                    borderRadius: 5,
                    borderColor: '#fff',
                    borderWidth: 1
                },
                label: {
                    show: false,
                    position: 'center'
                },
                labelLine: {
                    show: false
                },
              }
            ]
        };

        if (optionPendidikan && typeof optionPendidikan === 'object') {
            chartPendidikan.setOption(optionPendidikan);
        }
        
        window.addEventListener('resize', chartPendidikan.resize);
    </script>

    <script type="text/javascript">
        var domPekerjaan = document.getElementById('pie_pekerjaan');
        var chartPekerjaan = echarts.init(domPekerjaan, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        
        var dataPekerjaan = [
                @foreach ($pekerjaan as $row)
                    { value: {{ $row->total_visitorjob }}, name: '{{ $row->visitor_job }}' },
                @endforeach
                ];
    
        var optionPekerjaan;

        optionPekerjaan = {
            textStyle: {
                fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                fontSize: 10
            },
            tooltip: {
              trigger: 'item',
              formatter: '<strong>{b}</strong> : {c} ({d}%)'
            },
            legend: {
              top: '1%',
              left: 'center'
            },
            series: [
              {
                top: '20%',
                type: 'pie',
                radius: '90%',
                avoidLabelOverlap: false,
                data: dataPekerjaan,
                itemStyle: {
                    borderRadius: 5,
                    borderColor: '#fff',
                    borderWidth: 1
                },
                label: {
                    show: false,
                    position: 'center'
                },
                labelLine: {
                    show: false
                },
              }
            ]
        };

        if (optionPekerjaan && typeof optionPekerjaan === 'object') {
            chartPekerjaan.setOption(optionPekerjaan);
        }
        
        window.addEventListener('resize', chartPekerjaan.resize);
    </script>
@endsection