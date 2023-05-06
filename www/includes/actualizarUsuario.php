<?php
  include('../conexion.php');
  $con=conectar();

  $idUsuario=$_POST['idUsuario'];
  $nombreUsuario=$_POST['nombreUsuario'];
  $cargo=$_POST['cargo'];
  $correo=$_POST['correo'];
  if (isset($_POST['alertas'])) {
    $alertas = 1;
  } else {
    $alertas = 0;
  }

$sql = "UPDATE usuarios SET nombreUsuario='$nombreUsuario', cargo='$cargo', correo='$correo', recibe_alertas=$alertas WHERE idUsuario = '$idUsuario'";

$query=mysqli_query($con,$sql);
    if($query){
        Header("Location: ../vistas/mostrarUsuarios.php");
    }
?>
