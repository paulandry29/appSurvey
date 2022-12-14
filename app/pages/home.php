<?php

require_once '../functions/function.php';

if(!isset($_SESSION['user'])){
    header("location:login.php");
}elseif ($_SESSION['privilege'] == 'admin') {
    header("location:admin/view.php");
}elseif ($_SESSION['privilege'] == 'kaprogdi') {
    header("location:kaprogdi/view.php");
}elseif ($_SESSION['privilege'] == 'pegawai') {
    header("location:pegawai/view.php");
}elseif ($_SESSION['privilege'] == 'mahasiswa') {
    header("location:mahasiswa/view.php");
}

