<?php 
include'../../../config.php';

$id = $_GET['id'];
$id2 = $_GET['id2'];

if(isset($_GET['id'])){
	$conn -> query("DELETE FROM pegawai WHERE id_krywn = '$id'");
	$conn -> query("DELETE FROM user WHERE id = '$id2'");
	header('location: index.php');
}
if(isset($_GET['id2'])){
	$conn -> query("DELETE FROM user WHERE id = '$id2'");
	header('location: index.php');
}
?>