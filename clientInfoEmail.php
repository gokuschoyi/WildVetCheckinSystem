<?php session_start();
    $_SESSION["entEmail"] = $_SESSION['enteEmail'];
    $_SESSION["idEmail"] = $_SESSION["entEmail"];
    include_once 'includes/dbConn.php';
    //echo $_SESSION["entEmail"];
?>

<!DOCTYPE html>
<html lang="en">
<head></head>
<style>
.navbar-nav{
border-radius: 15px;
}
.nav-link{
    background-color:#f2f9ff;
    border-radius:15px;
}
.nav-item{
    text-align: center;
}
</style>
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
    <body style="background: url(&quot;assets/img/Home%20BG.jpg&quot;) top;">
        <nav class="navbar navbar-light navbar-expand-md navigation-clean" style="height: 190px; background :transparent ;">
            <div class="container"><a class="navbar-brand font-monospace" href="#" style="font-size: 28px;">Wild Vet Check-In</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav ms-auto" style = "background:#8cc1bf;">
                        <li class="nav-item"><a class="nav-link font-monospace" href="services.php">Services</a></li>
                        <li class="nav-item"><a class="nav-link font-monospace" href="contactUs.php">Contact Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="services.php">F.A.Q</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
        <?php
            if(isset($_SESSION["entEmail"]))
            {
                $query = "SELECT * FROM clientinfo where email = '$_SESSION[entEmail]' ORDER BY clientId DESC LIMIT 1 ";//change to prepared statement
                $query_run = mysqli_query($conn,$query);
                while($row = mysqli_fetch_array($query_run))
                {
                    ?>
                        <form action = "process.php" method = "POST">
                                <div class="row">
                                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Title" style="border-radius: 13px;width: 240px;opacity: 0.85;" name="title" value = "<?php echo $row["title"]?>" ></div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="First Name" style="border-radius: 13px;width: 240px;opacity: 0.85;" name="firstName" value = "<?php echo $row["firstName"]?>"  pattern="^[a-zA-Z0-9.-]*$" ></div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Surname" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="surName" value ="<?php echo $row["surName"]?>" ></div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Mobile Number" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="mobileNo" value ="<?php echo $row["mobileNo"]?>" ></div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Other Contact" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="othContact" value ="<?php echo $row["othContact"]?>" ></div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Email address" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="email" value ="<?php echo $row["email"]?>" ></div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Home Address" style="border-radius: 13px;border-color: rgb(231,173,169);width: 240px;opacity: 0.85;" name="address" value ="<?php echo $row["clientAddress"]?>" ></div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Suburb" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="suburb" value ="<?php echo $row["suburb"]?>" ></div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;"><input class="form-control-sm" type="text" placeholder="Postcode" style="border-radius: 13px;width: 240px;opacity: 0.85;border-width: 1px;border-color: rgb(231,173,169);" name="postcode" value ="<?php echo $row["postcode"]?>" ></div>
                                </div>
                                <div class="row">
                                    <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 100px;"><button id = "petdetails"class="btn btn-primary btn-sm font-monospace d-flex align-items-center" type="submit" name = "toPetE" style="border-radius: 30px;background: rgb(157,126,207);height: 45px;width: 148px;opacity: 0.92;">Proceed to Pet Details</button> </div>
                                </div>
                        </form>
                    <?php
                }
            }
        ?>
    </div>
    
        <div class="container">
        <footer class="footer-basic" style="background:#f2f9ff; opacity:0.80;padding-top:20px ">
            <div class="d-xl-flex justify-content-xl-center align-items-xl-center social"><a class="d-xl-flex justify-content-xl-center align-items-xl-center" href="https://www.instagram.com/thewildvetclinic/"><i class="icon ion-social-instagram"></i></a><a href="https://www.facebook.com/thewildvetclinic/"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="services.php">Services</a></li>
                <li class="list-inline-item"><a href="contactUs.php">Contact-Us</a></li>
                <li class="list-inline-item"><a href="services.php">F.A.Q</a></li>
            </ul>
            <p class="copyright" style="font-size : 18px; font-weight: bold; color: rgb(40,33,33);">The Wild Vet© 2021</p>
        </footer>
    </div>
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
<!-- <div class="container"style = "background:#8cc1bf;"> -->