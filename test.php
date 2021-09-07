<?php
$searchLink = 'https://www.google.co.in/search?q=dji+mavic+3';
$html = file_get_contents($searchLink);
$htmlDom = new DOMDocument;
@$htmlDom->loadHTML($html);
$links = $htmlDom->getElementsByTagName('a');
$extractedLinks = array();
foreach($links as $link){
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
echo searchString();

function searchString(){
    $str1 = "gokul";
    $str2 = "choyi";
    $str3 = $str1." ".$str2;
    $str4 = str_replace(' ', '+',$str3);
    echo $str4;

}

?>

