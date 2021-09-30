<?php
header('Content-Type: application/json');
$conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
$sqlQuery = "SELECT checkinDate as day, count(clientID) as totalC from clientinfo WHERE checkinDate BETWEEN CURDATE()-7 AND CURDATE() GROUP BY EXTRACT(day FROM checkinDate)";

$result = $conn->query($sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>

