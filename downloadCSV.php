<?php
include_once 'includes\dbConn.php';
    if(isset($_POST['downloadCSV'])){
        
            $value = "Yes";
            $filename = "members-data_" . date('d-m-y') . ".csv";
            header('Content-Type: text/csv'); 
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            $f = fopen('php://output', 'w');
            $delimiter = ","; 
            $fields = array('ID', 'TITLE', 'FIRST NAME', 'LAST NAME', 'MOBILE NO','EMAIL', 'CHECK-IN DATE');
            fputcsv($f, $fields, $delimiter); 
            $query1 = $conn->prepare("SELECT clientId, title, firstName, surName, mobileNo, email, checkinDate  FROM clientinfo WHERE newsletter = ?");
            $query1->bind_param("s",$value);
            $query1->execute();
            $result = $query1->get_result();
            while($row = mysqli_fetch_assoc($result)){
                fputcsv($f, $row);
            }
        fclose($f);
        
    }
?>