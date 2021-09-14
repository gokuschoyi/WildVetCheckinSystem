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
$conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
$stmt = $conn->prepare("UPDATE clientinfo SET assignedDoc = ? WHERE clientId = ?");
$stmt->bind_param("si",$opt, $id);
$stmt->execute();
header("Location: rToday.php");

?>