<?php
include('conexion.php');
 
$correo=$_POST["correo"];
$contrasena=$_POST["contrasena"];
 
$success=0;
$status="Active";
$sql = "INSERT INTO  `usuarios` (`correo` ,`contrasena`) 
VALUES ('$correo','$contrasena')";
 
if(mysql_query($sql))
{
$success=1;
}
$response["success"]=$success;
die(json_encode($response));
mysql_close($con);
?>