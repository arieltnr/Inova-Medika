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
				<li class="active"><a href="#">Pendaftaran</a>
				</li>
				<li><a href="include.php">List Obat & Tindakan</a>
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
						Pendaftaran Pasien
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" action="" method="post">
							<fieldset>
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">NIK </label>
									<div class="col-md-9">
										<input id="name" name="nik" type="text" placeholder="NIK" class="form-control">
									</div>
								</div>
								<!-- Name input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Nama </label>
									<div class="col-md-9">
										<input id="name" name="nama_p" type="text" placeholder="Nama Anda" class="form-control">
									</div>
								</div>
							
								<div class="form-group">
									<label class="control-label col-sm-3">Gender</label>
										<div class="radio col-md-9">
											<label>
												<input type="radio" name="gender_p" id="optionsRadios1" value="Pria">Pria
											</label>
											<label>
												<input type="radio" name="gender_p" id="optionsRadios2" value="Wanita">Wanita
											</label>
										</div>
								</div>
								
								<!-- Message body -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Alamat</label>
									<div class="col-md-9">
										<textarea class="form-control" id="message" name="alamat_p" placeholder="Alamat Anda" rows="5"></textarea>
									</div>
								</div>

								<div class="form-group">
				                    <label class="control-label col-sm-3" for="nama">Usia:</label>
				                      <div class="col-md-9">
				                      	<input type="number" class="form-control" name="usia_p" maxlength="35" required="">
				                      </div>
				                </div>

				                <div class="form-group">
				                    <label class="control-label col-sm-3" for="nama">NO HP:</label>
				                      <div class="col-md-9">
				                      	<input type="number" class="form-control" name="hp_p" maxlength="35" required="">
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

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						List Pasien
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body">
						<div class="panel-body tabs">
						<ul class="nav nav-pills">
							<li class="active"><a href="#tab1" data-toggle="tab">Tindakan</a></li>
							<li><a href="#tab2" data-toggle="tab">Selesai</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab1">
								<table id="lookup" class="table table-striped" data-toggle="table" data-select-item-name="toolbar1">
	                            <thead>
	                            <tr>
	                                <th>No</th>
							        <th>NIK</th>
							        <th>Nama Pasien</th>
							        <th>Gender</th>
							        <th>Keterangan</th>
	                            </tr>
	                             </thead>
	                             <tbody>
	                                 
	                               <?php
	                                $no = 1;
	                                $sql = $conn -> query("SELECT * FROM pasien ORDER BY nama_psn");
	                                while($data = $sql -> fetch_array()){ ?>
	                                
	                            <tr>
	                                <td> <?php echo $no++; ?> </td>
	                                <td> <?php echo $data[1]; ?> </td>
	                                <td> <?php echo $data[2]; ?> </td>
	                                <td> <?php echo $data[3]; ?> </td>
	                                <td> <a class="btn btn-danger" href="tindak.php?id=<?php echo $data[1]; ?>"><span class="glyphicon glyphicon-edit"></span>Tindak</a>
	                                </td>
	                            </tr>
	                            <?php } ?>
	                                 </tbody>
	                        </table>
							</div>
							<div class="tab-pane fade" id="tab2">
								<table id="lookup" class="table table-striped" data-toggle="table" data-select-item-name="toolbar1">
	                            <thead>
	                            <tr>
	                                <th>No</th>
							        <th>NIK</th>
							        <th>Nama Pasien</th>
							        <th>Tanggal Periksa</th>
							        <th>Keterangan</th>
	                            </tr>
	                             </thead>
	                             <tbody>
	                                 
	                               <?php
	                                $no2 = 1;
	                                $sql2 = $conn -> query("SELECT * FROM pasien JOIN pendaftaran USING(nik) WHERE ket = 'Selesai'");
	                                while($data2 = $sql2 -> fetch_array()){ ?>
	                                
	                            <tr>
	                                <td> <?php echo $no2++; ?> </td>
	                                <td> <?php echo $data2['nik']; ?> </td>
	                                <td> <?php echo $data2['nama_psn']; ?> </td>
	                                <td> <?php echo $data2['tgl_pdf']; ?> </td>
	                                <td> <?php echo $data2['ket']; ?> </td>
	                            </tr>
	                            <?php } ?>
	                                 </tbody>
	                        </table>
							</div>
						</div>
					</div> 
	                        <div id="crud"></div>
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