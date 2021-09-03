<?php
include('simple_html_dom.php');
$array = array();
    if(isset($_POST['search'])){
       $curl = curl_init();
       curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/search?q=2+year+old+labrador');
       curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       $result = curl_exec($curl);
        curl_close($curl);
        //echo $result;

        $domResult = new simple_html_dom();
        $domResult->load($result);

        foreach($domResult->find('a[href^=/url?]') as $link)
        array_push($array,$link->plaintext);
        
            }
            foreach($array as $lnk)

            echo $lnk. '<br>';
            var_dump($array);


?>
