<?php
  include "../conexion.php";
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
    echo "ERROR EN BASE DE DATOS";
    exit();
  }

  mysqli_free_result($resultado);
  mysqli_close($conexion);

  $target_mail = $user;
  $subject = "Recuperación de acceso";
  $body = "Hola usuario, a continuación te compartimos tu clave de acceso temporal: " . $tmp_pass;

  if (!isset($config['sendmail_from'])) {
    ?>
      <p>El correo electonico no se encuentra configurado, el contenido de esta página muestra lo que se estaría enviando vía correo:</p>
      <br>
      <h3><?=$subject?></h3>
      <p>Email to: <?=$target_mail?></h>
      <p><?=$body?></h>
      <br>
      <br>
      <br>
      <a href="../vistas/iniciarsesion.php?msg=<?=urldecode("Favor de revisar su correo para recuperar la clave.")?>">Click aquí para continuar</a>
    <?php 
  } else {
    mail(
      $user,
      $subject,
      $body
    );
  }
?>
