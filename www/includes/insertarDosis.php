<?php
    include('../conexion.php');
    $con = conectar();

    $nombreDosis = $_POST['nombreDosis'];

    $sql = "INSERT INTO dosis VALUES(DEFAULT,'$nombreDosis')";
    $query = mysqli_query($con,$sql);

    if($query){
        header("Location: ../vistas/mostrarDosis.php");
    }
?>
