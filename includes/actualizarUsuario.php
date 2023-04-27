<?php
  include('../conexion.php');
  $con=conectar();

  $idUsuario=$_POST['idUsuario'];
  $nombreUsuario=$_POST['nombreUsuario'];
  $cargo=$_POST['cargo'];
  $correo=$_POST['correo'];


$sql = "UPDATE usuarios SET nombreUsuario='$nombreUsuario', cargo='$cargo', correo='$correo' WHERE idUsuario = '$idUsuario'";

$query=mysqli_query($con,$sql);
    if($query){
        Header("Location: ../vistas/mostrarUsuarios.php");
    }
?>
