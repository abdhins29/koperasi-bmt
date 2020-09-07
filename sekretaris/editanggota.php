<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
	include ("../config/koneksi.php");
	$id_anggota= $_GET['kd'];
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Edit Anggota</h3>
		</div>
		<!-- /.box-header -->
		<?php 
			include ("../config/koneksi.php");
			$sql = mysqli_query($konek, "SELECT * FROM tbl_anggota a LEFT JOIN tbl_login b ON a.id_anggota=b.id_anggota WHERE a.id_anggota = '$id_anggota'");
			$data = mysqli_fetch_array($sql);
		?>
		<!-- form start -->
		<form role="form" method="post" action="">
			<div class="row">
				<div class="col-md-6">
					<div class="box-body">
						<div class="form-group">
							<input type="text" class="form-control" name="id_anggota" value="<?php echo $data['id_anggota'];?>" readonly>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="nik" value="<?php echo $data['nik'];?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="nama_anggota" value="<?php echo $data['nama_anggota'];?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="tempat_lahir" value="<?php echo $data['tempat_lahir'];?>">
						</div>
						<div class="form-group">
							<label>Masukan Tanggal Lahir Anggota</label>
							<input type="date" class="form-control" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir'];?>">
						</div>
						<div class="form-group">
							<label>Masukan Jenis Kelamin Anggota</label>
							<input type="text" class="form-control" name="gender" value="<?php echo $data['gender']; ?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat'];?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="pekerjaan" value="<?php echo $data['pekerjaan'];?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="status" value="<?php echo $data['status'];?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="tanggal_masuk" value="<?php echo $data['tanggal_masuk'];?>" readonly>
						</div>
						<div class="form-group">
							<select name="keterangan" class="form-control">
								<option value="Pending">Pending</option>
								<option value="Acc">Acc</option>
								<option value="Ditolak">Ditolak</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<h4>Form Edit Password</h4>
					<div class="box-body">
						<div class="form-group">
							<input type="text" class="form-control" name="username" value="<?php echo $data['username'];?>" readonly>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="password" value="<?php echo $data['password'];?>">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="level" value="<?php echo $data['level'];?>" readonly>
						</div>
					</div>
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
		$nik			= $_POST['nik'];
		$id_anggota		= $_POST['id_anggota'];
		$nama_anggota 	= $_POST['nama_anggota'];
		$tempat_lahir 	= $_POST['tempat_lahir'];
		$tanggal_lahir 	= $_POST['tanggal_lahir'];
		$gender 		= $_POST['gender'];
		$pekerjaan 		= $_POST['pekerjaan'];
		$alamat 		= $_POST['alamat'];
		$status 		= $_POST['status'];
		$keterangan 	= $_POST['keterangan'];

		$password 		= $_POST['password'];

		$update  = mysqli_query($konek, "UPDATE tbl_anggota SET nik ='$nik', nama_anggota = '$nama_anggota', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', gender = '$gender', alamat = '$alamat', pekerjaan = '$pekerjaan', status = '$status', keterangan = '$keterangan' WHERE id_anggota = '$id_anggota'");

		$update2 = mysqli_query($konek,"UPDATE tbl_login SET password = '$password' WHERE id_anggota = '$id_anggota'");
		if($update){
			echo "<script language=javascript>
				window.alert('Berhasil Mengedit!');
				window.location='dataanggota.php';
				</script>";
		}else{

			echo "<script language=javascript>
				window.alert('Gagal Mengedit!');
				window.location='dataanggota.php';
				</script>";
		}
	}
?>

<?php 
	include ("style/footer.php");
?>