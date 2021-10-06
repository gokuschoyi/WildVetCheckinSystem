<?php
require_once('simple_html_dom.php');
    function returnBingTitleLinks($searchF){
        $arrayLinks = array();
        $arrayTitle = array();
        $start = "&first=";
        $bing = 'http://www.bing.com/search?q='.$searchF.$start;
        
        for($i=0;$i<2;$i++){
            $bing = $bing.$i."0";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_URL, $bing);
            curl_setopt($curl, CURLOPT_REFERER, $bing);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $str = null;
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

            $linkObjs = $htmlDom->find('li h2 a');
            
            foreach ($linkObjs as $linkObj) {
                $title = trim($linkObj->plaintext);
                $link  = trim($linkObj->href);

                if (!preg_match('/^https?/', $link) && preg_match('/q=(.+)&amp;sa=/U', $link, $matches) && preg_match('/^https?/', $matches[1])) {
                    $link = $matches[1];
                } else if (!preg_match('/^https?/', $link)) { // skip if it is not a valid link
                    continue;    
                }
                array_push($arrayTitle, $title);
                array_push($arrayLinks, $link);
            }
        }
        $it = new MultipleIterator();
        $it->attachIterator(new ArrayIterator($arrayTitle));
        $it->attachIterator(new ArrayIterator($arrayLinks));
        return $it;
    }
    
    function returnGoogleTitleLinks($searchF){
        $arrayLinks = array();
        $arrayTitle = array();
        $search = 'https://www.google.com/search?q=';
        $start = "&start=";
        $searchF = $search.$searchF.$start;

        for($i=0;$i<2;$i++){
        
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
        $it->attachIterator(new ArrayIterator($arrayTitle));
        $it->attachIterator(new ArrayIterator($arrayLinks));
        return $it;
    }
        
    

    $search = "Important+information+about+pet+medicine";
    $resultB = returnBingTitleLinks($search);
    $resultG = returnGoogleTitleLinks($search);

    /* echo "Bing".'<br>';
    foreach($resultB as $bresult){
    echo $bresult[0].'<br>';}
    echo '<br>';

    echo "Google".'<br>';
    echo $resultG;
    foreach($resultG as $gresult){
    echo $gresult[0].'<br>';} */

    if (($resultG == "0")&&($resultB == "0"))
    {
        echo "both dom not working retyr after some time";
    }
    else if($resultG == "0"){
        echo "Bing".'<br>';
        foreach ($resultB as $res){
            echo $res[0].'<br>';
            echo $res[1].'<br>';
        }
    }
    else if($resultB == "0"){
        echo "Google".'<br>';
        foreach ($resultG as $res){
            echo $res[0].'<br>';
            echo $res[1].'<br>';
        }
    }
    else 

?>