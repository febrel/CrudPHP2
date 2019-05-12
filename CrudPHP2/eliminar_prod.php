<?php
EliminarProducto($_GET['no']);

function EliminarProducto($no)

{
	include 'conexion.php';
	$sentencia0 = "SELECT foto FROM productos WHERE no ='" . $no . "' ";
	$resultado_seleccionar = mysqli_query($conexion, $sentencia0);
	//Elimina la foto de base de datos y de imagenes
	$foto_db = mysqli_fetch_array($resultado_seleccionar);
	$ruta_foto_db = "../MySqli/images/" . $foto_db['foto'];

	//Si existe la elimina
	 if (isset($foto_db['foto']) && ( $foto_db['foto'] != "imagen.png")) {
		 	if (file_exists($ruta_foto_db)) {
				if ($empleado["foto"] != "imagen.png") {
						unlink($ruta_foto_db);
				}
	 	}

	 }



	//Procede a borrar base datos
	$sentencia = "DELETE FROM productos WHERE no='" . $no . "' ";
	$conexion->query($sentencia) or die("Error al eliminar" . mysqli_error($conexion));
}
?>

<script type="text/javascript">
	alert("Producto Eliminado!!");
	window.location.href = 'index.php';
</script>
