<?php
  include('../conexion.php');
  $con=conectar();

  $idPresentacion=$_POST['idPresentacion'];
  $nombrePresentacion=$_POST['nombrePresentacion'];

$sql="UPDATE presentacion SET nombrePresentacion='$nombrePresentacion' WHERE idPresentacion = '$idPresentacion'";
$query=mysqli_query($con,$sql);
    if($query){
        Header("Location: ../vistas/mostrarPresentacion.php");
    }
?>
