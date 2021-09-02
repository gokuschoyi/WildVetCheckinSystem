<?php
if(isset($_POST['deleteuser'])){
    $cid = $_POST['cid'];
    $conn = new mysqli('localhost', 'root','','wildvetcheckinsystem');

    $query2 = $conn->prepare("DELETE FROM petinfo WHERE petKey = ?");
    $query2->bind_param("i", $cid);
    $query2->execute();

    $query = $conn->prepare("DELETE FROM clientinfo WHERE clientId = ?");
    $query->bind_param("i", $cid);
    $query->execute();

    header("Location: rAllclients.php");
}


?>