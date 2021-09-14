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

//$_SESSION["emailToId"] = $email;
$conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
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



                     
                 