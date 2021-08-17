<?php session_start();
$email = $_SESSION['email'];


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
$mcDate = $_POST['mcDate'];


    $conn = new mysqli('localhost','root','','wildvetcheckinsystem');
    if($conn->connect_error){
    die('Connection to DB failed : '.$conn->connect_error);
    }
    
    else{
        $stmt = $conn->prepare("INSERT INTO petinfo (petName, petType, breed, sex, color, age, petWeight, microchip, insurance, medication, parasiteControl, mcDate) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
         $stmt->bind_param("sssssiissssi",$petName, $petType, $breed, $sex,
                                  $color, $age, $petWeight, $microchip,
                                  $insurance, $medication, $parasiteControl,
                                  $mcDate);
            $stmt->execute();

            $sql = "INSERT INTO petinfo (checkinID) SELECT checkinID FROM clientinfo WHERE email = ".$_SESSION['email'];
            $results = mysqli_query($conn,$sql);


    
            }

        echo " Pet Info saved to db...";
        header("Location: thankYou.html");
?>



                     
                 