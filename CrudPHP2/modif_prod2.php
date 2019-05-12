<?php

	ModificarProducto($_POST['no'], $_POST['id_producto'], $_POST['producto'], $_POST['descripcion'], $_FILES['foto']["name"]);

	function ModificarProducto($no, $id, $nom, $descrip, $foto)
	{
		include 'conexion.php';

		//Para la administracion de foto utilizo fecha para controlar poblema nombre, te agrega un nuevo nombre con fecha y si no te deja el por defecto
        $fecha = new DateTime();
        //Validar foto, sea diferente de vacios, y se concantena _ con la fecha
        //Si hay una foto real concatenas la fecha y su nombre, de lo contrario conserva el valor de foto por defecto
        $nombreArchivo = ($foto != "") ? $fecha->getTimestamp() . "_" . $_FILES["foto"]["name"] : "imagen.png";
        //Nombre que php devulve cuando se selecione
        $tmpFoto = $_FILES["foto"]["tmp_name"];

        if ($tmpFoto != "") {
            //Copia al servidor junto con el nombre del archivo
            move_uploaded_file($tmpFoto, "../MySqli/images/".$nombreArchivo);
        }

				//Eliminar la foto
				$sentencia0 = "SELECT foto FROM productos WHERE no ='" . $no . "' ";
				$resultado_seleccionar = mysqli_query($conexion, $sentencia0);
				$foto_db = mysqli_fetch_array($resultado_seleccionar);
				$ruta_foto_db = "../MySqli/images/" . $foto_db['foto'];

				//Si existe varibale fotografia
            if (isset($foto_db["foto"])) {
                //Verifica que existe en la carptea imagenes
                if (file_exists($ruta_foto_db)) {
                    unlink($ruta_foto_db);
                }
        }


		$sentencia="UPDATE productos SET id_producto='".$id."', nombre='".$nom."', descripcion='".$descrip."', foto='".$nombreArchivo."' WHERE no='".$no."' ";
		$conexion->query($sentencia) or die ("Error al actualizar datos".mysqli_error($conexion));
	}
?>

<script type="text/javascript">
	alert("Datos Actualizados Exitosamante!!");
	window.location.href='index.php';
</script>
