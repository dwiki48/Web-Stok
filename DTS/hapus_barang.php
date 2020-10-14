<?php
include 'koneksi.php';
$id = $_GET['idbarang'];

mysqli_query($MySQLi_CON, "delete from barang where idbarang='$id'");

header("location:nama_barang.php");
