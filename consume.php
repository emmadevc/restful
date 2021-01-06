<?php
    $url = "localhost/rest/";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    $resp = curl_exec($ch);
    if($e = curl_error($ch)){
        echo $e;
    }
    else{
        $decoded = jason_decode($resp);

    }
    curl_close($ch);
?>