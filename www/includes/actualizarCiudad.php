<?php
  include('../conexion.php');
  $con=conectar();

  $idCiudad=$_POST['idCiudad'];
  $nombreCiudad = $_POST['nombreCiudad'];

$sql="UPDATE ciudades SET nombreCiudad='$nombreCiudad' WHERE idCiudad = '$idCiudad'";
$query=mysqli_query($con, $sql);
    if($query){
        Header("Location: ../vistas/mostrarCiudades.php");
    }
?>
