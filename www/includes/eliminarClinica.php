<?php
  include('../conexion.php');
  $con=conectar();

  $idClinica=$_GET['idClinica'];

  $sql="DELETE FROM clinicas  WHERE idClinica='$idClinica'";
  $query=mysqli_query($con,$sql);

  if($query){
      Header("Location: ../vistas/mostrarClinicas.php");
  }
?>
