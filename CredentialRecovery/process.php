<?php
include('../includes/dbConn.php');
include('../includes/gmailCredentials.php');
session_start();
error_reporting();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include "../allVendor/simple_html_dom.php";
include '../allVendor/phpmailer/phpmailer/src/PHPMailer.php';
include '../allVendor/tecnickcom/tcpdf/tcpdf.php';
require '../allVendor/autoload.php';
ob_clean(); //Clear any previous output
ob_start(); //Start new output buffer

/* Password recovery for receptionist */ #error pop-up done
if (isset($_POST['passwordRecovery'])) {
    $email = $_POST['rEmail'];
    // ensure that the user exists on our system
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
            $_SESSION['statusD'] = 'Sorry, no user exists on our system with that email';
            $_SESSION['status_codeD'] = "error";
            header("Location: recoverySelection.php");
            exit();
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
            $httphost = "http://".$_SERVER['HTTP_HOST'];
            $requesturl = "/WildVetCheckin/CredentialRecovery/new_pass.php?token=".$token;
            $link = $httphost.$requesturl;
            //echo $to; echo $name;
            $subject = "Reset your password - Receptionist";
            $msg = "Hi there, click on this <a href=$link>link</a> to reset your password.";
            $msg = wordwrap($msg,70);
            

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $gmailUsername;
            $mail->Password = $gmailPassword;
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';
            $mail->setFrom('thewildvetcheckin@gmail.com', 'Wild Vet Reception - Reset Password');
            $mail->addAddress($to, $name);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $msg;

            try {
                $mail->send();
                $_SESSION['statusmail'] = 1;
                
            } catch (Exception $e) {
                echo "error" . $mail->ErrorInfo;
            }
        }
        if ($_SESSION['statusmail'] == 1) {
            header('Location: emailConfirm.php?email='.$email);
            exit();
        }
    }
}

// ENTER new credentials from link sent to mail #error pop-up done
if (isset($_POST['receptionistCredentials'])) {
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else{
        $token = $_POST['token'];
        $query = $conn->prepare("SELECT email FROM passwordreset WHERE token = ? LIMIT 1");
        $query->bind_param("s", $token);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        if ($result == 0){
            $_SESSION['statusD'] = "Sorry the link has expired. Try agian using the recovery.";
            $_SESSION['status_codeD'] = "error";
            header('Location: recoverySelection.php');
            exit();
        }
        else{
            $new_pass =  $_POST['rPassword'];
            $new_pass_c = $_POST['rEnterPassword'];
            
            if($new_pass != $new_pass_c){
                $_SESSION['statusD'] = "Passwords do not match. Re-Enter again.";
                $_SESSION['status_codeD'] = "error";
                $httphost = "http://".$_SERVER['HTTP_HOST'];
                $requesturl = "/WildVetCheckin/CredentialRecovery/new_pass.php?token=".$token;
                $link = $httphost.$requesturl;
                header("location: $link");
                exit();
            }
            else{
                $email = "$result[email]";
                $update = $conn->prepare("UPDATE reception SET rPassword = ? WHERE rEmail=?");
                $update->bind_param("ss", $new_pass, $email);
                $update->execute();
                if($update){
                    $tokendelete = $conn->prepare("delete from passwordreset where token = ?");
                    $tokendelete->bind_param("s",$token);
                    $tokendelete->execute();
                    $_SESSION['statusD'] = "Password has been update.";
                    $_SESSION['status_codeD'] = "success";
                    $_SESSION['msg'] = "";
                    header('location: ../Receptionist/receptionistLogin.php');
                    exit();
                }
                else{
                    $_SESSION['statusD'] = "Oops, something went wrong.";
                    $_SESSION['status_codeD'] = "error";
                    header('location: recoverySelection.php');
                    exit();
                }  
            }
        }
    }
}

// Username recovery for receptionist #error pop-up done
if (isset($_POST['usernameRecovery'])){
    $email = $_POST['rEmail'];
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else
    {
        $query = $conn->prepare("SELECT rEmail ,rID, rUsername, rFirstname FROM reception WHERE rEmail = ? ");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        
        if($result == 0) {
        $_SESSION['statusD'] = 'Sorry, no user exists on our system with that email';
        $_SESSION['status_codeD'] = "error";
        header("Location: recoverySelection.php");
        exit();
        }
        $token = bin2hex(random_bytes(5));
    
        if ($result > 0) {
        // store token in the password-reset database table against the user's email
            $riD = "$result[rID]";
            $query1 = $conn->prepare("INSERT INTO passwordreset(id, email, token) VALUES (?,?,?)");
            $query1->bind_param("iss", $riD, $email, $token);
            $query1->execute();

        
            // Send email to user with the token in a link they can click on
            $to = $email;
            $httphost = "http://".$_SERVER['HTTP_HOST'];
            $requesturl = "/WildVetCheckin/CredentialRecovery/new_rusername.php?token=".$token;
            $link = $httphost.$requesturl;
            $name = "$result[rFirstname]";
            //echo $to; echo $name;
            $subject = "Recover Your Username";
            $msg = "Hi there, click on this <a href=$link>link</a> to view your username.";
            $msg = wordwrap($msg,70);
            

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $gmailUsername;
            $mail->Password = $gmailPassword;
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';
            $mail->setFrom('thewildvetcheckin@gmail.com', 'Wild Vet Reception - View Username');
            $mail->addAddress($to, $name);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $msg;

            try {
                $mail->send();
                $_SESSION['statusmail'] = 1;
                
            } catch (Exception $e) {
                echo "error" . $mail->ErrorInfo;
            }
        }
        if ($_SESSION['statusmail'] == 1) {
            header('Location: emailConfirm.php?email='.$email);
        }
    }
}

// Viewing username after entering password to link sent via email #error pop-up done
if (isset($_POST['receptionistPassword'])) {
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else
    {
        $enteredPassword = $_POST['rPassword'];
        $token = $_POST['token'];
        $query2 = $conn->prepare("SELECT email FROM passwordreset WHERE token = ? LIMIT 1");
        $query2->bind_param("s", $token);
        $query2->execute();
        $result = $query2->get_result()->fetch_assoc();
        if($result == 0){
            $_SESSION['statusD'] = "Sorry the link has expired. Try agian using the recovery.";
            $_SESSION['status_codeD'] = "error";
            $_SESSION['msg'] ="";
            header('location: recoverySelection.php');
            exit();
        }
        else{
            $email = "$result[email]";
            $query = $conn->prepare("SELECT rPassword, rUsername FROM reception WHERE rEmail = ?");
            $query->bind_param("s", $email);
            $query->execute();
            if(!$query){
                $_SESSION['statusD'] = "Oops, sowmthing went wrong. Try again after some time. user does not exist";
                $_SESSION['status_codeD'] = "error";
                $_SESSION['msg'] ="";
                header('location: recoverySelection.php');
                exit();
            }
            else{
                $result = $query->get_result()->fetch_assoc();
                $rpassword = "$result[rPassword]";
                if($rpassword == $enteredPassword){
                    $rusername = "$result[rUsername]";
                    $_SESSION['statusD'] = "Here is your user-name : ".$rusername;
                    $_SESSION['status_codeD'] = "success";
                    $_SESSION['msg'] = "This dialogue cannot be viewed again after closing.";
                    $tokendelete = $conn->prepare("delete from passwordreset where token = ?");
                    $tokendelete->bind_param("s",$token);
                    $tokendelete->execute();
                    header('Location: ../Receptionist/receptionistLogin.php');
                    exit();
                }
                else{
                    $_SESSION['statusD'] = "Wrong password entered. Try again.";
                    $_SESSION['status_codeD'] = "error";
                    $_SESSION['msg'] ="";
                    $httphost = "http://".$_SERVER['HTTP_HOST'];
                    $requesturl = "/WildVetCheckin/CredentialRecovery/new_rusername.php?token=".$token;
                    $link = $httphost.$requesturl;
                    header("Location: $link");
                    exit();
                }
            }
        } 
    }
}

// Password reset for doctor #error pop-up done
if(isset($_POST['doctorPasswordRecovery'])){
    $email = $_POST['dEmail'];
    // ensure that the user exists on our system
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else
    {
        $query = $conn->prepare("SELECT dEmail, docId, dFname FROM doctor WHERE dEmail = ? ");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        
        if($result == 0) {
        $_SESSION['statusD'] = 'Sorry, no user exists on our system with that email';
        $selectedCount['status_codeD'] = "error";
        header("Location: recoverySelection.php");
        exit();
        }
        // generate a unique random token of length 100
        $token = bin2hex(random_bytes(5));
    
        if ($result > 0) {
        // store token in the password-reset database table against the user's email
            $riD = "$result[docId]";
            $query1 = $conn->prepare("INSERT INTO passwordreset(id, email, token) VALUES (?,?,?)");
            $query1->bind_param("iss", $riD, $email, $token);
            $query1->execute();

        
            // Send email to user with the token in a link they can click on
            $to = $email;
            $httphost = "http://".$_SERVER['HTTP_HOST'];
            $requesturl = "/WildVetCheckin/CredentialRecovery/new_docPassword.php?token=".$token;
            $link = $httphost.$requesturl;
            $name = "$result[dFname]";
            //echo $to; echo $name;
            $subject = "Reset your password";
            $msg = "Hi there, click on this <a href=$link>link</a> to reset your password.";
            $msg = wordwrap($msg,70);
            

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $gmailUsername;
            $mail->Password = $gmailPassword;
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';
            $mail->setFrom('thewildvetcheckin@gmail.com', 'Wild Vet Reception - Reset Docotor Password');
            $mail->addAddress($to, $name);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $msg;

            try {
                $mail->send();
                $_SESSION['statusmail'] = 1;
                
            } catch (Exception $e) {
                echo "error" . $mail->ErrorInfo;
            }
        }
        if ($_SESSION['statusmail'] == 1) {
            header('Location: emailConfirm.php?email='.$email);
        }
    }
}

// Enter doctor password to reset , link sent via mail #error pop-up done
if (isset($_POST['doctorCredentials'])) {
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else{
        $token = $_POST['token'];
        $query2 = $conn->prepare("SELECT email FROM passwordreset WHERE token = ? LIMIT 1");
        $query2->bind_param("s", $token);
        $query2->execute();
        $result1 = $query2->get_result()->fetch_assoc();
        if($result1 ==0){
            $_SESSION['statusD'] = "Sorry the link has expired. Try agian using the recovery.";
            $_SESSION['status_codeD'] = "error";
            header('Location: recoverySelection.php');
            exit();
        }
        else{
            $new_pass =  $_POST['rPassword'];
            $new_pass_c = $_POST['rEnterPassword'];

            if($new_pass != $new_pass_c){
                $_SESSION['statusD'] = "Passwords do not match. Re-Enter again.";
                $_SESSION['status_codeD'] = "error";
                $_SESSION['msg'] = "";
                $httphost = "http://".$_SERVER['HTTP_HOST'];
                $requesturl = "/WildVetCheckin/CredentialRecovery/new_docPassword.php?token=".$token;
                $link = $httphost.$requesturl;
                header("location: $link");
                exit();
            }
            else{
                $email = "$result1[email]";
                $update = $conn->prepare("UPDATE doctor SET dPassword = ? WHERE dEmail=?");
                $update->bind_param("ss", $new_pass, $email);
                $update->execute();
                if($update){
                    $tokendelete = $conn->prepare("delete from passwordreset where token = ?");
                    $tokendelete->bind_param("s",$token);
                    $tokendelete->execute();
                    $_SESSION['statusD'] = "Password has been update.";
                    $_SESSION['status_codeD'] = "success";
                    $_SESSION['msg'] = "";
                    header('location: ../Doctor/doctorLogin.php');
                    exit();
                }
                else{
                    $_SESSION['statusD'] = "Oops, something went wrong.";
                    $_SESSION['status_codeD'] = "error";
                    header('location: recoverySelection.php');
                    exit();
                }
            }
        }
    }
}

// Username recovery for doctor.. forgotten username
if(isset($_POST['dusernameRecovery'])){
    $email = $_POST['dEmail'];
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else
    {
        $query = $conn->prepare("SELECT dEmail , docId, username, dFname FROM doctor WHERE dEmail = ? ");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
        
        if($result == 0) {
        $_SESSION['statusD'] = 'Sorry, no user exists on our system with that email';
        $_SESSION['status_codeD'] = "error";
        header("Location: recoverySelection.php");
        exit();
        }
        $token = bin2hex(random_bytes(5));
    
        if ($result > 0) {
        // store token in the password-reset database table against the user's email
            $riD = "$result[docId]";
            $query1 = $conn->prepare("INSERT INTO passwordreset(id, email, token) VALUES (?,?,?)");
            $query1->bind_param("iss", $riD, $email, $token);
            $query1->execute();

        
            // Send email to user with the token in a link they can click on
            $to = $email;
            $httphost = "http://".$_SERVER['HTTP_HOST'];
            $requesturl = "/WildVetCheckin/CredentialRecovery/new_dusername.php?token=".$token;
            $link = $httphost.$requesturl;
            $name = "$result[dFname]";
            //echo $to; echo $name;
            $subject = "Recover Your Username - Doctor";
            $msg = "Hi there, click on this <a href=$link>link</a> to view your username.";
            $msg = wordwrap($msg,70);
            

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $gmailUsername;
            $mail->Password = $gmailPassword;
            $mail->SMTPSecure = 'tls';
            $mail->Port = '587';
            $mail->setFrom('thewildvetcheckin@gmail.com', 'Wild Vet Reception - View Username');
            $mail->addAddress($to, $name);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $msg;

            try {
                $mail->send();
                $_SESSION['statusmail'] = 1;
                
            } catch (Exception $e) {
                echo "error" . $mail->ErrorInfo;
            }
        }
        if ($_SESSION['statusmail'] == 1) {
            header('Location: emailConfirm.php?email='.$email);
        }
    }
}

// Viewing username for doctor.. forgotten username
if(isset($_POST['doctorPassword'])){
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else
    {
        $enteredPassword = $_POST['dPassword'];
        $token = $_POST['token'];
        $query2 = $conn->prepare("SELECT email FROM passwordreset WHERE token = ? LIMIT 1");
        $query2->bind_param("s", $token);
        $query2->execute();
        $result = $query2->get_result()->fetch_assoc();
        if($result == 0){
            $_SESSION['statusD'] = "Sorry the link has expired. Try agian using the recovery.";
            $_SESSION['status_codeD'] = "error";
            $_SESSION['msg'] ="";
            header('location: recoverySelection.php');
            exit();
        }
        else{
            $email = "$result[email]";
            $query = $conn->prepare("SELECT dPassword, username FROM doctor WHERE dEmail = ?");
            $query->bind_param("s", $email);
            $query->execute();
            if(!$query){
                $_SESSION['statusD'] = "Oops, sowmthing went wrong. Try again after some time. user does not exist";
                $_SESSION['status_codeD'] = "error";
                $_SESSION['msg'] ="";
                header('location: recoverySelection.php');
                exit();
            }
            else{
                $result = $query->get_result()->fetch_assoc();
                $dPassword = "$result[dPassword]";
                if($dPassword == $enteredPassword){
                    $rusername = "$result[username]";
                    $_SESSION['statusD'] = "Here is your user-name : ".$rusername;
                    $_SESSION['status_codeD'] = "success";
                    $_SESSION['msg'] = "This dialogue cannot be viewed again after closing.";
                    $tokendelete = $conn->prepare("delete from passwordreset where token = ?");
                    $tokendelete->bind_param("s",$token);
                    $tokendelete->execute();
                    header('Location: ../Doctor/doctorLogin.php');
                    exit();
                }
                else{
                    $_SESSION['statusD'] = "Wrong password entered. Try again.";
                    $_SESSION['status_codeD'] = "error";
                    $_SESSION['msg'] ="";
                    $httphost = "http://".$_SERVER['HTTP_HOST'];
                    $requesturl = "/WildVetCheckin/CredentialRecovery/new_dusername.php?token=".$token;
                    $link = $httphost.$requesturl;
                    header("Location: $link");
                    exit();
                }
            }
        } 
    }
}


