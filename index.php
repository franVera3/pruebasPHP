<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Insertar datos</title>
</head>

<body>
    <div id="main-container">
        <form action="index.php" method="post">
            <input type="text" name="texto" id="texto">
            <input type="submit" value="añadir pendiente">
        </form>
        <div id="mostrar-todo-container">
            <form action="index.php" id="formMostrarTodo" method="POST">
                <input type="checkbox" name="mostrar-todo" onchange="mostrarTodo(this)">Mostrar todo
            </form>
        </div>

        <div id="todolist">
            <?php
            $servidor = "localhost";
            $nombreusuario = "root";
            $password = "1234";
            $db = "todoListDB";

            $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

            if ($conexion->connect_error) {
                die("Conexion fallida: " . $conexion->connect_error);
            }
            //Valida que ingresaron datos
            if (isset($_POST['texto'])) {
                $texto = $_POST['texto'];

                $sql = "INSERT INTO todoTable(texto,completado) VALUES('$texto',false)";

                if ($conexion->query($sql) === true) {
                    //echo'<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
                } else {
                    die("Error al insertar datos: " . $conexion->error);
                }
            } elseif (isset($_POST['completar'])) {
                $id = $_POST['completar'];

                $sql = "UPDATE todoTable SET completado=1 WHERE id=$id";

                if ($conexion->query($sql) === true) {
                    //echo'<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
                } else {
                    die("Error al actualizar datos: " . $conexion->error);
                }
            } elseif (isset(($_POST['eliminar']))) {
                $id = $_POST['eliminar'];

                $sql = "DELETE FROM todoTable WHERE id=$id";

                if ($conexion->query($sql) === true) {
                    //echo'<div><form action=""><input type="checkbox">'.$texto.'</form></div>';
                } else {
                    die("Error al eliminar datos: " . $conexion->error);
                }
            }

            //agarra y muestra los datos de la tabla
            $sql = "SELECT * FROM todoTable WHERE completado=0";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    //var_dump($row);
            ?>
                    <div>
                        <form method="POST" id="form<?php echo $row['id']; ?>">
                            <input name="completar" value="<?php echo $row['id']; ?>" id="<?php echo $row['id']; ?>" type="checkbox" onchange="completarPendiente(this)"><?php echo $row['texto'] ?>
                        </form>
                        <form method="POST" id="form_eliminar_<?php echo $row['id']; ?>" action="index.php">
                            <input type="hidden" name="eliminar" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Eliminar">
                        </form>
                    </div>
            <?php

                }
                //echo $resultado->num_rows;muestra la cantidad de registros
            }
            $conexion->close();
            ?>
        </div>
    </div>

    <script>
        function completarPendiente(e) {
            var id = "form" + e.id;
            var formulario = document.getElementById(id);
            formulario.submit();
        }
    </script>
</body>

</html>


<!--

    /*ejercicio para conectar la base de datos
    $servidor="localhost";
    $nombreusuario="root";
    $password="1234";

    $conexion=new mysqli($servidor,$nombreusuario,$password);

    if ($conexion->connect_error) {
        die("Conexion fallida: " .   $conexion->connect_error);
    }//consultar porque no toma la excepcion y no muestar el mensaje, sera por la version?

    echo "Conexion exitosa...";
    //to do list
    $servidor="localhost";
    $nombreusuario="root";
    $password="1234";
    $db="todoListDB";

    $conexion=new mysqli($servidor,$nombreusuario,$password,$db);

    if($conexion->connect_error){
        die("Conexion fallida: ".$conexion->connect_error);
    }
    
    //crea base de datos
    $sql="CREATE DATABASE todolistDB";//crea la base de datos
    if($conexion->query($sql)===true){
        echo "Base de datos creada correctamente...";
    }else{
        die("Error al crear base de datos: ". mysqli_connect_error());
    }
    
    //crear tabla en la base de datos
    $sql="CREATE TABLE todoTable(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        texto VARCHAR(100) NOT NULL,
        completado BOOLEAN NOT NULL,
        timestamp TIMESTAMP
    )";

    if($conexion->query($sql)===true){
        echo "La tabla se creo correctamente";
    }else{
        die("Error al crear tabla: ".$conexion->error);
    }*/

?>-->