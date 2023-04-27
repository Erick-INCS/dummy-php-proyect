<?php
    include('../conexion.php');
    $con = conectar();

    $nombreCiudad = $_POST['nombreCiudad'];

    $sql = "INSERT INTO ciudades VALUES(DEFAULT,'$nombreCiudad')";
    $query = mysqli_query($con,$sql);

    if($query){
        header("Location: ../vistas/mostrarCiudades.php");
    }
?>
