<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
	include ("../config/koneksi.php");
	$id_simpanan= $_GET['kd'];
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Edit Simpanan</h3>
		</div>
		<!-- /.box-header -->
		<?php 
			include ("../config/koneksi.php");
			$sql = mysqli_query($konek, "SELECT * FROM tbl_simpanan WHERE id_simpanan = '$id_simpanan'");
			$data = mysqli_fetch_array($sql);
		?>
		<!-- form start -->
		<form role="form" method="post" action="">
			<div class="box-body">
				<div class="form-group">
					<input type="text" class="form-control" name="id_simpanan" value="<?php echo $data['id_simpanan'];?>" readonly>
				</div>
				<div class="form-group">
					<label>Masukan Tanggal Simpanan</label>
					<input type="date" class="form-control" name="tgl_simpanan" value="<?php echo $data['tgl_simpanan'];?>">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="id_anggota" value="<?php echo $data['id_anggota'];?>" readonly>
				</div>
				<div class="form-group">
					<label>Masukan Jenis Simpanan</label>
					<input type="text" class="form-control" name="jenis_simpanan" value="<?php echo $data['jenis_simpanan']; ?>" readonly>
				</div>
				<div class="form-group">
					<label>Masukan Jumlah Simpanan</label>
					<input type="text" class="form-control" name="jumlah_simpanan" value="<?php echo $data['jumlah_simpanan'];?>" readonly>
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
		$id_simpanan		= $_POST['id_simpanan'];
		$tgl_simpanan 		= $_POST['tgl_simpanan'];
		$jenis_simpanan 	= $_POST['jenis_simpanan'];
		$jumlah_simpanan 	= $_POST['jumlah_simpanan'];

		$update  = mysqli_query($konek, "UPDATE tbl_simpanan SET tgl_simpanan = '$tgl_simpanan', jumlah_simpanan = '$jumlah_simpanan' WHERE id_simpanan = '$id_simpanan'");
		if($update){
			echo "<script language=javascript>
				window.alert('Berhasil Mengedit!');
				window.location='datasimpanan.php';
				</script>";
		}else{

			echo "<script language=javascript>
				window.alert('Gagal Mengedit!');
				window.location='datasimpanan.php';
				</script>";
		}
	}
?>

<?php 
	include ("style/footer.php");
?>