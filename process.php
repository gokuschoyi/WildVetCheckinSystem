<?php
session_start();
error_reporting();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include 'includes/dbConn.php';
include "simple_html_dom.php";
include 'allVendor/phpmailer/phpmailer/src/PHPMailer.php';
include 'allVendor/tecnickcom/tcpdf/tcpdf.php';
require 'allVendor/autoload.php';
ob_clean(); //Clear any previous output
ob_start(); //Start new output buffer

/* password recovery for receptionist */ #error pop-up done
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
            //echo $to; echo $name;
            $subject = "Reset your password";
            $msg = "Hi there, click on this <a href=http://localhost/WildVetCheckin/new_pass.php?token=". $token ."\">link</a> to reset your password.";
            $msg = wordwrap($msg,70);
            

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'thewildvetcheckin@gmail.com';
            $mail->Password = 'fbzqqlhbztsjujan';
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
                header('location: http://localhost/WildVetCheckin/new_pass.php?token='.$token);
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
                    header('location: receptionistLogin.php');
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

//username recovery for receptionist #error pop-up done
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
            $name = "$result[rFirstname]";
            //echo $to; echo $name;
            $subject = "Recover Your Username";
            $msg = "Hi there, click on this <a href=http://localhost/WildVetCheckin/new_rusername.php?token=". $token ."\">link</a> to view your username.";
            $msg = wordwrap($msg,70);
            

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'thewildvetcheckin@gmail.com';
            $mail->Password = 'fbzqqlhbztsjujan';
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

//viewing username after entering password to link sent via email #error pop-up done
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
                    header('Location: doctorLogin.php');
                    exit();
                }
                else{
                    $_SESSION['statusD'] = "Wrong password entered. Try again.";
                    $_SESSION['status_codeD'] = "error";
                    $_SESSION['msg'] ="";
                    header('Location: http://localhost/WildVetCheckin/new_rusername.php?token='.$token);
                    exit();
                }
            }
        } 
    }
}

//password reset for doctor #error pop-up done
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
            $name = "$result[dFname]";
            //echo $to; echo $name;
            $subject = "Reset your password";
            $msg = "Hi there, click on this <a href=http://localhost/WildVetCheckin/new_docPassword.php?token=". $token . "\">link</a> to reset your password.";
            $msg = wordwrap($msg,70);
            

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'thewildvetcheckin@gmail.com';
            $mail->Password = 'fbzqqlhbztsjujan';
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

//Enter doctor password to reset , link sent via mail #error pop-up done
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
                header('location: http://localhost/WildVetCheckin/new_docPassword.php?token='.$token);
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
                    header('location: doctorLogin.php');
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

//(1) Assign doctors to specific client #error pop-up done
if(isset($_POST['assigndoc'])){
    $opt = $_POST['option'];
    $id = $_POST['cidd'];
    $stmt = $conn->prepare("UPDATE clientinfo SET assignedDoc = ? WHERE clientId = ?");
    $stmt->bind_param("si",$opt, $id);
    $stmt->execute();
    if($stmt){
        $_SESSION['status'] = "Dr.".$opt." assigned to client";
        $_SESSION['status_code'] = "success";
        header("Location: rToday.php");
        exit();
    }
    else{
        $_SESSION['status'] = "Cannot assign doctor";
        $_SESSION['status_code'] = "error";
        header("Location: rToday.php");
        exit();
    }
}

//(2) Delete a single client record from all clients page #error pop-up done
if(isset($_POST['deleteuser'])){
    $cid = $_POST['cid'];

    $query2 = $conn->prepare("DELETE FROM petinfo WHERE petKey = ?");
    $query2->bind_param("i", $cid);
    $query2->execute();

    $query = $conn->prepare("DELETE FROM clientinfo WHERE clientId = ?");
    $query->bind_param("i", $cid);
    $query->execute();

    if($query){
        $_SESSION['status'] = "Client Record Deleted";
        $_SESSION['status_code'] = "success";
        header("Location: rAllclients.php");
        exit();
    }
    else{
        $_SESSION['status'] = "Cannot Delete Client Record";
        $_SESSION['status_code'] = "error";
        header("Location: rAllclients.php");
        exit();
    }
}

//(3) Update client info (today page) #error pop-up done
if(isset($_POST['updateclient'])){
    $u_id = $_POST['cidd'];
    $u_mobile = $_POST['mobileUpdate'];
    $u_othContact = $_POST['otherContact'];
    $u_email = $_POST['email'];
    $u_address = $_POST['address'];
    $u_suburb = $_POST['suburb'];
    $u_postcode = $_POST['postcode'];

    $u_petname = $_POST['petname'];
    $u_pettype = $_POST['pettype'];
    $u_breed = $_POST['breed'];
    $u_sex = $_POST['sex'];
    $u_color = $_POST['color'];
    $u_age = $_POST['age'];
    $u_weight = $_POST['weight'];
    $u_microchip = $_POST['microchip'];
    $u_insurance = $_POST['insurance'];
    $u_medication = $_POST['medication'];
    $u_parasiteC = $_POST['parasiteC'];
    $u_mcdate = date('Y-m-d', strtotime($_POST['mcdate']));


    $query = $conn->prepare("UPDATE clientinfo SET mobileNo = ?, othContact = ?, email = ?, clientAddress =  ?, suburb = ?, postcode = ? WHERE clientId = ?");
    $query->bind_param("iisssii",$u_mobile, $u_othContact, $u_email, $u_address, $u_suburb, $u_postcode, $u_id);
    $query->execute();

    $query2 = $conn->prepare("UPDATE petinfo SET petName = ?, petType = ?, breed = ?, sex = ?, color = ?, age = ?, petWeight = ?, microchip = ?, insurance = ?, medication = ?, parasiteControl = ?, mcDate = ? WHERE petKey = ? ");
    $query2->bind_param("sssssiisssssi",$u_petname, $u_pettype, $u_breed, $u_sex, $u_color, $u_age, $u_weight, $u_microchip, $u_insurance, $u_medication, $u_parasiteC, $u_mcdate, $u_id);
    $query2->execute();
    $test = true;
    if($query2){
        $_SESSION['status'] = "Client details updated";
        $_SESSION['status_code'] = "success";
        header("Location: rToday.php");
        exit();
    }
    else{
        $_SESSION['status'] = "Client details not updated!";
        $_SESSION['status_code'] = "error";
        header("Location: rToday.php");
        exit();
    }
    
    
}

//(4) Update client info (all clients page) #error pop-up done
if(isset($_POST['updateAclient'])){
    $u_id = $_POST['cidd'];
    $u_mobile = $_POST['mobileUpdate'];
    $u_othContact = $_POST['otherContact'];
    $u_email = $_POST['email'];
    $u_address = $_POST['address'];
    $u_suburb = $_POST['suburb'];
    $u_postcode = $_POST['postcode'];

    $u_petname = $_POST['petname'];
    $u_pettype = $_POST['pettype'];
    $u_breed = $_POST['breed'];
    $u_sex = $_POST['sex'];
    $u_color = $_POST['color'];
    $u_age = $_POST['age'];
    $u_weight = $_POST['weight'];
    $u_microchip = $_POST['microchip'];
    $u_insurance = $_POST['insurance'];
    $u_medication = $_POST['medication'];
    $u_parasiteC = $_POST['parasiteC'];
    $u_mcdate = date('Y-m-d', strtotime($_POST['mcdate']));


    $query = $conn->prepare("UPDATE clientinfo SET mobileNo = ?, othContact = ?, email = ?, clientAddress =  ?, suburb = ?, postcode = ? WHERE clientId = ?");
    $query->bind_param("iisssii",$u_mobile, $u_othContact, $u_email, $u_address, $u_suburb, $u_postcode, $u_id);
    $query->execute();

    $query2 = $conn->prepare("UPDATE petinfo SET petName = ?, petType = ?, breed = ?, sex = ?, color = ?, age = ?, petWeight = ?, microchip = ?, insurance = ?, medication = ?, parasiteControl = ?, mcDate = ? WHERE petKey = ? ");
    $query2->bind_param("sssssiisssssi",$u_petname, $u_pettype, $u_breed, $u_sex, $u_color, $u_age, $u_weight, $u_microchip, $u_insurance, $u_medication, $u_parasiteC, $u_mcdate, $u_id);
    $query2->execute();
    if($query2){
        $_SESSION['status'] = "Client details updated";
        $_SESSION['status_code'] = "success";
        header("Location: rAllclients.php");
        exit();
    }
    else{
        $_SESSION['status'] = "Client details not updated!";
        $_SESSION['status_code'] = "error";
        header("Location: rAllclients.php");
        exit();
    }
}  

//(5) Doctor done from dashboard and undo for history #error pop-up done
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

//(6) Adding comments for clients by doctor #error pop-up done
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

//(7) Adding doctor deatails from reception #error pop-up done
if(isset($_POST['registerbtn'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $registered = "No";
    
    $email_query = $conn->prepare("SELECT * FROM doctor WHERE demail = ? ");
    $email_query->bind_param("s", $email);
    $email_query->execute();
    $result = $email_query->get_result()->fetch_assoc();
    if($result > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: addDoctor.php');
        exit();  
    }
    else
    {   
        $query = $conn->prepare("INSERT INTO doctor (dFname, dLname, dEmail, registered)VALUES(?,?,?,?)");
        $query->bind_param("ssss", $firstname,$lastname,$email,$registered);
        $query -> execute();
        
        if($query)
        {
            $_SESSION['status'] = "Doctor Profile Added";
            $_SESSION['status_code'] = "success";
            header('Location: addDoctor.php');
            exit();
        }
        else 
        {
            $_SESSION['status'] = "Doctor Profile Not Added";
            $_SESSION['status_code'] = "error";
            header('Location: addDoctor.php'); 
            exit(); 
        }                                                               
    }
}

//(8) Download CSV file error pop-up not working here
if(isset($_POST['downloadCSV'])){
    $value = "Yes";
    $filename = "members-data_" . date('d-m-y') . ".csv";
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    $f = fopen('php://output', 'w');
    $delimiter = ","; 
    $fields = array('ID', 'TITLE', 'FIRST NAME', 'LAST NAME', 'MOBILE NO','EMAIL', 'CHECK-IN DATE');
    fputcsv($f, $fields, $delimiter); 
    $query1 = $conn->prepare("SELECT clientId, title, firstName, surName, mobileNo, email, checkinDate  FROM clientinfo WHERE newsletter = ?");
    $query1->bind_param("s",$value);
    $query1->execute();
    $result = $query1->get_result();
    while($row = mysqli_fetch_assoc($result)){
        fputcsv($f, $row);
    }
    fclose($f);
}

//(9) Updating receptionist profile #error pop-up done
if(isset($_POST['updatereception'])){
    $r_username = $_POST['rname'];
    $r_password = $_POST['rpassword'];
    $r_id = $_POST['rid'];

    $query = $conn->prepare("UPDATE reception SET rUsername = ?, rPassword = ? WHERE rId = ?");
    $query->bind_param("ssi", $r_username, $r_password, $r_id);
    $query->execute();
    if($query){
        $_SESSION['status'] = 'Your information has been updated. Log out and sign back in for changes to take effect.';  
        $_SESSION['status_code'] = "success";
        $_SESSION['rNameU'] = $r_username;
        header("Location: rDashboard.php");
        exit();
    } 
    else{
        $_SESSION['status'] = 'Something went wrong when updating your information. Try again later';  
        $_SESSION['status_code'] = "error";
        header("Location: rDashboard.php");
        exit();
    }  
}

//(10) Sending snippet email to client #error pop-up done
if (isset($_POST['submitEmail'])) {
    $_SESSION['status'] = 0;

    $template = "./template.php";
    if (file_exists($template))
        $message = file_get_contents($template);
    else
        die("unable to locate file");
    
    $selectedCount = $_POST['selectedCount'];
    $selectedLinks = $_POST['selected'];
    
    function addExtraLinks($count, $message, $sLinks)
    {
        $htmlDom = new DOMDocument;
        @$htmlDom->loadHTML($message);
        for ($i = 0; $i < $count; $i++) {
            $links = "";
            $pieces = explode("\n", $sLinks);
            $links = substr($pieces[$i], 0, -1);
            $inside = $htmlDom->getElementById('test');
    
            $div = $htmlDom->createElement("div");
            $div->setAttribute("class", "justify-content: center;");
            $div->setAttribute("style", " height : 70px; display: flex; align-items: center; margin-left:35%; margin-right:35%; margin-top: 8px;");
            $div->setAttribute("id", $i);
    
            $link = $htmlDom->createElement("a");
            $link->setAttribute('href', $links);
            $link->setAttribute("class", "button");
            $link->setAttribute("style", "width : 150px; background-color: #b967c7; border: none; color: white; padding: 15px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;");
            $link->textContent = ("Article : ".$i+1);
    
            $div->appendChild($link);
    
            $inside->appendChild($div);
        }
        return $htmlDom->saveHTML();
    }
        $msg = addExtraLinks($selectedCount, $message, $selectedLinks);

        $cName = $_POST['sender_name'];
        $cEmail = $_POST['recipient'];
        $cSubject = $_POST['subject'];
        //$cAttachment = $_FILES['attachments']['name'];
        $cBody = $msg;

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thewildvetcheckin@gmail.com';
        $mail->Password = 'fbzqqlhbztsjujan';
        $mail->SMTPSecure = 'tls';
        $mail->Port = '587';
        $mail->setFrom('thewildvetcheckin@gmail.com', 'Wild Vet Reception - Links');
        $mail->addAddress($cEmail, $cName);
        $mail->isHTML(true);
        $mail->Subject = $cSubject;
        $mail->Body = $cBody;

        try {
            $mail->send();
            $_SESSION['status'] = 1;
        } 
        catch (Exception $e) {
            echo "error" . $mail->ErrorInfo;
        }

    if($_SESSION['status'] == 1){
        $_SESSION['status'] = 'Email sent successfully to : '.$cName;  
        $_SESSION['status_code'] = "success";
        $id = $_POST['cid'];
        $snippet = "Yes";
        $stmt = $conn->prepare("UPDATE clientinfo SET snippet = ? WHERE clientId = ?");
        $stmt->bind_param("si", $snippet, $id);
        $stmt->execute();
        header("Location: rSendsnippet.php");
        exit();
    }
    else{
        $_SESSION['status'] = 'Failed to send email. Try after some time.';  
        $_SESSION['status_code'] = "error";
        header("Location: rSendsnippet.php");
        exit();
    }

}

//(11) Doctor Login verification #error pop-up done
if(isset($_POST['logindoc']))
    {
    $docEmail = $_POST['email'];
    $docPass = $_POST['password'];
    /* echo $docEmail;
    echo $docPass; */
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else{
        $query = $conn->prepare("SELECT username, dEmail, dPassword FROM doctor WHERE dEmail = ?");
        $query->bind_param("s",$docEmail);
        $query->execute();
        $result = $query->get_result();
        if(!$query){
            $_SESSION['statusD'] = "Sowmething went Wrong. Try again later.";
            $_SESSION['status_codeD'] = "error";
            header("Location: doctorLogin.php");
            exit();
        }
        else{
            while($row = $result->fetch_assoc()){
                $qemail = "$row[dEmail]";
                $qpassword = "$row[dPassword]";
                $username = "$row[username]";
            }
            if(($docEmail == $qemail) && ($docPass == $qpassword))
            {
                $_SESSION['status'] = "WELCOME ".$username.'.'." You have successfully logged in.";
                $_SESSION['status_code'] = "success";
                $_SESSION['loggedin'] = "success";
                $_SESSION['docEmail'] = $qemail;
                header("Location: docDash.php");
                exit();
            }
            else if (($docEmail != $qemail) || ($docPass != $qpassword))
            {
                $_SESSION['statusD'] = "Wrong email or password. Try again.";
                $_SESSION['status_codeD'] = "error";
                header("Location: doctorLogin.php");
                exit();
            }
        }
    }
}

//(12) Receptionist login verification #error pop-up done
if(isset($_POST['rLogin'])){
    $rUsername = $_POST['username'];
    $rPassword = $_POST['password'];
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else{
        $query = $conn->prepare("SELECT rUsername, rPassword FROM reception WHERE rUsername = ?");
        $query->bind_param("s",$rUsername);
        $query->execute();
        $result= $query->get_result();
        if(mysqli_num_rows($result)==0){
            $_SESSION['statusD'] = 'Username is invalid';
            $_SESSION['status_codeD'] = "error";
            header('Location: receptionistLogin.php');
            exit();
        }
        else if(mysqli_num_rows($result)>0){
            while($row = $result->fetch_assoc()){
                $qusername = "$row[rUsername]";
                $qpassword = "$row[rPassword]";
            }
            if(($rUsername == $qusername) && ($rPassword == $qpassword))
            {
                $_SESSION['rName'] = $qusername;
                $_SESSION['status'] = 'WELCOME '.$qusername.'.'.' You have successfully logged in.';
                $_SESSION['status_code'] = "success";
                $_SESSION['loggedin'] = "success";
                header('Location: rDashboard.php');
                exit();
            }
            else if($rPassword != $qpassword)
            {
                $_SESSION['statusD'] = 'Password is invalid';
                $_SESSION['status_codeD'] = "error";
                header('Location: receptionistLogin.php');
                exit();
            }
        }
    }       
}

//(13) Delete doctor record #error pop-up done
if(isset($_POST['deletedoc'])){
    $did = $_POST['did'];
    $query = $conn->prepare("DELETE FROM doctor WHERE docId = ?");
    $query->bind_param("i", $did);
    $query->execute();
    if($query){
        $_SESSION['status'] = "Doctor record deleted.";
        $_SESSION['status_code'] = "success";
        header("Location: addDoctor.php");
        exit();
    }
    else{
        $_SESSION['status'] = "Cannot delete Doctor Record.";
        $_SESSION['status_code'] = "error";
        header("Location: addDoctor.php");
        exit();
    }
}

//(14) Updating comments for not viewed clients  #error pop-up done
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

//(15) Updating doctor profile #error pop-up done
if(isset($_POST['updatedoc'])){
    $d_id = $_POST['docid'];
    $d_firstname = $_POST['firstname'];
    $d_lastname = $_POST['lastname'];
    $d_email = $_POST['email'];
    $d_username = $_POST['username'];
    $d_password = $_POST['password'];

    $query = $conn->prepare("UPDATE doctor SET dFname = ?, username = ?, dLname = ?, dEmail =  ?, dPassword = ? WHERE docId = ?");
    $query->bind_param("sssssi", $d_firstname, $d_username, $d_lastname, $d_email, $d_password, $d_id);
    $query->execute();
    if($query){
        $_SESSION['status'] = "Doctor details has been updated.";
        $_SESSION['status_codeD'] = "success";
        $_SESSION['docId'] = $d_id;
        header("Location: doc_edit.php");
        exit();
    }
    else{
        $_SESSION['status'] = "Oops, something went wrong. Try gaian later.";
        $_SESSION['status_codeD'] = "error";
        header("Location: doc_edit.php");
        exit();
    }
} 

//(16) Doctor registration #error pop-up done
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
                    header("Location: doctorLogin.php");
                    exit();
                }
                else{
                    $_SESSION['statusD']= "Something went Wrong. Try again Later.";
                    $_SESSION['status_codeD'] = "error";
                    header("Location: doctorLogin.php");
                    exit();
                }
            }
            else{
                $_SESSION['statusD']="Passwords do not match re-enter and try again. ";
                $_SESSION['status_codeD'] = "error";
                header("Location: doctorRegister.php");
                exit();
            }    
        }
        else{
            $_SESSION['statusD']="The email and Name does not exist in our records. Contact Admin.";
            $_SESSION['status_codeD'] = "error";
            header("Location: doctorRegister.php");
            exit();
        }
    }
}


//(17) Saving new client info to dastabse. (client info not from existing email)
if(isset($_POST['toPetC'])) {
    date_default_timezone_set('Australia/ACT');
    $title = $_POST['title'];
    $firstName = $_POST['firstName'];
    $surName = $_POST['surName'];
    $mobileNo = $_POST['mobileNo'];
    $othContact = $_POST['othContact'];
    $email = $_POST['email'];
    $clientAddress = $_POST['address'];
    $suburb = $_POST['suburb'];
    $postcode = $_POST['postcode'];
    $_SESSION['idEmail'] = $_POST['email'];
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    }
    else 
    {
        $stmt = $conn->prepare("INSERT INTO clientinfo (title, firstName, surName, mobileNo, othContact, email, clientAddress, suburb, postcode) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssiisssi", $title, $firstName, $surName, $mobileNo, $othContact, $email, $clientAddress, $suburb, $postcode);
        $stmt->execute();
        header("Location: petInfo.php");
        exit();
    }
}

//(18) Saving existing client info entered via email to database
if(isset($_POST['toPetE'])){
    $title = $_POST['title'];
    $firstName = $_POST['firstName'];
    $surName = $_POST['surName'];
    $mobileNo = $_POST['mobileNo'];
    $othContact = $_POST['othContact'];
    $email = $_POST['email'];
    $clientAddress = $_POST['address'];
    $suburb = $_POST['suburb'];
    $postcode = $_POST['postcode'];
    
    //$_SESSION["emailToId"] = $email;
    if($conn->connect_error){
        die('Connection to DB failed : '.$conn->connect_error);
    }
    
    else{
        $date = date('Y/m/d');
        $stmt = $conn->prepare("INSERT INTO clientinfo (title, firstName, surName, mobileNo, othContact, email, clientAddress, suburb, postcode, checkinDate) 
        VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssiisssis", $title, $firstName, $surName, $mobileNo, $othContact, $email, $clientAddress, $suburb, $postcode, $date);
        $stmt->execute();
        echo " Client Info saved to db...";
        header("Location: petInfo.php");
    } 
}

//(19) Saving pet info to database.
if(isset($_POST['submitPet'])){
    $reason = $_POST['reason'];
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
    $mcDate =  date('Y-m-d', strtotime($_POST['mcDate']));
    $ID='';
    //$_SESSION['idEmail'] = $_POST['email'];
    
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else
    {
        $stmt = $conn->prepare("INSERT INTO petinfo (reason,petName, petType, breed, sex, color, age, petWeight, microchip, insurance, medication, parasiteControl, mcDate, petKey) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?, (SELECT clientId FROM clientinfo WHERE email = '$_SESSION[idEmail]' ORDER BY clientId DESC LIMIT 1))");
        $stmt->bind_param("ssssssiisssss",$reason, $petName, $petType, $breed, $sex, $color, $age, $petWeight, $microchip, $insurance, $medication, $parasiteControl, $mcDate);
        $stmt->execute();
        
        //$query = "UPDATE petinfo P, clientinfo C SET P.petKey = C.clientId WHERE C.email = '$_SESSION[idEmail]' ORDER BY C.clientId DESC LIMIT 1";
        //$query_run = mysqli_query($conn,$query);

        $Query2 = "SELECT petKey FROM petinfo WHERE petKey = (SELECT clientId FROM clientinfo WHERE email = '$_SESSION[idEmail]' ORDER BY clientId DESC LIMIT 1) ";
        $query_run2 = mysqli_query($conn,$Query2);

        while($row = mysqli_fetch_row($query_run2)) {
            $_SESSION['ID'] = $row[0]; 
            $pdfID = $_SESSION['ID'];
            $newsletter = "No";
            $snippet = "No";
            $viewed = "No";

            $stmt2 = $conn->prepare("UPDATE clientinfo SET newsletter = ?, snippet = ?, viewed = ? WHERE clientid = ?");
            $stmt2->bind_param("sssi",$newsletter, $snippet, $viewed, $pdfID);
            $stmt2->execute();

            date_default_timezone_set('Australia/ACT');
            $date = date("Y-m-d");
            $time = date("h:i:s A");
            $stmt = $conn->prepare("UPDATE clientinfo SET checkinDate = ?, checkinTime = ? WHERE clientid = ?");
            $stmt->bind_param("ssi",$date, $time, $pdfID);
            $stmt->execute();

            $query3 = $conn->prepare("SELECT * FROM petinfo INNER JOIN clientinfo WHERE clientinfo.clientId='$_SESSION[ID]'"); 
            $query3->execute();
            $query_run3 = $query3->get_result();

            while($row = $query_run3->fetch_assoc()){
                $title = "$row[title]";
                $firstName = "$row[firstName]";
                $surName = "$row[surName]";
                $mobileNo = "$row[mobileNo]";
                $othContact = "$row[othContact]";
                $email = "$row[email].";
                $clientAddress = "$row[clientAddress]";
                $suburb = "$row[suburb]";
                $postcode = "$row[postcode]";
                $checkinDate = "$row[checkinDate]";
                $checkinTime = "$row[checkinTime]";
                $_SESSION['first'] = $checkinTime;
            }
        
        $html = '
            <style>
            table, tr, td {
            padding: 15px;
            }
            </style>
            <table style="background-color: #222222; color: #fff">
            <thead></thead>
            <tbody>
            <tr>
            
            <td><h1>CHECK-IN ID<strong> #'.$pdfID.'</strong></h1><br/>
            <strong style="font-size:14px;">Check-In Date: '.$checkinDate.'</strong>
            </td>

            <td><h1></h1></td>

            <td align="left"><br/>
            THE WILD VET<br/>
            22 A, Bridge Street,<br/>
            Australia, NSW, 2037.<br/>
            | <strong>1300 9453 838</strong> | <br/> <strong>reception@thewildvet.com.au</strong>
            </td>
            
            </tr>
            </tbody>
            </table>
        ';

        $html .= '
            <table>
            <thead></thead>
            <tbody>
            <tr>
            <td align = "center"><h1><strong>WILD VET CHECK-IN SYSTEM</strong></h1><br/></td></tr>
            </tbody>
            </table>
        ';

        $html .= '
            <table>
            <thead></thead>
            <tbody>
            <tr>
            <td align="center"><strong style="font-size:16px;">Client Details</strong><br/>
            '.$title.' '.$firstName.' '.$surName.'<br/>
            '.$clientAddress.'<br/>
            '.$suburb.' '.$postcode.'
            </td>



            <td align="center"><strong style="font-size:16px; width = 100px">Contact Details</strong><br/>
            Phone No : '.$mobileNo.'<br/>
            Other Contact : '.$othContact.'<br/>
            Email : '.$email.'<br/>
            </td>
            </tr>
            </tbody>
            </table>
        ';

        $html .= '
            <table style="width:100%" align = "center">
            <thead></thead>
            <tbody>
            <tr>
            <td style="text-decoration: underline;"><strong style="font-size:16px;">Pet Details</strong></td>
            </tr>
            </tbody>
            </table>

            <table style="width:100%" align = "center">
            <thead></thead>
            <tbody>
            <tr>
            <td><strong = "font-size:14px;">Pet Name : '.$petName.'</strong><br/>
            <strong = "font-size:14px;">Pet Type : '.$petType.'</strong></td>
            </tr>
            </tbody>
            </table>

            <table style="width:100%" align = "center">
            <thead></thead>
            <tbody>
            <tr colspan="4" style="font-weight:bold;">
            <th style="border-top: 1px solid #222">Breed</th>
            <th style="border-top: 1px solid #222">Sex</th>
            <th style="border-top: 1px solid #222">Color</th>
            <th style="border-top: 1px solid #222">Age</th>
            <th style="border-top: 1px solid #222">Weight</th>
            </tr>
            </tbody>
            </table>

            <table "width:100%" align = "center">
            <thead></thead>
            <tbody>
            <tr>
            <td style="border-bottom: 1px solid #222">'.$breed.'</td>
            <td style="border-bottom: 1px solid #222">'.$sex.'</td>
            <td style="border-bottom: 1px solid #222">'.$color.'</td>
            <td style="border-bottom: 1px solid #222">'.$age.'</td>
            <td style="border-bottom: 1px solid #222">'.$petWeight.'</td>
            </tr>
            </tbody>
            </table>

            <table "width:100%" align = "center">
            <thead></thead>
            <tbody>
            <tr style="font-weight:bold;">
            <th>Microchip</th>
            <th>Insurance</th>
            <th>Medication</th>
            <th>Parasite Control</th>
            <th>MC Date</th>
            </tr>
            </tbody>
            </table>

            <table "width:100%" align = "center">
            <thead></thead>
            <tbody>
            <tr>
            <td style="border-bottom: 1px solid #222">'.$microchip.'</td>
            <td style="border-bottom: 1px solid #222">'.$insurance.'</td>
            <td style="border-bottom: 1px solid #222">'.$medication.'</td>
            <td style="border-bottom: 1px solid #222">'.$parasiteControl.'</td>
            <td style="border-bottom: 1px solid #222">'.$mcDate.'</td>
            </tr>
            </tbody>
            </table>
        ';

        $html .= '
            <table>
            <thead></thead>
            <tbody>
            <tr>
            <td style = "height:50px;"align="center"><strong style="font-size:16px;">Thank you for checkin in with us. See you soon.</strong></td>
            </tr>
            </tbody>
            </table>
        
        ';

        $html .= '
            <table>
            <thead></thead>
            <tbody>
            <tr>
            <td style = "height:40px;"align="center" "text-decoration: underline;"><strong style="font-size:16px;">Opening Hours</strong></td>
            </tr>
            </tbody>
            </table>

            <table "width:100%" align = "center">
            <thead></thead>
            <tbody>
            <tr>
            <td style="text-decoration: underline;">Mon-Fri : 08:00 am - 07:00 pm</td>
            </tr>
            </tbody>
            </table>

            <table align = "center">
            <thead></thead>
            <tbody>
            <tr>
            <td style="text-decoration: underline;">Saturday : 09:00 am - 05:00 pm</td>
            </tr>
            </tbody>
            </table>

            <table "width:100%" align = "center">
            <thead></thead>
            <tbody>
            <tr>
            <td style="text-decoration: underline;">Sunday : 09:00 am - 12:00 pm</td>
            </tr>
            </tbody>
            </table>
        
        ';

        $html .= '
            <table>
            <thead></thead>
            <tbody>
            <tr height = "40px";>
            </tr>
            </tbody>
            </table>

            <table>
            <thead></thead>
            <tbody>
            <tr>
            <td style="border-top: 1px solid #222" align="center"><strong style="font-size:42px;">THE WILD VET</strong></td>
            </tr>
            </tbody>
            </table>

            <table>
            <thead></thead>
            <tbody>
            <tr>
            <td align="center"><strong style="font-size:14px;">EXOTICS & SMALL ANIMAL VETERINARIAN</strong></td>
            </tr>
            </tbody>
            </table>
        
        ';
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);
        $pdf->SetMargins(-1, 0, -1);
        $pdf->setPrintHeader(false);
	    $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $fontname = TCPDF_FONTS::addTTFfont('ubuntu.ttf', 'TrueTypeUnicode', '', 96);
        $fontbold = TCPDF_FONTS::addTTFfont('ubuntuB.ttf', 'TrueTypeUnicode', '', 96);
        $pdf->SetFont($fontname, '', 10);
        $pdf->AddPage();
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
        $pdf_name = ''.$pdfID.'.pdf';
        $pdf->Output(dirname(__FILE__).'/invoice/'.$pdf_name.'', 'F');
        //echo 'PDF saved. <a href="invoice/'.$pdf_name.'">View</a>';
        $filepath = "invoice/".$pdf_name; 

        $template = "./templateCheckin.php";
        if(file_exists($template))
            $message = file_get_contents($template);
        else
            die("unable to locate file");

        $mail = new PHPMailer();
        $mail->SMTPDebug=2;
        $mail->IsSMTP();
        $mail-> Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thewildvetcheckin@gmail.com';
        $mail->Password = 'fbzqqlhbztsjujan';
        $mail->SMTPSecure ='tls';
        $mail->Port = '587';
        $mail->setFrom('thewildvetcheckin@gmail.com','Wild Vet Reception');
        $mail->addAddress('gokulsangamitrachoyi@gmail.com','Gokul');
        $mail->isHTML(true);
        $mail->Subject = "Checkin Information Test Server"; 
        $mail->Body = $message;
        $mail->AddAttachment($filepath);
        if(!$mail->send()){
        echo 'something went wrong';
        echo'Mailer Error : ' .$mail->ErrorInfo;
        }
        //email attachment remaining
        else
        echo ' Mail sent Success';
            $mail->smtpClose();
            header("Location: thankYou.php");
            exit();
    }
    }
}

//(20) Resetting doctor credentials #error pop-up done
if(isset($_POST['reset'])){
    $did = $_POST['did'];
    $password = "";
    $registered  = "No";
    $username = "";
    $query = $conn->prepare("UPDATE doctor SET username = ?, dPassword = ?, registered = ? WHERE docId = ? ");
    $query->bind_param("sssi", $username, $password, $registered, $did);
    $query->execute();
    if($query){
        $_SESSION['status'] = "Doctor credentials has been reset.";
        $_SESSION['status_code'] = "success";
        header("Location: addDoctor.php");
        exit();
    }
    else{
        $_SESSION['status'] = "Cannot reset doctor profile. Try again later.";
        $_SESSION['status_code'] = "error";
        header("Location: addDoctor.php");
        exit();
    }
}

//(21) Doctor logout #error pop-up done
if(isset($_POST['logoutDoc'])){
    $_SESSION['statusD'] = "You have successfully logged out. See you soon";
    $_SESSION['status_codeD'] = "info";
    unset($_SESSION['loggedin']);
    header("Location: doctorLogin.php");
    exit();
}

//(22) Receptionist logout #error pop-up done
if(isset($_POST['logoutRec'])){
    $_SESSION['statusD'] = "You have successfully logged out. See you soon";
    $_SESSION['status_codeD'] = "info";
    unset($_SESSION['loggedin']);
    header("Location: receptionistLogin.php");
    exit();
}

//(23) search db with email for client checkin
if(isset($_POST['searchEmail'])){
    $enteredemail = $_POST['enteredEmail'];
    $query = $conn->prepare("SELECT email FROM clientinfo where email = ? ORDER BY clientId DESC LIMIT 1 ");
    $query->bind_param("s", $enteredemail);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();
    if($result == 0){
        $_SESSION['statusD']= "Sorry the email does not exist in our database. Click the check-in Button below.";
        $_SESSION['status_codeD'] = "error";
        header('Location: clientCheckin.php');
        exit();
    }
    else{
        $_SESSION['statusD'] = "We have found a similar record. Make sure it is you and then proceed to pet details.";
        $_SESSION['status_codeD'] = "success";
        $_SESSION['enteEmail'] = $enteredemail;
        header('Location: clientInfoEmail.php');
        exit();
    }
}