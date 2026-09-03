<?php

// Replace 'live_xxx' with your actual API key from the API Sathi dashboard
$apiKey = "live_your_api_key_here"; // Or "test_your_api_key_here" for testing

// The RC number you want to verify
$rcNumber = "MP09CS3983";

$curl = curl_init();

$payload = json_encode([
    'rc_number' => $rcNumber
]);

curl_setopt_array($curl, [
    CURLOPT_URL => "https://apisathi.in/gw/v1/vehicle-rc-v1/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $payload,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "X-API-Key: " . $apiKey,
        "Idempotency-Key: " . uniqid() // Good practice for API Sathi
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo "HTTP Status Code: " . $httpcode . "\n\n";
    echo "Response:\n";
    
    // Pretty print the JSON response
    $decodedResponse = json_decode($response);
    if (json_last_error() === JSON_ERROR_NONE) {
        echo json_encode($decodedResponse, JSON_PRETTY_PRINT);
    } else {
        echo $response;
    }
}
?>
