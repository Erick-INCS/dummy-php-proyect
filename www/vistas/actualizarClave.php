<?php
session_start();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="../css/login.css">
<title>Actualizar clave</title>
<div class="login-page-ext">
<div class="form form-ext">
	<div class="imagen"></div>
	<h4>Actualiza tu clave</h4>
	<br>
	<?php
		$login_msg = $_SESSION['err_upd'];
		if (isset($login_msg)) { ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<?=$login_msg?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php
		}?>
	<div id="pass_linter_container"></div>
	<form class="login-form" action="../includes/actualizarClave.php" method="post">
	<input name="old_key" id="old_key" type="password" placeholder="Nueva clave" required/>
	<input name="new_key" type="password" placeholder="Repetir nueva clave" required/>
	<input name="email" type="hidden" value="<?=$_SESSION['correo']?>"/>
	<input name="pass" type="hidden" value="<?=$_SESSION['pass']?>"/>
	<button class="login">Actualizar</button>
	</form>
</div>
</div>

<script type="text/javascript" src="../js/pass_validator.js"></script>