<?php
$patient = array( 
  "idPetition" => "61", 
  "card" => "", 
  "medicalUnit" => "Unidad Venustiano Carranza Arenal", 
  "name" => "Juan",
  "lastName" => "Perez",
  "lastNameM" => "Prado",
  "gender" => "Masculino",
  "dateBirth" => "1988-12-30",
  "stateBirth" => "CDMX",
  "cell" => "1234567890",
  "landline" => "1234567890",
  "email" => "prueba@prueba.com.mx",
  "rfc" => "0000000201",
  "scholarship" => "Secundaria",
  "maritalStatus" => "Soltero",
  "curp" => "123456789012345678",
  "postalCode" => "12345",
  "suburb" => "ADOLFO LOPEZ MATEOS",
  "municipality" => "Venustiano Carranza",
  "state" => "CIUDAD DE MEXICO",
  "street" => "DONATO MIRANDA FONSECA",   
  "extNumber" => "3004"     
);
$data = array('patient' => $patient);
$data =json_encode($data);

$url="";
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
