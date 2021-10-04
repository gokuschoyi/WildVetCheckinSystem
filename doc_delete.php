<?php
include_once 'includes\dbConn.php';
if(isset($_POST['deletedoc'])){
    $did = $_POST['did'];
    $query = $conn->prepare("DELETE FROM doctor WHERE docId = ?");
    $query->bind_param("i", $did);
    $query->execute();

    header("Location: addDoctor.php");
}


?>