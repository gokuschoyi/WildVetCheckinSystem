<?php
if(isset($_POST['deleteuser'])){
    $cid = $_POST['cid'];
    $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');

    $query2 = $conn->prepare("DELETE FROM petinfo WHERE petKey = ?");
    $query2->bind_param("i", $cid);
    $query2->execute();

    $query = $conn->prepare("DELETE FROM clientinfo WHERE clientId = ?");
    $query->bind_param("i", $cid);
    $query->execute();

    header("Location: rAllclients.php");
}


?>