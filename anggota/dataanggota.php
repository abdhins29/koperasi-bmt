<?php 
	include ("style/header.php");
	include ("style/sidebar.php");

	function tgl_indo($tanggal){
		$bulan = array(
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember',);
		$pecahkan = explode('-', $tanggal);
		return $pecahkan[2] . '-' . $bulan[(int)$pecahkan[1]] . '-' . $pecahkan[0];
	}
?>
	<div class="box box-success">
		<div class="box-header with-border">
			<h3 class="box-title">Data Anggota</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">NIK</th>
							<th style="text-align: center;">Nama Anggota</th>
							<th style="text-align: center;">Tempat / Tanggal Lahir</th>
							<th style="text-align: center;">Jenis Kelamin</th>
							<th style="text-align: center;">Alamat</th>
							<th style="text-align: center;">Pekerjaan</th>
							<th style="text-align: center;">Status</th>
							<th style="text-align: center;">Tanggal Masuk</th>
							<th style="text-align: center;">Keterangan</th>
							<th style="text-align: center;" colspan="1">Aksi</th>
						</tr>
					</thead>
					<?php 
					$no = 1;
					include ("../config/koneksi.php");
					$sql = mysqli_query($konek, "SELECT * FROM tbl_anggota a LEFT JOIN tbl_login b ON a.id_anggota=b.id_anggota WHERE b.id = '$_SESSION[id]'");
					while ($data = mysqli_fetch_array($sql)){
					?>
					<tbody>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['nik']; ?></td>
							<td><?php echo $data['nama_anggota']; ?></td>
							<td><?php echo $data['tempat_lahir'];?> / <?php echo tgl_indo($data['tanggal_lahir']); ?></td>
							<td><?php echo $data['gender']; ?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td><?php echo $data['pekerjaan']; ?></td>
							<td><?php echo $data['status']; ?></td>
							<td><?php echo tgl_indo($data['tanggal_masuk']); ?></td>
							<td><?php echo $data['keterangan']; ?></td>
							<td><a href="editanggota.php?kd=<?php echo $data['id_anggota']; ?>"><i class="btn btn-success btn-sm"><span class="fa fa-edit fa-sm"></span></i></a></td>
						</tr>
					</tbody>
					<?php 
					}
					?>
				</table>
			</div>
		</div>
    </div>
<?php 
	include ("style/footer.php");
?>