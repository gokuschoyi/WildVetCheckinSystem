<?php
if(isset($_POST['deletedoc'])){
    $did = $_POST['did'];
    $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');

    $query = $conn->prepare("DELETE FROM doctor WHERE docId = ?");
    $query->bind_param("i", $did);
    $query->execute();

    header("Location: addDoctor.php");
}


?>