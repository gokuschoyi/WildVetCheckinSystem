<?php session_start();
    if(isset($_POST['search'])){
        $_SESSION['enteredEmail'] = $_POST['enteredEmail'];
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
</head>

<body style="border-style: none;height: 800px;background: url(&quot;assets/img/6677-3.jpg&quot;) center / auto;">
    <nav class="navbar navbar-light navbar-expand-md">
        <div class="container-fluid"><a class="navbar-brand" href="http://thewildvet.com.au/" style="font-size: 28px;">The Wild Vet</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="https://wildvet.ezyvet.com/external/portal/main/login" style="color: rgba(0, 0, 0, 0.9);">Sign-In</a></li>
                    <li class="nav-item"><a class="nav-link" href="contactUs.html" style="color: rgba(0, 0, 0, 0.9);">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.html" style="color: rgba(0, 0, 0, 0.9);">Services</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <h2 class="display-6 text-center d-flex align-items-center justify-content-lg-center justify-content-xl-center" style="font-family: 'Courier Prime', monospace;font-size: 33.4px;color: rgb(33,37,41);"><br><strong>Welcome to the Wild Vet Online Check-In</strong><br><br><br></h2>
    <div class="card-group">
        <div class="card" style="background: transparent;">
            <div class="card-body">
                <h3 class="font-monospace d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center card-title" style="opacity: 0.90;text-align: center;height: 45px;"><strong>Check-In with email</strong><br></h3>
                <div class="container" style="opacity: 1;">
                    <p class="lead text-center  d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="opacity: 1;background: transparent;height: 145px;font-family: 'Courier Prime', monospace;font-size: 16px;color: rgb(33, 37, 41);"><strong>If you have checked in before using this App, enter your email and click the submit button.</strong><br></p>
                </div>
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;"><input class="form-control-sm d-xl-flex justify-content-xl-center align-items-xl-center" type="email" placeholder="Enter your email" style="border-radius: 30px;width: 228px;" name=" enteredEmail" required=""></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 50px;"><button id = "checkinemail" class="btn btn-primary font-monospace d-xl-flex justify-content-xl-center align-items-xl-center" type="submit" name = "searchEmail" style="border-radius: 30px;height: 38px;background: rgb(160,120,227);">Submit</button>
                        <script type="text/javascript">
                            document.getElementById("checkinemail").onclick = function () {
                                location.href = "clientInfoEmail.php";
                            };
                        </script>
                    
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="background: transparent;">
            <div class="card-body" style="background: transparent;">
                <h3 class="font-monospace d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center card-title" style="opacity: 0.90;height: 45px;"><strong>Check-In</strong><br></h3>
                <p class="lead text-center d-flex justify-content-center align-items-center" style="background: transparent;color: rgb(33,37,41);font-size: 16px;height: 145px;font-family: 'Courier Prime', monospace;"><strong>If you are using the check-in app for the first time, click the Check-In button below</strong><br></p>
                <div class="col d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" style="height: 100px;"><button id = "checkin" class="btn btn-primary font-monospace d-md-flex justify-content-md-center align-items-md-center" type="submit" style="border-radius: 30px;background: rgb(160,120,227);">Check-In</button>
                    <script type="text/javascript">
                        document.getElementById("checkin").onclick = function () {
                            location.href = "clientInfo.php";
                        };
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" style="height: 60px;">
            <p></p>
        </div>
    </div>
    <div class="container">
        <footer class="footer-basic" style="background: transparent;">
            <div class="d-xl-flex justify-content-xl-center align-items-xl-center social"><a class="d-xl-flex justify-content-xl-center align-items-xl-center" href="https://www.instagram.com/thewildvetclinic/"><i class="icon ion-social-instagram"></i></a><a href="https://www.facebook.com/thewildvetclinic/"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="https://wildvet.ezyvet.com/external/portal/main/login">Sign-In</a></li>
                <li class="list-inline-item"><a href="contactUs.html">Contact</a></li>
                <li class="list-inline-item"><a href="services.html">Services</a></li>
            </ul>
            <p class="copyright" style="color: rgb(40,33,33);">The Wild Vet© 2021</p>
        </footer>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>