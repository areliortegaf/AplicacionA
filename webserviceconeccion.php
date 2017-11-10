<?php
$baseDatos = 'aplicacionandroid';
$consulta = 'select * from usuarios';
if (isset($_GET['correo']) && isset($_GET['contrasena'])) {
    $usuario = $_GET['correo'];
    $contrasena = $_GET['contrasena'];
    // Validar credenciales.
    if ('areli' != $usuario || '123' != $contrasena) {
        die('Las credenciales son invalidas');
    }
    // Conexion con la base de datos.
    $link = mysql_connect('localhost', 'root', '') or die('No se puede conectar con la bd!');
    mysql_select_db($baseDatos, $link) or die('La base de datos no existe!');
    // Se ejecuta la consulta.
    $resultados = mysql_query($consulta, $link) or die('Error al ejecutar: ' . $query);
    // Se crea el arreglo de json.
    $json = array();
    if(mysql_num_rows($resultados)) {
        while($resultado = mysql_fetch_assoc($resultados)) {
            $json[] = array(
                'id' => $resultado['id'],
                'correo' => $resultado['correo'],
                'contrasena' => $resultado['contrasena']
            );
        }
    }
    // Se envia el json.
    header('Content-type: application/json');
    echo json_encode($json);
} else {
    die('Ingresa tus credenciales');
}