<?php
  include "conexion.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/estilos.css">
<title>Nuevos Servicios</title>
<script src="ckeditor/ckeditor.js"></script>

</head>
<body>


	<h3 class="titulo">Nuevo Servicio</h3> 
  	<div id="main-container">
	  	<form action="nuevo_prod2.php" method="POST" enctype="multipart/form-data"">
  		
		<label>Id Producto</label>
  		<input type="text" id="id_producto" name="id_producto" placeholder="Id Producto"><br>

  		<label>Producto: </label>
  		<input type="text" id="producto" name="producto"  placeholder="Producto"><br>

  		<label>Descripcion: </label>
		<textarea  id="descripcion" style="border-radius: 10px;" rows="3" cols="50" name="descripcion" ></textarea><br>

		<label for="">Foto:</label>

		<input type="file" class="form-control" accept="image/*" name="foto" id="foto">

		<br>

  		<input type="submit" value="Guardar">

     </form>

  	</div>


  <br>


<script >

	CKEDITOR.replace('descripcion');
</script>


</body>
</html>
