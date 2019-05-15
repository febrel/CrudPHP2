<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/estilos.css">

<title>Servicios</title>
</head>
<body>

  <br>
    <div id="main-container">
    <a href="nuevo_prod1.php"> <button type="button" class="btnNuevo">Nuevo</button> </a> 
  	    <table id="customers">
  		      <thead>
              <tr>
  			        <th>No</th>
  			        <th>ID</th>
  			        <th>Producto</th>
  			        <th>Descripcion</th>
                <th>Foto</th>
                <th>Accion 1</th>
                <th>Accion 2</th>
            </tr>
  		        </thead>

      <?php
        include "conexion.php";
        $sentecia="SELECT * FROM productos";
        $resultado= $conexion->query($sentecia) or die (mysqli_error($conexion));
        while($fila=$resultado->fetch_assoc())
        {
          echo "<tr>";
            echo "<td>"; echo $fila['no']; echo "</td>";
            echo "<td>"; echo $fila['id_producto']; echo "</td>";
            echo "<td>"; echo $fila['nombre']; echo "</td>";
            echo "<td>"; echo $fila['descripcion']; echo "</td>";
            $direccion = $fila['foto'];
            echo "<td><img src='../MySqli/images/". $direccion ."' border='0' width='200' height='100' /></td>";
            echo "<td><a href='modif_prod1.php?no=".$fila['no']."'> <button type='button' class='btnModificar'>Modificar</button> </a></td>";
            echo " <td><a href='eliminar_prod.php?no=".$fila['no']."'> <button type='button' class='btnEliminar'>Eliminar</button> </a></td>";
          echo "</tr>";
        }
      ?>
  	  </table>
    </div>
        
        <br>

</body>
</html>
