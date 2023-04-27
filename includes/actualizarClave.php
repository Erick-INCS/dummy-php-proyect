<?php
  include "../conexion.php";
  
  $correo = $_POST['email'];
  $pass = $_POST['pass'];
  $old_key = $_POST['old_key'];
  $new_key = $_POST['new_key'];
  
  if (!($old_key == $new_key)) {
    session_start();
    $_SESSION['err_upd'] = 'Las contraseñas no coinciden';
    header("Location: ../vistas/actualizarClave.php");
  }
  else {
    $conexion=conectar();
    $consulta = "UPDATE usuarios SET claveUsuario = MD5('$new_key'), expiration_date = DATE_ADD(expiration_date, INTERVAL 2 MONTH) where correo='$correo' and claveUsuario = MD5('$pass')";

    $resultado=mysqli_query($conexion, $consulta);
    $filas = mysqli_fetch_assoc($resultado);

    // $resultado=mysqli_query($conexion, $consulta);
    // $filas = mysqli_fetch_assoc($resultado);
    mysqli_free_result($resultado);
    mysqli_close($conexion);

    header("Location: ../vistas/inicio.php");
    exit();
  }
    ?>
    <?php 
?>
