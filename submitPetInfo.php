<?php session_start();
include_once 'includes/dbConn.php';
$petName = $_POST['petName'];
$petType = $_POST['petType'];
$breed = $_POST['breed'];
$sex = $_POST['sex'];
$color = $_POST['color'];
$age = $_POST['age'];
$petWeight = $_POST['petWeight'];
$microchip = $_POST['microchip'];
$insurance = $_POST['insurance'];
$medication = $_POST['medication'];
$parasiteControl = $_POST['parasiteControl'];
$mcDate =  date('Y-m-d',strtotime($_POST['mcDate']));


    if($conn->connect_error)
    {
    die('Connection to DB failed : '.$conn->connect_error);
    }
    else
    {
        
        $stmt = $conn->prepare("INSERT INTO petinfo (petName, petType, breed, sex, color, age, petWeight, microchip, insurance, medication, parasiteControl, mcDate) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssiisssss", $petName, $petType, $breed, $sex, $color, $age, $petWeight, $microchip, $insurance, $medication, $parasiteControl, $mcDate);
        $stmt->execute();  
    } 

        echo " Pet Info saved to db...";
        session_destroy();
        header("Location: thankYou.php");
?>