<?php 
    session_start();
    $_SESSION['cust_user'] = '';
    session_unset();
    header('location:login.php');