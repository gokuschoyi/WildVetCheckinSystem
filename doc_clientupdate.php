<?php
session_start();
include_once 'includes\dbConn.php';
    if(isset($_POST['updateDocclient'])){
        $u_id = $_POST['cidd'];
        $u_comments = $_POST['comments'];
        $query = $conn->prepare("UPDATE clientinfo SET addComments = ? WHERE clientId = ?");
        $query->bind_param("si", $u_comments, $u_id,);
        $query->execute();
        $_SESSION['cidup'] = $u_id;
        header("Location: doc_clientedit.php");
    }
            
?>