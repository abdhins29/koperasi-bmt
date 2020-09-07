<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Koperasi BMT</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="assets//css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="assets/dist/css/skins/skin-blue.min.css">
</head>
<style>
body {
	background-image: url(assets/dist/img/Logo.jpg);
}

.form-signin {
	max-width: 400px;
	padding: 15px;
	margin: 0 auto;
	margin-top: 10px;
	background-color: #eee;
}
</style>
<body>
    <div class="container">

      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading" align="center" style="margin-top: -5px; margin-bottom: -5px;">Daftar Anggota!</h2>
        <div class="box-body">
            <div class="form-group">
                <input type="text" class="form-control" name="nama_anggota" placeholder="Masukan Nama Anggota" required="">
                <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukan Tempat Lahir Anggota" required="">
            </div>
            <div class="form-group">
                <label>Masukan Tanggal Lahir Anggota</label>
                <input type="date" class="form-control" name="tanggal_lahir"required="">
            </div>
            <div class="form-group">
                <label>Masukan Jenis Kelamin Anggota</label>
                <select name="gender" class="form-control">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat Anggota" required="">
                <input type="text" class="form-control" name="pekerjaan" placeholder="Masukan Pekerjaan Anggota" required="">
            </div>
            <div class="form-group">
                <label>Masukan Status Anggota</label>
                <select name="status" class="form-control">
                    <option value="Belum Menikah">Belum Menikah</option>
                    <option value="Menikah">Menikah</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="nik" placeholder="Masukan NIK Anggota" required="">
                <input type="password" class="form-control" name="password" placeholder="Masukan Password Anggota" required="">
                <input type="hidden" class="form-control" name="level" value="anggota" readonly="">
            </div>
            <center>
            <a href="index.php" style="text-decoration: underline;">Kembali Ke Halaman Utama</a>
            </center>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="tambah" type="submit"><i class="fa fa-registered"></i> Daftar</button>
      </form>

    </div> <!-- /container -->

<?php 
    include ("config/koneksi.php");
    if (isset($_POST['tambah'])) {
        $nama_anggota       = $_POST['nama_anggota'];
        $tempat_lahir       = $_POST['tempat_lahir'];
        $tanggal_lahir      = $_POST['tanggal_lahir'];
        $gender             = $_POST['gender'];
        $alamat             = $_POST['alamat'];
        $pekerjaan          = $_POST['pekerjaan'];
        $status             = $_POST['status'];
        $tanggal_masuk      = date("Y-m-d");

        $nik                = $_POST['nik'];
        $password           = $_POST['password'];
        $level              = $_POST['level'];

        $cekdulu = mysqli_query($konek, "SELECT * FROM tbl_anggota a LEFT JOIN tbl_login b ON a.id_anggota=b.id_anggota WHERE a.nik = '$nik'");
        if(mysqli_num_rows($cekdulu)){
            echo "<script>alert('NIK Sudah Digunakan');history.go(-1)</script>";
        }else{

            $sql = mysqli_query($konek,"SELECT * FROM tbl_anggota ORDER BY id_anggota DESC");
            $data = mysqli_fetch_assoc($sql);
            $jml = mysqli_num_rows($sql);
            if($jml==0){
                $id_anggota='AGT001';
            }else{
                $subid = substr($data['id_anggota'],3);
                if($subid>0 && $subid<=8){
                    $sub = $subid+1;
                    $id_anggota='AGT00'.$sub;
                }elseif($subid>=9 && $subid<=100){
                    $sub = $subid+1;
                    $id_anggota='AGT0'.$sub;
                }elseif($subid>=99 && $subid<=1000){
                    $sub = $subid+1;
                    $id_anggota='AGT'.$sub;
                }
            }

            $sql2 = mysqli_query($konek,"SELECT * FROM tbl_tabungan ORDER BY id_tabungan DESC");
            $data2 = mysqli_fetch_assoc($sql2);
            $jml2 = mysqli_num_rows($sql2);
            if($jml2==0){
                $id_tabungan='TBN001';
            }else{
                $subid2 = substr($data2['id_tabungan'],3);
                if($subid2>0 && $subid2<=8){
                    $sub2 = $subid2+1;
                    $id_tabungan='TBN00'.$sub2;
                }elseif($subid2>=9 && $subid2<=100){
                    $sub2 = $subid2+1;
                    $id_tabungan='TBN0'.$sub2;
                }elseif($subid2>=99 && $subid2<=1000){
                    $sub2 = $subid2+1;
                    $id_tabungan='TBN'.$sub2;
                }
            }       

            $save = mysqli_query($konek, "INSERT INTO tbl_anggota VALUES('$id_anggota','$nik','$nama_anggota','$tempat_lahir','$tanggal_lahir','$gender','$alamat','$pekerjaan','$status','$tanggal_masuk','Pending')");
            $save2 = mysqli_query($konek, "INSERT INTO tbl_login VALUES('','$id_anggota','$nik','$password','$level')");
            $save3 = mysqli_query($konek, "INSERT INTO tbl_tabungan VALUES('$id_tabungan','$id_anggota','0','0')");

            if($save) {
                echo "<script language=javascript>
                window.alert('Berhasil Menambah!');
                window.location='pemberitahuan.php';
                </script>";
            }else{
                echo "<script language=javascript>
                window.alert('Gagal Menambah!');
                window.location='daftar.php';
                </script>";
            }
        }
    }
?>

</body>
	<script src="assets/js/dist/jquery.min.js"></script>
	<script src="assets/dist/js/bootstrap.min.js"></script>
	<script src="assets/dist/js/adminlte.min.js"></script>
</html>