<?php
if(!$_SESSION['loggedin']){
    $_SESSION['statusD'] = "Please log in to access the system";
    $_SESSION['status_codeD'] = "error";
    header("Location: receptionistLogin.php");
    exit();
}
?>