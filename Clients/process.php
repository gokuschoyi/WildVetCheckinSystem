<?php
session_start();
error_reporting();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('../includes/dbConn.php');
include('../includes/gmailCredentials.php');
include('../allVendor/simple_html_dom.php');
include ('../allVendor/phpmailer/phpmailer/src/PHPMailer.php');
include ('../allVendor/tecnickcom/tcpdf/tcpdf.php');
require ('../allVendor/autoload.php');
ob_clean(); //Clear any previous output
ob_start(); //Start new output buffer

//(1) Saving new client info to dastabse. (client info not from existing email)
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
        $date = date('Y/m/d');
        $time = date("h:i:s");
        $stmt = $conn->prepare("INSERT INTO clientinfo (title, firstName, surName, mobileNo, othContact, email, clientAddress, suburb, postcode, checkinDate, checkinTime) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssiisssiss", $title, $firstName, $surName, $mobileNo, $othContact, $email, $clientAddress, $suburb, $postcode, $date, $time);
        $stmt->execute();
        $_SESSION['cEmail'] = $email;
        header("Location: petInfo.php");
        exit();
    }
}

//(2) Saving existing client info entered via email to database
if(isset($_POST['toPetE'])){
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
    
    //$_SESSION["emailToId"] = $email;
    if($conn->connect_error){
        die('Connection to DB failed : '.$conn->connect_error);
    }
    
    else{
        $time = date("h:i:s");
        $date = date('Y/m/d');
        $stmt = $conn->prepare("INSERT INTO clientinfo (title, firstName, surName, mobileNo, othContact, email, clientAddress, suburb, postcode, checkinDate, checkinTime) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssiisssiss", $title, $firstName, $surName, $mobileNo, $othContact, $email, $clientAddress, $suburb, $postcode, $date, $time);
        $stmt->execute();
        echo " Client Info saved to db...";
        $_SESSION['cEmail'] = $email;
        header("Location: petInfo.php");
    } 
}

//(3) Saving pet info to database.
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

        $toEmail = $_SESSION['cEmail'];
        $gusername = $gmailUsername;
        $gpassword = $gmailPassword;
        $mail = new PHPMailer();
        $mail->SMTPDebug=2;
        $mail->IsSMTP();
        $mail-> Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $gusername;
        $mail->Password = $gpassword;
        $mail->SMTPSecure ='tls';
        $mail->Port = '587';
        $mail->setFrom('thewildvetcheckin@gmail.com','Wild Vet Reception');
        $mail->addAddress($toEmail, $firstName);
        $mail->isHTML(true);
        $mail->Subject = "Checkin Information Test Server"; 
        $mail->Body = $message;
        $mail->AddAttachment($filepath);
        if(!$mail->send()){
            $_SESSION['statusD']= "Sorry the email ID is invalid.";
            $_SESSION['status_codeD'] = "error";
            header('Location: clientCheckin.php');
            exit();
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

//(4) search db with email for client checkin
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