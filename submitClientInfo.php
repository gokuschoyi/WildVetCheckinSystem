<?php session_start();
$title = $_POST['title'];
$firstName = $_POST['firstName'];
$surName = $_POST['surName'];
$mobileNo = $_POST['mobileNo'];
$othContact = $_POST['othContact'];
$email = $_POST['email'];
$clientAddress = $_POST['address'];
$suburb = $_POST['suburb'];
$postcode = $_POST['postcode'];

$conn = new mysqli('localhost','root','','wildvetcheckinsystem');
if($conn->connect_error){
    die('Connection to DB failed : '.$conn->connect_error);
}
else{
    $date = date('Y/m/d');
    
    $stmt = $conn->prepare("INSERT INTO clientinfo (title, firstName, surName, mobileNo, othContact, email, clientAddress, suburb, postcode, checkinDate) 
    VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssiisssis", $title, $firstName, $surName, $mobileNo, $othContact, $email, $clientAddress, $suburb, $postcode, $date);
    $stmt->execute();
    echo " Client Info saved to db...";
    header("Location: petInfo.php");
    }
    ?>



                     
                 