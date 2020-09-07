<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
	include ("../config/koneksi.php");
	$id_pinjaman= $_GET['kd'];
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Edit Pinjaman</h3>
		</div>
		<!-- /.box-header -->
		<?php 
			include ("../config/koneksi.php");
			$sql = mysqli_query($konek, "SELECT * FROM tbl_pinjaman WHERE id_pinjaman = '$id_pinjaman'");
			$data = mysqli_fetch_array($sql);
		?>
		<!-- form start -->
		<form role="form" method="post" action="">
			<div class="box-body">
				<div class="form-group">
					<input type="text" class="form-control" name="id_pinjaman" value="<?php echo $data['id_pinjaman'];?>" readonly>
				</div>
				<div class="form-group">
					<label>Masukan Tanggal Pinjaman</label>
					<input type="date" class="form-control" name="tgl_pinjaman" value="<?php echo $data['tgl_pinjaman'];?>">
				</div>
				<div class="form-group">
					<label>Masukan ID Anggota</label>
					<input type="text" class="form-control" name="id_anggota" value="<?php echo $data['id_anggota'];?>" readonly>
				</div>
				<div class="form-group">
					<label>Masukan Bunga Per-Bulan</label>
					<input type="text" class="form-control" name="bunga_perbulan" id="bunga_perbulan" value="<?php echo $data['bunga_perbulan']; ?>" readonly>
				</div>
				<div class="form-group">
					<label>Masukan Lama Cicilan</label>
					<input type="text" class="form-control" name="lama_cicilan" id="lama_cicilan" value="<?php echo $data['lama_cicilan']; ?>" readonly>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="jumlah_pinjaman" id="jumlah_pinjaman" value="<?php echo $data['jumlah_pinjaman']; ?>">
				</div>
				<div class="form-group">
					<label>Masukan Angsuran/Bulan</label>
					<input type="text" class="form-control" name="angsuran" id="angsuran" value="<?php echo $data['angsuran']; ?>" readonly>
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
		$id_pinjaman		= $_POST['id_pinjaman'];
		$tgl_pinjaman 		= $_POST['tgl_pinjaman'];
		$id_anggota 		= $_POST['id_anggota'];
		$bunga_perbulan 	= $_POST['bunga_perbulan'];
		$lama_cicilan 		= $_POST['lama_cicilan'];
		$jumlah_pinjaman 	= $_POST['jumlah_pinjaman'];
		$angsuran 			= $_POST['angsuran'];

		$update  = mysqli_query($konek, "UPDATE tbl_pinjaman SET tgl_pinjaman = '$tgl_pinjaman', jumlah_pinjaman = '$jumlah_pinjaman', angsuran = '$angsuran' WHERE id_pinjaman = '$id_pinjaman'");
		if($update){
			echo "<script language=javascript>
				window.alert('Berhasil Mengedit!');
				window.location='datapinjaman.php';
				</script>";
		}else{

			echo "<script language=javascript>
				window.alert('Gagal Mengedit!');
				window.location='datapinjaman.php';
				</script>";
		}
	}
?>


<script>
  document.getElementById("angsuran").value = 0;
  function hitungTotalHarga()
  {
    var bunga = document.getElementById("bunga_perbulan").value;
    var lama = document.getElementById("lama_cicilan").value;
    var jumlah = document.getElementById("jumlah_pinjaman").value;
    var cicilan = jumlah/lama;
    var jml_bunga = (jumlah * bunga)/lama;
    var total = cicilan+jml_bunga;
    if(!isNaN(total))
    {
      document.getElementById("angsuran").value = total;
    }
    else
    {
      document.getElementById("angsuran").value = 0;
    }
  }
  // Daftarkan fungsi ke element HTML
  document.getElementById("jumlah_pinjaman").addEventListener("keyup", hitungTotalHarga);
</script>
<?php 
	include ("style/footer.php");
?>