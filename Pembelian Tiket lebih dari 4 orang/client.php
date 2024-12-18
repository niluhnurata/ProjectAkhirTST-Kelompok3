<?php
$method = 'GET'; 
$url = 'http://localhost/rest/server.php/user?userId=123&numOfPeople=5&totalPrice=15000000';

$options = array (
    CURLOPT_CUSTOMREQUEST => $method,
    CURLOPT_URL => $url,
    CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false
);

$ch = curl_init();
curl_setopt_array($ch, $options);
$result = curl_exec($ch);

if(curl_errno($ch)) {
    $error_msg = curl_error($ch);
    echo "cURL Error: $error_msg";
} else {
    var_dump($result);
}

curl_close($ch);
?>
