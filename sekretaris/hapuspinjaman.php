<?php
include ("../config/koneksi.php");
$id_pinjaman= $_GET['kd'];
$delete = mysqli_query($konek,"DELETE FROM tbl_pinjaman WHERE id_pinjaman = '$id_pinjaman'");

if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='datapinjaman.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='datapinjaman.php';
	</script>";
}

?>