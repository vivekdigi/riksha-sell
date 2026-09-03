<?php

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://rto-vehicle-details.p.rapidapi.com/api",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => json_encode([
		'vehicle_number' => 'MH02FB2727'
	]),
	CURLOPT_HTTPHEADER => [
		"Content-Type: application/json",
		"x-rapidapi-host: rto-vehicle-details.p.rapidapi.com",
		"x-rapidapi-key: 88c8b45fb4mshfe9bf9790078c4dp13c078jsna74172702017"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}?>