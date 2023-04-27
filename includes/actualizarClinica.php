<?php
  include('../conexion.php');
  $con=conectar();

  $idClinica=$_POST['idClinica'];
  $nombreClinica=$_POST['nombreClinica'];
  $ciudadClinica=$_POST['ciudadClinica'];
  $donacionClinica=$_POST['donacionClinica'];
  $direccionClinica=$_POST['direccionClinica'];

$sql="UPDATE clinicas SET nombreClinica='$nombreClinica', idCiudad = '$ciudadClinica', donacionClinica = '$donacionClinica', direccionClinica='$direccionClinica' WHERE idClinica = '$idClinica'";
$query=mysqli_query($con,$sql);
    if($query){
        Header("Location: ../vistas/mostrarClinicas.php");
    }
?>
