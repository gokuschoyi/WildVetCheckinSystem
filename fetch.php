<!DOCTYPE html>
<html>
    <?php
    include 'simple_html_dom.php';

    $link = 'https://www.wikihow.com/Care-for-a-Labrador-Retriever';
        //echo file_get_contents($link);
        /* $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_REFERER, $link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $str = curl_exec($curl);
        

        curl_close($curl);

        $htmlDom = new simple_html_dom();
        $htmlDom->load($str);
        echo $htmlDom; */
        
        date_default_timezone_set('Australia/ACT');
        $dateT = date("Y-m-d");
        $date = date_create($dateT);
        $DateF = date_format($date, 'Y-m-d');
        echo $DateF;
?>
    <!-- <iframe style = "height : 600px; width : 1100px;" src="<?php echo $str ?>"></iframe> -->
</html>