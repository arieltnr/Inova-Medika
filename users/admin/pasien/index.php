<?php
session_start();
if(empty($_SESSION['admin'])){
header("location: ../../index.php");
}
$id = $_SESSION['admin'];
include'../../../config.php';
ob_start();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Pasien</title>

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
			<li class="active"><a href="index.php"><em class="fa fa-users">&nbsp;</em> Pasien</a></li>
			<li><a href="../obat/"><em class="fa fa-shopping-cart">&nbsp;</em> Obat</a></li>
			<li><a href="../tindakan/"><em class="fa fa-clone">&nbsp;</em> Tindakan</a></li>
			<li><a href="../../logout.php" onclick="return confirm('Yakin?')"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Data Pasien</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
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
						        <th>NIK</th>
						        <th>Nama Pasien</th>
						        <th>Jenis Kelamin</th>
						        <th>Alamat</th>
						        <th>Usia</th>
						        <th>NO HP</th>
                                <th>Opsi</th>
                            </tr>
                             </thead>
                             <tbody>
                                 
                               <?php
                                $no = 1;
                                $sql = $conn -> query("SELECT * FROM pasien ORDER BY nama_psn");
                                $i = array();
                                while($data = $sql -> fetch_array()){ ?>
                                
                            <tr>
                                <td> <?php echo $no++; ?> </td>
                                <td> <?php echo $data[1]; ?> </td>
                                <td> <?php echo $data[2]; ?> </td>
                                <td> <?php echo $data[3]; ?> </td>
                                <td> <?php echo $data[4]; ?> </td>
                                <td> <?php echo $data[5]; ?> </td>
                                <td> <?php echo $data[6]; ?> </td>
                                <td>
                                     <a class="btn btn-warning" href="index.php?id=<?php echo $data[0]; ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                     <a class="btn btn-danger" href="pasien_h.php?id=<?php echo $data[0]; ?>"><span class="glyphicon glyphicon-remove" onclick="return confirm('Hapus?')"></span></a>
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
                      <label class="control-label col-sm-3" for="nama">NIK:</label>
                       <div class="col-sm-4">
                       <input type="number" class="form-control" name="nik">
                       </div>
                     </div>
    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Nama Pasien:</label>
                      <div class="col-sm-5">
                      <input type="txt" class="form-control" name="nama_p" maxlength="35" required="">
                      </div>
                    </div>

                   <div class="form-group">
						<label class="control-label col-sm-3" for="gender">Gender</label>
							<div class="radio">
								<label>
									<input type="radio" name="gender_p" id="optionsRadios1" value="Pria" checked>Pria
								</label>
								<label>
									<input type="radio" name="gender_p" id="optionsRadios2" value="Wanita">Wanita
								</label>
							</div>
					</div>

                    <div class="form-group">
                    	<label class="control-label col-sm-3" for="alamat">Alamat:</label>
                    	<div class="col-sm-5">
								<textarea class="form-control" rows="3" name="alamat_p"></textarea>
						</div>
					</div>

                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Usia:</label>
                      <div class="col-sm-5">
                      <input type="number" class="form-control" name="usia_p" maxlength="35" required="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">NO HP:</label>
                      <div class="col-sm-5">
                      <input type="number" class="form-control" name="hp_p" maxlength="35" required="">
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
	$sql = $conn -> query("SELECT * FROM pasien WHERE id_psn = '$id'");
    $data = $sql -> fetch_array(); ?>

  <div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<form action="" method="POST" class="form-horizontal">
				<div class="modal-body">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">NIK:</label>
                       <div class="col-sm-4">
                       <input type="number" class="form-control" name="e_nik" value="<?php echo $data[1]; ?>">
                       <input type="hidden" class="form-control" name="id" value="<?php echo $data[0]; ?>">
                       </div>
                     </div>
    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Nama Pasien:</label>
                      <div class="col-sm-5">
                      <input type="txt" class="form-control" name="e_nama_p" maxlength="35" value="<?php echo $data[2]; ?>" required="">
                      </div>
                    </div>

                   <div class="form-group">
						<label class="control-label col-sm-3" for="gender">Gender</label>
							<div class="radio">
								<label>
									<input type="radio" name="e_gender_p" id="optionsRadios1" value="Pria"
									<?php if($data[3] =='Pria'){ echo'checked';} ?>>Pria
								</label>
								<label>
									<input type="radio" name="e_gender_p" id="optionsRadios2" value="Wanita" 
									<?php if($data[3] =='Wanita'){ echo'checked';} ?>>Wanita
								</label>
							</div>
					</div>

                    <div class="form-group">
                    	<label class="control-label col-sm-3" for="alamat">Alamat:</label>
                    	<div class="col-sm-5">
								<textarea class="form-control" rows="3" name="e_alamat_p"><?php echo $data[4]; ?></textarea>
						</div>
					</div>

                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">Usia:</label>
                      <div class="col-sm-5">
                      <input type="number" class="form-control" name="e_usia_p" maxlength="35" value="<?php echo $data[5]; ?>" required="">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-3" for="nama">NO HP:</label>
                      <div class="col-sm-5">
                      <input type="number" class="form-control" name="e_hp_p" maxlength="35" value="<?php echo $data[6]; ?>" required="">
                      </div>
                    </div>
				</div>
				<div class="modal-footer">
                    <input type="submit" name="edit" value="Simpan" class="btn btn-info btn-md" onclick="(Yakin??)">
					<a href="pasien.php" class="btn btn-default">Batal</a>						
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

if(isset($_POST['edit'])){
	$edit = $_POST['id'];
    $edit_a = $_POST['e_nik'];
    $edit_b = $_POST['e_nama_p'];
    $edit_c = $_POST['e_gender_p'];
    $edit_d = $_POST['e_alamat_p'];
    $edit_e = $_POST['e_usia_p'];
    $edit_f = $_POST['e_hp_p'];

$ed = $conn -> query("UPDATE pasien SET nik = '$edit_a',
                                        nama_psn = '$edit_b',
                                        gender_psn = '$edit_c',
                                        alamat_psn = '$edit_d',
                                        usia = '$edit_e',
                                        no_hp = '$edit_f'
                                       WHERE id_psn = '$edit'");
    if($ed) { ?>
         <script language="JavaScript">
	              alert('Data Berhasil Diubah');
	              document.location='index.php';
	     </script>
<?php } } 
ob_flush();
?>