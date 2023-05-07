<?php
session_start();

if(!isset($_SESSION['usuario'])){
  ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="../css/login.css">
<title>Recuperar clave</title>
<div class="login-page">
  <div class="form">
      <div class="imagen"></div>
      <h4>Recuperar clave</h4>
      <br>
    <form class="login-form" action="../includes/recuperarClave.php" method="post">
      <input name="usuario" type="email" placeholder="Correo electrónico" required/>
      <button class="login">Enviar clave</button>
    </form>
  </div>
</div>
<?php
}
else
{
  header("Location: ../vistas/inicio.php");
}
?>
