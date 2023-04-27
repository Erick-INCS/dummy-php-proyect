<?php
    include('../conexion.php');
    $con = conectar();

    $nombreClinica = $_POST['nombreClinica'];
    $ciudadClinica = $_POST['ciudadClinica'];
    if($_POST['donacionClinica']==1){
      $donacionClinica = 1;
    }
    elseif($_POST['donacionClinica']==2){
      $donacionClinica = 2;
    }
    $direccionClinica = $_POST['direccionClinica'];
    //VER ESTO DESPUES
    $sql = "INSERT INTO clinicas VALUES(DEFAULT,'$nombreClinica','$direccionClinica','$donacionClinica','$ciudadClinica')";
    $query = mysqli_query($con,$sql);

    if($query){
        header("Location: ../vistas/mostrarClinicas.php");
    }
?>
