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
	padding-top: 40px;
	padding-bottom: 40px;
	background-image: url(assets/dist/img/Logo.jpg);
}

.form-signin {
	max-width: 400px;
	padding: 15px;
	margin: 0 auto;
	margin-top: 130px;
	background-color: #eee;
}
</style>
<body>
    <div class="container">

      <form class="form-signin" method="post" action="">
        <h2 class="form-signin-heading" align="center">Silahkan Login!</h2>
        <div class="form-group">
        	<input type="text" name="username" class="form-control" placeholder="Masukan Username" required autofocus>
        	<input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
	        <select name="level" class="form-control">
	        	<option value="Silahkan Pilih">Silahkan Pilih Level</option>
                <option value="anggota">Anggota</option>
	        	<option value="bendahara">Bendahara</option>
	        	<option value="sekretaris">Sekretaris</option>
	        </select>
            <br>
            <center>
            <a href="index.php" style="text-decoration: underline;">Kembali Ke Halaman Utama</a>
            </center>
	    </div>
        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit"><i class="fa fa-sign-in"></i> Login</button>
      </form>

    </div> <!-- /container -->

    <?php 
    session_start();
    include ("config/koneksi.php");
    if(isset($_POST['login'])) {
    	$username   =$_POST['username'];
    	$password   =$_POST['password'];

    	$query  =mysqli_query($konek,"SELECT * FROM tbl_login WHERE username='$username' AND password='$password'"); 
    	echo mysqli_error($query);
    	$row=mysqli_num_rows($query);
    	if ($row > 0) {
    		$data = mysqli_fetch_assoc($query);
    		if($data['level'] == "sekretaris"){
    			$_SESSION['id']    = $data['id'];
    			$_SESSION['username']   = $username;
    			$_SESSION['level']      = "sekretaris";
    			echo "<script language=javascript>
    			window.alert('Selamat Datang Sekretaris!');
    			window.location='sekretaris/index.php';
    			</script>";
            }else if($data['level'] == "anggota"){
                $_SESSION['id']    = $data['id'];
                $_SESSION['username']   = $username;
                $_SESSION['level']      = "anggota";
                echo "<script language=javascript>
                window.alert('Selamat Datang Anggota!');
                window.location='anggota/index.php';
                </script>";
            }else if($data['level'] == "bendahara"){
    			$_SESSION['id']    = $data['id'];
    			$_SESSION['username']   = $username;
    			$_SESSION['level']      = "bendahara";
    			echo "<script language=javascript>
    			window.alert('Selamat Datang Bendahara!');
    			window.location='bendahara/index.php';
    			</script>";
    		}else{
    			echo "<script language=javascript>
    			window.alert('Username atau Password Salah!');
    			window.location='login.php';
    			</script>";
    		}
    	}else{
    		echo "<script language=javascript>
    		window.alert('Username atau Password Salah!');
    		window.location='login.php';
    		</script>";
    	}
    }
    ?>

</body>
	<script src="assets/js/dist/jquery.min.js"></script>
	<script src="assets/dist/js/bootstrap.min.js"></script>
	<script src="assets/dist/js/adminlte.min.js"></script>
</html>