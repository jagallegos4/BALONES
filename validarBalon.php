<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnGuardar'])) {
    $nombreBalon = $_POST['txtNombreBalon'];
    $precio = $_POST['txtPrecio'];
    $color = $_POST['txtColor'];
    $idMarca = $_POST['idMarca'];

    $conn = conectar();
    $sql = "INSERT INTO balon (ID_MARCA, NOMBRE_BALON, PRECIO, COLOR ) VALUES ($idMarca,'$nombreBalon', $precio, '$color')";
    
    $sql_validar = "SELECT * FROM balon WHERE NOMBRE_BALON = '$nombreBalon'";
    $validar = $conn->query($sql_validar);
    if ($validar->num_rows > 0) {
        echo '<div class="text-bg-danger text-center my-2" role="alert">El balón ya existe</div>';
    } else {
        if ($conn->query($sql) === TRUE) {
            echo '<div class="text-bg-success text-center my-2" role="alert">Registro Guardado exitosamente!</div>';
        } else {
            echo '<div class="text-bg-danger text-center my-2" role="alert">ERROR</div>';
        }
    }
}
?>