<?php
  include('../conexion.php');
  $con=conectar();

  $idDosis=$_GET['idDosis'];

  $sql="DELETE FROM dosis  WHERE idDosis='$idDosis'";
  $query=mysqli_query($con,$sql);

  if($query){
      Header("Location: ../vistas/mostrarDosis.php");
  }
?>
