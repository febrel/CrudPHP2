<?php 
    //Validamos si llega información, if ternario
$txtId = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtApellido = (isset($_POST['txtApellido'])) ? $_POST['txtApellido'] : "";
$txtCorreo = (isset($_POST['txtCorreo'])) ? $_POST['txtCorreo'] : "";
//Ingreso tipo file
$txtFoto = (isset($_FILES['txtFoto']["name"])) ? $_FILES['txtFoto']["name"] : "";

//Recibo accion de boton
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

//Variables para botones
$accionAgregar = "";
$accionModificar =$accionEliminar=$accionCancelar ="disabled";
$mostrarModal = false;


include("../dll/conexion.php");

switch ($accion) {

    case "btnAgregar":
        $sentencia = $pdo->prepare("INSERT INTO empleados(nombre,apellido,correo,foto) VALUES (:nombre,:apellido,:correo,:foto)");
        $sentencia->bindParam(':nombre', $txtNombre);
        $sentencia->bindParam(':apellido', $txtApellido);
        $sentencia->bindParam(':correo', $txtCorreo);

        //Para la administracion de foto utilizo fecha para controlar poblema nombre, te agrega un nuevo nombre con fecha y si no te deja el por defecto
        $fecha = new DateTime();
        //Validar foto, sea diferente de vacios, y se concantena _ con la fecha
        //Si hay una foto real concatenas la fecha y su nombre, de lo contrario conserva el valor de foto por defecto
        $nombreArchivo = ($txtFoto != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtFoto"]["name"] : "imagen.png";
        //Nombre que php devulve cuando se selecione
        $tmpFoto = $_FILES["txtFoto"]["tmp_name"];

        if ($tmpFoto != "") {
            //Copia al servidor junto con el nombre del archivo
            move_uploaded_file($tmpFoto, "../img/" . $nombreArchivo);
        }

        $sentencia->bindParam(':foto', $nombreArchivo);
        $sentencia->execute();

        header("Location: index.php");

        break;

    case "btnModificar":
        $sentencia = $pdo->prepare(" UPDATE empleados SET nombre =:nombre, apellido =:apellido, correo=:correo WHERE id_empreado =:id_empreado");
        $sentencia->bindParam(':nombre', $txtNombre);
        $sentencia->bindParam(':apellido', $txtApellido);
        $sentencia->bindParam(':correo', $txtCorreo);
        $sentencia->bindParam(':id_empreado', $txtId);
        $sentencia->execute();

        //Para actualizar la foto, volvemos a actualizar el mismo script

        //Para la administracion de foto utilizo fecha para controlar poblema nombre, te agrega un nuevo nombre con fecha y si no te deja el por defecto
        $fecha = new DateTime();
        //Validar foto, sea diferente de vacios, y se concantena _ con la fecha
        //Si hay una foto real concatenas la fecha y su nombre, de lo contrario conserva el valor de foto por defecto
        $nombreArchivo = ($txtFoto != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtFoto"]["name"] : "imagen.png";
        //Nombre que php devulve cuando se selecione
        $tmpFoto = $_FILES["txtFoto"]["tmp_name"];

        if ($tmpFoto != "") {
            //Copia al servidor junto con el nombre del archivo
            move_uploaded_file($tmpFoto, "../img/" . $nombreArchivo);


            //Realizo una eliminacion de foto, por eso vuelvo a poner el codigo

            $sentencia = $pdo->prepare(" SELECT foto FROM empleados WHERE id_empreado =:id_empreado");
            $sentencia->bindParam(':id_empreado', $txtId);
            $sentencia->execute();

            //Devuelve dato de la tabla seleccionada
            $empleado = $sentencia->fetch(PDO::FETCH_LAZY);
            print_r($empleado);

            //Si existe varibale fotografia
            if (isset($empleado["foto"])) {

                //Verifica que existe en la carptea imagenes
                if (file_exists("../img/" . $empleado["foto"])) {
                    unlink("../img/" . $empleado["foto"]);
                }
            }

            $sentencia = $pdo->prepare(" UPDATE empleados SET  foto=:foto WHERE id_empreado =:id_empreado");
            $sentencia->bindParam(':foto', $nombreArchivo);
            $sentencia->bindParam(':id_empreado', $txtId);
            $sentencia->execute();
        }

        header("Location:index.php");



        break;

    case "btnEliminar":
        $sentencia = $pdo->prepare(" SELECT foto FROM empleados WHERE id_empreado =:id_empreado");
        $sentencia->bindParam(':id_empreado', $txtId);
        $sentencia->execute();

        //Devuelve dato de la tabla seleccionada
        $empleado = $sentencia->fetch(PDO::FETCH_LAZY);
        print_r($empleado);

        //Si existe varibale fotografia, y no es la de por defecto
        if (isset($empleado["foto"]) && ($empleado["foto"] != "imagen.png")) {

            //Verifica que existe en la carptea imagenes
            if (file_exists("../img/" . $empleado["foto"])) {

                if ($empleado["foto"] != "imagen.png") {
                    unlink("../img/" . $empleado["foto"]);
                }
            }
        }


        $sentencia = $pdo->prepare(" DELETE FROM empleados WHERE id_empreado =:id_empreado");
        $sentencia->bindParam(':id_empreado', $txtId);
        $sentencia->execute();
        header("Location: index.php");


        break;

    case "btnCancelar":
        header("Location: index.php");
        break;

    case "Seleccionar":
        //Variables para botones
        $mostrarModal = true;
        $accionAgregar = "disabled";
        $accionModificar = $accionEliminar = $accionCancelar = "";

        $sentencia = $pdo->prepare(" SELECT foto FROM empleados WHERE id_empreado =:id_empreado");
        $sentencia->bindParam(':id_empreado', $txtId);
        $sentencia->execute();

        //Devuelve dato de la tabla seleccionada
        $empleado = $sentencia->fetch(PDO::FETCH_LAZY);
        break;
}

$sentencia = $pdo->prepare("SELECT * FROM empleados WHERE 1");
$sentencia->execute();
//Guarda en un arreglo todo lo que ejecuta la base datos
$listaEmpleados  = $sentencia->fetchall(PDO::FETCH_ASSOC);

?>
