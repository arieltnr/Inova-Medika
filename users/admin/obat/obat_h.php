<?php 
include'../../../config.php';
$id = $_GET['id'];

$conn -> query("DELETE FROM obat WHERE id_obt = '$id'");
header('location: index.php');
?>