<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Tambah Anggota</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form role="form" method="post" action="">
			<div class="row">
				<div class="col-md-6">
					<div class="box-body">
						<div class="form-group">
							<input type="text" class="form-control" name="nik" placeholder="Masukan NIK Anggota" required="">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="nama_anggota" placeholder="Masukan Nama Anggota" required="">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="tempat_lahir" placeholder="Masukan Tempat Lahir Anggota" required="">
						</div>
						<div class="form-group">
							<label>Masukan Tanggal Lahir Anggota</label>
							<input type="date" class="form-control" name="tanggal_lahir"required="">
						</div>
						<div class="form-group">
							<label>Masukan Jenis Kelamin Anggota</label>
							<select name="gender" class="form-control">
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat Anggota" required="">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="pekerjaan" placeholder="Masukan Pekerjaan Anggota" required="">
						</div>
						<div class="form-group">
							<label>Masukan Status Anggota</label>
							<select name="status" class="form-control">
								<option value="Belum Menikah">Belum Menikah</option>
								<option value="Menikah">Menikah</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<h4>Form Password & Level</h4>
					<div class="box-body">
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Masukan Password Anggota" required="">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="level" value="anggota" readonly="">
						</div>
					</div>
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
		$nik 				= $_POST['nik'];
		$nama_anggota 		= $_POST['nama_anggota'];
		$tempat_lahir 		= $_POST['tempat_lahir'];
		$tanggal_lahir 		= $_POST['tanggal_lahir'];
		$gender 			= $_POST['gender'];
		$alamat 			= $_POST['alamat'];
		$pekerjaan 			= $_POST['pekerjaan'];
		$status 			= $_POST['status'];
		$tanggal_masuk		= date("Y-m-d");

		$password 			= $_POST['password'];
		$level 				= $_POST['level'];

		$cekdulu = mysqli_query($konek, "SELECT * FROM tbl_anggota a LEFT JOIN tbl_login b ON a.id_anggota=b.id_anggota WHERE a.nik = '$nik'");
        if(mysqli_num_rows($cekdulu)){
            echo "<script>alert('NIK Sudah Digunakan');history.go(-1)</script>";
        }else{

        	$sql = mysqli_query($konek,"SELECT * FROM tbl_anggota ORDER BY id_anggota DESC");
        	$data = mysqli_fetch_assoc($sql);
        	$jml = mysqli_num_rows($sql);
        	if($jml==0){
        		$id_anggota='AGT001';
        	}else{
        		$subid = substr($data['id_anggota'],3);
        		if($subid>0 && $subid<=8){
        			$sub = $subid+1;
        			$id_anggota='AGT00'.$sub;
        		}elseif($subid>=9 && $subid<=100){
        			$sub = $subid+1;
        			$id_anggota='AGT0'.$sub;
        		}elseif($subid>=99 && $subid<=1000){
        			$sub = $subid+1;
        			$id_anggota='AGT'.$sub;
        		}
        	}

        	$sql2 = mysqli_query($konek,"SELECT * FROM tbl_tabungan ORDER BY id_tabungan DESC");
        	$data2 = mysqli_fetch_assoc($sql2);
        	$jml2 = mysqli_num_rows($sql2);
        	if($jml2==0){
        		$id_tabungan='TBN001';
        	}else{
        		$subid2 = substr($data2['id_tabungan'],3);
        		if($subid2>0 && $subid2<=8){
        			$sub2 = $subid2+1;
        			$id_tabungan='TBN00'.$sub2;
        		}elseif($subid2>=9 && $subid2<=100){
        			$sub2 = $subid2+1;
        			$id_tabungan='TBN0'.$sub2;
        		}elseif($subid2>=99 && $subid2<=1000){
        			$sub2 = $subid2+1;
        			$id_tabungan='TBN'.$sub2;
        		}
        	}		

        	$save = mysqli_query($konek, "INSERT INTO tbl_anggota VALUES('$id_anggota','$nik','$nama_anggota','$tempat_lahir','$tanggal_lahir','$gender','$alamat','$pekerjaan','$status','$tanggal_masuk','Acc')");
        	$save2 = mysqli_query($konek, "INSERT INTO tbl_login VALUES('','$id_anggota','$nik','$password','$level')");
        	$save3 = mysqli_query($konek, "INSERT INTO tbl_tabungan VALUES('$id_tabungan','$id_anggota','0','0')");

        	if($save) {
        		echo "<script language=javascript>
        		window.alert('Berhasil Menambah!');
        		window.location='dataanggota.php';
        		</script>";
        	}else{
        		echo "<script language=javascript>
        		window.alert('Gagal Menambah!');
        		window.location='dataanggota.php';
        		</script>";
        	}
        }
    }
?>

<?php 
	include ("style/footer.php");
?>