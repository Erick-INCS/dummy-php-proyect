<?php
  include "../conexion.php";
  include('mail.php');

  $conexion=conectar();

  $user=$_POST['usuario'];

  $consulta = "SELECT claveUsuario FROM usuarios where correo='$user'";
  $resultado=mysqli_query($conexion, $consulta);
  $filas = mysqli_fetch_assoc($resultado);
  
  if($filas>0)
  {
    $tmp_pass = $filas['claveUsuario'];
    $consulta = "UPDATE usuarios SET claveUsuario=MD5('$tmp_pass'), expiration_date = CURRENT_DATE() where correo='$user'";
    mysqli_query($conexion,$consulta);
  }
  else
  {
    Header("Location: ../vistas/iniciarsesion.php?err=" . urldecode("El correo no se encuentra registrado."));
    exit();
  }

  mysqli_free_result($resultado);
  mysqli_close($conexion);

  $target_mail = $user;
  $subject = "Recuperación de acceso";
  $body = "Hola usuario, a continuación te compartimos tu clave de acceso temporal: " . $tmp_pass;

  send_mail(
      $user,
      $subject,
      $body
    );
    Header("Location: ../vistas/iniciarsesion.php?msg=" . urldecode("Favor de revisar su correo para recuperar la clave."));
?>
