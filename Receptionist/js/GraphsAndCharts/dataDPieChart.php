<!-- fetching data for clients viewd or not by the doctor -->
<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('../../../includes/dbConn.php');
date_default_timezone_set('Australia/ACT');
$dateT = date("Y-m-d");
$date = date_create($dateT);
//date_sub($date, date_interval_create_from_date_string('7 days'));
$DateF = date_format($date, 'Y-m-d');
$sqlQuery = "SELECT viewed as v, count(viewed) AS vC FROM clientinfo WHERE checkinDate = '$DateF' GROUP BY viewed";

$result = $conn->query($sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>