<?php

include ("conexion.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Balones</title>
</head>

<body>
    <div class="container">
    <h1 class="text-center my-2">Gestionar balones</h1>
        <div class="row pt-3">
            <div class="col">
                <h3 class="text-center">Nuevo balón</h3>
                <form action="balones.php" method="POST" id="formularioBalones">
                    <div class="mb-2">
                        <label for="nombreBalon" class="form-label">Nombre</label>
                        <input type="text" class="form-control w-75" id="txtNombreBalon" name="txtNombreBalon" placeholder="Nombre del balón">
                    </div>
                    <div class="mb-2">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control w-75" id="txtPrecio" name="txtPrecio" placeholder="Precio del balón">
                    </div>
                    <div class="mb-2">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control w-75" id="txtColor" name="txtColor" placeholder="Color del balón">
                    </div>
                    <div class="mb-2">
                        <label for="idMarca" class="form-label mr-3">Marca</label>
                        <select name="idMarca" id="idMarca" required class="form mx-2">
                            <?php
                            $conn = conectar();
                            $sql = "SELECT * FROM marca";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $eleccion = $row['ID_MARCA']==$idMarca ? "selected" : "";
                                    echo "<option value='" . $row['ID_MARCA'] . "'>" . $row['NOMBRE_MARCA'] . "</option>";
                                }
                            }
                            ?>                           
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input placeholder="ID" type="number" name="txtCodigo" class="form-control w-25" id="txtCodigo">
                    </div>
                    <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
                    <button type="submit" name="btnActualizar" id="btnActualizar" class="btn btn-dark">Actualizar</button>
                    <button type="submit" name="btnEliminar" id="btnEliminar" class="btn btn-danger">Eliminar</button>
                </form>
                <?php
                include ("validarBalon.php");
                ?>
            </div>
            <div class="col">
                <h3 class="text-center">Listar balones</h3>
                <table class="table">
                    <thead>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Color</th>
                        <th scope="col">Marca</th>
                    </thead>
                    <tbody>
                        <?php
                        $conn = conectar();
                        $sql = "SELECT B.ID_BALON, B.NOMBRE_BALON, B.PRECIO, B.COLOR, M.NOMBRE_MARCA 
                        FROM BALON B INNER JOIN MARCA M ON B.ID_MARCA=M.ID_MARCA;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['ID_BALON'] . "</td>";
                                echo "<td>" . $row['NOMBRE_BALON'] . "</td>";
                                echo "<td>" . $row['PRECIO'] . "</td>";
                                echo "<td>" . $row['COLOR'] . "</td>";
                                echo "<td>" . $row['NOMBRE_MARCA'] . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>
    </div>

</body>

<?php
/*if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnGuardar'])) {
    $nombreBalon = $_POST['txtNombreBalon'];
    $precio = $_POST['txtPrecio'];
    $color = $_POST['txtColor'];
    $idMarca = $_POST['idMarca'];

    $conn = conectar();
    $sql = "INSERT INTO balon (ID_MARCA, NOMBRE_BALON, PRECIO, COLOR ) VALUES ($idMarca,'$nombreBalon', $precio, '$color')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro guardado";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}*/
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnActualizar'])) {
    $nombreBalon = $_POST['txtNombreBalon'];
    $precio = $_POST['txtPrecio'];
    $color = $_POST['txtColor'];
    //$idMarca = $_POST['idMarca'];
    $codigo = $_POST['txtCodigo'];

    $conn = conectar();
    $sql = "UPDATE balon SET NOMBRE_BALON='$nombreBalon', PRECIO=$precio, COLOR='$color' WHERE ID_BALON=$codigo";
    if ($conn->query($sql) === TRUE) {
        echo '<div class="text-bg-success text-center my-2 w-50" role="alert">Registro actualizado exitosamente!</div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if (isset($_POST['btnEliminar'])) {
    $nombreBalon = $_POST['txtNombreBalon'];
    $precio = $_POST['txtPrecio'];
    $color = $_POST['txtColor'];
    $codigo = $_POST['txtCodigo'];
    //$idMarca = $_POST['idMarca'];

    $conn = conectar();
    $sql = "DELETE FROM balon WHERE ID_BALON=$codigo";
    if ($conn->query($sql) === TRUE) {
        echo '<div class="text-bg-success text-center my-2 w-50" role="alert">Registro Eliminado exitosamente!</div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

</html>