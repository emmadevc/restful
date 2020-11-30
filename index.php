<?php
include "config.php";
include "utils.php";
header('Content-Type: application/json; charset=utf-8;');
$dbConn =  connect($db);

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['CURP']))
    {
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT 
      ID_TARJETA
      , UNIDAD_MEDICA
      , NOMBRE
      , APELLIDO_PATERNO
      , APELLIDO_MATERNO
      , GENERO
      , FECHA_DE_NACIMIENTO
      , EDAD
      , ESTADO_DE_NACIMIENTO
      , TELEFONO_FIJO
      , TELEFONO_CELULAR
      , EMAIL
      , RFC
      , ESCOLARIDAD
      , CURP
      , CODIGO_POSTAL
      , COLONIA
      , MUNICIPIO
      , ESTADO
      , CALLE
      , NUMERO_EXT
      , FECHA_VISITADO
      , FECHA_ASIGNADO 
      FROM beneficiarios 
      WHERE CURP=:id
      LIMIT 1");
      $sql->bindValue(':id', $_GET['CURP']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC),JSON_UNESCAPED_UNICODE   );
      exit();
	  }
    else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT 
      ID_TARJETA
      , UNIDAD_MEDICA
      , NOMBRE
      , APELLIDO_PATERNO
      , APELLIDO_MATERNO
      , GENERO
      , FECHA_DE_NACIMIENTO
      , EDAD
      , ESTADO_DE_NACIMIENTO
      , TELEFONO_FIJO
      , TELEFONO_CELULAR
      , EMAIL
      , RFC
      , ESCOLARIDAD
      , CURP
      , CODIGO_POSTAL
      , COLONIA
      , MUNICIPIO
      , ESTADO
      , CALLE
      , NUMERO_EXT
      , FECHA_VISITADO
      , FECHA_ASIGNADO 
      FROM beneficiarios");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll(),JSON_UNESCAPED_UNICODE  );
      exit();
	}
}

// Crear un nuevo post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;
    $sql = "INSERT INTO posts
          (title, status, content, user_id)
          VALUES
          (:title, :status, :content, :user_id)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $postId = $dbConn->lastInsertId();
    if($postId)
    {
      $input['id'] = $postId;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
	 }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	$id = $_GET['id'];
  $statement = $dbConn->prepare("DELETE FROM posts where id=:id");
  $statement->bindValue(':id', $id);
  $statement->execute();
	header("HTTP/1.1 200 OK");
	exit();
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    $postId = $input['CURP'];
    $fields = getParams($input);

    $sql = "UPDATE beneficiarios
          SET $fields
          WHERE CURP='$postId'
           ";

    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>