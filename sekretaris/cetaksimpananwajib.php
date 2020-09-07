<?php 
	include ("../config/koneksi.php");
	function tgl_indo($tanggal){
		$bulan = array(
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember',);
		$pecahkan = explode('-', $tanggal);
		return $pecahkan[2] . '-' . $bulan[(int)$pecahkan[1]] . '-' . $pecahkan[0];
	}
  	$date = tgl_indo(date('Y-m-d'));

	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];
		if($bulan == "1")
		{
			$bln = "Januari";
		}
		else if($bulan == "2")
		{
			$bln == "Februari";
		}
		else if($bulan == "3")
		{
			$bln = "Maret";
		}
		else if($bulan == "4")
		{
			$bln = "April";
		}
		else if($bulan == "5")
		{
			$bln = "Mei";
		}
		else if($bulan == "6")
		{
			$bln = "Juni";
		}
		else if($bulan == "7")
		{
			$bln = "Juli";
		}
		else if($bulan == "8")
		{
			$bln = "Agustus";
		}
		else if($bulan == "9")
		{
			$bln = "September";
		}
		else if($bulan == "10")
		{
			$bln = "Oktober";
		}
		else if($bulan == "11")
		{
			$bln = "November";
		}
		else if($bulan == "12")
		{
			$bln = "Desember";
		}
?>
<body onload="window.print();">
	<center>
		<h2 style="margin-bottom: -20px;">LAPORAN ENTRY DATA</h2>
		<h3 style="margin-bottom: -20px;">SIMPANAN WAJIB ANGGOTA</h3>
		<h4>Jl. Soekarno-Hatta No. 01</h4>
	</center>
	<div class="container-fluid">
		<table>
			<tr>
				<td>Bulan - Tahun</td>
				<td>:</td>
				<td><?php echo $bln; ?>-<?php echo $tahun ?></td>
			</tr>
		</table>
		<div class="table-responsive">
			<table border="1" width="100%">
				<thead>
					<tr>
						<th style="text-align: center;">No</th>
						<th style="text-align: center;">ID Simpanan</th>
						<th style="text-align: center;">Tanggal Simpanan</th>
						<th style="text-align: center;">ID Anggota</th>
						<th style="text-align: center;">Nama Anggota</th>
						<th style="text-align: center;">Jenis Simpanan</th>
						<th style="text-align: center;">Jumlah Simpanan</th>
					</tr>
				</thead>
		
				<?php 
				$no = 1;
				include ("../config/koneksi.php");
				$simpan=0;
				$sql = mysqli_query($konek, "SELECT * FROM tbl_simpanan a LEFT JOIN tbl_anggota b ON a.id_anggota=b.id_anggota WHERE month(a.tgl_simpanan) = '$bulan' AND year(a.tgl_simpanan) = '$tahun' AND a.jenis_simpanan='Simpanan Wajib'");
				?>
				<div class="btn-group" style="margin-bottom: 5px;">
					<a href="cetaksimpananpokok.php?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun ?>" target="_blank();" class="btn btn-primary btn-flat"><i class="fa fa-print"></i></a>
				</div>
				<?php
				while ($data = mysqli_fetch_array($sql)){
					$simpan = $simpan+$data['jumlah_simpanan'];
					?>
					<tbody>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['id_simpanan']; ?></td>
							<td><?php echo tgl_indo($data['tgl_simpanan']); ?></td>
							<td><?php echo $data['id_anggota']; ?></td>
							<td><?php echo $data['nama_anggota']; ?></td>
							<td><?php echo $data['jenis_simpanan']; ?></td>
							<td><?php echo "Rp ".number_format($data['jumlah_simpanan'],0,',','.');?></td>
						</tr>
						<?php 
					}
					?>
					<tr>
						<th colspan="6" style="text-align: center;">Total</th>
						<td><?php echo "Rp ".number_format($simpan,0,',','.'); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="admin" style="float: right; width: 35%;">
		<p align="center">Payakumbuh, <?php echo $date; ?>
		<br>
		<br>
		<br>
		<p align="center">Admin BMT</p>
	</div>
</body>