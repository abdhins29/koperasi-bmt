<?php
include ("../config/koneksi.php");
$id_anggota= $_GET['kd'];
$delete = mysqli_query($konek,"DELETE FROM tbl_anggota WHERE id_anggota = '$id_anggota'");
$delete3 = mysqli_query($konek,"DELETE FROM tbl_tabungan WHERE id_anggota = '$id_anggota'");
$delete2 = mysqli_query($konek,"DELETE FROM tbl_login WHERE id_anggota = '$id_anggota'");

if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='dataanggota.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='dataanggota.php';
	</script>";
}

?>