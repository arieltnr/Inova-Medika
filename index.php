<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Klinik</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
	html, body {
		height: 100%;
	}
	h3 {
		font-family: Forte;
		background-color: cyan;
		}

	.tengah {
		background:#0c000;
  		color:#fff;
  		padding:20px;
  		margin:20px auto;
  		border:3px dashed #050;
  		border-radius:70px 0;
		}

</style>
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="tengah">
            <h3>Login Klinik</h3>
					<form role="form" action="" method="post">
							<div class="col-sm-12">
								<input class="form-control" placeholder="nip" name="nip" type="text" autofocus="" required="">
							</div>
							<div class="col-sm-12">
								<input class="form-control" placeholder="Password" name="pass" type="password" value="" required="">
							</div>
							<div style="margin-left: 6%;">
								<input type="submit" name="kirim" class="btn btn-danger btn-sm" value="Masuk" style="margin-top: 5px;">
								<input type="reset" class="btn btn-warning btn-sm" value="Reset" style="margin-top: 5px;">
							</div>
					</form>
					<div>
		</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
include'config.php';
if(isset($_POST['kirim'])){
session_start();
    $a = $_POST['nip'];
    $b = $_POST['pass'];

$sql = $conn -> query("SELECT * FROM user WHERE nip = '$a' AND password = '$b'");
$data = $sql -> num_rows >= 1;
$data = mysqli_fetch_array($sql);
$id = $data[1];

      if ($data['level'] == 'Admin'){
                $_SESSION['admin'] = $id; ?>
                 <script language="JavaScript">
	             alert("Selamat Datang");
                 onclick=document.location='users/admin/';	
	             </script>
<?php
       }
      else if ($data['level'] == 'Operator'){
                $_SESSION['operator'] = $id; ?>
                <script language="JavaScript">
	             alert("Selamat Datang");
                 onclick=document.location='users/operator/';	
	             </script>
<?php     
      }
      else { ?>
                <script type="text/javascript">
                	alert("NIP atau password salah!");
                </script>
 <?php  // header("location: index.php");
	  }
}
?>
