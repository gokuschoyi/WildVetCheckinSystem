<?php
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

$link1 = $htmlDom->getElementsByTagName('a');
$extractedLinks1 = array();
foreach($link1 as $lnk){
    $linkHref = $lnk->getAttribute('h3 class');
       echo $linkHref . '<br>';
    }
    





?>

