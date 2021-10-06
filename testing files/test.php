<?php
include "simple_html_dom.php";

$template = "./template.php";

if(file_exists($template))
    $message = file_get_contents($template);
else
    die("unable to locate file");
if(!$message)
echo "test";
$htmlDom = new DOMDocument;
@$htmlDom->loadHTML($message);
echo $htmlDom->saveHTML();

//$html = file_get_html($bing);
//echo $html;
/* for($i=0; $i<2; $i++){
    $links = "http://google.com";
    $inside = $htmlDom->getElementById('test');
    

    $div = $htmlDom->createElement("div");
    $div->setAttribute("class","justify-content: center;");
    $div->setAttribute("style"," height : 70px; display: flex; align-items: center; margin-left:35%; margin-right:35%; margin-top: 8px;");
    $div->setAttribute("id", $i);
    
    $link = $htmlDom->createElement("a");
    $link->setAttribute('href', $links);
    $link->setAttribute("class", "button");
    $link->setAttribute("style", "width : 150px; background-color: #b967c7; border: none; color: white; padding: 15px 15px; text-align: center; text-decoration: none; display: inline-block; font-size: 12px; margin: 4px 2px; cursor: pointer;");
    $link->textContent =("Go to Google");
    
    $div->appendChild($link);

    $inside->appendChild($div);

    
    
}
echo $htmlDom->saveHTML(); */

//echo $htmlDom->saveHTML();
//$search = 'https://www.google.com/search?q=';

/* $extractedLinks = array(); 
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
    

    echo $htmlDomt->saveHTML() .'<br>';
    
        
            echo '<br>';
            foreach($arrayLinks as $links)
            echo $links.'<br>'; 
            echo '<br>';
            foreach($arrayTitle as $title)
            echo $title.'<br>'; 
            
 */
?>