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
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Data Simpanan</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="form-group">
				<a href="tambahsimpanan.php"><i class="btn btn-primary btn-md"><span class="fa fa-plus fa-md"> Tambah Simpanan</span></i></a>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">ID Simpanan</th>
							<th style="text-align: center;">Tanggal Simpanan</th>
							<th style="text-align: center;">ID Anggota</th>
							<th style="text-align: center;">Jenis Simpanan</th>
							<th style="text-align: center;">Jumlah Simpanan</th>
							<th style="text-align: center;" colspan="2">Aksi</th>
						</tr>
					</thead>
					<?php 
					$no = 1;
					include ("../config/koneksi.php");
					$sql = mysqli_query($konek, "SELECT * FROM tbl_simpanan");
					while ($data = mysqli_fetch_array($sql)){
					?>
					<tbody>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['id_simpanan']; ?></td>
							<td><?php echo tgl_indo($data['tgl_simpanan']); ?></td>
							<td><?php echo $data['id_anggota']; ?></td>
							<td><?php echo $data['jenis_simpanan']; ?></td>
							<td><?php echo "Rp ".number_format($data['jumlah_simpanan'],0,',','.'); ?></td>
							<td><a href="editsimpanan.php?kd=<?php echo $data['id_simpanan']; ?>"><i class="btn btn-success btn-sm"><span class="fa fa-edit fa-sm"></span></i></a></td>
							<td><a href="hapussimpanan.php?kd=<?php echo $data['id_simpanan']; ?>"><i class="btn btn-danger btn-sm"><span class="fa fa-trash fa-sm"></span></i></a></td>
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