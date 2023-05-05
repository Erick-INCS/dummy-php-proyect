<?php
  include('../conexion.php');
  $con=conectar();

  $idCiudad=$_GET['idCiudad'];

  $sql="DELETE FROM ciudades  WHERE idCiudad='$idCiudad'";
  $query=mysqli_query($con,$sql);

  if($query){
      Header("Location: ../vistas/mostrarCiudades.php");
  }
?>
