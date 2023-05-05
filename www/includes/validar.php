<?php
  include "../conexion.php";
  $conexion= conectar();

  $user=$_POST['usuario'];
  $pass=$_POST['clave'];

  $consulta = "SELECT idUsuario, expiration_date<=CURRENT_DATE() AS EXPIRED, cargo FROM usuarios where correo='$user' and claveUsuario=MD5('$pass')";
  $resultado=mysqli_query($conexion, $consulta);
  $filas = mysqli_fetch_assoc($resultado);

  if($filas > 0) {
    session_start();
    $_SESSION['usuario']=$filas['idUsuario'];
    $_SESSION['correo']=$user;
    $_SESSION['pass']=$pass;
    $_SESSION['admin']=$filas['cargo'] == 'Administrador';

    if (isset($filas['EXPIRED']) and $filas['EXPIRED'] == 1) {
      header("Location: ../vistas/actualizarClave.php");
    } else {
      header("Location: ../vistas/inicio.php");
    }
  }
  else
  {
      header("Location: ../vistas/iniciarsesion.php?err=" . urlencode("Error al ingresar: Intente de nuevo."));
      exit();
  }
  mysqli_free_result($resultado);
  mysqli_close($conexion);
?>
