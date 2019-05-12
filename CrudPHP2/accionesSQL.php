<?php
//Recibo accion de boton
$accion = $_POST["accion"];

switch ($accion) {
    case "guardar":
    ModificarProducto($_POST['no'], $_POST['id_producto'], $_POST['producto'], $_POST['descripcion']);

        function ModificarProducto($no, $id_prod, $nom, $descrip)
        {
            include 'conexion.php';
            echo $sentencia = "UPDATE productos SET id_producto='" . $id_prod . "', nombre='" . $nom . "', descripcion='" . $descrip . "' WHERE no='" . $no . "' ";
            $conexion->query($sentencia) or die("Error al actualizar datos" . mysqli_error($conexion));
            window . location . href = 'index.php';
        }

        break;
}
