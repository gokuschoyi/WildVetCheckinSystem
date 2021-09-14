<?php

$conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
    if(isset($_POST['updateDocNotViewedclient'])){
        $u_id = $_POST['cidd'];
        $u_comments = $_POST['comments'];
        $query = $conn->prepare("UPDATE clientinfo SET addComments = ? WHERE clientId = ?");
        $query->bind_param("si", $u_comments, $u_id,);
        $query->execute();
        header("Location: docNotviewed.php");
    }
            
?>