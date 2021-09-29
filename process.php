<?php
session_start();
error_reporting();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "simple_html_dom.php";
require 'vendor/autoload.php';
if (isset($_POST['rEmail'])) {
    $email = $_POST['rEmail'];
    // ensure that the user exists on our system
    $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else
    {
        $query = $conn->prepare("SELECT rEmail ,rID, rFirstname FROM reception WHERE rEmail = ? ");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        
        if($result == 0) {
        $_SESSION['error'] = 'Sorry, no user exists on our system with that email';
        header("Location: recoverySelection.php");
        }
        // generate a unique random token of length 100
        $token = bin2hex(random_bytes(5));
    
        if ($result > 0) {
        // store token in the password-reset database table against the user's email
            $riD = "$result[rID]";
            $query1 = $conn->prepare("INSERT INTO passwordreset(id, email, token) VALUES (?,?,?)");
            $query1->bind_param("iss", $riD, $email, $token);
            $query1->execute();

        
            // Send email to user with the token in a link they can click on
            $to = $email;
            $name = "$result[rFirstname]";
            //echo $to; echo $name;
            $subject = "Reset your password";
            $msg = "Hi there, click on this <a href=http://localhost/WildVetCheckin/new_pass.php?token=" . $token . "\">link</a> to reset your password.";
            $msg = wordwrap($msg,70);
            

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'thewildvetcheckin@gmail.com';
            $mail->Password = '123@wildvet';
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';
            $mail->setFrom('thewildvetcheckin@gmail.com', 'Wild Vet Reception - Reset Password');
            $mail->addAddress($to, $name);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $msg;

            try {
                $mail->send();
                $_SESSION['status'] = 1;
                
            } catch (Exception $e) {
                echo "error" . $mail->ErrorInfo;
            }
        }
        if ($_SESSION['status'] == 1) {
            header('Location: emailConfirm.php?email='.$email);
        }
    }
}

        
// ENTER A NEW PASSWORD
if (isset($_POST['receptionistCredentials'])) {
    $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else
    {
        $new_pass =  $_POST['rPassword'];
        $new_pass_c = $_POST['rEnterPassword'];

        // Grab to token that came from the email link
        $token = $_POST['token'];
        echo $token;
        if ($new_pass !== $new_pass_c){
            $_SESSION['status'] = "Password do not match";
            header('Location: http://localhost/WildVetCheckin/new_pass.php?token='.$token);
        }
        else
        {
            $query2 = $conn->prepare("SELECT email FROM passwordreset WHERE token = ? LIMIT 1");
            $query2->bind_param("s", $token);
            $query2->execute();
            $result1 = $query2->get_result()->fetch_assoc();
            $email = "$result1[email]";
            echo $email;
            if ($email != null) {
                //$new_pass = md5($new_pass);
                $update = $conn->prepare("UPDATE reception SET rPassword = ? WHERE rEmail=?");
                $update->bind_param("ss", $new_pass, $email);
                $update->execute();
                $_SESSION['status'] = "Password Updated";
                header('location: receptionistLogin.php');
            }
        }
    }
}