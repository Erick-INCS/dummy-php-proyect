<?php
  include('../conexion.php');
  $con=conectar();

  $idDosis=$_POST['idDosis'];
  $nombreDosis=$_POST['nombreDosis'];

$sql="UPDATE dosis SET nombreDosis='$nombreDosis' WHERE idDosis = '$idDosis'";
$query=mysqli_query($con,$sql);
    if($query){
        Header("Location: ../vistas/mostrarDosis.php");
    }
?>
