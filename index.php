<?php

session_start();
//print_r($_SESSION);

    include 'connect.php';
    include 'header.php';
    include 'banner.php';
    include 'navbar.php';
    include 'listproduct.php';
    include 'footer.php';

    $act = (isset($_GET['act']) ? $_GET['act'] : '');
    if($act=='q'){
        include('list_prd_by_search.php');
    }
?>
