@extends('layouts.app')

@section('content')
    <div class="page-banner">
        <div class="container">
            <h1>{{ translateText('Survey Kepuasan Masyarakat') }}</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="container-jdihcontent">
            <div class="form-row">
                <div class="col-md-12">
                    <h4 class="contact-form-title mt_5 mb_20">
                        Profil Responden
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-chart-pie"></i>
                        </button>
                    </h4>
                    
                    <div class="accordion mb_20" id="accordionCharts">
                        <div class="card shadow">
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionCharts">
                                <div class="card-header">
                                    <span class="font-weight-bold">
                                        Chart Survey Kepuasan
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-xl-4 col-lg-5">
                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="font-weight-bold float-right">Jenis Kelamin</span>
                                                </div>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div style="height: 300%" id="pie_jns_kelamin"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-lg-5">
                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="font-weight-bold float-right">Pendidikan Terakhir</span>
                                                </div>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div style="height: 300%" id="pie_pendidikan_terakhir"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-lg-5">
                                            <div class="card">
                                                <div class="card-header">
                                                    <span class="font-weight-bold float-right">Pekerjaan</span>
                                                </div>
                                                <!-- Card Body -->
                                                <div class="card-body">
                                                    <div style="height: 300%" id="pie_pekerjaan"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('front.spmipm.create') }}" method="post">
                        @csrf
                        <div class="card shadow mb-4">
                        	<div class="card-body">

                        		<div class="form-row">
		                            <div class="col-md-4">
		                                <div class="form-group">
		                                    <label>Nama <font style="color: red;">*</font></label>
                                                    <input type="text" class="form-control form-control-sm" name="visitor_name" value="{{ old('visitor_name') }}" required>
		                                </div>
		                            </div>

		                            <div class="col-md-4">
		                                <div class="form-group">
		                                    <label>Jenis Kelamin <font style="color: red;">*</font></label>
		                                    <select class="form-control form-control-sm" name="visitor_sex" value="{{ old('visitor_sex') }}" required>
		                                        <option value="" disabled selected>-- Pilih --</option>
		                                        <option value="L">Laki-Laki</option>
		                                        <option value="P">Perempuan</option>
		                                    </select>
		                                </div>
		                            </div>

		                            <div class="col-md-4">
		                                <div class="form-group">
		                                    <label>Usia <font style="color: red;">*</font></label>
                                                    <input type="text" maxlength="2" class="form-control form-control-sm" name="visitor_age" value="{{ old('visitor_age') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" onkeyup="this.value = minmax(this.value, 1, 100)" required>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="form-row">
		                            <div class="col-md-4">
		                                <div class="form-group">
		                                    <label>Alamat Email <font style="color: red;">*</font></label>
		                                    <input type="email" class="form-control form-control-sm" name="visitor_email" value="{{ old('visitor_email') }}" required>
		                                </div>
		                            </div>

		                            <div class="col-md-4">
		                                <div class="form-group">
		                                    <label>Pendidikan Terakhir <font style="color: red;">*</font></label>
		                                    <select class="form-control form-control-sm" name="visitor_education" value="{{ old('visitor_education') }}" required>
		                                        <option value="" disabled selected>-- Pilih --</option>
		                                        <option value="SD">SD</option>
		                                        <option value="SMP">SMP</option>
		                                        <option value="SMA">SMA</option>
		                                        <option value="S1">S1</option>
		                                        <option value="S2">S2</option>
		                                        <option value="S3">S3</option>
		                                    </select>
		                                </div>
		                            </div>

		                            <div class="col-md-4" id="div_visitor_job">
		                                <div class="form-group">
		                                    <label>Pekerjaan <font style="color: red;">*</font></label>
		                                    <select class="form-control form-control-sm" name="visitor_job" id="visitor_job" value="{{ old('visitor_job') }}" required>
		                                        <option value="" disabled selected>-- Pilih --</option>
		                                        <option value="PNS">PNS</option>
		                                        <option value="TNI">TNI</option>
		                                        <option value="POLRI">POLRI</option>
		                                        <option value="SWASTA">SWASTA</option>
		                                        <option value="WIRAUSAHA">WIRAUSAHA</option>
		                                        <option value="LAINNYA">LAINNYA</option>
		                                    </select>
		                                </div>
		                            </div>

		                            <div class="col-md-2" id="div_job_lainnya" style="display: none;">
		                                <div class="form-group">
		                                    <label>Sebutkan <font style="color: red;">*</font></label>
		                                    <input type="text" class="form-control form-control-sm" name="visitor_jobother" value="{{ old('visitor_jobother') }}">
		                                </div>
		                            </div>
		                        </div>
		                        
                        	</div>
                        </div>

                        <div class="card" style="margin-bottom: 2%;">
                            <div style="text-align: center;" class="card-header">
                                <span style="font-size: small; font-weight: 600;">Mohon kesediaan Anda untuk memberikan penilaian dan masukan kepada kami, dimana hal ini sangat bermanfaat untuk meningkatkan kualitas pelayanan kami</span>
                            </div>
                        </div>

                        <div style="text-align: center;">
                            <span style="font-size: x-large; font-weight: 600;">PENDAPAT ANDA TENTANG JDIH PROVINSI BANTEN</span>
                        </div>

                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive-md table-striped">
                                    <table class="table" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                        <tbody>
                                            <tr style="text-align: center; background-color: cadetblue;">
                                                <td style="vertical-align: middle; width: 40%;">
                                                    <strong>Koleksi Dokumen Hukum</strong>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <strong>A<br/>
                                                        (Sangat Baik)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <strong>B<br/>
                                                        (Baik)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <strong>C<br/>
                                                        (Cukup)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <strong>D<br/>
                                                        (Buruk)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <strong>Saran</strong>
                                                </td>
                                            </tr>
                                            <tr style="vertical-align: middle;">
                                                <td>Informasi yang dibutuhkan dapat ditemukan di JDIH Provinsi Banten</td>
                                                <td style="text-align: center;"><input type="radio" name="informasi_radio" value="Sangat Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="informasi_radio" value="Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="informasi_radio" value="Cukup"></td>
                                                <td style="text-align: center;"><input type="radio" name="informasi_radio" value="Buruk"></td>
                                                <td style="text-align: center;"><input type="text" name="informasi_saran" value="{{ old('informasi_saran') }}" class="w-100"></td>
                                            </tr>
                                            <tr style="vertical-align: middle;">
                                                <td>Koleksi dokumen hukum dalam JDIH Provinsi Banten sudah lengkap</td>
                                                <td style="text-align: center;"><input type="radio" name="koleksi_radio" value="Sangat Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="koleksi_radio" value="Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="koleksi_radio" value="Cukup"></td>
                                                <td style="text-align: center;"><input type="radio" name="koleksi_radio" value="Buruk"></td>
                                                <td style="text-align: center;"><input type="text" name="koleksi_saran" value="{{ old('koleksi_saran') }}" class="w-100"></td>
                                            </tr>
                                            <tr style="vertical-align: middle;">
                                                <td>Beragam jenis dokumen hukum yang ada dalam JDIH Provinsi Banten</td>
                                                <td style="text-align: center;"><input type="radio" name="ragam_radio" value="Sangat Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="ragam_radio" value="Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="ragam_radio" value="Cukup"></td>
                                                <td style="text-align: center;"><input type="radio" name="ragam_radio" value="Buruk"></td>
                                                <td style="text-align: center;"><input type="text" name="ragam_saran" value="{{ old('ragam_saran') }}" class="w-100"></td>
                                            </tr>
                                            <tr style="vertical-align: middle;">
                                                <td>JDIH Provinsi Banten Mencantumkan dokumen terkait yang dibutuhkan &nbsp;&nbsp;</td>
                                                <td style="text-align: center;"><input type="radio" name="cantum_radio" value="Sangat Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="cantum_radio" value="Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="cantum_radio" value="Cukup"></td>
                                                <td style="text-align: center;"><input type="radio" name="cantum_radio" value="Buruk"></td>
                                                <td style="text-align: center;"><input type="text" name="cantum_saran" value="{{ old('cantum_saran') }}" class="w-100"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive-md table-striped">
                                    <table class="table" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                        <tbody>
                                            <tr style="text-align: center; background-color: cadetblue;">
                                                <td style="vertical-align: middle; width: 40%;">
                                                    <strong>Antarmuka (interface) Pengguna</strong>
                                                </td>
                                                <td style="vertical-align:middle;">
                                                    <strong>A<br />
                                                        (Sangat Baik)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align:middle;">
                                                    <strong>B<br />
                                                        (Baik)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align:middle;">
                                                    <strong>C<br />
                                                        (Cukup)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align:middle">
                                                    <strong>D<br />
                                                        (Buruk)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align:middle">
                                                    <strong>Saran</strong>
                                                </td>
                                            </tr>
                                            <tr style="vertical-align: middle;">
                                                <td>Menu dan fitur mudah digunakan</td>
                                                <td style="text-align: center;"><input type="radio" name="menu_radio" value="Sangat Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="menu_radio" value="Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="menu_radio" value="Cukup"></td>
                                                <td style="text-align: center;"><input type="radio" name="menu_radio" value="Buruk"></td>
                                                <td style="text-align: center;"><input type="text" name="menu_saran" value="{{ old('menu_saran') }}" class="w-100"></td>
                                            </tr>
                                            <tr style="vertical-align: middle;">
                                                <td>Tampilan Website antarmuka pengguna menarik</td>
                                                <td style="text-align: center;"><input type="radio" name="tampilan_radio" value="Sangat Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="tampilan_radio" value="Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="tampilan_radio" value="Cukup"></td>
                                                <td style="text-align: center;"><input type="radio" name="tampilan_radio" value="Buruk"></td>
                                                <td style="text-align: center;"><input type="text" name="tampilan_saran" value="{{ old('tampilan_saran') }}" class="w-100"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive-md table-striped">
                                    <table class="table" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                        <tbody>
                                            <tr style="text-align: center; background-color: cadetblue;">
                                                <td style="vertical-align: middle; width: 40%;">
                                                    <strong>Kualitas Penyajian Dokumen</strong>
                                                </td>
                                                <td style="vertical-align:middle;">
                                                    <strong>A<br />
                                                        (Sangat Baik)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align:middle;">
                                                    <strong>B<br />
                                                        (Baik)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align:middle;">
                                                    <strong>C<br />
                                                        (Cukup)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align:middle">
                                                    <strong>D<br />
                                                        (Buruk)
                                                    </strong>
                                                </td>
                                                <td style="vertical-align:middle">
                                                    <strong>Saran</strong>
                                                </td>
                                            </tr>
                                            <tr style="vertical-align: middle;">
                                                <td>Dokumen yang disajikan jelas dan dapat terbaca</td>
                                                <td style="text-align: center;"><input type="radio" name="dokumen_radio" value="Sangat Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="dokumen_radio" value="Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="dokumen_radio" value="Cukup"></td>
                                                <td style="text-align: center;"><input type="radio" name="dokumen_radio" value="Buruk"></td>
                                                <td style="text-align: center;"><input type="text" name="dokumen_saran" value="{{ old('dokumen_saran') }}" class="w-100"></td>
                                            </tr>
                                            <tr style="vertical-align: middle;">
                                                <td>Informasi detail dokumen hukum mudah dipahami</td>
                                                <td style="text-align: center;"><input type="radio" name="informasidetail_radio" value="Sangat Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="informasidetail_radio" value="Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="informasidetail_radio" value="Cukup"></td>
                                                <td style="text-align: center;"><input type="radio" name="informasidetail_radio" value="Buruk"></td>
                                                <td style="text-align: center;"><input type="text" name="informasidetail_saran" value="{{ old('informasidetail_saran') }}" class="w-100"></td>
                                            </tr>
                                            <tr style="vertical-align: middle;">
                                                <td>Isi abstrak memudahkan untuk memahami isi dokumen hukum</td>
                                                <td style="text-align: center;"><input type="radio" name="isi_radio" value="Sangat Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="isi_radio" value="Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="isi_radio" value="Cukup"></td>
                                                <td style="text-align: center;"><input type="radio" name="isi_radio" value="Buruk"></td>
                                                <td style="text-align: center;"><input type="text" name="isi_saran" value="{{ old('isi_saran') }}" class="w-100"></td>
                                            </tr>
                                            <tr style="vertical-align: middle;">
                                                <td>Kecepatan dan ketepatan dalam mengakses dokumen hukum yang dicari</td>
                                                <td style="text-align: center;"><input type="radio" name="kecepatan_radio" value="Sangat Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="kecepatan_radio" value="Baik"></td>
                                                <td style="text-align: center;"><input type="radio" name="kecepatan_radio" value="Cukup"></td>
                                                <td style="text-align: center;"><input type="radio" name="kecepatan_radio" value="Buruk"></td>
                                                <td style="text-align: center;"><input type="text" name="kecepatan_saran" value="{{ old('kecepatan_saran') }}" class="w-100"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    <div class="card" style="margin-bottom: 2%;">
                    	<div class="card-header" style="text-align: center;">
                    		<span style="font-weight: 600;">
                    			Terima kasih atas waktu dan masukan yang Anda berikan, semua masukan yang Anda berikan akan kami terima sebagai sarana bagi kami untuk meningkatkan kualitas pelayanan kami
                    		</span>
                    	</div>
                    </div>
                        
                    <div style="text-align: center; margin-bottom: 2%;">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>

                    <button type="submit" class="btn btn-outline-warning btn-sm btn-block text-uppercase">
                    	<strong>Kirim</strong>
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#visitor_job').on('change', function() {
                var visJob = $(this).val();
                if(visJob == "LAINNYA") {
                    $("#div_visitor_job").attr('class', 'col-md-2');
                    $("#div_job_lainnya").show(900);
                    $("[name='visitor_jobother']").attr("required", true);
                } else {
                    $("#div_visitor_job").attr('class', 'col-md-4');
                    $("#div_job_lainnya").hide(900);
                    $("[name='visitor_jobother']").attr("required", false);
                    $("[name='visitor_jobother']").val('');
                }
            });
            
            $('#accordionCharts').on('shown.bs.collapse', function () {
                chartJnsKelamin.resize();
                chartPendidikan.resize();
                chartPekerjaan.resize();
            });
        });
        
        function minmax(value, min, max) 
        {
            if(parseInt(value) < min || isNaN(parseInt(value))) {
                return '';
            } else if(parseInt(value) > max) {
                return max;
            } else {
                return value;
            }
        }
    </script>
    
    <script type="text/javascript">
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