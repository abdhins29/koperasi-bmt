<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
	include ("../config/koneksi.php");
	$id_pengambilan= $_GET['kd'];
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Edit Pengambilan</h3>
		</div>
		<!-- /.box-header -->
		<?php 
			include ("../config/koneksi.php");
			$sql = mysqli_query($konek, "SELECT * FROM tbl_pengambilan a LEFT JOIN tbl_tabungan b ON a.id_anggota=b.id_anggota WHERE id_pengambilan = '$id_pengambilan'");
			$data = mysqli_fetch_array($sql);
		?>
		<!-- form start -->
		<form role="form" method="post" action="">
			<div class="box-body">
				<div class="form-group">
					<input type="text" class="form-control" name="id_pengambilan" value="<?php echo $data['id_pengambilan'];?>" readonly>
				</div>
				<div class="form-group">
					<label>Masukan Tanggal Pengambilan</label>
					<input type="date" class="form-control" name="tgl_pengambilan" value="<?php echo $data['tgl_pengambilan'];?>">
				</div>
				<div class="form-group">
					<label>Masukan ID Anggota</label>
					<input type="text" class="form-control" name="id_anggota" value="<?php echo $data['id_anggota'];?>" readonly>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="jumlah_pengambilan" id="jumlah_pengambilan" value="<?php echo $data['jumlah_pengambilan']; ?>" readonly>
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
		$id_pengambilan			= $_POST['id_pengambilan'];
		$tgl_pengambilan 		= $_POST['tgl_pengambilan'];
		$id_anggota 			= $_POST['id_anggota'];
		$jumlah_pengambilan 	= $_POST['jumlah_pengambilan'];

		$update  = mysqli_query($konek, "UPDATE tbl_pengambilan SET tgl_pengambilan = '$tgl_pengambilan' WHERE id_pengambilan = '$id_pengambilan'");
		if($update){
			echo "<script language=javascript>
				window.alert('Berhasil Mengedit!');
				window.location='datapengambilan.php';
				</script>";
		}else{

			echo "<script language=javascript>
				window.alert('Gagal Mengedit!');
				window.location='datapengambilan.php';
				</script>";
		}
	}
?>

<?php 
	include ("style/footer.php");
?>