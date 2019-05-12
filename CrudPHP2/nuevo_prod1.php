<?php
  include "conexion.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alta de Producto</title>
<style type="text/css">
@import url("css/mycss.css");
</style>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="todo">

  <div id="cabecera">
  	<img src="images/swirl.png" width="1188" id="img1">
  </div>

  <div id="contenido">
  	<div style="margin: auto; width: 800px; border-collapse: separate; border-spacing: 10px 5px;">
  		<span> <h1>Alta de Nuevo Producto</h1> </span>
  		<br>
	  <form action="nuevo_prod2.php" method="POST" enctype="multipart/form-data" style="border-collapse: separate; border-spacing: 10px 5px;">
  		<label>Id Producto: </label>
  		<input type="text" id="id_producto" name="id_producto"><br>

  		<label>Producto: </label>
  		<input type="text" id="producto" name="producto" ><br>

  		<label>Descripcion: </label>
		<textarea style="border-radius: 10px;" rows="3" cols="50" name="descripcion" ></textarea><br>

		<label for="">Foto:</label>

		<input type="file" class="form-control" accept="image/*" name="foto" id="foto">


  		<br>
  		<button type="submit" class="btn btn-success">Guardar</button>
     </form>
  	</div>

  </div>

	<div id="footer">
  		<img src="images/swirl2.png" id="img2">
  	</div>

</div>


</body>
</html>
