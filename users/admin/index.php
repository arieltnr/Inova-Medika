<?php
session_start();
if(empty($_SESSION['admin'])){
header("location: ../../index.php");
}

$id = $_SESSION['admin'];
include'../../config.php';

$today = date("l, d-M-Y");
$now = date('y-m-d h:i:s');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Klinik - Dashboard</title>
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
<script type="text/javascript">  
    <?php date_default_timezone_set("Asia/Jakarta"); ?>;
    var detik = <?php echo date('s'); ?>;
    var menit = <?php echo date('i'); ?>;
    var jam   = <?php echo date('H'); ?>;
    
     
    function clock()
    {
        if (detik!=0 && detik%60==0) {
            menit++;
            detik=0;
        }
        second = detik;
         
        if (menit!=0 && menit%60==0) {
            jam++;
            menit=0;
        }
        minute = menit;
         
        if (jam!=0 && jam%24==0) {
            jam=0;
        }
        hour = jam;
         
        if (detik<10){
            second='0'+detik;
        }
        if (menit<10){
            minute='0'+menit;
        }
         
        if (jam<10){
            hour='0'+jam;
        }
        waktu = hour+':'+minute+':'+second;
         
        document.getElementById("clock").innerHTML = waktu;
        detik++;
    }
    setInterval(clock,1000);
</script>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Inova</span>Medika</a>
				<ul class="nav navbar-top-links navbar-right">
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img class="img-responsive" alt="">
			</div>
<?php 
$sql = $conn -> query("SELECT nama_krywn, nip FROM user JOIN pegawai USING(nip) WHERE nip = '$id'");
$nip = $sql -> fetch_array();
?>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo $nip[0]; ?> </div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="pegawai/"><em class="fa fa-toggle-off">&nbsp;</em> Pegawai & User</a></li>
			<li><a href="pasien/"><em class="fa fa-users">&nbsp;</em> Pasien</a></li>
			<li><a href="obat/"><em class="fa fa-shopping-cart">&nbsp;</em> Obat</a></li>
			<li><a href="tindakan/"><em class="fa fa-clone">&nbsp;</em> Tindakan</a></li>
			<li><a href="../logout.php" onclick="return confirm('Yakin?')"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
<?php
$obat = $conn -> query("SELECT id_obt FROM obat");
$pasien = $conn -> query("SELECT nik FROM pasien");
$data = $obat -> num_rows;
$data2 = $pasien -> num_rows; ?> 
	
			<div class="row">
				<div class="col-lg-12">
					<div class="alert bg-warning" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em> Welcome to the admin dashboard
						<a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a>
					</div>
				</div>
			</div>

		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large"> <?php echo $data; ?> </div>
							<div class="text-muted">Obat</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<div class="large"> <?php echo $data; ?> </div>
							<div class="text-muted">Pasien</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding">
						<div class="panel-body">
							<font id="clock" size="5" color="teal" face="algeria"></font>
							<font size="4" color="teal" face="algeria"> WIB </font>
						</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
					<div class="row no-padding">
						<div class="panel-body">
							<font size="4" color="teal" face="algeria">
						 		<?php echo $today;?>
							</font>
						</div>
					</div>
					</div>
				</div>
			</div><!--/.row-->
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