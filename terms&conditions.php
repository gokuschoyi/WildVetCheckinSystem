<?php
session_start();
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Courier+Prime:400,400i,700,700i&amp;subset=latin-ext&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=GFS+Neohellenic&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Features-Blue.css">
    <link rel="stylesheet" href="assets/css/Features-Boxed.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="allVendor/sweetalert2/dist/sweetalert2.min.css">
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
<body style="background: url(&quot;assets/img/6677.jpg&quot;) center no-repeat;">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean" style="height: 150px;background: #c292fb;">
        <div class="container"><a class="navbar-brand font-monospace" href="index.php" style="font-size: 35px;">The Wild Vet</a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1">
                <span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto" style = "background:#c292fb;">
                    <li class="nav-item"><a class="nav-link font-monospace" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link font-monospace" href="#">Services</a></li>
                    <li class="nav-item"><a class="nav-link font-monospace" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link font-monospace" href="#">Terms & Conditions</a></li>
                    <li class="nav-item"><a class="nav-link font-monospace" href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class = "example">
            <div class="col-md-12 d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style = 'width :100px; padding-left : 45px;'>
                <img src="assets\img\logo.png" style="height: 80px;">
            </div>
            </div>
        </div>
    </nav>
    <h4 class="font-monospace text-center d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 133px;font-weight: bold;opacity: 0.85;font-size: 28px;">Terms and Conditions</h4>
    <div class="d-flex d-lg-flex d-xl-flex justify-content-center align-items-start justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="height: 570px;">
    
        <div class="row" style = "background-color:azure; opacity:0.9;">
            <div class="col d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center">
                <p class="font-monospace text-center d-flex d-md-flex justify-content-center align-items-center justify-content-md-center align-items-md-center" style="font-size: 14px;color: rgb(109,134,163);width: 550px;">
                The information contained in this document is subject to change without notice. The vendor assumes no accountability or liability for any errors that may appear in this document. 
                No warranty or representation, either expressed or implied, is made regarding the quality, accuracy, or fitness of any part of this document. The manufacturer shall not be liable for any direct, indirect, special, incidental, or consequential damages arising from any defect or error in this document or product. Product names appearing in this document are for identification purposes only. 
                Trademarks and product or brand names appearing in this document are the property of their respective owners.  
                Copyright on all material and all intellectual property residing in material in this document, including (but not limited to) graphics, book titles, text, layout, logos, trademarks, and samples is owned by Wild Vet and La Trobe University unless otherwise indicated. No reproduction, modification, translation, transmission, distribution, or use for commercial purposes of this document without written approval from Wild Vet and La Trobe University. 
                This document contains material protected under International Copyright Laws. All rights reserved. 
                These terms are subject to the conditions prescribed under the Australian Copyright Act 1968</p>
            </div>
        </div>
    
    </div>
    <footer class="footer-basic" style="height: 130px; padding-top:30px;">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="index.php">Home</a></li>
            <li class="list-inline-item"><a href="about.php">About</a></li>
            <li class="list-inline-item"><a href="terms&conditions.php">Terms & Conditions</a></li>
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
        </ul>
        <p class="copyright">The Wild Vet © 2021</p>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="allVendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <?php
        if((isset($_SESSION['statusD']) && $_SESSION['statusD']) !='')
        {
            ?>
            <script>
                Swal.fire({
                icon: '<?php echo $_SESSION['status_codeD']?>',
                title: '<?php echo $_SESSION['statusD']?>',
                html: '<b><?php echo $_SESSION['msg']?></b>',
            })
            </script>
            <?php unset($_SESSION['statusD']);
        }
    ?>
</body>

</html>