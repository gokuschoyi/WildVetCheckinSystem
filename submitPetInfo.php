<?php session_start();
    $_SESSION["emailToId"] = $_POST['email'];
    echo $_SESSION["emailToId"];

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


    $conn = new mysqli('localhost','root','','wildvetcheckinsystem');
    if($conn->connect_error)
    {
    die('Connection to DB failed : '.$conn->connect_error);
    }
    else
    {
        $sql = $conn->prepare("UPDATE petinfo P SET P.petId = '$clientId' WHERE P.petId = (SELECT  c.clientId FROM clientinfo c WHERE c.email = '$_SESSION[emailToId]' ORDER BY c.clientId DESC LIMIT 1 );");
        $sql->execute();
        $stmt = $conn->prepare("INSERT INTO petinfo (petId,petName, petType, breed, sex, color, age, petWeight, microchip, insurance, medication, parasiteControl, mcDate) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("isssssiisssss",$sql, $petName, $petType, $breed, $sex, $color, $age, $petWeight, $microchip, $insurance, $medication, $parasiteControl, $mcDate);
        $stmt->execute();
    
        
        
    } 

        echo " Pet Info saved to db...";
        session_destroy();
        header("Location: thankYou.php");
?>



                     
                 