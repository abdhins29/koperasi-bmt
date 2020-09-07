<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
	include ("../config/koneksi.php");
	$id_angsuran= $_GET['kd'];
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Edit Angsuran Pembayaran</h3>
		</div>
		<!-- /.box-header -->
		<?php 
			include ("../config/koneksi.php");
			$sql = mysqli_query($konek, "SELECT * FROM tbl_pembayaran WHERE id_angsuran = '$id_angsuran'");
			$data = mysqli_fetch_array($sql);
		?>
		<!-- form start -->
		<form role="form" method="post" action="">
			<div class="box-body">
				<div class="form-group">
					<input type="text" class="form-control" name="id_angsuran" value="<?php echo $data['id_angsuran'];?>" readonly>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="id_pinjaman" value="<?php echo $data['id_pinjaman'];?>" readonly>
				</div>
				<div class="form-group">
					<label>Masukan Tanggal Simpanan</label>
					<input type="date" class="form-control" name="tgl_bayar" value="<?php echo $data['tgl_bayar'];?>">
				</div>
				<div class="form-group">
					<label>Masukan Cicilan Ke-</label>
					<input type="text" class="form-control" name="cicilan" value="<?php echo $data['cicilan']; ?>">
				</div>
				<div class="form-group">
					<label>Masukan Jumlah Angsuran</label>
					<input type="text" class="form-control" name="jml_bayar" value="<?php echo $data['jml_bayar'];?>" readonly>
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" name="edit" class="btn btn-success">Edit</button>
			</div>
		</form>
    </div>
<?php 
	include ("../config/koneksi.php");
	if(isset($_POST['edit'])){
		$id_angsuran		= $_POST['id_angsuran'];
		$tgl_bayar 		= $_POST['tgl_bayar'];
		$cicilan 	= $_POST['cicilan'];
		$jml_bayar 	= $_POST['jml_bayar'];

		$update  = mysqli_query($konek, "UPDATE tbl_pembayaran SET tgl_bayar = '$tgl_bayar', cicilan = '$cicilan' WHERE id_angsuran = '$id_angsuran'");
		if($update){
			echo "<script language=javascript>
				window.alert('Berhasil Mengedit!');
				window.location='datapembayaran.php';
				</script>";
		}else{

			echo "<script language=javascript>
				window.alert('Gagal Mengedit!');
				window.location='datapembayaran.php';
				</script>";
		}
	}
?>

<?php 
	include ("style/footer.php");
?>