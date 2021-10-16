<?php
session_start();
error_reporting();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include '../includes/dbConn.php';
include "../allVendor/simple_html_dom.php";
include '../allVendor/phpmailer/phpmailer/src/PHPMailer.php';
include '../allVendor/tecnickcom/tcpdf/tcpdf.php';
require '../allVendor/autoload.php';
ob_clean(); //Clear any previous output
ob_start(); //Start new output buffer

//(1) Doctor done from dashboard and undo for history #error pop-up done
if(isset($_POST['done'])){
    $u_id = $_POST['cid'];
    $u_viewed = "Yes";
    $query = $conn->prepare("UPDATE clientinfo SET viewed = ? WHERE clientId = ?");
    $query->bind_param("si", $u_viewed, $u_id);
    $query->execute();
    if($query){
        $_SESSION['statusDr'] = "Client has been updated as seen.";
        $_SESSION['status_codeDr'] = "success";
        header("Location: docDash.php");
        exit();
    }
    else{
        $_SESSION['statusDr'] = "Error, something went wrong. Try again later.";
        $_SESSION['status_codeDr'] = "error";
        header("Location: docDash.php");
        exit();
    }
}
if(isset($_POST['undo'])){
    $u_id = $_POST['cid'];
    $u_viewed = "No";
    $query = $conn->prepare("UPDATE clientinfo SET viewed = ? WHERE clientId = ?");
    $query->bind_param("si", $u_viewed, $u_id);
    $query->execute();
    if($query){
        $_SESSION['statusDr'] = "Client info moved back to dashboard.";
        $_SESSION['status_codeDr'] = "success";
        header("Location: docHistory.php");
        exit();
    }
    else{
        $_SESSION['statusDr'] = "Error, something went wrong. Try again later.";
        $_SESSION['status_codeDr'] = "error";
        header("Location: docDash.php");
        exit();

    }
}

//(2) Adding comments for clients by doctor #error pop-up done
if(isset($_POST['updateDocclient'])){
    $u_id = $_POST['cidd'];
    $u_comments = $_POST['comments'];
    $query = $conn->prepare("UPDATE clientinfo SET addComments = ? WHERE clientId = ?");
    $query->bind_param("si", $u_comments, $u_id);
    $query->execute();
    if($query){
        $_SESSION['statusDr'] = "Comment added to Client.";
        $_SESSION['status_codeDr'] = "success";
        $_SESSION['cidup'] = $u_id;
        header("Location: doc_clientedit.php");
        exit();
    }
    else{
        $_SESSION['statusDr'] = "Oops, something went wrong. Try again later.";
        $_SESSION['status_codeDr'] = "error";
        header("Location: docDash.php");
        exit();
    }
}

//(3) Doctor Login verification #error pop-up done
if(isset($_POST['logindoc']))
    {
    $docUname = $_POST['username'];
    $docPass = $_POST['password'];
    /* echo $docEmail;
    echo $docPass; */
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else{
        $query = $conn->prepare("SELECT username, dPassword, dFname, dLname, dEmail FROM doctor WHERE username = ?");
        $query->bind_param("s",$docUname);
        $query->execute();
        $result = $query->get_result();
        if(mysqli_num_rows($result)==0){
            $_SESSION['statusD'] = "The username is invalid, try again .";
            $_SESSION['status_codeD'] = "error";
            header("Location: doctorLogin.php");
            exit();
        }
        else {
            while($row = $result->fetch_assoc()){
                $qpassword = "$row[dPassword]";
                $username = "$row[username]";
                $fname = "$row[dFname]";
                $lname = "$row[dLname]";
                $qemail = "$row[dEmail]";
            }
            if(($docUname == $username) && ($docPass == $qpassword))
            {
                $_SESSION['status'] = "WELCOME ".$fname." ".$lname.'.'." You have successfully logged in.";
                $_SESSION['status_code'] = "success";
                $_SESSION['loggedin'] = "success";
                $_SESSION['docEmail'] = $qemail;
                header("Location: docDash.php");
                exit();
            }
            else if (($docEmail != $qemail) || ($docPass != $qpassword))
            {
                $_SESSION['statusD'] = "Password is invalid, try again.";
                $_SESSION['status_codeD'] = "error";
                header("Location: doctorLogin.php");
                exit();
            }
        }
    }
}

//(4) Updating comments for not viewed clients  #error pop-up done
if(isset($_POST['updateDocNotViewedclient'])){
    $u_id = $_POST['cidd'];
    $u_comments = $_POST['comments'];
    $query = $conn->prepare("UPDATE clientinfo SET addComments = ? WHERE clientId = ?");
    $query->bind_param("si", $u_comments, $u_id);
    $query->execute();
    if($query){
        $_SESSION['statusDr'] = "Comment/Note added to client record.";
        $_SESSION['status_codeDr'] = "success";
        header("Location: docNotviewed.php");
        exit();
    }
    else{
        $_SESSION['statusDr'] = "Oops, something went wrong. Try again later.";
        $_SESSION['status_codeDr'] = "error";
        header("Location: docNotviewed.php");
        exit();
    }
}

//(5) Doctor registration #error pop-up done
if(isset($_POST['docRegister'])){
    $firstname = $_POST['dFname'];
    $username = $_POST['username'];
    $dEmail = $_POST['dEmail'];
    $dPassword = $_POST['dPassword'];
    $dCpassword = $_POST['dCpassword'];
    if($conn->connect_error){
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else{
        $query = $conn->prepare("SELECT * FROM doctor WHERE dEmail = ?");
        $query->bind_param("s",$dEmail);
        $query->execute();
        $result = $query->get_result();
        while( $row = $result->fetch_assoc()){
            $qname = "$row[dFname]";
            $qemail = "$row[dEmail]";
            $qid = "$row[docId]";
        }
        if(($firstname == $qname) && ($dEmail == $qemail))
        {
            if($dPassword == $dCpassword){
                $registered = "Yes";
                $query = $conn->prepare("UPDATE doctor SET username = ?,dPassword = ?, registered = ? WHERE docId = ?");
                $query->bind_param("sssi",$username, $dPassword, $registered, $qid);
                $query->execute();
                if($query){
                    $_SESSION['statusD']= "Thank you for registering. You can now Log-In.";
                    $_SESSION['status_codeD'] = "success";
                    $_SESSION['msg'] = "";
                    header("Location: doctorLogin.php");
                    exit();
                }
                else{
                    $_SESSION['statusD']= "Something went Wrong. Try again Later.";
                    $_SESSION['status_codeD'] = "error";
                    $_SESSION['msg'] = "";
                    header("Location: doctorLogin.php");
                    exit();
                }
            }
            else{
                $_SESSION['statusD']="Passwords do not match re-enter and try again. ";
                $_SESSION['status_codeD'] = "error";
                $_SESSION['msg'] = "";
                header("Location: doctorRegister.php");
                exit();
            }    
        }
        else{
            $_SESSION['statusD']="The email and Name does not exist in our records. Contact Admin.";
            $_SESSION['status_codeD'] = "error";
            $_SESSION['msg'] = "";
            header("Location: doctorRegister.php");
            exit();
        }
    }
}

//(6) Doctor logout #error pop-up done
if(isset($_POST['logoutDoc'])){
    $_SESSION['statusD'] = "You have successfully logged out. See you soon";
    $_SESSION['status_codeD'] = "info";
    $_SESSION['msg'] = "";
    unset($_SESSION['loggedin']);
    header("Location: doctorLogin.php");
    exit();
}



