<?php
session_start();
if(isset($_POST['registerbtn']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    
    $conn = new mysqli('localhost', 'root', '', 'wildvetcheckinsystem');
    $email_query = $conn->prepare("SELECT * FROM doctor WHERE demail = ? ");
    $email_query->bind_param("s", $email);
    $email_query->execute();
    $result = $email_query->get_result();
    if(mysqli_num_rows($result) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: addDoctor.php');  
    }
    else
    {   
        $query = $conn->prepare("INSERT INTO doctor (dFname, dLname, dEmail)VALUES(?,?,?)");
        $query->bind_param("sss", $firstname,$lastname,$email);
        $query -> execute();
        
        
        if($query)
        {
            // echo "Saved";
            $_SESSION['status'] = "Doctor Profile Added";
            $_SESSION['status_code'] = "success";
            header('Location: addDoctor.php');
        }
        else 
        {
            $_SESSION['status'] = "Doctor Profile Not Added";
            $_SESSION['status_code'] = "error";
            header('Location: addDoctor.php');  
        }                                                               
    }
}



?>