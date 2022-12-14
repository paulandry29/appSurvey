<?php

require_once '../../functions/pegawaiFunction.php';

if(!isset($_SESSION['privilege'])){
    header("location: ../login.php");
}elseif ($_SESSION['privilege'] != 'pegawai') {
    header("location: ../login.php");
}

$id = $_GET['id_survey'];
$id_user = $_SESSION['id'];

if (isset($_POST['submit'])) {

    createRespon($id_user, $id);

    $id_respon = getOneIdRespon($id_user, $id);

    $count = getCountPertanyaan($id);

    for ($i=1; $i <= $count ; $i++) {
        ${"id" . $i} = $_POST['id' . $i];
    }

    for ($j=1; $j <= $count ; $j++) {
        ${"jawaban" . $j} = $_POST['jawaban' . $j];
    }

    for ($k=1; $k <= $count ; $k++) {
        inputJawaban(${"jawaban" . $k}, $id_respon, ${"id" . $k});
    }

    header("location:view.php");

}

$pertanyaan = getPertanyaan($id);

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
                                <b class="mr-2 d-none d-lg-inline text-gray-800">Mahasiswa</b>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <a href="view.php" class="nav-link text-danger"><b>Survey</b></a>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <a href="jawabSurvey.php" class="nav-link text-danger"><b>Jawab Survey</b></a>
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


                     <!-- Content Row -->
                     <div class="row">

                        <!-- Border Left Utilities -->
                        <div class="col-lg-12">

                            <form method="post">

                            <?php $i = 1;foreach ($pertanyaan as $key => $val) {?>

                            <div class="card mb-3 border-left-danger">
                                <div class="card-body justify-content-between">

                                    <div class="text-gray-800">
                                        <?=$val['pertanyaan']?>
                                        <input type="text" name="id<?=$i?>" value="<?=$val['id']?>" hidden>
                                    </div>

                                    <br>

                                    <div class="text-gray-800">
                                        <div class="form-check">
                                            <input type="radio" name="jawaban<?=$i?>" value="5" id="r5" class="form-check-input" required/>
                                            <label class="form-check-label" for="r5">Sangat Baik</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="jawaban<?=$i?>" value="4" id="r4" class="form-check-input" required/>
                                            <label class="form-check-label" for="r4">Baik</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="jawaban<?=$i?>" value="3" id="r3" class="form-check-input" required/>
                                            <label class="form-check-label" for="r3">Cukup</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="jawaban<?=$i?>" value="2" id="r2" class="form-check-input" required/>
                                            <label class="form-check-label" for="r2">Kurang</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="jawaban<?=$i?>" value="1" id="r1" class="form-check-input" required/>
                                            <label class="form-check-label" for="r1">Sangat Kurang</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php $i++;}?>

                            <button type="submit" class="btn btn-danger" name="submit">Submit</button>

                            </form>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <br>

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