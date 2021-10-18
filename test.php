<?php
include 'Receptionist/simple_html_dom.php';
function returnGoogleTitleLinks($searchF){
    $arrayLinks = array();
    $arrayTitle = array();
    $search = 'https://www.google.com/search?q=';
    $start = "&start=";
    $searchF = $search.$searchF.$start;

    for($i=0;$i<4;$i++){
    
        $searchF = $searchF.$i."0";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $searchF);
        curl_setopt($curl, CURLOPT_REFERER, $searchF);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $str = curl_exec($curl);
        curl_close($curl);
        try {
            if($str == null)
            {
                throw new exception("0");
            }
        }
        catch (exception $e){
            return $e->getMessage();
        }

        $htmlDom = new simple_html_dom();
        $htmlDom->load($str);
        echo '<br>';
        foreach($htmlDom->find("div.kCrYT") as $h){
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
                    array_push($arrayLinks,$cutRes);
                }
            } 
            foreach($h->find("h3.zBAuLc") as $title){
                $title->find('.BNeawe UPmit AP7Wnd');
                array_push($arrayTitle, $title->plaintext); 
            }
        }   
    }
    $it = new MultipleIterator();
    $it->attachIterator(new ArrayIterator($arrayLinks));
    $it->attachIterator(new ArrayIterator($arrayTitle));
    return $it;
} 
$vlal = ReturnGoogleTitleLinks("dog+breeds");
foreach ($vlal as $val){
    echo $val[0]."<br>";
}
?>