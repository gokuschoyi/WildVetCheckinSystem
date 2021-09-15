<?php
include "simple_html_dom.php";
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
$searchLink = 'https://www.google.co.in/search?q=how+to+get+title+from+simple+dom+parser';
$html = file_get_contents($searchLink);
$htmlDom = new DOMDocument;
@$htmlDom->loadHTML($html);
$link1 = $htmlDom->getElementsByTagName('a');
$extractedLinks = array();
foreach($link1 as $link){
    $linkHref = $link->getAttribute('href');
    if(strlen(trim($linkHref)) == 0){
        continue;
    }
    if($linkHref[1] == 'u')
    {
        $count = 0;
        $cutRes = "";
        while($linkHref[$count] != '&')
        {
            $count++;
            $cutRes = substr($linkHref, 7, $count-7);
            
        }

        echo $count;
        echo $cutRes . '<br>'; 
            //echo $linkHref . '<br>';
    }
    //echo searchString();
}

$html = file_get_html("https://www.google.co.in/search?q=Male+Entire+rajapalaya+Canine+Dentstry");
//echo $html;
echo '<br>';
foreach($html->find("div.kCrYT") as $h){
    foreach($h->find("h3.zBAuLc") as $title){
        foreach($h->find('a[href^=/url?q]') as $links){
            $li = $links->getAttribute('href');
            if(strlen(trim($li)) == 0){
                continue;
                }
                if($li[1] == 'u'){
                    $count = 0;
                    $cutRes = "";
                    while($li[$count] != '&'){
                        $count++;
                        $cutRes = substr($li, 7, $count-7);
                        }
                    echo $cutRes .'<br>';}
                }
    echo $title->innertext;}
}
echo '<br>';
echo $html;
echo '<br>';
$mail = new PHPMailer();
        $mail->IsSMTP();
        $mail-> Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thewildvetcheckin@gmail.com';
        $mail->Password = '123@wildvet';
        $mail->SMTPSecure ='tls';
        $mail->Port = '587';
        $mail->setFrom('thewildvetcheckin@gmail.com','Wild Vet');
        $mail->addAddress('gokulsangamitrachoyi@gmail.com','Gokul');
        $mail->isHTML(true);
        $mail->Subject = "Checkin Information Test Server"; 
        $mail->Body = "<p>Thank you for checking in with us. Attached is a pdf document containig your information. See you soon.</p>";
        $mail->AddAttachment($filepath);
        if(!$mail->send()){
        echo 'something went wrong';
        echo'Mailer Error : ' .$mail->ErrorInfo;
        }
        //email attachment remaining
        else
        echo ' Mail sent Success';
            $mail->smtpClose();
            header("Location: thankYou.php"); 
?>