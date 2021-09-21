<?php
include "simple_html_dom.php";
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$searchLink = 'https://www.google.com/search?q=it+jobs';
$html = file_get_contents($searchLink);
$htmlDom = new DOMDocument;
@$htmlDom->loadHTML($html);
//echo $htmlDom->saveHTML();

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
            $cutRes = substr($linkHref, 15, $count-15);
            
        }

        echo $count;
        echo $cutRes . '<br>'; 
            //echo $linkHref . '<br>';
    }
    //echo searchString();
}
$arrayLinks = array();
$arrayTitle = array();
    for($i=1;$i<=3;$i++){
        
        if($i==1){
        $str = "https://www.google.co.in/search?q=Male+Entire+rajapalaya+Canine+Dentstry";
        $html = file_get_html($str);
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
                            echo $cutRes .'<br>';
                            array_push($arrayLinks,$cutRes);
                        }
                }
                echo $title->innertext;
                array_push($arrayTitle,$title);
            }
        }   
        }
        if($i ==2){
        $str = "https://www.google.co.in/search?q=Male+Entire+rajapalaya+Canine+Dentstry&start=10";
        $html = file_get_html($str);
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
                            echo $cutRes .'<br>';
                            array_push($arrayLinks,$cutRes);
                        }
                }
                echo $title->innertext;
                array_push($arrayTitle,$title);
            }
        }   
        }
        if($i==3){
            $str = "https://pelaqitapersians.com/persian-cat-care-and-nail-trimming/";
        $html = file_get_html($str);
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
                            echo $cutRes .'<br>';
                            array_push($arrayLinks,$cutRes);
                        }
                }
                echo $title->innertext;
                array_push($arrayTitle,$title);
            }
        }   
        }
    }
    

    
        
            echo '<br>';
            foreach($arrayLinks as $links)
            echo $links.'<br>'; 
            echo '<br>';
            foreach($arrayTitle as $title)
            echo $title.'<br>'; 
            

?>