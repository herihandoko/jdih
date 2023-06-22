@extends('layouts.app')

@section('content')
    <div class="page-banner" style="background-color: lightgrey;">
        <div class="bg-page"></div>
        <div class="text">
            <h1>Survey Kepuasan Pengunjung</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
        	<div class="row">
                <div class="col-md-12">
                    <h4 class="contact-form-title mt_50 mb_20">Informasi Pengunjung</h4>
                    <form action="{{ route('front.spmipm.create') }}" method="post">
                        @csrf
                        <div class="card shadow mb-4">
                        	<div class="card-body">

                        		<div class="form-row">
		                            <div class="col-md-4">
		                                <div class="form-group">
		                                    <label>Nama Pengunjung <font style="color: red;">*</font></label>
		                                    <input type="text" class="form-control form-control-sm" name="visitor_name" required>
		                                </div>
		                            </div>

		                            <div class="col-md-4">
		                                <div class="form-group">
		                                    <label>Jenis Kelamin <font style="color: red;">*</font></label>
		                                    <select class="form-control form-control-sm" name="visitor_sex" required>
		                                        <option value="" disabled selected>-- Pilih --</option>
		                                        <option value="L">Laki-Laki</option>
		                                        <option value="P">Perempuan</option>
		                                    </select>
		                                </div>
		                            </div>

		                            <div class="col-md-4">
		                                <div class="form-group">
		                                    <label>Usia <font style="color: red;">*</font></label>
		                                    <input type="text" class="form-control form-control-sm" name="visitor_age" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="form-row">
		                            <div class="col-md-4">
		                                <div class="form-group">
		                                    <label>Alamat Email <font style="color: red;">*</font></label>
		                                    <input type="email" class="form-control form-control-sm" name="visitor_email" required>
		                                </div>
		                            </div>

		                            <div class="col-md-4">
		                                <div class="form-group">
		                                    <label>Pendidikan Terakhir <font style="color: red;">*</font></label>
		                                    <select class="form-control form-control-sm" name="visitor_education" required>
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
		                                    <select class="form-control form-control-sm" name="visitor_job" id="visitor_job" required>
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
		                                    <input type="text" class="form-control form-control-sm" name="visitor_jobother">
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
                        	<span style="font-size: x-large; font-weight: 600;">PENDAPAT PENGUNJUNG TENTANG JDIH PROVINSI BANTEN</span>
                        </div>

                        <div class="card shadow mb-4">
                        	<div class="card-body">
                        		<div class="table-responsive-md table-striped">
			                        	<table class="table" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%">
										<thead class="thead" style="background-color: #11D694;">
											<tr>
												<th scope="col" style="text-align:center"><strong>No</strong></th>
												<th scope="col" style="text-align:center; width: 45%;"><strong>Deskripsi</strong></th>
												<th colspan="5" scope="col" style="text-align:center"><strong>Penilaian</strong></th>
											</tr>
										</thead>
										<tbody>
											<tr style="text-align: center; background-color: cadetblue;">
												<th scope="row"><strong>1</strong></th>
												<td><strong>Koleksi Dokumen Hukum</strong></td>
												<td><strong>A<br/>
												(Sangat Baik)</strong></td>
												<td><strong>B<br/>
												(Baik)</strong></td>
												<td><strong>C<br/>
												(Cukup)</strong></td>
												<td><strong>D<br/>
												(Buruk)</strong></td>
												<td><strong>Saran</strong></td>
											</tr>
											<tr>
												<th scope="row">&nbsp;</th>
												<td>Informasi yang dibutuhkan dapat ditemukan di JDIH Provinsi Banten</td>
												<td style="text-align: center;"><input type="radio" name="informasi_radio" value="Sangat Baik"></td>
												<td style="text-align: center;"><input type="radio" name="informasi_radio" value="Baik"></td>
												<td style="text-align: center;"><input type="radio" name="informasi_radio" value="Cukup"></td>
												<td style="text-align: center;"><input type="radio" name="informasi_radio" value="Buruk"></td>
												<td style="text-align: center;"><input type="text" name="informasi_saran"></td>
											</tr>
											<tr>
												<th scope="row">&nbsp;</th>
												<td>Koleksi dokumen hukum dalam JDIH Provinsi Banten sudah lengkap</td>
												<td style="text-align: center;"><input type="radio" name="koleksi_radio" value="Sangat Baik"></td>
												<td style="text-align: center;"><input type="radio" name="koleksi_radio" value="Baik"></td>
												<td style="text-align: center;"><input type="radio" name="koleksi_radio" value="Cukup"></td>
												<td style="text-align: center;"><input type="radio" name="koleksi_radio" value="Buruk"></td>
												<td style="text-align: center;"><input type="text" name="koleksi_saran"></td>
											</tr>
											<tr>
												<th scope="row">&nbsp;</th>
												<td>Beragam jenis dokumen hukum yang ada dalam JDIH Provinsi Banten</td>
												<td style="text-align: center;"><input type="radio" name="ragam_radio" value="Sangat Baik"></td>
												<td style="text-align: center;"><input type="radio" name="ragam_radio" value="Baik"></td>
												<td style="text-align: center;"><input type="radio" name="ragam_radio" value="Cukup"></td>
												<td style="text-align: center;"><input type="radio" name="ragam_radio" value="Buruk"></td>
												<td style="text-align: center;"><input type="text" name="ragam_saran"></td>
											</tr>
											<tr>
												<th scope="row">&nbsp;</th>
												<td>JDIH Provinsi Banten Mencantumkan dokumen terkait yang dibutuhkan &nbsp;&nbsp;</td>
												<td style="text-align: center;"><input type="radio" name="cantum_radio" value="Sangat Baik"></td>
												<td style="text-align: center;"><input type="radio" name="cantum_radio" value="Baik"></td>
												<td style="text-align: center;"><input type="radio" name="cantum_radio" value="Cukup"></td>
												<td style="text-align: center;"><input type="radio" name="cantum_radio" value="Buruk"></td>
												<td style="text-align: center;"><input type="text" name="cantum_saran"></td>
											</tr>

											<tr style="text-align: center; background-color: cadetblue;">
												<th scope="row"><strong>2</strong></th>
												<td><strong>Antarmuka (interface) Pengguna</strong></td>
												<td style="text-align:center;"><strong>A<br />
												(Sangat Baik)</strong></td>
												<td style="text-align:center;"><strong>B<br />
												(Baik)</strong></td>
												<td style="text-align:center;"><strong>C<br />
												(Cukup)</strong></td>
												<td style="text-align:center"><strong>D<br />
												(Buruk)</strong></td>
												<td style="text-align:center"><strong>Saran</strong></td>
											</tr>
											<tr>
												<th scope="row">&nbsp;</th>
												<td>Menu dan fitur mudah digunakan</td>
												<td style="text-align: center;"><input type="radio" name="menu_radio" value="Sangat Baik"></td>
												<td style="text-align: center;"><input type="radio" name="menu_radio" value="Baik"></td>
												<td style="text-align: center;"><input type="radio" name="menu_radio" value="Cukup"></td>
												<td style="text-align: center;"><input type="radio" name="menu_radio" value="Buruk"></td>
												<td style="text-align: center;"><input type="text" name="menu_saran"></td>
											</tr>
											<tr>
												<th scope="row">&nbsp;</th>
												<td>Tampilan Website antarmuka pengguna menarik</td>
												<td style="text-align: center;"><input type="radio" name="tampilan_radio" value="Sangat Baik"></td>
												<td style="text-align: center;"><input type="radio" name="tampilan_radio" value="Baik"></td>
												<td style="text-align: center;"><input type="radio" name="tampilan_radio" value="Cukup"></td>
												<td style="text-align: center;"><input type="radio" name="tampilan_radio" value="Buruk"></td>
												<td style="text-align: center;"><input type="text" name="tampilan_saran"></td>
											</tr>

											<tr style="text-align: center; background-color: cadetblue;">
												<th scope="row"><strong>3</strong></th>
												<td><strong>Kualitas Penyajian Dokumen</strong></td>
												<td style="text-align:center;"><strong>A<br />
												(Sangat Baik)</strong></td>
												<td style="text-align:center;"><strong>B<br />
												(Baik)</strong></td>
												<td style="text-align:center;"><strong>C<br />
												(Cukup)</strong></td>
												<td style="text-align:center"><strong>D<br />
												(Buruk)</strong></td>
												<td style="text-align:center"><strong>Saran</strong></td>
											</tr>
											<tr>
												<th scope="row">&nbsp;</th>
												<td>Dokumen yang disajikan jelas dan dapat terbaca</td>
												<td style="text-align: center;"><input type="radio" name="dokumen_radio" value="Sangat Baik"></td>
												<td style="text-align: center;"><input type="radio" name="dokumen_radio" value="Baik"></td>
												<td style="text-align: center;"><input type="radio" name="dokumen_radio" value="Cukup"></td>
												<td style="text-align: center;"><input type="radio" name="dokumen_radio" value="Buruk"></td>
												<td style="text-align: center;"><input type="text" name="dokumen_saran"></td>
											</tr>
											<tr>
												<th scope="row">&nbsp;</th>
												<td>Informasi detail dokumen hukum mudah dipahami</td>
												<td style="text-align: center;"><input type="radio" name="informasidetail_radio" value="Sangat Baik"></td>
												<td style="text-align: center;"><input type="radio" name="informasidetail_radio" value="Baik"></td>
												<td style="text-align: center;"><input type="radio" name="informasidetail_radio" value="Cukup"></td>
												<td style="text-align: center;"><input type="radio" name="informasidetail_radio" value="Buruk"></td>
												<td style="text-align: center;"><input type="text" name="informasidetail_saran"></td>
											</tr>
											<tr>
												<th scope="row">&nbsp;</th>
												<td>Isi abstrak memudahkan untuk memahami isi dokumen hukum</td>
												<td style="text-align: center;"><input type="radio" name="isi_radio" value="Sangat Baik"></td>
												<td style="text-align: center;"><input type="radio" name="isi_radio" value="Baik"></td>
												<td style="text-align: center;"><input type="radio" name="isi_radio" value="Cukup"></td>
												<td style="text-align: center;"><input type="radio" name="isi_radio" value="Buruk"></td>
												<td style="text-align: center;"><input type="text" name="isi_saran"></td>
											</tr>
											<tr>
												<th scope="row">&nbsp;</th>
												<td>Kecepatan dan ketepatan dalam mengakses dokumen hukum yang dicari</td>
												<td style="text-align: center;"><input type="radio" name="kecepatan_radio" value="Sangat Baik"></td>
												<td style="text-align: center;"><input type="radio" name="kecepatan_radio" value="Baik"></td>
												<td style="text-align: center;"><input type="radio" name="kecepatan_radio" value="Cukup"></td>
												<td style="text-align: center;"><input type="radio" name="kecepatan_radio" value="Buruk"></td>
												<td style="text-align: center;"><input type="text" name="kecepatan_saran"></td>
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

                    <button type="submit" class="btn btn-primary btn-sm btn-block">
                    	<strong>KIRIM</strong>
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
	    });
	</script>
@endsection