<?php
ob_start();
session_start();
include 'rSecurity.php';
/* setting session name for the curent user (Receptionist)*/
if(isset($_SESSION['rName'])){
    $_SESSION['username'] = $_SESSION['rName'];
}
/* setting session name for the user after updating user name (Receptionist) */
if(isset($_SESSION['rNameU'])){
    $_SESSION['username'] = $_SESSION['rNameU'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>WILD VET CHECKIN Dashboard</title>
    <link href="js/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    <style>
        td,th{
            text-align: center;
            } 
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
