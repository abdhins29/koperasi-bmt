<?php
include ("../config/koneksi.php");
$id_pengambilan= $_GET['kd'];
$delete = mysqli_query($konek,"DELETE FROM tbl_pengambilan WHERE id_pengambilan = '$id_pengambilan'");


if($delete) {
	echo "<script language=javascript>
	window.alert('Berhasil Menghapus!');
	window.location='datapengambilan.php';
	</script>";
}else{
	echo "<script language=javascript>
	window.alert('Gagal Menghapus!');
	window.location='datapengambilan.php';
	</script>";
}

?>