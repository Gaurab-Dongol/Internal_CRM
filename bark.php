<?php
// SET YOUR CLIENT ID AND SECRET
$CLIENT_ID = '60cbec057555c6959626';
$CLIENT_SECRET = '19038a41-cfce-11eb-912b-0aba04bea550';
// REQUEST AN ACCESS TOKEN
$params = array(
'grant_type' => 'client_credentials',
'client_id' => $CLIENT_ID,
'client_secret' => $CLIENT_SECRET
);

$url = 'https://api.bark.com/oauth/token';
$options = array(
'http' => array(
'header' => "Content-type: application/x-www-form-urlencoded\r\n",
'method' => 'GET',
'content' => http_build_query($params)
)
);

$context = stream_context_create($options);
$result = json_decode(file_get_contents($url, false, $context));
// SET THE AUTHORIZATION HEADERS
$headers = array(
"Content-Type: application/x-www-form-urlencoded",
"Accept: application/vnd.bark.pub_v1+json",
"Authorization: Bearer" . $result->access_token
);

// GET A LIST OF BARKS IN YOUR SERVICE AREAS
$url = 'https://api.bark.com/seller/barks';
$options = array(
'http' => array(
'header' => implode("\r\n", $headers),
'method' => 'GET'
)
);

$context = stream_context_create($options);
$result = json_decode(file_get_contents($url, false, $context));
foreach ($result->data->items as $bark) {
// PURCHASE AND RESPOND TO EACH BARK
echo "Responding to " . $bark->metadata->category->name . " in " .
$bark->metadata->location->name . PHP_EOL;
$params = array(
'bark_id' => $bark->id
);

$url = 'https://api.bark.com/seller/bark/' . $bark->id . '/purchase';
$options = array(
'http' => array(
'header' => implode("\r\n", $headers),
'method' => 'POST',
'content' => http_build_query($params)
)
);

$context = stream_context_create($options, $params);
$response = json_decode(file_get_contents($url, false, $context));
// PRINT THE BUYER INFORMATION
var_dump($response->buyerInfo);
// object(stdClass) {
// ["email"]=>
// string(29) "something@somewhere.com"
// ["name"]=>
// string(5) "Their Name"
// ["tel"]=>
// string(11) "012345678901"
// }
}