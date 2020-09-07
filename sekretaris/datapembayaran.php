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
			<h3 class="box-title">Data Pembayaran Angsuran</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="form-group">
				<a href="tambahpembayaran.php"><i class="btn btn-primary btn-md"><span class="fa fa-plus fa-md"> Tambah Pembayaran</span></i></a>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">ID Angsuran</th>
							<th style="text-align: center;">ID Pinjaman</th>
							<th style="text-align: center;">Angsuran Ke-</th>
							<th style="text-align: center;">Jumlah Pembayaran</th>
							<th style="text-align: center;">Tanggal Pembayaran</th>
							<th style="text-align: center;" colspan="2">Aksi</th>
						</tr>
					</thead>
					<?php 
					$no = 1;
					include ("../config/koneksi.php");
					$sql = mysqli_query($konek, "SELECT * FROM tbl_pembayaran");
					while ($data = mysqli_fetch_array($sql)){
					?>
					<tbody>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['id_angsuran']; ?></td>
							<td><?php echo $data['id_pinjaman']; ?></td>
							<td><?php echo $data['cicilan']; ?></td>
							<td><?php echo "Rp ".number_format($data['jml_bayar'],0,',','.');?></td>
							<td><?php echo tgl_indo($data['tgl_bayar']); ?></td>
							<td><a href="editpembayaran.php?kd=<?php echo $data['id_angsuran']; ?>"><i class="btn btn-success btn-sm"><span class="fa fa-edit fa-sm"></span></i></a></td>
							<td><a href="hapuspembayaran.php?kd=<?php echo $data['id_angsuran']; ?>"><i class="btn btn-danger btn-sm"><span class="fa fa-trash fa-sm"></span></i></a></td>
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