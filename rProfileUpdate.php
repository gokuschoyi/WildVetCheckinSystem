<?php
session_start();
$conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
    if(isset($_POST['updatereception'])){
        //$r_id = $_POST['docid'];
        $r_username = $_POST['rname'];
        $r_password = $_POST['rpassword'];
        $r_id = $_POST['rid'];

        $query = $conn->prepare("UPDATE reception SET rUsername = ?, rPassword = ? WHERE rId = ?");
        $query->bind_param("ssi", $r_username, $r_password, $r_id);
        $success = $query->execute();
        if($success == true){
            $_SESSION['rNameUM'] = 'Log out and Sign Back in For changes to take effect.';  
            $_SESSION['rNameU'] = $r_username;
        }   
        header("Location: rDashboard.php");
    }
?> 