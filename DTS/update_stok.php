<?php
include 'koneksi.php';

$idbarang = $_POST['idbarang'];
$stok_barang = $_POST['stok_barang'];

mysqli_query($MySQLi_CON, "update barang set stok_barang='$stok_barang' where idbarang='$idbarang'");

header("location:stok_barang.php");
