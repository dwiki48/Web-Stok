<?php
include 'koneksi.php';

$idbarang = $_POST['idbarang'];
$nama_barang = $_POST['nama_barang'];
$jenis_barang = $_POST['jenis_barang'];
$stok_barang = $_POST['stok_barang'];

mysqli_query($MySQLi_CON, "update barang set nama_barang='$nama_barang', jenis_barang='$jenis_barang', stok_barang='$stok_barang' where idbarang='$idbarang'");

header("location:nama_barang.php");
