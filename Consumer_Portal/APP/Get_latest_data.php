<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "12080",
  CURLOPT_URL => "https://platform.iot.tatacommunications.com:12080/davc/m2m/HPE_IoT/9c65f9fffe218a69/default/latest",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/vnd.onem2m-res+json;",
    "authorization: Basic QzczNzczOTYwLWI5ZGZmMDlhOlRlc3RAMTIz",
    "cache-control: no-cache",
    "content-type: application/vnd.onem2m-res+json;ty=4;",
    "postman-token: 19824f5c-11dd-d74f-fa5a-7d94bfc37fa7",
    "x-m2m-origin: C73773960-b9dff09a",
    "x-m2m-ri: 9900001"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
