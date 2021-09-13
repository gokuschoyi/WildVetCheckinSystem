<?php

$conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
    if(isset($_POST['updatedoc'])){
        $d_id = $_POST['docid'];
        $d_firstname = $_POST['firstname'];
        $d_lastname = $_POST['lastname'];
        $d_email = $_POST['email'];
        $d_username = $_POST['username'];
        $d_password = $_POST['password'];

        $query = $conn->prepare("UPDATE doctor SET dFname = ?, username = ?, dLname = ?, dEmail =  ?, dPassword = ? WHERE docId = ?");
        $query->bind_param("sssssi", $d_firstname, $d_username, $d_lastname, $d_email, $d_password, $d_id);
        $query->execute();

        header("Location: addDoctor.php");
    }
            
?> 