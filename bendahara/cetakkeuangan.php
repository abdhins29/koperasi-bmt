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
		<h2 style="margin-bottom: -20px;">LAPORAN KEUANGAN</h2>
		<h3 style="margin-bottom: -20px;">KOPERASI BMT</h3>
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
							<th style="text-align: center;">Tanggal Transaksi</th>
							<th style="text-align: center;">Kode Transaksi</th>
							<th style="text-align: center;">Jumlah Transaksi</th>
						</tr>
					</thead>
					<?php 
					$no = 1;
					$simpan = 0;
					$sql = mysqli_query($konek, "SELECT * FROM tbl_simpanan WHERE month(tgl_simpanan) = '$bulan' AND year(tgl_simpanan) = '$tahun' GROUP BY id_simpanan");
					while ($data = mysqli_fetch_array($sql)){
						$simpan = $simpan+$data['jumlah_simpanan'];
					?>
					<tbody>
						<tr>
							<td style="text-align: center;"><?php echo $no++; ?></td>
							<td style="text-align: center;"><?php echo tgl_indo($data['tgl_simpanan']); ?></td>
							<td style="text-align: center;"><?php echo $data['id_simpanan']; ?></td>
							<td style="text-align: center;"><?php echo "Rp ".number_format($data['jumlah_simpanan'],0,',','.');?></td>
						</tr>
					<?php
					}
					$ambil = 0;
					$sql2 = mysqli_query($konek, "SELECT * FROM tbl_pengambilan WHERE month(tgl_pengambilan) = '$bulan' AND year(tgl_pengambilan) = '$tahun' GROUP BY id_pengambilan");
					while ($data2 = mysqli_fetch_array($sql2)){
						$ambil = $ambil+$data2['jumlah_pengambilan'];
					?>
						<tr>
							<td style="text-align: center;"><?php echo $no++; ?></td>
							<td style="text-align: center;"><?php echo tgl_indo($data2['tgl_pengambilan']); ?></td>
							<td style="text-align: center;"><?php echo $data2['id_pengambilan']; ?></td>
							<td style="text-align: center;"><?php echo "Rp -".number_format($data2['jumlah_pengambilan'],0,',','.');?></td>
						</tr>
					<?php
						$total = 0;
						$total = $simpan-$ambil; 
					}
					?>
						<tr>
							<th colspan="3" style="text-align: center;">Saldo</th>
							<td style="text-align: center;"><?php echo "Rp ".number_format($total,0,',','.'); ?></td>
						</tr>
					</tbody>
				</table>
				<br>
				<table border="1" width="100%">
					<thead>
						<tr>
							<th style="text-align: center;">No</th>
							<th style="text-align: center;">Tanggal Pinjaman</th>
							<th style="text-align: center;">Nama Anggota</th>
							<th style="text-align: center;">Jumlah Pinjaman</th>
						</tr>
					</thead>
					<?php 
					$no3 = 1;
					$total2 = 0;
					$sql3 = mysqli_query($konek, "SELECT * FROM tbl_pinjaman a LEFT JOIN tbl_anggota b ON a.id_anggota=b.id_anggota WHERE month(tgl_pinjaman) = '$bulan' AND year(tgl_pinjaman) = '$tahun' GROUP BY id_pinjaman");
					while ($data3 = mysqli_fetch_array($sql3)){
                    $total2=$total2+$data3['jumlah_pinjaman'];
					?>
					<tbody>
						<tr>
							<td style="text-align: center;"><?php echo $no3++; ?></td>
							<td style="text-align: center;"><?php echo tgl_indo($data3['tgl_pinjaman']); ?></td>
							<td><?php echo $data3['nama_anggota']; ?></td>
							<td style="text-align: center;"><?php echo "Rp ".number_format($data3['jumlah_pinjaman'],0,',','.');?></td>
						</tr>
					<?php 
					} 
					?>
						<tr>
							<th colspan="3" style="text-align: center;">Total</th>
							<td style="text-align: center;"><?php echo "Rp ".number_format($total2,0,',','.'); ?></td>
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