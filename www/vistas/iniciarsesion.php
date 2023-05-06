<?php
session_start();

if(!isset($_SESSION['usuario'])){
  ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/login.css">
<title>Inicio de sesion</title>
<div class="login-page">
  <div class="form">
      <div class="imagen"></div>
      <?php
        $login_error = $_GET['err'];
        $login_msg = $_GET['msg'];
        if (isset($login_error)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?=$login_error?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php
        }
        if (isset($login_msg)) { ?>
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <?=$login_msg?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
        }
      ?>
    <form class="login-form" action="../includes/validar.php" method="post">
      <input name="usuario" type="email" placeholder="Correo electrónico" required/>
      <input name="clave" type="password" placeholder="Clave de usuario" required/>
      <button class="login">login</button>
    </form>
    <a href="recuperarClave.php">¿Olvidaste tu contraseña?</a>
  </div>
</div>
<?php
}
else
{
  header("Location: ../vistas/inicio.php");
}
?>
