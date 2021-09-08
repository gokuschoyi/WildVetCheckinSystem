<?php

$conn = new mysqli('localhost', 'root','','wildvetcheckinsystem');
    if(isset($_POST['done'])){
        $u_id = $_POST['cid'];
        $u_viewed = "Yes";
        $query = $conn->prepare("UPDATE clientinfo SET viewed = ? WHERE clientId = ?");
        $query->bind_param("si", $u_viewed, $u_id,);
        $query->execute();
        header("Location: docDash.php");
    }
            
?>