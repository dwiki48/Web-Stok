<?php
include 'koneksi.php';

$nama_barang = $_POST['nama_barang'];
$jenis_barang = $_POST['jenis_barang'];

mysqli_query($MySQLi_CON, "insert into barang values('','$nama_barang','$jenis_barang','')");

header("location:nama_barang.php");
