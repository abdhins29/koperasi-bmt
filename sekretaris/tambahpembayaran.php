<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
	include ("../config/koneksi.php"); 
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Tambah Pembayaran Anggsuran</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form role="form" method="post" action="">
			<div class="box-body">
				<div class="form-group">
					<label>Masukan ID Anggota</label>
					<select name="id_pinjaman" id="id_pinjaman" class="form-control" required="">
						<option value="">Pilih Anggota</option>
						<?php
						$daftar_anggota = array();
						$qqq = mysqli_query($konek,"SELECT * FROM tbl_pinjaman a LEFT JOIN tbl_anggota b ON a.id_anggota=b.id_anggota");
						while($ddd = mysqli_fetch_assoc($qqq)){
							$daftar_anggota[] = $ddd;
							?>
							<option value="<?php echo $ddd['id_pinjaman']; ?>"><?php echo $ddd['id_pinjaman']; ?> - <?php echo $ddd['nama_anggota']; ?></option>
							<?php 
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Masukan Tanggal Pembayaran Anggsuran</label>
					<input type="date" class="form-control" name="tgl_bayar" required="">
				</div>
				<div class="form-group">
					<label>Masukan Cicilan Ke</label>
					<select name="cicilan" class="form-control">
						<option value="pilih cicilan">-- Pilih Cicilan --</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
				</div>
				<div class="form-group">
					<label>Masukan Jumlah Angsuran</label>
					<input type="text" name="jml_bayar" id="angsuran" class="form-control" readonly>
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
	if(isset($_POST['tambah'])) {
		$tgl_bayar 			= $_POST['tgl_bayar'];
		$id_pinjaman 		= $_POST['id_pinjaman'];
		$cicilan 			= $_POST['cicilan'];
		$jml_bayar 			= $_POST['jml_bayar'];

		$sql = mysqli_query($konek,"SELECT * FROM tbl_pembayaran ORDER BY id_angsuran DESC");
		$data = mysqli_fetch_assoc($sql);
		$jml = mysqli_num_rows($sql);
		if($jml==0){
			$id_angsuran='AGN001';
		}else{
			$subid = substr($data['id_angsuran'],3);
			if($subid>0 && $subid<=8){
				$sub = $subid+1;
				$id_angsuran='AGN00'.$sub;
			}elseif($subid>=9 && $subid<=100){
				$sub = $subid+1;
				$id_angsuran='AGN0'.$sub;
			}elseif($subid>=99 && $subid<=1000){
				$sub = $subid+1;
				$id_angsuran='AGN'.$sub;
			}
		}

	$save = mysqli_query($konek, "INSERT INTO tbl_pembayaran VALUES('$id_angsuran','$id_pinjaman','$cicilan','$jml_bayar','$tgl_bayar')");

	if($save) {
			echo "<script language=javascript>
			window.alert('Berhasil Menambah!');
			window.location='datapembayaran.php';
			</script>";
	}else{
			echo "<script language=javascript>
			window.alert('Gagal Menambah!');
			window.location='datapembayaran.php';
			</script>";
		}
	}
?>

<script>
  document.getElementById("angsuran").value = 0;
  function tampilkanangsuran()
  {
    var anggota = <?php echo json_encode($daftar_anggota); ?>;
    var anggota_terpilih = document.getElementById("id_pinjaman").selectedIndex;
    var angsuran = 0;
    if(anggota_terpilih != 0)
    {
      angsuran = anggota[anggota_terpilih-1].angsuran;
    }
    document.getElementById("angsuran").value = angsuran;
  }
  // Daftarkan fungsi ke element HTML
  document.getElementById("id_pinjaman").addEventListener("change", tampilkanangsuran);
</script>

<?php 
	include ("style/footer.php");
?>