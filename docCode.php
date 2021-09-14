<?php
session_start();
if(isset($_POST['registerbtn']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $registered = "No";
    
    $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
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
        $query = $conn->prepare("INSERT INTO doctor (dFname, dLname, dEmail, registered)VALUES(?,?,?,?)");
        $query->bind_param("ssss", $firstname,$lastname,$email,$registered);
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