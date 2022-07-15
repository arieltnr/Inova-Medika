<?php 
include'../../../config.php';
$id = $_GET['id'];

$conn -> query("DELETE FROM tindakan WHERE id_tdk = '$id'");
header('location: index.php');
?>