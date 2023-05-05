<?php
    include('../conexion.php');
    $con = conectar();

    $nombrePresentacion = $_POST['nombrePresentacion'];

    $sql = "INSERT INTO presentacion VALUES(DEFAULT,'$nombrePresentacion')";
    $query = mysqli_query($con,$sql);

    if($query){
        header("Location: ../vistas/mostrarPresentacion.php");
    }
?>
