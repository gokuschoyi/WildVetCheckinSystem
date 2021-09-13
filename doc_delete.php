<?php
if(isset($_POST['deletedoc'])){
    $did = $_POST['did'];
    $conn = new mysqli('localhost', 'root','','wildvetcheckinsystem');

    $query = $conn->prepare("DELETE FROM doctor WHERE docId = ?");
    $query->bind_param("i", $did);
    $query->execute();

    header("Location: addDoctor.php");
}


?>