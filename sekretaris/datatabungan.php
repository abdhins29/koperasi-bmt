<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Data Tabungan Anggota</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">ID Tabungan</th>
							<th style="text-align: center;">Nama Anggota</th>
							<th style="text-align: center;">Saldo Pokok</th>
							<th style="text-align: center;">Saldo Wajib</th>
						</tr>
					</thead>
					<?php 
					$no = 1;
					include ("../config/koneksi.php");
					$sql = mysqli_query($konek, "SELECT * FROM tbl_tabungan a LEFT JOIN tbl_anggota b ON a.id_anggota=b.id_anggota");
					while ($data = mysqli_fetch_array($sql)){
					?>
					<tbody>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['id_tabungan']; ?></td>
							<td><?php echo $data['nama_anggota']; ?></td>
							<td><?php echo "Rp ".number_format($data['saldo'],0,',','.'); ?></td>
							<td><?php echo "Rp ".number_format($data['saldo_wajib'],0,',','.'); ?></td>
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