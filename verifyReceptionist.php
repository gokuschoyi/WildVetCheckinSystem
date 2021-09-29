<?php
use Exception as Exception;
class nouserException extends Exception{};
session_start();
if(isset($_POST['rLogin']))
{
    $rUsername = $_POST['username'];
    $rPassword = $_POST['password'];
    $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else{
        $_SESSION['rName'] = "";
        $query = $conn->prepare("SELECT rUsername, rPassword FROM reception WHERE rUsername = ?");
        $query->bind_param("s",$rUsername);
        $query->execute();
        $result= $query->get_result();
        if(mysqli_num_rows($result)==0){
            $_SESSION['fail'] = 'Username is invalid';
            header('Location: receptionistLogin.php');
        }
        else if(mysqli_num_rows($result)>0){
            while($row = $result->fetch_assoc()){
                $qusername = "$row[rUsername]";
                $qpassword = "$row[rPassword]";
                if(($rUsername == $qusername) && ($rPassword == $qpassword))
                {
                    $_SESSION['rName'] = $qusername;
                    header('Location: rDashboard.php');
                }
                else if($rPassword != $qpassword)
                {
                    $_SESSION['fail'] = 'Password is invalid';
                    header('Location: receptionistLogin.php');
                }
            }
        }
    }       
}
?>