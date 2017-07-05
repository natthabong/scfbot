<?php
$access_token = 'r4RxGKfhv01GPAAq6YXMOZte/cJsiLF3nAmWoXFbhmbODyuVPnp1AC01soF3dBQ6x88MGijebWpDJv/nJE4rK86vbCimPjK1/F1KsdkiH9ws1kbwBlkgfn6Xr/m//GxMjOD9ZZdr67vrwQv51JUz6QdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;