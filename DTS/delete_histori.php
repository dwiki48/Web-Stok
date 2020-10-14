<?php

include('koneksi.php');

if (isset($_GET['idhistory']) && is_numeric($_GET['idhistory'])) {

    $id = $_GET['idhistory'];

    if ($stmt = $MySQLi_CON->prepare("DELETE FROM history WHERE idhistory = ? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "ERROR: could not prepare SQL statement.";
    }
    $MySQLi_CON->close();

    header("Location: histori.php");
} else {
    header("Location: histori.php");
}
