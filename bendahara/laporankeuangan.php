<?php 
	include ("style/header.php");
	include ("style/sidebar.php");
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
?>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Laporan Keuangan</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<form action="" method="post">
				<div class="select-group">
					<select name="bulan" class="form-control" style="width: 15%; margin-bottom: 5px;">
						<option value="">Pilih Bulan</option>
						<option value="1">Januari</option>
						<option value="2">Februari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
				</div>
				<div class="select-group">
					<select name="tahun" class="form-control" style="width: 15%; margin-bottom: 5px;">
						<option value="">Pilih Tahun</option>
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
					</select>
					<span class="select-group-btn">
						<button type="submit" class="btn btn-success btn-flat" name="cari">Check</button>
					</span>
				</div>
			</form>
			<br>
			<?php
			$no = 1;
			if(isset($_POST['cari'])){
				$bulan 	= $_POST['bulan'];
				$tahun 	= $_POST['tahun'];
			?>
			<div class="btn-group" style="margin-bottom: 5px;">
				<a href="cetakkeuangan.php?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun ?>" target="_blank();" class="btn btn-primary btn-flat"><i class="fa fa-print"></i></a>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered">
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
				<table class="table table-bordered">
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
			<?php 
			}
			?>
		</div>
    </div>
<?php 
	include ("style/footer.php");
?>