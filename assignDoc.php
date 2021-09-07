<?php
session_start();
if(isset($_POST['assigndoc']))
{
    $opt = $_POST['option'];
    //$_SESSION['clientid'] = $_POST['cidd'];
    $id = $_POST['cidd'];
}
    //echo $_SESSION['clientid'];
    echo $id;
    echo $opt;
$conn = new mysqli('localhost', 'root','','wildvetcheckinsystem');
$stmt = $conn->prepare("UPDATE clientinfo SET assignedDoc = ? WHERE clientId = ?");
$stmt->bind_param("si",$opt, $id);
$stmt->execute();
header("Location: rToday.php");

?>