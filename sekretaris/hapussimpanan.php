<?php
include ("../config/koneksi.php");
$id_simpanan= $_GET['kd'];
$delete = mysqli_query($konek,"DELETE FROM tbl_simpanan WHERE id_simpanan = '$id_simpanan'");

if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='datasimpanan.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='datasimpanan.php';
	</script>";
}

?>