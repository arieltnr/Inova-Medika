<?php 
include'../../../config.php';
$id = $_GET['id'];

$conn -> query("DELETE FROM pasien WHERE id_psn = '$id'");
header('location: index.php');
?>