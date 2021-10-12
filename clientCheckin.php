<?php session_start();?>
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
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
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
<body style="background: url(&quot;assets/img/6677.jpg&quot;) center no-repeat;">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean" style="height: 150px;background: #c292fb;">
        <div class="container-fluid"><a class="navbar-brand" href="clientCheckin.php" style="font-size: 28px;">The Wild Vet Check-In</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto" style = "background:#c292fb;">
                    <li class="nav-item"><a class="nav-link" href="https://wildvet.ezyvet.com/external/portal/main/login" style="color: rgba(0, 0, 0, 0.9);">Sign-In</a></li>
                    <li class="nav-item"><a class="nav-link" href="contactUs.php" style="color: rgba(0, 0, 0, 0.9);">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php" style="color: rgba(0, 0, 0, 0.9);">Services</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <h2 class="display-6 text-center d-flex align-items-center justify-content-lg-center justify-content-xl-center" style="font-family: 'Courier Prime', monospace;font-size: 33.4px;color: rgb(33,37,41);"><br><strong>Welcome to the Wild Vet Online Check-In</strong><br><br><br></h2>
    
    
        <div class="card-body" style = "height : 280px;">
            <h3 class="font-monospace d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center card-title" style="opacity: 0.90;text-align: center;height: 45px;"><strong>Check-In with email</strong><br></h3>
            <div class="container" style="background-color:#dfebfb; opacity: 0.90; border-radius:20px; height : 100px; ">
                <p class="lead text-center  d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style=" opacity: 1;background: transparent;height: 85px;font-family: 'Courier Prime', monospace;font-size: 16px;color: rgb(33, 37, 41);"><strong>If you have checked in before using this App, enter your email and click the submit button.</strong><br></p>
            </div>
            <form action="process.php" method="POST"> 
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;">
                    <input class="form-control-sm d-xl-flex justify-content-xl-center align-items-xl-center" type="email" placeholder="Enter your email" style="border-radius: 30px;width: 228px;" name="enteredEmail" required=""></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;">
                        <button class="btn btn-primary font-monospace d-xl-flex justify-content-xl-center align-items-xl-center" type="submit" name="searchEmail" style="border-radius: 30px;height: 38px;background: rgb(160,120,227);">Submit</button>       
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body" style = "height : 280px; padding-bottom:30px;">
            <h3 class="font-monospace d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center card-title" style="opacity: 0.90;text-align: center;height: 45px;"><strong>Check-In with email</strong><br></h3>
            <div class="container" style="background-color:#dfebfb; opacity: 0.90; border-radius:20px; height : 100px; ">
                <p class="lead text-center  d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style=" opacity: 1;background: transparent;height: 85px;font-family: 'Courier Prime', monospace;font-size: 16px;color: rgb(33, 37, 41);"><strong>If you are using the check-in app for the first time, click the Check-In button below</strong><br></p>
            </div>
            <form action="clientInfo.php" method="POST"> 
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;">
                        <button id="checkinemail" class="btn btn-primary font-monospace d-xl-flex justify-content-xl-center align-items-xl-center" type="submit" name="searchEmail" style="border-radius: 30px;height: 38px;background: rgb(160,120,227);">Check-In</button>       
                    </div>
                </div>            
            </form>
        </div>
    
    
    <footer class="footer-basic" style="height: 150px; padding-top:30px;">
        <div class="d-xl-flex justify-content-xl-center align-items-xl-center social">
            <a class="d-xl-flex justify-content-xl-center align-items-xl-center" href="https://www.instagram.com/thewildvetclinic/">
                <i class="icon ion-social-instagram"></i></a><a href="https://www.facebook.com/thewildvetclinic/"><i class="icon ion-social-facebook"></i>
            </a>
        </div>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="https://wildvet.ezyvet.com/external/portal/main/login">Sign-In</a></li>
            <li class="list-inline-item"><a href="contactUs.html">Contact</a></li>
            <li class="list-inline-item"><a href="services.html">Services</a></li>
        </ul>
        <p class="copyright" style="font-size : 18px; font-weight: bold; padding-top:20px; color: rgb(40,33,33);">The Wild Vet© 2021</p>
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
                
            })
            </script>
            <?php unset($_SESSION['statusD']);
        }
    ?>
</body>

</html>