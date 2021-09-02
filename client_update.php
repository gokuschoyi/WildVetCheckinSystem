<?php

$conn = new mysqli('localhost', 'root','','wildvetcheckinsystem');
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
        $u_mcdate = $_POST['mcdate'];


        $query = $conn->prepare("UPDATE clientinfo SET mobileNo = ?, othContact = ?, email = ?, clientAddress =  ?, suburb = ?, postcode = ? WHERE clientId = ?");
        $query->bind_param("iisssii",$u_mobile, $u_othContact, $u_email, $u_address, $u_suburb, $u_postcode, $u_id);
        $query->execute();

        $query2 = $conn->prepare("UPDATE petinfo SET petName = ?, petType = ?, breed = ?, sex = ?, color = ?, age = ?, petWeight = ?, microchip = ?, insurance = ?, medication = ?, parasiteControl = ?, mcDate = ? WHERE petKey = ? ");
        $query2->bind_param("sssssiissssii",$u_petname, $u_pettype, $u_breed, $u_sex, $u_color, $u_age, $u_weight, $u_microchip, $u_insurance, $u_medication, $u_parasiteC, $u_mcdate, $u_id);
        $query2->execute();
        header("Location: rToday.php");
    }
            
?> 