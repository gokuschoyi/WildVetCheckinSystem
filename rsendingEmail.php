<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once 'includes/dbConn.php';
include "simple_html_dom.php";
require 'allVendor/autoload.php';
//error_reporting();
$_SESSION['status'] = 0;

$template = "./template.php";
if (file_exists($template))
    $message = file_get_contents($template);
else
    die("unable to locate file");

if (isset($_POST['submitEmail'])) {
    $selectedCount = $_POST['selectedCount'];
    $selectedLinks = $_POST['selected'];
}


function addExtraLinks($count, $message, $sLinks)
{
    $htmlDom = new DOMDocument;
    @$htmlDom->loadHTML($message);
    for ($i = 0; $i < $count; $i++) {
        $links = "";
        $pieces = explode("\n", $sLinks);
        $links = substr($pieces[$i], 0, -1);
        $inside = $htmlDom->getElementById('test');

        $div = $htmlDom->createElement("div");
        $div->setAttribute("class", "justify-content: center;");
        $div->setAttribute("style", " height : 70px; display: flex; align-items: center; margin-left:35%; margin-right:35%; margin-top: 8px;");
        $div->setAttribute("id", $i);

        $link = $htmlDom->createElement("a");
        $link->setAttribute('href', $links);
        $link->setAttribute("class", "button");
        $link->setAttribute("style", "width : 150px; background-color: #b967c7; border: none; color: white; padding: 15px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;");
        $link->textContent = ("Go to Google");

        $div->appendChild($link);

        $inside->appendChild($div);
    }
    return $htmlDom->saveHTML();
}

$msg = addExtraLinks($selectedCount, $message, $selectedLinks);

if (isset($_POST['submitEmail'])) {
    $cName = $_POST['sender_name'];
    $cEmail = $_POST['recipient'];
    $cSubject = $_POST['subject'];
    //$cAttachment = $_FILES['attachments']['name'];
    $cBody = $msg;

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'thewildvetcheckin@gmail.com';
    $mail->Password = '123@wildvet';
    $mail->SMTPSecure = 'tls';
    $mail->Port = '587';
    $mail->setFrom('thewildvetcheckin@gmail.com', 'Wild Vet Reception - Links');
    $mail->addAddress($cEmail, $cName);
    $mail->isHTML(true);
    $mail->Subject = $cSubject;
    $mail->Body = $cBody;

    try {
        $mail->send();
        $_SESSION['status'] = 1;
    } catch (Exception $e) {
        echo "error" . $mail->ErrorInfo;
    }
}

if ($_SESSION['status'] == 1) {
    $id = $_POST['cid'];
    $snippet = "Yes";
    $stmt = $conn->prepare("UPDATE clientinfo SET snippet = ? WHERE clientId = ?");
    $stmt->bind_param("si", $snippet, $id);
    $stmt->execute();
    header("Location: rSendsnippet.php");
}
?>