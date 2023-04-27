<?php
  include('../conexion.php');
  $con=conectar();

  $idUsuario=$_GET['idUsuario'];

  $sql="DELETE FROM usuarios  WHERE idUsuario='$idUsuario'";
  $query=mysqli_query($con,$sql);

  if($query){
      Header("Location: ../vistas/mostrarUsuarios.php");
  }
?>
