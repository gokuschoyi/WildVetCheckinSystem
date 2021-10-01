<?php
// PHP program to illustrate date_sub() function
// // Subtract 5 days from the 25th of June, 2018
date_default_timezone_set('Australia/ACT');
$dateT = date("Y-m-d");
$date = date_create($dateT);
date_sub($date, date_interval_create_from_date_string('30 days'));
$DateF = date_format($date, 'Y-m-d');
echo $DateF;
?>