<?php
session_start();
if(empty($_SESSION['operator'])){
header("location: ../../index.php");
}

$id = $_SESSION['operator'];
include'../../config.php';

$today = date("l, d-M-Y");
$now = date('y-m-d h:i:s');
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
				<li class="active"><a href="include.php">List Obat & Tindakan</a>
				</li>
				<li><a href="alur.php">Timeline</a>
				</li>

			</ol></center>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1></h1>
			</div>
		</div><!--/.row-->

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						List Obat
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body">
						<table id="lookup" class="table table-striped" data-toggle="table" data-select-item-name="toolbar1">
	                            <thead>
	                            <tr>
	                                <th>No</th>
							        <th>Kode Obat</th>
							        <th>Nama Obat</th>
							        <th>Jenis</th>
	                            </tr>
	                             </thead>
	                             <tbody>
	                                 
	                               <?php
	                                $no = 1;
	                                $sql = $conn -> query("SELECT * FROM obat ORDER BY id_obt");
	                                while($data = $sql -> fetch_array()){ ?>
	                                
	                            <tr>
	                                <td> <?php echo $no++; ?> </td>
	                                <td> <?php echo $data[0]; ?> </td>
	                                <td> <?php echo $data[1]; ?> </td>
	                                <td> <?php echo $data[2]; ?> </td>
	                            </tr>
	                            <?php } ?>
	                                 </tbody>
	                        </table>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						List Tindakan
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body">
						<table id="lookup" class="table table-striped" data-toggle="table" data-select-item-name="toolbar1">
	                            <thead>
	                            <tr>
	                                <th>No</th>
							        <th>Kode Tindakan</th>
							        <th>Nama Tindakan</th>
	                            </tr>
	                             </thead>
	                             <tbody>
	                                 
	                               <?php
	                                $no = 1;
	                                $sql = $conn -> query("SELECT * FROM tindakan ORDER BY id_tdk");
	                                while($data = $sql -> fetch_array()){ ?>
	                                
	                            <tr>
	                                <td> <?php echo $no++; ?> </td>
	                                <td> <?php echo $data[0]; ?> </td>
	                                <td> <?php echo $data[1]; ?> </td>
	                            </tr>
	                            <?php } ?>
	                                 </tbody>
	                        </table>
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
    $b = $_POST['nama_p'];
    $c = $_POST['gender_p'];
    $d = $_POST['alamat_p'];
    $e = $_POST['usia_p'];
    $f = $_POST['hp_p'];

$up = $conn -> query("INSERT INTO pasien VALUES('', '$a', '$b', '$c', '$d', '$e', '$f')");
    if($up) { ?>
         <script language="JavaScript">
	              alert('Data Berhasil Ditambahkan');
	              document.location='index.php';
	     </script>
<?php }
}
?>