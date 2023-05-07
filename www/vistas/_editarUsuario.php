<div class="d-flex align-items-center justify-content-between mb-4">
    <h5 class="mb-0">Editar usuario</h6>
</div>

<?php
    session_start();
    $user_id = $_SESSION['usuario'];
    include('../conexion.php');
    $conn = conectar();

    $idUsuario=$_GET['idUsuario'];
    $consultaClinicas="SELECT * FROM  usuarios WHERE idUsuario='$idUsuario'";
    $cantidadClinicas=mysqli_query($conn, $consultaClinicas);
    $filaClinica = mysqli_fetch_array($cantidadClinicas);
    // echo var_dump($idUsuario);
?>
<form action="../includes/actualizarUsuario.php" method="post" class="row mt-3">
	<div class="mb-3 col-6">
		<label for="nombreUsuario" class="form-label">Nombre</label>
		<input type="hidden" name="idUsuario" value="<?php echo $filaClinica['idUsuario'] ?>">
		<input type="text" name="nombreUsuario" class="form-control" id="nombreUsuario" value="<?=$filaClinica['nombreUsuario']?>" required>
	</div>

	<div class="mb-3 col-6">
		<label for="cargo" class="form-label">Cargo</label>
		<select id="cargo" class="form-select" name="cargo" aria-label="Selecciona el tipo de usuario." required>
		<option <?php if (!isset($filaClinica['cargo'])) echo 'selected'?> value="">-</option>
		<option <?php if ($filaClinica['cargo']=='Administrador') echo 'selected'?>>Administrador</option>
		<option <?php if ($filaClinica['cargo']=='Pasante') echo 'selected'?> >Pasante</option>
		<option <?php if ($filaClinica['cargo']=='Médico') echo 'selected'?> >Médico</option>
		</select>
	</div>

	<div class="mb-3 col-6">
		<label for="correo" class="form-label">Correo</label>
		<input type="email" name="correo" class="form-control" value="<?=$filaClinica['correo']?>" id="correo" required>
	</div>

	<div class="col-6 mt-4">
		<div class="form-check">
			<input class="form-check-input" type="checkbox" value="1" id="alertas" name="alertas" <?php if($filaClinica['recibe_alertas']==1) {echo 'checked';}?>>
			<label class="form-check-label" for="alertas">
				Recibe alertas
			</label>
		</div>
	</div>

	
	<div class="col-12">
		<button type="submit" class="btn btn-primary">Guardar</button>
		<a href="mostrarUsuarios.php" class="btn btn-secondary">Cancelar</a>
		<?php if ($filaClinica['idUsuario'] != 1) { ?>
			<a href="../includes/eliminarUsuario.php?idUsuario=<?=$filaClinica['idUsuario']?>" class="btn btn-danger">Eliminar</a>
		<?php } ?>
	</div>
</form>