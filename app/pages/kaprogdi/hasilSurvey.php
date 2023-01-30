<?php

include_once '../../functions/kaprogdiFunction.php';

if(!isset($_SESSION['privilege'])){
    header("location: ../login.php");
}elseif ($_SESSION['privilege'] != 'kaprogdi') {
    header("location: ../login.php");
}

$id = $_GET['id_survey'];

$data_table = "";

$data = getPertanyaan($id);
$jsb = 0;
$jb = 0;
$jc = 0;
$jk = 0;
$jsk = 0;

if (isset($_POST['filter'])) {
    $radiofilter = $_POST['radiofilter'];
    $fakultas = $_POST['fakultas'];
    $jRespon = getSumResponFilter($id, $radiofilter, $fakultas);

    foreach ($data as $key => $val) {
        $sk = getSumJawabanFilter($val['id'], 1, $radiofilter, $fakultas);
        $k = getSumJawabanFilter($val['id'], 2, $radiofilter, $fakultas);
        $c = getSumJawabanFilter($val['id'], 3, $radiofilter, $fakultas);
        $b = getSumJawabanFilter($val['id'], 4, $radiofilter, $fakultas);
        $sb = getSumJawabanFilter($val['id'], 5, $radiofilter, $fakultas);
        $data_table .= '
        <tr>
            <td>' . $val['pertanyaan'] . '</td>
            <td>' . $sb . '</td>
            <td>' . $b . '</td>
            <td>' . $c . '</td>
            <td>' . $k . '</td>
            <td>' . $sk . '</td>
        </tr>
        ';
        $jsb += $sb;
        $jb += $b;
        $jc += $c;
        $jk += $k;
        $jsk += $sk;
    }
} else {
    $jRespon = getSumRespon($id);

    foreach ($data as $key => $val) {
        $sk = getSumJawaban($val['id'], 1);
        $k = getSumJawaban($val['id'], 2);
        $c = getSumJawaban($val['id'], 3);
        $b = getSumJawaban($val['id'], 4);
        $sb = getSumJawaban($val['id'], 5);
        $data_table .= '
        <tr>
            <td>' . $val['pertanyaan'] . '</td>
            <td>' . $sb . '</td>
            <td>' . $b . '</td>
            <td>' . $c . '</td>
            <td>' . $k . '</td>
            <td>' . $sk . '</td>
        </tr>
        ';
        $jsb += $sb;
        $jb += $b;
        $jc += $c;
        $jk += $k;
        $jsk += $sk;
    }
}


$jPertanyaan = getSumPertanyaan($id);

$data_table2 = "";

if ($jRespon == 0 || $jPertanyaan == 0) {
    $data_table2 = "";
} else {
    $data_table2 .= '
    
    <tr>
    <th>Rata-rata</td>
    <th>' . round((($jsb / $jPertanyaan) * 100) / $jRespon, 2) . '%</th>
    <th>' . round((($jb / $jPertanyaan) * 100) / $jRespon, 2) . '%</th>
    <th>' . round((($jc / $jPertanyaan) * 100) / $jRespon, 2) . '%</th>
    <th>' . round((($jk / $jPertanyaan) * 100) / $jRespon, 2) . '%</th>
    <th>' . round((($jsk / $jPertanyaan) * 100) / $jRespon, 2) . '%</th>
    </tr>

';
}

if ($data_table == "") {
    $data_table = '<tr><td colspan=6 style="color:red"><center>DATA BELUM TERSEDIA</center></td><tr>';
}

$data_fakultas = getFakultas();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Survey</title>

    <!-- Custom fonts for this template -->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book-reader"></i>
                </div>
                <div class="sidebar-brand-text mx-3">App Survay </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            
            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="view.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Survey</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="nav-item">
                            <span class="nav-link">
                                <b class="mr-2 d-none d-lg-inline text-gray-800">Kaprogdi</b>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <a href="view.php" class="nav-link text-danger"><b>Survey</b></a>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <a href="hasilSurvey.php" class="nav-link text-danger"><b>Hasil Survey</b></a>
                            </span>
                        </div>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Logout</span>
                                <i class="fas fa-sign-out-alt fa-fw"></i>
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"></h1>
                    <p class="h4 mb-4 text-danger">Jumlah Responden <?=$jRespon;?></p>

                    <!-- Filter -->
                    <div class="mb-2">
                        <div class="d-flex justify-content-between ml-1 mr-1">
                            <div>
                                <a href="#filter" class="btn btn-warning" data-toggle="collapse" data-toggle="tooltip" title="Filter">Filter <i class="fas fa-fw fa-sliders-h"></i></a>
                            </div>                            
                            <div>
                                <a href="exportExcel.php?id_survey=<?=$id?>" target="_blank" rel="noopener noreferrer" class="btn btn-success">Export <i class="fas fa-fw fa-print"></i></a>
                            </div>                            
                        </div>
                        <div class="collapse card-body" id="filter">
                            <form method="post">
                                <div class="form-group">
                                    <label class="form-label h6">Sory By:</label>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="filter1" name="radiofilter" value="5" checked>
                                        <label class="form-check-label" for="filter1">Semua</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="filter2" name="radiofilter" value="4">
                                        <label class="form-check-label" for="filter2">Mahasiswa</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="filter3" name="radiofilter" value="3">
                                        <label class="form-check-label" for="filter3">Dosen</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!-- <input type="text" class="form-control col-sm-2 mr-2" name="textfilter" placeholder="Fakultas, Progdi">  -->
                                    <select class="form-control col-sm-2 mr-2" name="fakultas">
                                        <option value="">Pilih Fakultas</option>
                                        <?php foreach($data_fakultas as $val){ ?>
                                        <option value="<?= $val['id_fakultas'] ?>"><?= $val['fakultas'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <button type="submit" class="btn btn-danger" name="filter">Submit</button>
                                </div>                                
                            </form>                            
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Survey</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th width="60%" rowspan="2">Pertanyaan</th>
                                            <th colspan="5"><center>Jawaban</center></th>
                                        </tr>
                                        <tr>
                                           <th>Sangat Baik</th>
                                           <th>Baik</th>
                                           <th>Cukup</th>
                                           <th>Kurang</th>
                                           <th>Sangat Kurang</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <?=$data_table2?>
                                    </tfoot>
                                    <tbody>
                                        <?=$data_table?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; LPM UKSW 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin mau keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" dibawah jika ingin keluar dari Aplikasi Survey.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>
    
    <!-- Page level plugins -->
    <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/js/demo/datatables-demo.js"></script>

</body>

</html>