<?php
// ------funcion para conectarse a la bdd -------
function conectar(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bd_balones";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed : " . $conn->connect_error);
    }
    //echo "Conexion satisfactoria";
    return $conn;
}

?>