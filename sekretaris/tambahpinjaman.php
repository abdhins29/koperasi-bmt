<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Tambah Pinjaman</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form role="form" method="post" action="">
			<div class="box-body">
				<div class="form-group">
					<label>Masukan Tanggal Pinjaman</label>
					<input type="date" class="form-control" name="tgl_pinjaman" required="">
				</div>
				<div class="form-group">
					<label>Masukan ID Anggota</label>
					<select name="id_anggota" id="id_anggota" class="form-control" required="">
						<option value="">Pilih Anggota</option>
						<?php
						$daftar_anggota = array();
						include ("../config/koneksi.php"); 
						$qqq = mysqli_query($konek,"SELECT * FROM tbl_tabungan a LEFT JOIN tbl_anggota b ON a.id_anggota=b.id_anggota");
						while($ddd = mysqli_fetch_assoc($qqq)){
							$daftar_anggota[] = $ddd;
							?>
							<option value="<?php echo $ddd['id_anggota']; ?>"><?php echo $ddd['id_anggota']; ?> - <?php echo $ddd['nama_anggota']; ?></option>
							<?php 
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Masukan Saldo</label>
					<input type="text" name="saldo" id="saldo" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label>Masukan Bunga Per-Bulan</label>
					<input type="text" class="form-control" name="bunga_perbulan" id="bunga_perbulan" value="0.1" readonly>
				</div>
				<div class="form-group">
					<label>Masukan Lama Cicilan</label>
					<input type="text" class="form-control" name="lama_cicilan" id="lama_cicilan" value="12" readonly>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="jumlah_pinjaman" id="jumlah_pinjaman" placeholder="Masukan Jumlah Pinjaman" required="">
				</div>
				<div class="form-group">
					<label>Masukan Angsuran/Bulan</label>
					<input type="text" class="form-control" name="angsuran" id="angsuran" readonly>
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
		$tgl_pinjaman 		= $_POST['tgl_pinjaman'];
		$id_anggota 		= $_POST['id_anggota'];
		$bunga_perbulan 	= $_POST['bunga_perbulan'];
		$lama_cicilan 		= $_POST['lama_cicilan'];
		$jumlah_pinjaman 	= $_POST['jumlah_pinjaman'];
		$angsuran 			= $_POST['angsuran'];

		$sql = mysqli_query($konek,"SELECT * FROM tbl_pinjaman ORDER BY id_pinjaman DESC");
		$data = mysqli_fetch_assoc($sql);
		$jml = mysqli_num_rows($sql);
		if($jml==0){
			$id_pinjaman='PJN001';
		}else{
			$subid = substr($data['id_pinjaman'],3);
			if($subid>0 && $subid<=8){
				$sub = $subid+1;
				$id_pinjaman='PJN00'.$sub;
			}elseif($subid>=9 && $subid<=100){
				$sub = $subid+1;
				$id_pinjaman='PJN0'.$sub;
			}elseif($subid>=99 && $subid<=1000){
				$sub = $subid+1;
				$id_pinjaman='PJN'.$sub;
			}
		}

	$save = mysqli_query($konek, "INSERT INTO tbl_pinjaman VALUES('$id_pinjaman','$tgl_pinjaman','$id_anggota','$bunga_perbulan','$lama_cicilan','$jumlah_pinjaman','$angsuran')");

	if($save) {
			echo "<script language=javascript>
			window.alert('Berhasil Menambah!');
			window.location='datapinjaman.php';
			</script>";
	}else{
			echo "<script language=javascript>
			window.alert('Gagal Menambah!');
			window.location='datapinjaman.php';
			</script>";
		}
	}
?>

<script>
  document.getElementById("saldo").value = 0;
  document.getElementById("angsuran").value = 0;
  function tampilkanSaldo()
  {
    var anggota = <?php echo json_encode($daftar_anggota); ?>;
    var anggota_terpilih = document.getElementById("id_anggota").selectedIndex;
    var saldo = 0;
    if(anggota_terpilih != 0)
    {
      saldo = anggota[anggota_terpilih-1].saldo;
    }
    document.getElementById("saldo").value = saldo;
  }

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
  document.getElementById("id_anggota").addEventListener("change", tampilkanSaldo);
  document.getElementById("jumlah_pinjaman").addEventListener("keyup", hitungTotalHarga);
</script>

<?php 
	include ("style/footer.php");
?>