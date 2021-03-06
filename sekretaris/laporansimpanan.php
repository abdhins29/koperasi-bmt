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
			<h3 class="box-title">Laporan Simpanan Pokok & Wajib</h3>
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
		</div>
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Laporan Simpanan Pokok</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-bordered">
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
					$sql = mysqli_query($konek, "SELECT * FROM tbl_simpanan a LEFT JOIN tbl_anggota b ON a.id_anggota=b.id_anggota WHERE month(a.tgl_simpanan) = '$bulan' AND year(a.tgl_simpanan) = '$tahun' AND a.jenis_simpanan='Simpanan Pokok'");
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
	</div>

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Laporan Simpanan Wajib</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-bordered">
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
					$simpan2 = 0;
					include ("../config/koneksi.php");
					$sql = mysqli_query($konek, "SELECT * FROM tbl_simpanan a LEFT JOIN tbl_anggota b ON a.id_anggota=b.id_anggota WHERE month(a.tgl_simpanan) = '$bulan' AND year(a.tgl_simpanan) = '$tahun' AND a.jenis_simpanan='Simpanan Wajib'");
					?>
					<div class="btn-group" style="margin-bottom: 5px;">
					<a href="cetaksimpananwajib.php?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun ?>" target="_blank();" class="btn btn-primary btn-flat"><i class="fa fa-print"></i></a>
					</div>
					<?php
					while ($data = mysqli_fetch_array($sql)){
						$simpan2 = $simpan2+$data['jumlah_simpanan'];
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
							<td><?php echo "Rp ".number_format($simpan2,0,',','.'); ?></td>
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