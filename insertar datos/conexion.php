<?php
    
    $dbhost = 'sweetdev.net';
    $dbuser = 'root';
    $dbpass = '';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);    
    if(!$conn) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db('aplicacionandroid');
?>