<?php session_start();
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
        <form action="process.php?>" method="POST">
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;">
                    <select class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center" style="width: 240px;height: 33px;border-radius: 13px;border-width: 1px;border-color: rgb(231,173,169);opacity: 0.85;" name="reason" required="">
                        <option value="General" selected="">Select one option *</option>
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
                    </select>
                    <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Reason for your visit today. If you are not sure leave it as it is.">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Pet Name *"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169); opacity: 0.85;"
                        name="petName" required="" autocomplete="on">
                        <div class="bd-example tooltip-demo">
                            <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Enter your pet name.">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                                </svg>
                            </a>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><select
                        class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center"
                        style="width: 240px;height: 33px;border-radius: 13px;border-width: 1px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="petType" required="">
                        <option value="No Pet Selected" selected="">Select type of pet *</option>
                        <option value="Canine">Canine</option>
                        <option value="Feline">Feline</option>
                        <option value="Reptile">Reptile</option>
                        <option value="Avian">Avian</option>
                        <option value="Amphibian">Amphibian</option>
                        <option value="Rabbit">Rabbit</option>
                        <option value="Rodent">Rodent</option>
                        <option value="Ferret">Ferret</option>
                    </select>
                    <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Select the type of your pet">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Breed *"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="breed" required="" autocomplete="on">
                        <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Select the breed of your pet.">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><select
                        class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center"
                        style="width: 240px;border-radius: 13px;height: 31px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="sex" required="">
                        <option value="None Selected" selected="">Select sex *</option>
                        <option value="Male Entire">Male Entire</option>
                        <option value="Male Neutered">Male Neutered</option>
                        <option value="Female Entire">Female Entire</option>
                        <option value="Female Spayed">Female Spayed</option>
                        <option value="Unknown">Unknown</option>
                    </select>
                    <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Select the sex of your pet.">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Color"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="color"  autocomplete="on">
                        <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="What color is your pet?">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Age *"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="age" required="" autocomplete="on">
                        <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Enter age">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Weight (Kg) *"
                        style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="petWeight" required="" autocomplete="on">
                        <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Enter your pet's weight.">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><select
                        class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center"
                        style="width: 240px;border-radius: 13px;height: 31px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="microchip" required="">
                        <option value="None Selected" selected="">Microchip *</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Yes if your pet is microchipped.">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><select
                        class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center"
                        style="width: 240px;border-radius: 13px;height: 31px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="insurance" required="">
                        <option value="None Selected" selected="">Insurance *</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Yes if you have pet insurance.">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><input
                        class="form-control-sm d-lg-flex justify-content-lg-center align-items-lg-center" type="text"
                        placeholder="Medication (If Any)"
                        style="border-radius: 13px;width: 240px;border-width: 1px; opacity: 0.85; border-color: rgb(231,173,169);width: 240px;" name="medication"
                        autocomplete="on">
                        <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Give the name of any medication your pet is on, if any.">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 50px;"><select onchange="mcyesno(this);"
                        class="form-select-sm d-lg-flex justify-content-lg-center align-items-lg-center"
                        style="width: 240px;border-radius: 13px;height: 31px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="parasiteControl" required="">
                        <option value="No" selected="">Parasite Control *</option>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                    <div class="bd-example tooltip-demo">
                        <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Has your pet taken any parasite control medication?">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row" id ="date">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center" style="height: 50px;">
                <input class="datepicker" type="text" style="border-radius: 13px;width: 240px;border-width: 1px;border-color: rgb(231,173,169);opacity: 0.85;"
                        name="mcDate" placeholder=" Select date">
                        <div class="bd-example tooltip-demo">
                            <a href="#" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="right" title="Select the date of parasite contol.">
                                <svg src="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="30" fill="#e35fe5"/>
                                </svg>
                            </a>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col d-flex d-lg-flex justify-content-center align-items-center justify-content-lg-center align-items-lg-center"
                    style="height: 34px;"><button id="petDetails"
                        class="btn btn-primary btn-sm font-monospace d-flex justify-content-center align-items-center"
                        type="submit" name="submitPet" 
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
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js.map"></script>
    <script src="assets/js/all.min.css"></script>
<script>
    $(document).ready(function () {
        var today = new Date();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose:true,
            endDate: "today",
            maxDate: today
        }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });


        $('.datepicker').keyup(function () {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9^-]/g, '');
            }
        });
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    function mcyesno(that){
        if(that.value == "Yes"){
            document.getElementById("date").style.display = "block";
        }
        else{
            document.getElementById("date").defaultValue = "";
            document.getElementById("date").style.display = "none";
        }
    }

</script>
</body>

</html>