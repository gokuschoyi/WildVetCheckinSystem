<?php session_start();
use PHPMailer\PHPMailer\PHPMailer;
require 'allVendor/autoload.php';
include 'allVendor/tecnickcom/tcpdf/tcpdf.php';
include_once 'includes/dbConn.php';
error_reporting(0);
ob_clean(); //Clear any previous output
ob_start(); //Start new output buffer
include_once('allVendor/tecnickcom/tcpdf/tcpdf.php');
//echo $_SESSION["idEmail"];
if (isset($_POST['submit'])){
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
        $mail->  SMTPDebug=2;
        $mail->IsSMTP();
        $mail-> Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thewildvetcheckin@gmail.com';
        $mail->Password = '123@wildvet';
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
    }
    }  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Client Landing page</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Adamina&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Advent+Pro&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aguafina+Script&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akaya+Kanadaka&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akaya+Telivigala&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akronim&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aladin&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aldrich&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alef&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alegreya+SC&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aleo&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alex+Brush&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alice&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alike&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alike+Angular&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allan&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allura&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Almarai&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Almendra&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Almendra+Display&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Almendra+SC&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amarante&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amaranth&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amethysta&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amiko&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amiri&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amita&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anaheim&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Andada&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Andika&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Averia+Serif+Libre&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Courier+Prime:400,400i,700,700i&amp;subset=latin-ext&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=GFS+Neohellenic&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Features-Blue.css">
    <link rel="stylesheet" href="assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<style>
    .navbar-nav{
    border-radius: 15px;
}
.nav-item{
    text-align: center;
}
.nav-link{
    background-color:#f2f9ff;
    border-radius:15px;
}
</style>
<body>
    <nav class="navbar navbar-light navbar-expand-md d-flex justify-content-center align-items-center navigation-clean"style="background :transparent;height: 190px;">
        <div class="container"><a
                class="navbar-brand font-monospace d-lg-flex justify-content-lg-center align-items-lg-center" href="#"
                style="font-size: 28px;">Wild Vet Check-In</a><button data-bs-toggle="collapse" class="navbar-toggler"
                data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto" style = "background:#8cc1bf;">
                    <li class="nav-item"><a class="nav-link font-monospace" href="services.php">Services</a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link font-monospace" href="contactUs.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">F.A.Q</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="background: url(&quot;assets/img/11027%20(2).jpg&quot;)  center no-repeat;height :788px;">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" id="petDetails">
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;">
                    <select class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center" style="width: 240px;height: 33px;border-radius: 13px;border-width: 1px;border-color: rgb(231,173,169);opacity: 0.85;" name="reason" required="">
                        <option value="General" selected="">Reason for Visit</option>
                        <option value="Health Check">Health Check</option>
                        <option value="Nail Clipping">Nail Clipping</option>
                        <option value="Microchipping">Microchipping</option>
                        <option value="Dentstry">Dentstry</option>
                        <option value="New puppies/kittens">New puppies/kittens</option>
                        <option value="Laboratory Testing">Laboratory Testing</option>
                        <option value="Surgery">Surgery</option>
                        <option value="Hospitalization">Hospitalization</option>
                        <option value="Parasite Prevention">Parasite Prevention</option>
                        <option value="Medicine">Medicine</option>
                        <option value="Behavioural Advice">Behavioural Advice</option>
                        <option value="Nutritional Advice">Nutritional Advice</option>
                    </select></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Pet Name"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);"
                        name="petName" required="" autocomplete="on"></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><select
                        class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center"
                        style="width: 240px;height: 33px;border-radius: 13px;border-width: 1px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="petType" required="">
                        <option value="No Pet Selected" selected="">Select type of pet</option>
                        <option value="Canine">Canine</option>
                        <option value="Feline">Feline</option>
                        <option value="Reptile">Reptile</option>
                        <option value="Avian">Avian</option>
                        <option value="Amphibian">Amphibian</option>
                        <option value="Rabbit">Rabbit</option>
                        <option value="Rodent">Rodent</option>
                        <option value="Ferret">Ferret</option>
                    </select></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Breed"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);"
                        name="breed" required="" autocomplete="on"></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><select
                        class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center"
                        style="width: 240px;border-radius: 13px;height: 31px;border-color: rgb(231,173,169);opacity: .85;"
                        name="sex" required="">
                        <option value="None Selected" selected="">Select sex</option>
                        <option value="Male Entire">Male Entire</option>
                        <option value="Male Neutered">Male Neutered</option>
                        <option value="Female Entire">Female Entire</option>
                        <option value="Female Spayed">Female Spayed</option>
                        <option value="Unknown">Unknown</option>
                    </select></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Color"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);"
                        name="color" required="" autocomplete="on"></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Age"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);"
                        name="age" required="" autocomplete="on"></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Weight (Kg)"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);"
                        name="petWeight" required="" autocomplete="on"></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><select
                        class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center"
                        style="width: 240px;border-radius: 13px;height: 31px;border-color: rgb(231,173,169);opacity: .85;"
                        name="microchip" required="">
                        <option value="None Selected" selected="">Microchip</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><select
                        class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center"
                        style="width: 240px;border-radius: 13px;height: 31px;border-color: rgb(231,173,169);opacity: .85;"
                        name="insurance" required="">
                        <option value="None Selected" selected="">Insurance</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Medication (If Any)"
                        style="border-radius: 13px;border-color: rgb(231,173,169);width: 240px;" name="medication"
                        required="" autocomplete="on"></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><select
                        class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center"
                        style="width: 240px;border-radius: 13px;height: 31px;border-color: rgb(231,173,169);opacity: .85;"
                        name="parasiteControl" required="">
                        <option value="None Selected" selected="">Parasite Control</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center" style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="date"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="mcDate" required=""></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 34px;"><button id="petDetails"
                        class="btn btn-primary btn-sm font-monospace d-flex justify-content-center align-items-center"
                        type="submit" form="petDetails" name="submit" value="Submit"
                        style="border-radius: 30px;background: rgb(157,126,207);height: 35px;width: 148px; font-weight: bold;">SUBMIT DETAILS</button></div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><button onclick="parent.location='clientInfo.php'" id="goBack"
                        class="btn btn-primary btn-sm font-monospace d-xl-flex justify-content-xl-center align-items-xl-center"
                        type="button" style="border-radius: 30px;background: rgb(157,126,207);">Go Back</button>
                </div>
            </div>
    </div>
    </form>
    <div class="container" style="height: 180px">
        <footer class="footer-basic" style="background: transparent;">
            <div class="d-xl-flex justify-content-xl-center align-items-xl-center social"><a
                    class="d-xl-flex justify-content-xl-center align-items-xl-center"
                    href="https://www.instagram.com/thewildvetclinic/"><i class="icon ion-social-instagram"></i></a><a
                    href="https://www.facebook.com/thewildvetclinic/"><i class="icon ion-social-facebook"></i></a>
                </div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="https://wildvet.ezyvet.com/external/portal/main/login">Sign-In</a>
                </li>
                <li class="list-inline-item"><a href="contactUs.html">Contact Us</a></li>
                <li class="list-inline-item"><a href="services.html">F.A.Q</a></li>
            </ul>
            <p class="copyright" style="font-size : 18px; font-weight: bold; color: rgb(40,33,33);">The Wild Vet© 2021</p>
        </footer>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js">
</script>

</body>

</html>