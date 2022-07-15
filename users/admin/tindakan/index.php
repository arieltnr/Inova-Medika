<?php
session_start();
if(empty($_SESSION['admin'])){
header("location: ../../index.php");
}
$id = $_SESSION['admin'];
include'../../../config.php';
ob_start();

$carikode = $conn -> query("SELECT MAX(id_tdk) FROM tindakan");
  $datakode = mysqli_fetch_array($carikode);
  if ($datakode) {
   $nilaikode = substr($datakode[0], 2);

   $kode = (int) $nilaikode;

   $kode = $kode + 1;
   $kode_otomatis = "T".str_pad($kode, 2, "0", STR_PAD_LEFT);
  } else {
   $kode_otomatis = "T01";
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Tindakan</title>

<link href="../../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../../css/datepicker3.css" rel="stylesheet">
<link href="../../../css/bootstrap-table.css" rel="stylesheet">
<link href="../../../aset/datatables/dataTables.bootstrap.css" rel="stylesheet">

<link href="../../../css/font-awesome.min.css" rel="stylesheet">
<link href="../../../css/styles.css" rel="stylesheet">
	
<!--Custom Font-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<!--Icons-->
<script src="../../../js/lumino.glyphs.js"></script>

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
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="" class="img-responsive" alt="">
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
			<li><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="../pegawai/"><em class="fa fa-toggle-off">&nbsp;</em> Pegawai & User</a></li>
			<li><a href="../pasien/"><em class="fa fa-users">&nbsp;</em> Pasien</a></li>
			<li><a href="../obat/"><em class="fa fa-shopping-cart">&nbsp;</em> Obat</a></li>
			<li class="active"><a href="#"><em class="fa fa-clone">&nbsp;</em> Tindakan</a></li>
			<li><a href="../../logout.php" onclick="return confirm('Yakin?')"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Data Tindakan</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-md-6">
				<h3></h3>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
                         <a id="pesan_sedia" class="btn btn-success" href="#" data-toggle="modal" data-target="#modalpesan2">Tambah</a>
                         <a class="btn btn-info" href="#">
                            <span class="glyphicon glyphicon-print"></span> Cetak Laporan
                         </a>
                         <a class="btn btn-default" href="index.php"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
                    </div>
					<div class="panel-body">
                         <table id="lookup" class="table table-striped" data-toggle="table" data-select-item-name="toolbar1">
                            <thead>
                            <tr>
                                <th>No</th>
						        <th>Kode Tindakan</th>
						        <th>Nama Tindakan</th>
								<th>Biaya</th>
                                <th>Opsi</th>
                            </tr>
                             </thead>
                             <tbody>
                                 
                               <?php
                                $no = 1;
                                $sql = $conn -> query("SELECT * FROM tindakan ORDER BY id_tdk");
                                $i = array();
                                while($data = $sql -> fetch_array()){ ?>
                                
                            <tr>
                                <td> <?php echo $no++; ?> </td>
                                <td> <?php echo $data[0]; ?> </td>
                                <td> <?php echo $data[1]; ?> </td>
								<td> <?php echo $data[2]; ?> </td>
                                <td>
                                     <a class="btn btn-warning" href="index.php?id=<?php echo $data[0]; ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                     <a class="btn btn-danger" href="tindakan_h.php?id=<?php echo $data[0]; ?>"><span class="glyphicon glyphicon-remove" onclick="return confirm('Hapus?')"></span></a>
                                </td>
                            </tr>
                            <?php } ?>
                                 </tbody>
                        </table>
                        <div id="crud"></div>
						</div>
				</div>
			</div>
		</div><!--/.row-->
        <div id="modalpesan2" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Tambah Data</h4>
				</div>
              <form action="" method="POST" class="form-horizontal">
				<div class="modal-body">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Kode Tindakan:</label>
                       <div class="col-sm-4">
                       <input type="text" class="form-control" name="kd_t" value="<?php echo $kode_otomatis; ?>" readonly>
                       </div>
                     </div>
    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Nama Tindakan:</label>
                      <div class="col-sm-5">
                      <input type="text" class="form-control" name="nama_t" maxlength="35" required="">
                      </div>
                    </div>

					<div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Biaya:</label>
                      <div class="col-sm-5">
                      <input type="number" class="form-control" name="biaya" maxlength="35" required="">
                      </div>
                    </div>
				</div>
				<div class="modal-footer">
                    <input type="submit" name="kirim" value="Simpan" class="btn btn-info btn-md" onclick="(Yakin??)">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>						
				</div>
                </form>
			</div>
		</div>
	</div>
						<script>
						    $(function () {
						        $('#hover, #striped, #condensed').click(function () {
						            var classes = 'table';
						
						            if ($('#hover').prop('checked')) {
						                classes += ' table-hover';
						            }
						            if ($('#condensed').prop('checked')) {
						                classes += ' table-condensed';
						            }
						            $('#table-style').bootstrapTable('destroy')
						                .bootstrapTable({
						                    classes: classes,
						                    striped: $('#striped').prop('checked')
						                });
						        });
						    });
						
						    function rowStyle(row, index) {
						        var classes = ['active', 'success', 'info', 'warning', 'danger'];
						
						        if (index % 2 === 0 && index / 2 < classes.length) {
						            return {
						                classes: classes[index / 2]
						            };
						        }
						        return {};
						    }
						</script>
<?php
if (isset($_GET['id'])){
	$id = $_GET['id'];
	$sql = $conn -> query("SELECT * FROM tindakan WHERE id_tdk = '$id'");
    $data = $sql -> fetch_array(); ?>

  <div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<form action="" method="POST" class="form-horizontal">
				<div class="modal-body">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Kode Tindakan:</label>
                       <div class="col-sm-4">
                       <input type="text" class="form-control" name="kd_t" value="<?php echo $data[0]; ?>" readonly>
                       </div>
                     </div>
    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Nama Tindakan:</label>
                      <div class="col-sm-5">
                      <input type="txt" class="form-control" name="e_nama_t" maxlength="35" value="<?php echo $data[1]; ?>" required="">
                      </div>
                    </div>

					<div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Biaya:</label>
                      <div class="col-sm-5">
                      <input type="txt" class="form-control" name="e_biaya" maxlength="35" value="<?php echo $data[2]; ?>" required="">
                      </div>
                    </div>
				</div>
				<div class="modal-footer">
                    <input type="submit" name="edit" value="Simpan" class="btn btn-info btn-md" onclick="(Yakin??)">
					<a href="index.php" class="btn btn-default">Batal</a>						
				</div>
                </form>
				</div>
			</div>
		</div><!--/.row--> 
<?php } ?> 
	</div><!--/.main-->

	<script src="../../../js/jquery-1.11.1.min.js"></script>
	<script src="../../../js/bootstrap.min.js"></script>
	<script src="../../../js/chart.min.js"></script>
	<script src="../../../js/chart-data.js"></script>
	<script src="../../../js/easypiechart.js"></script>
	<script src="../../../js/easypiechart-data.js"></script>
	<script src="../../../js/bootstrap-datepicker.js"></script>
	<script src="../../../js/bootstrap-table.js"></script>
	<script src="../../../aset/datatables/jquery.dataTables.js"></script>
    <script src="../../../aset/datatables/dataTables.bootstrap.js"></script>
   	<script type="text/javascript">

//            jika dipilih, nim akan masuk ke input dan modal di tutup
            $(document).on('click', '.pilih', function (e) {
                document.getElementById("nim").value = $(this).attr('data-nim');
                $('#myModal').modal('hide');
            });
			

//            tabel lookup mahasiswa
            $(function () {
                $("#lookup").dataTable();
            });

            function dummy() {
                var nim = document.getElementById("nim").value;
                alert('Nomor Induk Mahasiswa ' + nim + ' berhasil tersimpan');
				
				var ket = document.getElementById("ket").value;
                alert('Keterangan ' + ket + ' berhasil tersimpan');
            }
        </script>
</body>

</html>

<?php
if(isset($_POST['kirim'])){
    $b = $_POST['nama_t'];
	$c = $_POST['biaya'];

$up = $conn -> query("INSERT INTO tindakan VALUES('$kode_otomatis', '$b', '$c')");
    if($up) { ?>
         <script language="JavaScript">
	              alert('Data Berhasil Ditambahkan');
	              document.location='index.php';
	     </script>
<?php }
}

if(isset($_POST['edit'])){
	$edit = $_POST['kd_t'];
    $edit_a = $_POST['e_nama_t'];
	$edit_b = $_POST['e_biaya'];

$ed = $conn -> query("UPDATE tindakan SET nama_tdk = '$edit_a', biaya = '$edit_b' WHERE id_tdk = '$edit'");
    if($ed) { ?>
         <script language="JavaScript">
	              alert('Data Berhasil Diubah');
	              document.location='index.php';
	     </script>
<?php } } 
ob_flush();
?>