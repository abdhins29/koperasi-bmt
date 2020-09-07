<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Tambah Simpanan</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form role="form" method="post" action="">
			<div class="box-body">
				<div class="form-group">
					<label>Masukan Tanggal Simpanan</label>
					<input type="date" class="form-control" name="tgl_simpanan" required="">
				</div>
				<div class="form-group">
					<label>Masukan ID Anggota</label>
					<select name="id_anggota" class="form-control" required="">
				<?php 
				include ("../config/koneksi.php");
				$sql2 = mysqli_query($konek, "SELECT * FROM tbl_anggota");
				while ($data2 = mysqli_fetch_array($sql2)){
				?>
					<option value="<?php echo $data2['id_anggota']; ?>"><?php echo $data2['id_anggota']; ?> - <?php echo $data2['nama_anggota']; ?></option>
				<?php 
				}
				?>
					</select>
				</div>
				<div class="form-group">
					<label>Masukan Jenis Simpanan</label>
					<select name="jenis_simpanan" class="form-control">
						<option value="Simpanan Wajib">Simpanan Wajib</option>
						<option value="Simpanan Pokok">Simpanan Pokok</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="jumlah_simpanan" placeholder="Masukan Jumlah Simpanan" required="">
				</div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
			</div>
		</form>
    </div>

<?php 
	include ("../config/koneksi.php");
	if (isset($_POST['tambah'])) {
		$tgl_simpanan 		= $_POST['tgl_simpanan'];
		$id_anggota 		= $_POST['id_anggota'];
		$jenis_simpanan 	= $_POST['jenis_simpanan'];
		$jumlah_simpanan 	= $_POST['jumlah_simpanan'];

		$sql = mysqli_query($konek,"SELECT * FROM tbl_simpanan ORDER BY id_simpanan DESC");
		$data = mysqli_fetch_assoc($sql);
		$jml = mysqli_num_rows($sql);
		if($jml==0){
			$id_simpanan='SPN001';
		}else{
			$subid = substr($data['id_simpanan'],3);
			if($subid>0 && $subid<=8){
				$sub = $subid+1;
				$id_simpanan='SPN00'.$sub;
			}elseif($subid>=9 && $subid<=100){
				$sub = $subid+1;
				$id_simpanan='SPN0'.$sub;
			}elseif($subid>=99 && $subid<=1000){
				$sub = $subid+1;
				$id_simpanan='SPN'.$sub;
			}
		}

		$save = mysqli_query($konek, "INSERT INTO tbl_simpanan VALUES('$id_simpanan','$tgl_simpanan','$id_anggota','$jenis_simpanan','$jumlah_simpanan')");
		if($save) {
			echo "<script language=javascript>
			window.alert('Berhasil Menambah!');
			window.location='datasimpanan.php';
			</script>";
		}else{
			echo "<script language=javascript>
			window.alert('Gagal Menambah!');
			window.location='datasimpanan.php';
			</script>";
		}
	}
?>

<?php 
	include ("style/footer.php");
?>