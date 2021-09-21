<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
error_reporting();
$_SESSION['status'] = 0;

$template = "./template.php";
if(file_exists($template))
    $message = file_get_contents($template);
else
    die("unable to lovate file");

if(isset($_POST['submitEmail']))
    {
        $cName = $_POST['sender_name'];
        $cEmail = $_POST['recipient'];
        $cSubject = $_POST['subject'];
        //$cAttachment = $_FILES['attachments']['name'];
        $cBody = $_POST['body'];
        $linksArr = array();
        $linksArr = $_POST['selectedLinks'];
        echo $linksArr; 
    
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail-> Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thewildvetcheckin@gmail.com';
        $mail->Password = '123@wildvet';
        $mail->SMTPSecure ='tls';
        $mail->Port = '587';
        $mail->setFrom('thewildvetcheckin@gmail.com','Wild Vet Reception - Links');
        $mail->addAddress($cEmail, $cName);
        $mail->isHTML(true);
        $mail->Subject = $cSubject; 
        $mail->Body = $message;
        
        try{
            $mail->send();
            $_SESSION['status'] = 1;
        }
        catch(Exception $e){
            echo "error" .$mail->ErrorInfo;
        }
        
    }
    if($_SESSION['status'] == 1){
        $snippet ="Yes";
        $id = $_POST['cid'];
        $conn = new mysqli('pk1l4ihepirw9fob.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'sn4abkagkvz8sd1n','nm85ad3jt3wpvxc6','xlx8er1i5yj6m7u4');
        $snippet ="Yes";
        $stmt = $conn->prepare("UPDATE clientinfo SET snippet = ? WHERE clientId = ?");
        $stmt->bind_param("si", $snippet, $id);
        $stmt->execute();
        header("Location: rSendsnippet.php");
    }
?>
<script>
    
</script>