<!-- Page where the clients enters their personal details -->
<?php session_start();
include('../includes/dbConn.php');
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
<style>
    .navbar-nav {
        border-radius: 15px;
    }

    .nav-item {
        text-align: center;
    }

    .nav-link {
        background-color: #f2f9ff;
        border-radius: 15px;
    }
</style>

<body style="background: url(&quot;assets/img/Home%20BG.jpg&quot;) top;">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean" style="height: 190px; background :transparent ;">
        <div class="container"><a class="navbar-brand font-monospace" href="#" style="font-size: 28px;">Wild Vet Check-In</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto" style="background:#8cc1bf;">
                    <li class="nav-item"><a class="nav-link font-monospace" href="services.php">Services</a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link font-monospace" href="contactUs.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">F.A.Q</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <form action="process.php" method="POST">
            <div>
                <div class="row">
                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;border-radius: 13px;border-color: rgb(231,173,169);"><select class="form-select-sm" style="width: 240px;height: 31px;border-radius: 13px;opacity: 0.85;border-color: rgb(231,173,169);" name="title" required="">
                            <option value="None Selected" selected="">Select your Title</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Mr">Mr</option>
                            <option value="Miss">Miss</option>
                            <option value="Ms">Ms</option>
                            <option value="Dr">Dr</option>
                        </select></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="First Name" data-placeholder="First Name" style="border-radius: 13px;width: 240px;opacity: 0.85;" name="firstName" required=""></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Surname" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="surName" required=""></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="tel" placeholder="Mobile Number" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="mobileNo" required="" maxlength="10" minlength="10"></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="tel" placeholder="Other Contact" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="othContact" minlength="10" maxlength="10" autocomplete="on"></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="email" placeholder="Email address" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="email" required=""></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Home Address" style="border-radius: 13px;border-color: rgb(231,173,169);width: 240px;opacity: 0.85;" name="address" required=""></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Suburb" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="suburb" required=""></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Postcode" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="postcode" required=""></div>
                </div>
                <div class="row">
                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 100px;"><button id="petdetails" class="btn btn-primary btn-sm font-monospace d-flex align-items-center" type="submit" name="toPetC" style="border-radius: 30px;background: rgb(157,126,207);height: 45px;width: 148px;opacity: 0.92;">Proceed to Pet Details</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <footer class="footer-basic" style="background:#f2f9ff; opacity:0.80;padding-top:20px ">
            <div class="d-xl-flex justify-content-xl-center align-items-xl-center social"><a class="d-xl-flex justify-content-xl-center align-items-xl-center" href="https://www.instagram.com/thewildvetclinic/"><i class="icon ion-social-instagram"></i></a><a href="https://www.facebook.com/thewildvetclinic/"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="services.php">Services</a></li>
                <li class="list-inline-item"><a href="contactUs.php">Contact-Us</a></li>
                <li class="list-inline-item"><a href="services.php">F.A.Q</a></li>
            </ul>
            <p class="copyright" style="color: rgb(40,33,33);">The Wild Vet© 2021</p>
        </footer>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>