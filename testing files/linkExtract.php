<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://tldrthis.p.rapidapi.com/v1/model/abstractive/summarize-url/",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "{\r
    \"url\": \"https://www.lovingyourlab.com/9-common-labrador-behavior-problems/\",\r
    \"min_length\": 100,\r
    \"max_length\": 300,\r
    \"is_detailed\": false\r
}",
	CURLOPT_HTTPHEADER => [
		"content-type: application/json",
		"x-rapidapi-host: tldrthis.p.rapidapi.com",
		"x-rapidapi-key: 2898a18e8cmshba658a8bb9ac788p1c20acjsn1a83bb393ad8"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}