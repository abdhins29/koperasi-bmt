<?php
include ("../config/koneksi.php");
$id_angsuran= $_GET['kd'];
$delete = mysqli_query($konek,"DELETE FROM tbl_pembayaran WHERE id_angsuran = '$id_angsuran'");

if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='datapembayaran.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='datapembayaran.php';
	</script>";
}

?>