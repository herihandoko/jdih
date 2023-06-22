<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Memuat hasil survey</h6>
            </div>
            <div class="modal-body">
                <div style="width: 100%; background-color: #ddd;">
                  <div id="myBar" role="progressbar" style="width: 1%; height: 30px; background-color: #04AA6D;" 
                  aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width:100%; height: 40px">
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">

        <div class="modal-header text-black">
        	<span class="modal-title text-center" style="font-weight: 700; font-size: x-large;" id="headTitle"></span>
        	<button type="button" class="btn btn-outline-danger btn-rounded btn-close-modal">
    			<i class="fas fa-times-circle"></i>
    		</button>
        </div>

        <div class="modal-body modal-content">
        	<div class="card shadow mb-4">
            	<div class="card-body">
            		<div class="table-responsive-md table-striped">
                        	<table class="table" align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%; font-size: small;">
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
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="informasi_radio_sb" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="informasi_radio_b" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="informasi_radio_c" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="informasi_radio_br" style="display: none;"></i>
									</td>
									<td style="text-align: center;"><input type="text" id="informasi_saran"></td>
								</tr>
								<tr>
									<th scope="row">&nbsp;</th>
									<td>Koleksi dokumen hukum dalam JDIH Provinsi Banten sudah lengkap</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="koleksi_radio_sb" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="koleksi_radio_b" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="koleksi_radio_c" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="koleksi_radio_br" style="display: none;"></i>
									</td>
									<td style="text-align: center;"><input type="text" id="koleksi_saran"></td>
								</tr>
								<tr>
									<th scope="row">&nbsp;</th>
									<td>Beragam jenis dokumen hukum yang ada dalam JDIH Provinsi Banten</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="ragam_radio_sb" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="ragam_radio_b" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="ragam_radio_c" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="ragam_radio_br" style="display: none;"></i>
									</td>
									<td style="text-align: center;"><input type="text" id="ragam_saran"></td>
								</tr>
								<tr>
									<th scope="row">&nbsp;</th>
									<td>JDIH Provinsi Banten Mencantumkan dokumen terkait yang dibutuhkan &nbsp;&nbsp;</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="cantum_radio_sb" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="cantum_radio_b" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="cantum_radio_c" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="cantum_radio_br" style="display: none;"></i>
									</td>
									<td style="text-align: center;"><input type="text" id="cantum_saran"></td>
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
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="menu_radio_sb" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="menu_radio_b" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="menu_radio_c" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="menu_radio_br" style="display: none;"></i>
									</td>
									<td style="text-align: center;"><input type="text" id="menu_saran"></td>
								</tr>
								<tr>
									<th scope="row">&nbsp;</th>
									<td>Tampilan Website antarmuka pengguna menarik</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="tampilan_radio_sb" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="tampilan_radio_b" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="tampilan_radio_c" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="tampilan_radio_br" style="display: none;"></i>
									</td>
									<td style="text-align: center;"><input type="text" id="tampilan_saran"></td>
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
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="dokumen_radio_sb" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="dokumen_radio_b" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="dokumen_radio_c" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="dokumen_radio_br" style="display: none;"></i>
									</td>
									<td style="text-align: center;"><input type="text" id="dokumen_saran"></td>
								</tr>
								<tr>
									<th scope="row">&nbsp;</th>
									<td>Informasi detail dokumen hukum mudah dipahami</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="informasidetail_radio_sb" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="informasidetail_radio_b" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="informasidetail_radio_c" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="informasidetail_radio_br" style="display: none;"></i>
									</td>
									<td style="text-align: center;"><input type="text" id="informasidetail_saran"></td>
								</tr>
								<tr>
									<th scope="row">&nbsp;</th>
									<td>Isi abstrak memudahkan untuk memahami isi dokumen hukum</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="isi_radio_sb" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="isi_radio_b" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="isi_radio_c" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="isi_radio_br" style="display: none;"></i>
									</td>
									<td style="text-align: center;"><input type="text" id="isi_saran"></td>
								</tr>
								<tr>
									<th scope="row">&nbsp;</th>
									<td>Kecepatan dan ketepatan dalam mengakses dokumen hukum yang dicari</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="kecepatan_radio_sb" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="kecepatan_radio_b" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="kecepatan_radio_c" style="display: none;"></i>
									</td>
									<td style="text-align: center;">
										<i class="fas fa-check-circle" style="color: orangered;" aria-hidden="true" id="kecepatan_radio_br" style="display: none;"></i>
									</td>
									<td style="text-align: center;"><input type="text" id="kecepatan_saran"></td>
								</tr>
							</tbody>
						</table>
                    </div>
            	</div>
            </div>
        </div>
      </div>
    </div>
</div>