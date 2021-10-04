<?php
include_once 'includes/dbConn.php';
    if(isset($_POST['updateDocNotViewedclient'])){
        $u_id = $_POST['cidd'];
        $u_comments = $_POST['comments'];
        $query = $conn->prepare("UPDATE clientinfo SET addComments = ? WHERE clientId = ?");
        $query->bind_param("si", $u_comments, $u_id,);
        $query->execute();
        header("Location: docNotviewed.php");
    }
            
?>