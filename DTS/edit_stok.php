<?php
session_start();
include_once 'koneksi.php';

if (!isset($_SESSION['userSession'])) {
    header("Location: ../login.php");
} else {
    $sql = "SELECT * FROM user WHERE user_id=" . $_SESSION['userSession'];
    $userquery = $MySQLi_CON->query($sql);
    $userRow = $userquery->fetch_object();
    $username = $userRow->username;
}

$id = $_GET['idbarang'];
$userquery = $MySQLi_CON->query("SELECT * FROM barang WHERE idbarang = " . $id);
$row = $userquery->fetch_object();
if (isset($_POST["ubah"])) {
    $hasil_stok = $_POST["stok_barang"];
    $sql = "UPDATE barang SET stok_barang = '" . $hasil_stok . "' WHERE idbarang = " . $id;
    if ($MySQLi_CON->query($sql) == TRUE) {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date("d/m/Y h:i:s");
        $kegiatan = "Mengubah stok barang " . $row->nama_barang . " sehingga stok barang menjadi " . $hasil_stok;
        $sqlhistory = "INSERT INTO history (waktu, jenis_barang, nama_barang, kegiatan) 
	VALUES ('" . $waktu . "','" . $row->nama_barang . "','" . $row->jenis_barang . "','" . $kegiatan . "')";
        if ($MySQLi_CON->query($sqlhistory) == TRUE) {
            header("Location: stok_barang.php");
        } else {
            echo "Error dalam mengubah data: " . $MySQLi_CON->error;
        }
    } else {
        echo "Error dalam mengubah data: " . $MySQLi_CON->error;
    }
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Stok Barang</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php
        include 'navbar.php';
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-maroon elevation-4">
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <?php
            include 'sidebar.php';
            ?>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Edit Barang</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Nama Barang</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="col-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <?php
                        $id = $_GET['idbarang'];
                        $data = mysqli_query($MySQLi_CON, "select * from barang where idbarang='$id'");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <form method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Masukan Stok</label>
                                        <input type="hidden" name="idbarang" value="<?php echo $d['idbarang']; ?>">
                                        <input type="number" name="stok_barang" class="form-control" id="exampleInputEmail1" value="<?php echo $d['stok_barang']; ?>" placeholder="Masukan Stok Barang">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        <?php
                        }
                        ?>
                    </div>
                    <!-- /.card -->
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2020 Dwiki.</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
</body>

</html>