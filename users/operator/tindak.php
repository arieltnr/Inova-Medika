<?php
session_start();
if(empty($_SESSION['operator'])){
header("location: ../../index.php");
}

$id = $_SESSION['operator'];
include'../../config.php';

$today = date("l, d-M-Y");
$now = date('y-m-d h:i:s');

$nik = $_GET['id'];
$sql = $conn -> query("SELECT * FROM pasien WHERE nik = '$nik'");
$data = $sql -> fetch_array();

$sqll = $conn -> query("SELECT * FROM tindakan");
$sqlll = $conn -> query("SELECT * FROM obat");

$carikode = $conn -> query("SELECT MAX(id_pdf) FROM pendaftaran");
  $datakode = mysqli_fetch_array($carikode);
  if ($datakode) {
   $nilaikode = substr($datakode[0], 2);

   $kode = (int) $nilaikode;

   $kode = $kode + 1;
   $kode_otomatis = "P".str_pad($kode, 2, "0", STR_PAD_LEFT);
  } else {
   $kode_otomatis = "P01";
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inova Medika</title>
	<link href="../../css/bootstrap.min.css" rel="stylesheet">
	<link href="../../css/font-awesome.min.css" rel="stylesheet">
	<link href="../../css/datepicker3.css" rel="stylesheet">
	<link href="../../css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Inova</span>Medika</a>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a href="../logout.php" onclick="return confirm('Yakin?')"><em class="fa fa-power-off">&nbsp;</em> Logout </a>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
<div class="container-fluid">
	<div class="row"><center>
			<ol class="breadcrumb">
				<li><a href="index.php">Pendaftaran</a>
				</li>
				<li><a href="include.php">List Obat & Tindakan</a>
				</li>
				<li class="active"><a href="alur.php">Timeline</a>
				</li>

			</ol></center>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1></h1>
			</div>
		</div><!--/.row-->

			<div class="col-md-8 col-lg-offset-2 main">
				<div class="panel panel-default ">
					<div class="panel-heading">
						Penanganan Pasien
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<form class="form-horizontal" action="" method="post">
							<fieldset>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">NIK </label>
									<div class="col-md-9">
										<input name="nik" type="text" class="form-control" value="<?php echo $data[1]; ?>" readonly>
									</div>
								</div>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Nama </label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="<?php echo $data[2]; ?>" readonly>
									</div>
								</div>
							
								<div class="form-group">
									<label class="col-md-3 control-label">Tindakan</label>
										<div class="checkbox col-md-9">
											<label>
												<?php while ($tdk = $sqll -> fetch_array()) { ?>
													<input type="checkbox" value="<?php echo $tdk[0]; ?>" name="tdk"><?php echo $tdk[1]; ?><br>
												<?php  } ?>
											</label>
										</div>
								</div>
								
								<!-- Message body -->
								<div class="form-group">
									<label class="col-md-3 control-label">Obat</label>
										<div class="checkbox col-md-9">
											<label>
												<?php while ($obt = $sqlll -> fetch_array()) { ?>
													<input type="checkbox" value="<?php echo $obt[0]; ?>" name="obt"><?php echo $obt[1]; ?><br>
												<?php  } ?>
											</label>
										</div>
								</div>
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" name="kirim" class="btn btn-default btn-md pull-right">Submit</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
</div>	<!--/.main-->
	
	<script src="../../js/jquery-1.11.1.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/chart.min.js"></script>
	<script src="../../js/chart-data.js"></script>
	<script src="../../js/easypiechart.js"></script>
	<script src="../../js/easypiechart-data.js"></script>
	<script src="../../js/bootstrap-datepicker.js"></script>
	<script src="../../js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>

<?php
if(isset($_POST['kirim'])){
    $a = $_POST['nik'];
    $b = $_POST['tdk'];
    $c = $_POST['obt'];

    $cek = $conn -> query("SELECT harga FROM obat WHERE id_obt = '$c'");
    $cekk = $cek -> fetch_array();
    $harga = $cekk['harga'];

    $cek2 = $conn -> query("SELECT biaya FROM tindakan WHERE id_tdk = '$b'");
    $cekk2 = $cek2 -> fetch_array();
    $biaya = $cekk2['biaya'];

    $t = $harga + $biaya;

$up2 = $conn -> query("INSERT INTO rincian_daftar VALUES('', '$kode_otomatis', '$b', '$c')");
$up = $conn -> query("INSERT INTO pendaftaran VALUES('$kode_otomatis', '$a', '$now', '$t', 'Selesai')");

    if($up) { ?>
         <script language="JavaScript">
	              alert('Data Berhasil Ditambahkan');
	              document.location='bayar.php?nik=<?php echo $a; ?>';
	     </script>
<?php }
}
?>