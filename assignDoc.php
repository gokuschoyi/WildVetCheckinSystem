<?php
if(isset($_POST['assigndoc']));
$opt = $_POST['option'];
$id = $_POST['cid'];
echo $id;
echo $opt;
$conn = new mysqli('localhost', 'root','','wildvetcheckinsystem');
$stmt = $conn->prepare("UPDATE clientinfo SET assignedDoc = ? WHERE clientId = ?");
$stmt->bind_param("si",$opt, $id);
$stmt->execute();


?>