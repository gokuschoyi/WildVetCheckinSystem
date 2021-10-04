<?php
include_once 'includes\dbConn.php';
session_start();
    if(isset($_POST['logindoc']))
    {
    $docEmail = $_POST['email'];
    $docPass = $_POST['password'];
    echo $docEmail;
    echo $docPass;
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else{
        $_SESSION['docEmail'] = "";
        $query = $conn->prepare("SELECT dEmail, dPassword FROM doctor WHERE dEmail = ?");
        $query->bind_param("s",$docEmail);
        $query->execute();
        $result = $query->get_result();
        while($row = $result->fetch_assoc()){
            $qemail = "$row[dEmail]";
            $qpassword = "$row[dPassword]";
            if(($docEmail == $qemail)&&($docPass == $qpassword))
            {
                $_SESSION['docEmail'] = $qemail;
                header('Location: docDash.php'); 
            }
            else if (($docEmail != $qemail) || ($docPass != $qpassword))
            {
                $_SESSION['fail'] = 'Email or Password is invalid';
                header('Location: doctorLogin.php');
            }
        }
    }
}
    ?>