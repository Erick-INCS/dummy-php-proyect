<?php
  include('../conexion.php');
  $con=conectar();

  $idClinica=$_GET['idClinica'];
  $idMedicamento=$_GET['idMedicamento'];

  $sql="DELETE FROM clinicatienemedicamento  WHERE idClinica='$idClinica' AND idMedicamento ='$idMedicamento'";
  $query=mysqli_query($con,$sql);
  $sqldos="DELETE FROM medicamentos  WHERE idMedicamento='$idMedicamento'";
  $querydos=mysqli_query($con,$sqldos);

  if($query){
      Header("Location: ../vistas/mostrarMedicamentos.php");
  }
?>
