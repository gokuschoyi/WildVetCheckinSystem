<?php
session_start();
include_once 'includes/dbConn.php';
if(isset($_POST['assigndoc']))
{
    $opt = $_POST['option'];
    $id = $_POST['cidd'];
    $stmt = $conn->prepare("UPDATE clientinfo SET assignedDoc = ? WHERE clientId = ?");
    $stmt->bind_param("si",$opt, $id);
    $stmt->execute();
    header("Location: rToday.php");
}

?>