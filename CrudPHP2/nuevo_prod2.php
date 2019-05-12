<?php
	NuevoProducto($_POST['id_producto'], $_POST['producto'], $_POST['descripcion'], $_FILES['foto']["name"]);

	function NuevoProducto($id, $nom, $descrip, $foto){

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


		include 'conexion.php';
		$sentencia= "INSERT INTO productos (id_producto, nombre, descripcion, foto) VALUES ('".$id."','".$nom."', '".$descrip."','".$nombreArchivo."') ";
		$conexion->query($sentencia) or die ("Error al ingresar los datos".mysqli_error($conexion));
	}
	
?>

<script type="text/javascript">
	alert("Producto Ingresado Exitosamante!!");
	window.location.href='index.php';
</script>
