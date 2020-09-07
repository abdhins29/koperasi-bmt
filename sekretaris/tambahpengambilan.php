<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Form Tambah Pengambilan</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form role="form" method="post" action="">
			<div class="box-body">
				<div class="form-group">
					<label>Masukan Tanggal Pengambilan</label>
					<input type="date" class="form-control" name="tgl_pengambilan" required="">
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
					<input type="text" class="form-control" name="jumlah_pengambilan" id="jumlah_pengambilan" placeholder="Masukan Jumlah Pinjaman" required="">
				</div>
				<div class="form-group">
					<label>Sisa Saldo</label>
					<input type="text" class="form-control" name="sisa_saldo" id="sisa_saldo" readonly>
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
		$tgl_pengambilan 	= $_POST['tgl_pengambilan'];
		$id_anggota 		= $_POST['id_anggota'];
		$jumlah_pengambilan = $_POST['jumlah_pengambilan'];

		$sql = mysqli_query($konek,"SELECT * FROM tbl_pengambilan ORDER BY id_pengambilan DESC");
		$data = mysqli_fetch_assoc($sql);
		$jml = mysqli_num_rows($sql);
		if($jml==0){
			$id_pengambilan='PGN001';
		}else{
			$subid = substr($data['id_pengambilan'],3);
			if($subid>0 && $subid<=8){
				$sub = $subid+1;
				$id_pengambilan='PGN00'.$sub;
			}elseif($subid>=9 && $subid<=100){
				$sub = $subid+1;
				$id_pengambilan='PGN0'.$sub;
			}elseif($subid>=99 && $subid<=1000){
				$sub = $subid+1;
				$id_pengambilan='PGN'.$sub;
			}
		}

	$save = mysqli_query($konek, "INSERT INTO tbl_pengambilan VALUES('$id_pengambilan','$tgl_pengambilan','$id_anggota','$jumlah_pengambilan')");

	if($save) {
			echo "<script language=javascript>
			window.alert('Berhasil Menambah!');
			window.location='datapengambilan.php';
			</script>";
	}else{
			echo "<script language=javascript>
			window.alert('Gagal Menambah!');
			window.location='datapengambilan.php';
			</script>";
		}
	}
?>

<script>
  document.getElementById("saldo").value = 0;
  document.getElementById("sisa_saldo").value = 0;
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
  	var saldo = document.getElementById("saldo").value;
    var jumlah = document.getElementById("jumlah_pengambilan").value;
    var total = saldo-jumlah;
    if(!isNaN(total))
    {
      document.getElementById("sisa_saldo").value = total;
    }
    else
    {
      document.getElementById("sisa_saldo").value = 0;
    }
  }
  // Daftarkan fungsi ke element HTML
  document.getElementById("id_anggota").addEventListener("change", tampilkanSaldo);
  document.getElementById("jumlah_pengambilan").addEventListener("keyup", hitungTotalHarga);
</script>

<?php 
	include ("style/footer.php");
?>