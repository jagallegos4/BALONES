<?php

include ("conexion.php");

if (isset($_POST['btnGuardar'])) {
    $codigo = $_POST['txtCodigo'];
    $nombre = $_POST['txtNombreMarca'];
    $pais = $_POST['txtPais'];
    $conn = conectar();
    $sql = "INSERT INTO marca (NOMBRE_MARCA, PAIS_ORIGEN) VALUES ('$nombre', '$pais')";
    $sql_validar = "SELECT * FROM marca WHERE NOMBRE_MARCA = '$nombre'";
    $validar = $conn->query($sql_validar);
    if ($validar->num_rows > 0) {
        echo '<div class="text-bg-danger text-center my-2" role="alert">La Marca ya existe</div>';
    } else {
        if ($conn->query($sql) === TRUE) {
            echo '<div class="text-bg-success text-center my-2" role="alert">Registro Guardado exitosamente!</div>';
        } else {
            echo '<div class="text-bg-danger text-center my-2" role="alert">ERROR</div>';
        }
    }
}
