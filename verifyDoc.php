<?php
include_once 'includes\dbConn.php';
session_start();
    $firstname = $_POST['dFname'];
    $username = $_POST['username'];
    $dEmail = $_POST['dEmail'];
    $dPassword = $_POST['dPassword'];
    $dCpassword = $_POST['dCpassword'];
   
    if ($conn->connect_error) {
        die('Connection to DB failed : ' . $conn->connect_error);
    } 
    else{
    $_SESSION['message']="";
    $buttonFlag = false;
    $query = $conn->prepare("SELECT * FROM doctor WHERE dEmail = '$dEmail'");
    //$query->bind_param("s",$dEmail);
    $query->execute();
    $result = $query->get_result();
        while( $row = $result->fetch_assoc()){
            $qname = "$row[dFname]";
            $qemail = "$row[dEmail]";
            $qid = "$row[docId]";
            $registered = "Yes";
            if(($firstname == $qname) && ($dEmail == $qemail))
            {
                if($dPassword == $dCpassword){
                $query = $conn->prepare("UPDATE doctor SET username = ?,dPassword = ?, registered = ? WHERE docId = ?");
                $query->bind_param("sssi",$username, $dPassword, $registered, $qid);
                $query->execute();
                $_SESSION['message']= "Thank you for registering. You can now Log-In.";
                $buttonFlag = true;
                }
                else{
                $_SESSION['message']="Passwords do not match re-enter and try again. ";
                }    
            }
            else{
                $_SESSION['message']="The email and Name does not exist in our records. Contact Admin.";

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
@media screen and (max-width: 600px) {
    div.example {
    display: none;
    }
}
.navbar-collapse{
    z-index: 1000;
    
}
.navbar-nav{
    border-radius: 10px;
}
.nav-link{
    background-color:#f2f9ff;
    border-radius:15px;
}
</style>
<body>
    <nav class="navbar navbar-light navbar-expand-md d-flex justify-content-center align-items-center navigation-clean" style="height: 180px;background: #c292fb;">
        <div class="container"><a class="navbar-brand font-monospace d-lg-flex justify-content-lg-center align-items-lg-center" href="index.php" style="font-size: 35px;">Wild Vet</a><button data-bs-toggle="collapse"
                class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle
                    navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto" style = "background:#c292fb;">
                    <li class="nav-item"><a class="nav-link font-monospace" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link font-monospace" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link font-monospace" href="#">Terms & Services</a></li>
                    <li class="nav-item"><a class="nav-link font-monospace" href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class = "example" style = "padding-top:20px;">
            <div class="d-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style = "width :100px; padding-left : 45px;">
                <img src="assets\img\logo.png" style="height: 80px;">
            </div>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="d-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center">
            <img src="assets/img/check.png" style="width: 100px;">
        </div>
    </div>
    <div class="d-sm-flex d-lg-flex d-xl-flex justify-content-sm-center align-items-sm-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center"
        style="height: 210px;">
        <p class="font-monospace text-center d-flex d-md-flex justify-content-center align-items-center justify-content-md-center align-items-md-center"
            style="font-size: 25px;color: rgb(163,109,112);width: 397px;height: 179px;">
            <?php echo $_SESSION['message'] ?></p>
    </div>
    <div class="d-xl-flex justify-content-xl-center align-items-xl-center" style="height: 170px;">
        <?php 
    if($buttonFlag == true){
        echo '<form action = "doctorLogin.php" method = "POST" class = "d-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center">
        <button class="btn btn-success" type="submit" name = "login">Log-In</button></form>';
        $buttonFlag = false;
        }
    else {
        echo '<form action = "doctorRegister.php" method = "POST" class ="d-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center">
        <button class="btn btn-success " type="submit" name = "goback">GO BACK</button></form>';   
        }
        ?></div>
    <div class="container">
        <footer class="footer-basic" style="background: transparent;height: 200px;">
            <div class="d-xl-flex justify-content-xl-center align-items-xl-center social"><a
                    class="d-xl-flex justify-content-xl-center align-items-xl-center"
                    href="https://www.instagram.com/thewildvetclinic/"><i class="icon ion-social-instagram"></i></a><a
                    href="https://www.facebook.com/thewildvetclinic/"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">

                <li class="list-inline-item"><a href="contactUs.html">Contact Us</a></li>
                <li class="list-inline-item"><a href="services.html">F.A.Q</a></li>
            </ul>
            <p class="copyright" style="color: rgb(40,33,33);">The Wild Vet© 2021</p>
        </footer>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<?php session_destroy(); ?>

</html>