<?php

require_once '../../functions/adminFunction.php';

if(!isset($_SESSION['privilege'])){
    header("location: ../login.php");
}elseif ($_SESSION['privilege'] != 'admin') {
    header("location: ../login.php");
}

$id = $_GET['id_survey'];

if (isset($_POST['submit'])) {
    $pertanyaan = $_POST['pertanyaan'];
    tambahPertanyaanSem($pertanyaan, $id);
    header('location:tambahPertanyaanSem.php?id_survey='.$id.'');
}

if(isset($_POST['edit'])) {

    $idp = $_POST['id'];
    $editedJudul = $_POST['judul'];

    updatePertanyaanSem($idp, $editedJudul);

    header('location:tambahPertanyaanSem.php?id_survey='.$id.'');
}

$judul = getOneJudulSem($id);

$data_table = '';
$data = getPertanyaanSem($id);
foreach($data as $key => $val){
    $data_table .='
    <tr>
        <td>'.$val['pertanyaan'].'</td>
        <td hidden>'.$val['id'].'</td> 
        <td>
            <a class="btn btn-success editJudul" data-toggle="modal" data-target="#editModal"> Edit </a>
            <a class="btn btn-danger" href="deletePertanyaanSem.php?id_pertanyaan='.$val['id'].'&&id_survey='.$id.'">Delete</a>
        </td>
    </tr> 
    ';
}

if ($data_table == "") {
    $data_table = '<tr><td colspan=2 style="color:red"><center><b>DATA BELUM TERSEDIA</b></center></td><tr>';
}


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
            <li class="nav-item">
                <a class="nav-link" href="view.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Survey</span></a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="create.php">
                    <i class="fas fa-fw fa-pen"></i>
                    <span>Buat Survey</span></a>
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

                    <!-- Topbar Route -->
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="nav-item">
                            <span class="nav-link">
                                <b class="mr-2 d-none d-lg-inline text-gray-800">Admin</b>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <a href="create.php" class="nav-link text-danger"><b>Buat Survey</b></a>
                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                <a href="tambahPertanyaanSem.php" class="nav-link text-danger"><b>Pertanyaan</b></a>
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
                    <h2 class="h3 mb-2 text-gray-900">Judul</h2>
                    <p class="h5 mb-5 text-danger"><?= $judul ?></p>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Tambah Pertanyaan</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post">

                                        <div class="form-group">
                                            <textarea name="pertanyaan" cols="20" rows="10" class="form-control" ></textarea>
                                        </div>
                                        
                                        <button type="submit" name="submit" class="btn btn-danger">Tambah</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Pertanyaan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="85%">Pertanyaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Pertanyaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?= $data_table ?>
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

    <!-- Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pertanyaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" id="id">
                            <label for="judul">Pertanyaan</label>
                            <input type="text" class="form-control" name="judul" required id="judul">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-danger" name="edit">Edit</button>
                    </div>
                </div>
            </form>
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

    <!-- Custom -->
    <script src="../../assets/js/custom.js"></script>

</body>

</html>
