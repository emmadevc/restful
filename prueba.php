<?php
$credentials = array( 
    "user" => "Subrogado", 
    "password" => "pruebas"
  );
  $data = array('systemRequest' =>$credentials , );
  $data =json_encode($data);
  
  $url="http://medicallife.sybi.mx/APIRest/Subrogados/public/login/access";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_ENCODING, "");
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
  curl_setopt($ch, CURLOPT_TIMEOUT, 0);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
  curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json" ));
  $response = curl_exec($ch);
  $err = curl_error($ch);
  curl_close($ch);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    //var_dump($response);
    echo $response;
  } 
  
?>