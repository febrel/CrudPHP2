<?php

  $consulta=ConsultarProducto($_GET['no']);

  function ConsultarProducto( $no_prod )
  {
   include 'conexion.php';
   $sentencia="SELECT * FROM productos WHERE no='".$no_prod."' ";
   $resultado= $conexion->query($sentencia) or die ("Error al consultar producto".mysqli_error($conexion));
   $fila=$resultado->fetch_assoc();

   return [
    $fila['id_producto'],
    $fila['nombre'],
    $fila['descripcion']
   ];
  }
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/estilos.css">
<script src="ckeditor/ckeditor.js"></script>
<title>Modificar Servicio</title>

</head>
<body>


  	<img src="images/swirl.jpg">


  <div id="main-container">
  
  		 <h3>Modificar Producto</h3> 
  	<br>
	  <form action="modif_prod2.php" enctype="multipart/form-data" method="POST>
      <input type="hidden" name="no"  value="<?php echo $_GET['no']?>">

      <label>Id Producto: </label>
  		<input type="text" id="id_producto" name="id_producto" placeholder="Id Producto"  value="<?php echo $consulta[0] ?>"><br>

  		<label>Producto: </label>
  		<input type="text" id="producto" name="producto" placeholder="Producto" value="<?php echo $consulta[1] ?>" ><br>

  		<label>Descripcion: </label>
			<textarea id="descripcion" style="border-radius: 10px;" rows="3" cols="50" name="descripcion"> <?php echo $consulta[2] ?>  </textarea><br>

		<label for="">Foto:</label>

		<input type="file" class="form-control" accept="image/*" name="foto" id="foto" value="<?php echo $consulta[3] ?>">



  		<br>
      <input type="submit" value="Modificar">
     </form>
  	</div>

    <br>



  		<img src="images/swirl.jpg" id="img2">



<script >

	CKEDITOR.replace('descripcion');
</script>


</body>
</html>
