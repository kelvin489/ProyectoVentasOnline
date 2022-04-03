<?php
$host="localhost";
$bd="vent";
$usuario="root";
$contrasenia="";
try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
?>
