<?php
  include('../conexion.php');
  $con=conectar();

  $idPresentacion=$_GET['idPresentacion'];

  $sql="DELETE FROM presentacion  WHERE idPresentacion='$idPresentacion'";
  $query=mysqli_query($con,$sql);

  if($query){
      Header("Location: ../vistas/mostrarPresentacion.php");
  }
?>
