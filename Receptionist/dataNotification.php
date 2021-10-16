<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include('../includes/dbConn.php');
if (isset($_POST['view'])) {
    if ($_POST["view"] != '') {
        $update_query = $conn->prepare("UPDATE clientinfo SET cNotification = 1 WHERE cNotification = 0");
        $update_query->execute();
        
    }
    date_default_timezone_set('Australia/ACT');
    $dateT = date("Y-m-d");
    $date = date_create($dateT);
    $DateF = date_format($date, 'Y-m-d');
    $query = $conn->prepare("SELECT clientId, title, firstName, surName, checkinDate, checkinTime FROM clientinfo WHERE cNotification = 0 AND checkinDate = ? ORDER BY clientId DESC LIMIT 10");
    $query->bind_param("s", $DateF);
    $query->execute();
    $result = $query->get_result();
    $output = '';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {//d='.$id.'
            $output .= '
            <a class="dropdown-item d-flex align-items-center" i href="#">
            <div class="mr-3">
            <div class="icon-circle bg-primary">
            <i class="fas fa-check text-white"></i>
            </div>
            </div>
            <div>
            <div class="small text-gray-500" id = '.$row["clientId"].'>'.$row["checkinDate"].' Client ID  = '.$row["clientId"].' </div>
            <span class="font-weight-bold">'.$row["title"].' '.' '.$row["firstName"].', '.'  has checked in.</span>
            </div>
            </a>
            ';
        }
        $prepend = '<h6 class="dropdown-header">Alerts Center</h6>';
        $footer = '<a class="dropdown-item text-center small text-gray-500" href="#">New Check-In</a>';
        $output = $prepend.$output.$footer;
    }
    else{
        date_default_timezone_set('Australia/ACT');
        $dateT = date("Y-m-d");
        $date = date_create($dateT);
        $DateF = date_format($date, 'Y-m-d');
        $query = $conn->prepare("SELECT clientId, title, firstName, surName, checkinDate, checkinTime FROM clientinfo WHERE cNotification = 1 AND checkinDate = ? ORDER BY clientId DESC LIMIT 10");
        $query->bind_param("s", $DateF);
        $query->execute();
        $result = $query->get_result();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <a class="dropdown-item d-flex align-items-center" i href="#">
            <div class="mr-3">
            <div class="icon-circle bg-warning">
            <i class="fas fa-check text-white"></i>
            </div>
            </div>
            <div>
            <div class="small text-gray-500" id = '.$row["clientId"].'>'.$row["checkinDate"].' Client ID  = '.$row["clientId"].' </div>
            <span class="font-weight-bold">'.$row["title"].' '.' '.$row["firstName"].', '.'  has checked in.</span>
            </div>
            </a>
            ';
        }
        $prepend = '<h6 class="dropdown-header">Alerts Center</h6>';
        $footer = '<a class="dropdown-item text-center small text-gray-500" href="#">OLD NOTIFICATIONS</a>';
        $output = $prepend.$output.$footer;
    }
}
        $status_query = $conn->prepare("SELECT  clientId FROM clientinfo WHERE cNotification = 0 AND checkinDate = ?");
        $status_query->bind_param("s", $DateF);
        $status_query->execute();
        $resultc = $status_query->get_result();
        $count = mysqli_num_rows($resultc);
        //echo $count;
        $data = array(
            'notification' => $output,
            'unseen_notification'  => $count
        );
    mysqli_close($conn);
    echo json_encode($data);

}
?>