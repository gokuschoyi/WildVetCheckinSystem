<!-- checks if the receptioist 'loggedin' session is set or not If it is set user has access else redirects to login page --> 
<?php
if(!$_SESSION['loggedin']){
    $_SESSION['statusD'] = "Please log in to access the system";
    $_SESSION['status_codeD'] = "error";
    $_SESSION['msg'] = "";
    header("Location: receptionistLogin.php");
    exit();
}
?>