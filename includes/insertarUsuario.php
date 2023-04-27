<?php
    include('../conexion.php');
    $con = conectar();

    $nombreUsuario = $_POST['nombreUsuario'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];

    $sql = "INSERT INTO usuarios(nombreUsuario, correo, cargo, expiration_date) VALUES('$nombreUsuario','$correo', '$cargo', DATE_ADD(CURRENT_DATE(), INTERVAL 1 MONTH))";
    $query = mysqli_query($con,$sql);

    if($query){
        header("Location: ../vistas/mostrarUsuarios.php");
    }
?>
