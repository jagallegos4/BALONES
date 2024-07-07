<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>MARCAS</title>
</head>

<body>
    <div class="container">
        <h1 class="text-center">MARCAS</h1>
        <div class="row pt-3" >
            <div class="col">
                <h2>Gestionar marca</h2>
                <form action="marca.php" method="POST" id="formularioMarcas">
                    <div class="mb-3">
                        <label for="nombreMarca" class="form-label"><h5>Nombre</h5></label>
                        <input type="text" class="form-control" id="txtNombreMarca" name="txtNombreMarca" placeholder="Nombre de la marca">
                    </div>
                    <div class="mb-3">
                        <label for="pais" class="form-label"><h5>País de Origen</h5></label>
                        <input type="text" class="form-control" id="txtPais" name="txtPais" placeholder="País de origen">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><h5>ID</h5></label>
                        <input placeholder="Al guardar no ingrese nada" type="number" name="txtCodigo" class="form-control" id="txtCodigo">
                    </div>
                    <button type="submit" name="btnGuardar" class="btn btn-primary">Guardar</button>
                    <button type="submit" name="btnActualizar" id="btnActualizar" class="btn btn-dark">Actualizar</button>
                    <button type="submit" name="btnEliminar" id="btnEliminar" class="btn btn-danger">Eliminar</button>
                    <?php
                    include ("validarMarca.php");
                    ?>
                </form>

            </div>
            <div class="col">
                <h2 class="text-center">LISTA DE MARCAS</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">PAIS DE ORIGEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = conectar();
                        $sql = "SELECT * FROM marca";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>" . $row['ID_MARCA'] . "</td>";
                                echo "<td>" . $row['NOMBRE_MARCA'] . "</td>";
                                echo "<td>" . $row['PAIS_ORIGEN'] . "</td>";
                                echo "</tr>";
                            }
                        }else{
                            echo "no hay registros";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>

<?php

if(isset($_POST['btnActualizar'])){
    $codigo = $_POST['txtCodigo'];
    $nombre = $_POST['txtNombreMarca'];
    $pais = $_POST['txtPais'];
    $conn = conectar();
    $sql = "UPDATE marca SET NOMBRE_MARCA = '$nombre', PAIS_ORIGEN = '$pais' WHERE ID_MARCA = $codigo";
    if($conn->query($sql) === TRUE){
        echo '<div class="text-bg-success text-center my-2 w-50" role="alert">Registro actualizado exitosamente!</div>';
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if(isset($_POST['btnEliminar'])){
    $codigo = $_POST['txtCodigo'];
    $conn = conectar();
    $sql = "DELETE FROM marca WHERE ID_MARCA = $codigo";
    if($conn->query($sql) === TRUE){
        echo '<div class="text-bg-success text-center my-2 w-50" role="alert">Registro Eliminado exitosamente!</div>';
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>